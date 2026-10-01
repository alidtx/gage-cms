<script setup>
import { computed } from 'vue';
const props = defineProps({ location: { type: Object, required: true } });
const embedUrl = computed(() => /^https:\/\/(?:www\.)?google\.com\/maps\/embed(?:\?|\/)[^\s]*$/.test(props.location.embed_url || '') ? props.location.embed_url : null);
const directionsUrl = computed(() => {
    try {
        const url = new URL(props.location.directions_url);
        return url.protocol === 'https:' ? url.href : null;
    } catch { return null; }
});
</script>
<template>
    <section class="relative rounded-2xl overflow-hidden bg-slate-900 min-h-[350px]">
        <iframe v-if="embedUrl" :src="embedUrl" :title="'Map: ' + (location.name || 'Location')" class="w-full h-[350px] border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        <div v-else class="h-[350px] flex flex-col items-center justify-center pb-20 text-slate-400 gap-3"><i class="fas fa-map-marked-alt text-5xl text-red-800" aria-hidden="true"></i><p>Add a Google Maps embed URL to preview the location.</p></div>
        <div class="absolute bottom-4 inset-x-4 flex justify-center pointer-events-none"><div class="bg-white rounded-2xl px-6 py-4 text-center shadow-lg pointer-events-auto"><p class="text-slate-900"><i class="fas fa-map-marker-alt text-red-600 mr-2" aria-hidden="true"></i><strong>{{ location.name || 'Location' }}</strong><span v-if="location.address" class="text-gray-500"> — {{ location.address }}</span></p><a v-if="directionsUrl" :href="directionsUrl" target="_blank" rel="noopener noreferrer" class="inline-block mt-2 text-red-600 font-medium">Get Directions</a></div></div>
    </section>
</template>
