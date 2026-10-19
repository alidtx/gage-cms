<?php

namespace App\Services;

use App\Models\SocialLink;

class FrontendSocialLinks
{
    /** @var array<string, array{label: string, url: string}>|null */
    private ?array $links = null;

    /** @return array<string, array{label: string, url: string}> */
    public function all(): array
    {
        if ($this->links !== null) {
            return $this->links;
        }
        $settings = SocialLink::orderBy('id')->first();
        $this->links = [];
        foreach (['linkedin' => 'LinkedIn', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'whatsapp' => 'WhatsApp'] as $platform => $label) {
            $url = trim((string) $settings?->$platform);
            if (! filter_var($url, FILTER_VALIDATE_URL) || ! in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
                continue;
            }
            $this->links[$platform] = ['label' => $label, 'url' => $url];
        }

        return $this->links;
    }
}
