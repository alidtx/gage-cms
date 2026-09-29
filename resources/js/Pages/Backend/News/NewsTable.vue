<script setup>
import { Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({ articles: Object, categories: Array, filters: Object, busy: Boolean });
defineEmits(['delete']);
const search = reactive({ search: props.filters.search ?? '', status: props.filters.status ?? '', category: props.filters.category ?? '', featured: props.filters.featured ?? '' });
function applyFilters() {
    router.get(route('backend.news.index'), search, { preserveScroll: true });
}
function clearFilters() {
    router.get(route('backend.news.index'), {}, { preserveScroll: true });
}
function dateLabel(value) {
    return value ? new Date(value).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) : '—';
}
</script>

<template>
    <section id="all-news" class="scroll-mt-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800 mb-4"><i class="fas fa-list-ul text-gray-500 mr-2" aria-hidden="true"></i>All News Articles</h3>
            <form @submit.prevent="applyFilters" class="flex flex-wrap gap-3">
                <input v-model="search.search" aria-label="Search news" placeholder="Search news..." maxlength="255" class="border-gray-200 rounded-lg text-sm grow" />
                <select v-model="search.category" aria-label="Filter by category" class="border-gray-200 rounded-lg text-sm">
                    <option value="">All categories</option><option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
                <select v-model="search.status" aria-label="Filter by status" class="border-gray-200 rounded-lg text-sm">
                    <option value="">All statuses</option><option value="draft">Draft</option><option value="published">Published</option><option value="archived">Archived</option>
                </select>
                <select v-model="search.featured" aria-label="Filter featured articles" class="border-gray-200 rounded-lg text-sm">
                    <option value="">All articles</option><option value="1">Featured</option><option value="0">Not featured</option>
                </select>
                <button :disabled="busy" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm disabled:opacity-50">Search</button>
                <button type="button" @click="clearFilters" :disabled="busy" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm disabled:opacity-50">Clear</button>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead class="bg-gray-50 border-b border-gray-200"><tr>
                    <th v-for="heading in ['Title', 'Category', 'Author', 'Published', 'Status', 'Featured', 'Actions']" :key="heading" scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider" :class="heading === 'Actions' ? 'text-right' : 'text-left'">{{ heading }}</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100">
                    <tr v-for="article in articles.data" :key="article.id">
                        <td class="px-6 py-4 font-medium text-gray-900"><Link :href="route('backend.news.edit', article.id)" class="hover:text-blue-600">{{ article.title }}</Link></td>
                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">{{ article.category?.name ?? 'Uncategorized' }}</span></td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ article.author?.name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ dateLabel(article.published_at) }}</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs font-medium capitalize" :class="article.status === 'published' ? 'bg-green-100 text-green-700' : article.status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600'">{{ article.status }}</span></td>
                        <td class="px-6 py-4"><i class="fas fa-star" :class="article.is_featured ? 'text-yellow-400' : 'text-gray-300'" aria-hidden="true"></i><span class="sr-only">{{ article.is_featured ? 'Featured' : 'Not featured' }}</span></td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <Link :href="route('backend.news.edit', article.id)" :aria-label="`Edit ${article.title}`" class="p-2 text-blue-600"><i class="fas fa-edit" aria-hidden="true"></i></Link>
                            <button type="button" :disabled="busy" @click="$emit('delete', article)" :aria-label="`Delete ${article.title}`" class="p-2 text-red-500 disabled:opacity-50"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <tr v-if="!articles.data.length"><td colspan="7" class="px-6 py-12 text-center text-gray-500">No news articles found.</td></tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4 text-sm text-gray-500">
            <p>Showing {{ articles.from ?? 0 }}–{{ articles.to ?? 0 }} of {{ articles.total }} news articles</p>
            <nav aria-label="News pagination" class="flex flex-wrap gap-1">
                <template v-for="(link, index) in articles.links" :key="index">
                    <Link v-if="link.url" :href="link.url" preserve-scroll class="px-3 py-1 rounded-lg border" :class="link.active ? 'bg-blue-600 text-white border-blue-600' : 'border-gray-200 hover:bg-gray-50'" :aria-current="link.active ? 'page' : undefined">{{ index === 0 ? 'Previous' : index === articles.links.length - 1 ? 'Next' : link.label }}</Link>
                    <span v-else class="px-3 py-1 rounded-lg border border-gray-100 text-gray-400">{{ index === 0 ? 'Previous' : index === articles.links.length - 1 ? 'Next' : link.label }}</span>
                </template>
            </nav>
        </div>

    </section>
</template>
