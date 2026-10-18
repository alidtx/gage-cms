<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;

class ArticleHtml
{
    public function clean(string $html): string
    {
        $document = new DOMDocument;
        $previous = libxml_use_internal_errors(true);
        try {
            $document->loadHTML('<?xml encoding="UTF-8"><div>'.$html.'</div>', LIBXML_NONET);
            $body = $document->getElementsByTagName('body')->item(0);
            if (! $body) {
                return '';
            }
            $this->cleanChildren($body);

            return implode('', array_map(fn ($node) => $document->saveHTML($node), iterator_to_array($body->childNodes)));
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }

    private function cleanChildren(DOMNode $parent): void
    {
        $allowed = ['div', 'span', 'p', 'br', 'h2', 'h3', 'h4', 'h5', 'h6', 'strong', 'b', 'em', 'i', 'u', 's', 'ul', 'ol', 'li', 'blockquote', 'pre', 'code', 'a', 'img', 'table', 'thead', 'tbody', 'tr', 'th', 'td', 'hr'];
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if (! $node instanceof DOMElement) {
                continue;
            }
            if (strtolower($node->tagName) === 'h1') {
                $heading = $node->ownerDocument->createElement('h2');
                while ($node->firstChild) {
                    $heading->appendChild($node->firstChild);
                }
                $parent->replaceChild($heading, $node);
                $node = $heading;
            }
            if (! in_array(strtolower($node->tagName), $allowed, true)) {
                $parent->removeChild($node);

                continue;
            }
            foreach (iterator_to_array($node->attributes) as $attribute) {
                $name = strtolower($attribute->name);
                $value = trim($attribute->value);
                $url = in_array($name, ['href', 'src'], true)
                    && (($node->tagName === 'a' && $name === 'href') || ($node->tagName === 'img' && $name === 'src'))
                    && (preg_match('~^https?://~i', $value) || preg_match('~^/(?!/)~', $value))
                    && ! preg_match('/[\x00-\x20\x7f]/', $value);
                if (! $url && ! ($node->tagName === 'img' && $name === 'alt')) {
                    $node->removeAttribute($attribute->name);
                }
            }
            $this->cleanChildren($node);
        }
    }
}
