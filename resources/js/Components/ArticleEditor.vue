<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import Image from '@tiptap/extension-image';
import { TableKit } from '@tiptap/extension-table';

const props = defineProps({
    modelValue: { type: String, default: '' },
    disabled: { type: Boolean, default: false },
});
const emit = defineEmits(['update:modelValue', 'uploading']);
const imageInput = ref(null);
const uploading = ref(false);
const uploadError = ref('');
const editor = useEditor({
    content: props.modelValue,
    editable: !props.disabled,
    extensions: [
        StarterKit.configure({ link: { openOnClick: false, defaultProtocol: 'https://' } }),
        Placeholder.configure({ placeholder: 'Write the full article content here...' }),
        Image,
        TableKit,
    ],
    editorProps: {
        attributes: { 'aria-labelledby': 'news-content-label', 'aria-required': 'true', role: 'textbox', 'aria-multiline': 'true' },
    },
    onUpdate: ({ editor }) => emit('update:modelValue', editor.isEmpty ? '' : editor.getHTML()),
});

watch(() => props.modelValue, value => {
    if (editor.value && value !== editor.value.getHTML()) {
        editor.value.commands.setContent(value || '', { emitUpdate: false });
    }
});
watch(() => props.disabled, disabled => editor.value?.setEditable(!disabled));

const buttons = [
    { label: 'Bold', icon: 'bold', command: 'toggleBold', active: 'bold' },
    { label: 'Italic', icon: 'italic', command: 'toggleItalic', active: 'italic' },
    { label: 'Underline', icon: 'underline', command: 'toggleUnderline', active: 'underline' },
    { label: 'Strikethrough', icon: 'strikethrough', command: 'toggleStrike', active: 'strike' },
    { label: 'Bullet list', icon: 'list-ul', command: 'toggleBulletList', active: 'bulletList' },
    { label: 'Numbered list', icon: 'list-ol', command: 'toggleOrderedList', active: 'orderedList' },
    { label: 'Quote', icon: 'quote-right', command: 'toggleBlockquote', active: 'blockquote' },
    { label: 'Code block', icon: 'code', command: 'toggleCodeBlock', active: 'codeBlock' },
];
function setHeading(event) {
    const level = Number(event.target.value);
    if (level) editor.value.chain().focus().setHeading({ level }).run();
    else editor.value.chain().focus().setParagraph().run();
}
function setLink() {
    const value = window.prompt('Link URL (leave empty to remove)', editor.value.getAttributes('link').href || 'https://');
    if (value === null) return;
    if (!value.trim()) {
        editor.value.chain().focus().extendMarkRange('link').unsetLink().run();
        return;
    }
    try {
        const url = new URL(value.trim());
        if (!['http:', 'https:', 'mailto:'].includes(url.protocol)) throw new Error();
        editor.value.chain().focus().extendMarkRange('link').setLink({ href: url.href }).run();
    } catch {
        window.alert('Enter a valid http, https, or mailto link.');
    }
}
async function uploadImage(event) {
    const file = event.target.files?.[0];
    event.target.value = '';
    if (!file || uploading.value || props.disabled) return;
    uploadError.value = '';
    if (!['image/jpeg', 'image/png', 'image/webp', 'image/gif'].includes(file.type) || file.size > 5 * 1024 * 1024) {
        uploadError.value = 'Choose a JPG, PNG, WebP, or GIF image up to 5 MB.';
        return;
    }
    const position = editor.value.state.selection.from;
    const data = new FormData();
    data.append('image', file);
    uploading.value = true;
    emit('uploading', true);
    try {
        const response = await axios.post(route('backend.news.editor-images.store', {}, false), data);
        if (!editor.value || editor.value.isDestroyed) return;
        editor.value.chain().focus().insertContentAt(position, {
            type: 'image', attrs: { src: response.data.url, alt: file.name },
        }).run();
    } catch (error) {
        uploadError.value = error.response?.data?.errors?.image?.[0] || 'Image upload failed. Please try again.';
    } finally {
        uploading.value = false;
        emit('uploading', false);
    }
}
defineExpose({ editor });
</script>

<template>
    <div class="article-editor border border-gray-200 rounded-xl bg-white overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
        <div v-if="editor" role="group" aria-label="Article formatting" class="flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50 p-2">
            <select aria-label="Text style" :disabled="disabled" :value="editor.isActive('heading') ? editor.getAttributes('heading').level : 0" @change="setHeading" class="rounded-lg border-gray-200 text-sm py-1.5 pr-8">
                <option :value="0">Paragraph</option><option :value="1">Heading 1</option><option :value="2">Heading 2</option><option :value="3">Heading 3</option>
            </select>
            <button v-for="button in buttons" :key="button.command" type="button" :title="button.label" :aria-label="button.label" :aria-pressed="editor.isActive(button.active)" :disabled="disabled" @click="editor.chain().focus()[button.command]().run()" class="editor-button" :class="editor.isActive(button.active) ? 'bg-blue-100 text-blue-700' : 'text-gray-600'">
                <i :class="`fas fa-${button.icon}`" aria-hidden="true"></i>
            </button>
            <button type="button" title="Add or edit link" aria-label="Add or edit link" :aria-pressed="editor.isActive('link')" :disabled="disabled" @click="setLink" class="editor-button text-gray-600"><i class="fas fa-link" aria-hidden="true"></i></button>
            <input ref="imageInput" type="file" accept="image/jpeg,image/png,image/webp,image/gif" hidden @change="uploadImage" />
            <button type="button" title="Upload image" aria-label="Upload image" :disabled="disabled || uploading" @click="imageInput.click()" class="editor-button text-gray-600"><i class="fas fa-image" aria-hidden="true"></i></button>
            <button type="button" title="Insert table" aria-label="Insert table" :disabled="disabled" @click="editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()" class="editor-button text-gray-600"><i class="fas fa-table" aria-hidden="true"></i></button>
            <button type="button" title="Undo" aria-label="Undo" :disabled="disabled || !editor.can().undo()" @click="editor.chain().focus().undo().run()" class="editor-button text-gray-600"><i class="fas fa-undo" aria-hidden="true"></i></button>
            <button type="button" title="Redo" aria-label="Redo" :disabled="disabled || !editor.can().redo()" @click="editor.chain().focus().redo().run()" class="editor-button text-gray-600"><i class="fas fa-redo" aria-hidden="true"></i></button>
            <template v-if="editor.isActive('table')">
                <button type="button" :disabled="disabled" @click="editor.chain().focus().addRowAfter().run()" class="editor-button text-sm">+ Row</button>
                <button type="button" :disabled="disabled" @click="editor.chain().focus().addColumnAfter().run()" class="editor-button text-sm">+ Column</button>
                <button type="button" :disabled="disabled" @click="editor.chain().focus().deleteTable().run()" class="editor-button text-sm text-red-600">Delete table</button>
            </template>
        </div>
        <EditorContent :editor="editor" />
        <p v-if="uploading" role="status" class="px-4 py-2 text-sm text-gray-600">Uploading image...</p>
        <p v-if="uploadError" role="alert" class="px-4 py-2 text-sm text-red-600">{{ uploadError }}</p>
    </div>
</template>

<style scoped>
.editor-button { padding: .375rem .625rem; border-radius: .375rem; }
.editor-button:hover:not(:disabled) { background-color: #e5e7eb; }
.editor-button:disabled { opacity: .4; cursor: not-allowed; }
.article-editor :deep(.tiptap) { min-height: 240px; max-height: 520px; overflow-y: auto; padding: 1rem; outline: none; overflow-wrap: anywhere; }
.article-editor :deep(.tiptap p) { margin: .5rem 0; }
.article-editor :deep(.tiptap p.is-editor-empty:first-child::before) { content: attr(data-placeholder); float: left; color: #9ca3af; pointer-events: none; height: 0; }
.article-editor :deep(.tiptap h1) { font-size: 2rem; font-weight: 700; }
.article-editor :deep(.tiptap h2) { font-size: 1.5rem; font-weight: 600; }
.article-editor :deep(.tiptap h3) { font-size: 1.25rem; font-weight: 600; }
.article-editor :deep(.tiptap ul) { list-style: disc; padding-left: 1.5rem; }
.article-editor :deep(.tiptap ol) { list-style: decimal; padding-left: 1.5rem; }
.article-editor :deep(.tiptap blockquote) { border-left: 3px solid #d1d5db; padding-left: 1rem; margin: 1rem 0; }
.article-editor :deep(.tiptap pre) { background: #1f2937; color: #f9fafb; padding: 1rem; border-radius: .5rem; white-space: pre-wrap; }
.article-editor :deep(.tiptap a) { color: #2563eb; text-decoration: underline; }
.article-editor :deep(.tiptap img) { max-width: 100%; height: auto; }
.article-editor :deep(.tiptap table) { border-collapse: collapse; width: 100%; margin: 1rem 0; }
.article-editor :deep(.tiptap th), .article-editor :deep(.tiptap td) { border: 1px solid #d1d5db; padding: .5rem; min-width: 50px; vertical-align: top; position: relative; }
.article-editor :deep(.tiptap th) { background: #f3f4f6; font-weight: 600; }
.article-editor :deep(.tiptap .selectedCell) { background: #dbeafe; }
.article-editor :deep(.ProseMirror-selectednode) { outline: 2px solid #3b82f6; }
</style>
