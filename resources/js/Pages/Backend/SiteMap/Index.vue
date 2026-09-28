<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    settings: { type: Array, required: true },
    stats: { type: Object, required: true },
    generatedAt: { type: String, default: null },
    sitemapUrl: { type: String, required: true },
    success: { type: String, default: null },
});

const form = useForm({
    settings: props.settings.map(({ content_type, include, priority, change_frequency }) => ({
        content_type, include, priority, change_frequency,
    })),
});
const priorities = Array.from({ length: 11 }, (_, index) => (index / 10).toFixed(1));
const frequencies = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];
const cards = computed(() => [
    { label: 'Total Pages', value: props.stats.total, color: 'bg-blue-50 text-blue-600' },
    { label: 'Included', value: props.stats.included, color: 'bg-green-50 text-green-600' },
    { label: 'Excluded', value: props.stats.excluded, color: 'bg-yellow-50 text-yellow-600' },
    { label: 'Sitemap Files', value: props.stats.files, color: 'bg-purple-50 text-purple-600' },
]);
const generatedLabel = computed(() => props.generatedAt ? new Date(props.generatedAt).toLocaleString() : 'Not generated yet');

function save(regenerate = false) {
    const options = { preserveScroll: true, onSuccess: () => form.defaults() };
    if (regenerate) {
        form.post(route('backend.sitemap.regenerate'), options);
    } else {
        form.put(route('backend.sitemap.update'), options);
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Sitemap Settings" />
        <div class="p-4 md:p-8">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Sitemap Settings</h2>
                    <p class="text-gray-600">Configure which content appears in your XML sitemap</p>
                </div>
                <button type="button" @click="save(true)" :disabled="form.processing"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-sync-alt mr-2" aria-hidden="true"></i>
                    {{ form.processing ? 'Saving...' : 'Regenerate Sitemap' }}
                </button>
            </div>

            <p v-if="success && !form.isDirty" role="status" class="mb-6 p-4 rounded-xl bg-green-50 text-green-700">{{ success }}</p>
            <div v-if="Object.keys(form.errors).length" role="alert" class="mb-6 p-4 rounded-xl bg-red-50 text-red-700">
                <p v-for="(error, field) in form.errors" :key="field">{{ error }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div v-for="card in cards" :key="card.label" class="p-4 rounded-xl text-center" :class="card.color">
                        <p class="text-3xl font-bold">{{ card.value.toLocaleString() }}</p>
                        <p class="text-sm text-gray-600">{{ card.label }}</p>
                    </div>
                </div>
            </div>

            <form @submit.prevent="save()">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th v-for="heading in ['Content Type', 'Included', 'Priority', 'Change Frequency', 'Public Pages']" :key="heading"
                                    scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ heading }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(setting, index) in form.settings" :key="setting.content_type" class="border-b border-gray-100 last:border-b-0">
                                <th scope="row" class="px-6 py-4 text-left font-medium text-gray-800">{{ setting.content_type }}</th>
                                <td class="px-6 py-4"> 
                                    <input v-model="setting.include" type="checkbox" :disabled="form.processing"
                                        :aria-label="`Include ${setting.content_type} in sitemap`"
                                        class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500" />
                                </td>
                                <td class="px-6 py-4">
                                    <select v-model="setting.priority" :disabled="form.processing" :aria-label="`${setting.content_type} priority`"
                                        class="border border-gray-200 rounded-lg py-1 pl-3 pr-8 text-sm focus:ring-blue-500">
                                        <option v-for="priority in priorities" :key="priority" :value="priority">{{ priority }}</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <select v-model="setting.change_frequency" :disabled="form.processing" :aria-label="`${setting.content_type} change frequency`"
                                        class="border border-gray-200 rounded-lg py-1 pl-3 pr-8 text-sm focus:ring-blue-500">
                                        <option v-for="frequency in frequencies" :key="frequency" :value="frequency">{{ frequency }}</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ settings[index].page_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                    <div class="text-sm text-gray-600">
                        <a :href="sitemapUrl" target="_blank" rel="noopener" class="text-blue-600 hover:underline">View XML sitemap <i class="fas fa-external-link-alt ml-1" aria-hidden="true"></i></a>
                        <p class="mt-1">Last generated: {{ generatedLabel }}</p>
                        <p class="mt-1">{{ form.isDirty ? 'You have unsaved changes.' : 'Counts reflect saved settings.' }}</p>
                    </div>
                    <button type="submit" :disabled="form.processing || !form.isDirty"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        {{ form.processing ? 'Saving...' : 'Save Changes' }}
                    </button>
                </div>
            </form>
            <p class="mt-4 text-sm text-gray-500">Only pages with public URLs are included. Categories showing zero pages are ready for future content. Inclusion does not guarantee search-engine indexing.</p>
        </div>
    </AuthenticatedLayout>
</template>
