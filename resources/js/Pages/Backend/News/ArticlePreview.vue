<script setup>
import Modal from '@/Components/Modal.vue';
import { computed, onBeforeUnmount, ref, watch } from 'vue';

const props = defineProps({ show: Boolean, article: Object, category: String, author: String, imageUrl: String });
defineEmits(['close']);
const uploadUrl = ref(null);
watch(() => props.article.featured_image, file => {
    if (uploadUrl.value) URL.revokeObjectURL(uploadUrl.value);
    uploadUrl.value = file ? URL.createObjectURL(file) : null;
});
onBeforeUnmount(() => { if (uploadUrl.value) URL.revokeObjectURL(uploadUrl.value); });
const document = computed(() => `<!doctype html><html><head><meta charset="utf-8"><meta http-equiv="Content-Security-Policy" content="default-src 'none'; style-src 'unsafe-inline'; img-src data:; base-uri 'none'; form-action 'none'"><style>body{font:16px/1.7 system-ui,sans-serif;color:#1f2937;margin:0;overflow-wrap:anywhere}img{max-width:100%;height:auto}article{white-space:pre-wrap}blockquote{border-left:3px solid #2563eb;padding-left:16px}</style></head><body><article>${props.article.content || ''}</article></body></html>`);
</script>

<template>
    <Modal :show="show" max-width="2xl" @close="$emit('close')">
        <div class="p-5">
            <div class="flex items-center justify-between gap-4 mb-4"><h2 class="font-semibold text-lg">Article preview</h2><button type="button" @click="$emit('close')" class="px-4 py-2 bg-gray-100 rounded-lg">Close</button></div>
            <p class="text-sm text-gray-500 mb-3">Preview of your current changes. Save the article to keep them.</p>
            <div class="max-h-[65vh] overflow-y-auto border border-gray-200 rounded-xl bg-white p-5">
                <p class="text-sm text-gray-500">{{ category }} · {{ author }} · {{ article.published_at?.replace('T', ' ') }}</p>
                <h1 class="text-3xl font-bold text-gray-800 mt-3 break-words">{{ article.title || 'Untitled article' }}</h1>
                <p class="text-gray-600 my-4 break-words">{{ article.excerpt }}</p>
                <img v-if="uploadUrl || imageUrl" :src="uploadUrl || imageUrl" alt="Featured image" class="w-full rounded-lg mb-4" />
                <iframe title="News article content preview" sandbox="" referrerpolicy="no-referrer" :srcdoc="document" class="w-full h-[45vh] bg-white"></iframe>
            </div>
        </div>
    </Modal>
</template>
