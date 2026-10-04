<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ stats: Object, recentMessages: Array, latestNews: Array, recentPages: Array });
const cards = [
    { key: 'pages', label: 'Total Pages', icon: 'file-alt', color: 'bg-blue-100 text-blue-600', route: 'backend.pages.index' },
    { key: 'entities', label: 'Active Entities', icon: 'building', color: 'bg-green-100 text-green-600', route: 'backend.entities.index' },
    { key: 'news', label: 'Published News', icon: 'newspaper', color: 'bg-purple-100 text-purple-600', route: 'backend.news.index' },
    { key: 'messages', label: 'Contact Messages', icon: 'envelope', color: 'bg-orange-100 text-orange-600', route: 'backend.contact-submissions.index' },
];
const actions = [
    { label: 'Create Page', icon: 'file-alt', route: 'backend.pages.index', params: { create: 1 } },
    { label: 'Add Entity', icon: 'building', route: 'backend.entities.index', params: { create: 1 } },
    { label: 'Add News', icon: 'newspaper', route: 'backend.news.index' },
    { label: 'View Messages', icon: 'envelope', route: 'backend.contact-submissions.index' },
];
const date = value => value ? new Date(value).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) : '—';
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />
        <div class="p-4 md:p-8 space-y-6">
            <div><h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1><p class="mt-1 text-sm text-gray-500">Your content and latest messages at a glance.</p></div>
            <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">
                <Link v-for="card in cards" :key="card.key" :href="route(card.route)" class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex justify-between items-center hover:shadow-md">
                    <div><p class="text-sm text-gray-500">{{ card.label }}</p><p class="mt-2 text-3xl font-bold text-gray-900">{{ stats[card.key] }}</p></div>
                    <span class="w-12 h-12 rounded-xl flex items-center justify-center" :class="card.color"><i :class="'fas fa-' + card.icon" aria-hidden="true"></i></span>
                </Link>
            </div>
            <div class="grid xl:grid-cols-3 gap-6 items-start">
                <div class="xl:col-span-2 space-y-6">
                    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-5 flex justify-between gap-4 items-center"><h2 class="font-semibold text-gray-800">Recent Contact Messages</h2><Link :href="route('backend.contact-submissions.index')" class="text-sm text-blue-600">View all</Link></div>
                        <div class="overflow-x-auto"><table class="w-full text-left"><thead class="bg-gray-50 text-xs uppercase text-gray-500"><tr><th class="px-5 py-3">Sender / Subject</th><th class="px-5 py-3">Received</th><th class="px-5 py-3 text-right">Action</th></tr></thead><tbody class="divide-y divide-gray-100">
                            <tr v-for="message in recentMessages" :key="message.id"><td class="px-5 py-4"><p class="text-sm font-medium text-gray-900">{{ message.full_name }}</p><p class="text-sm text-gray-500 mt-1 break-words">{{ message.subject }}</p></td><td class="px-5 py-4 text-sm text-gray-500 whitespace-nowrap">{{ date(message.created_at) }}</td><td class="px-5 py-4 text-right"><Link :href="route('backend.contact-submissions.show', message.id)" class="text-sm text-blue-600" :aria-label="'View message from ' + message.full_name">View</Link></td></tr>
                            <tr v-if="!recentMessages.length"><td colspan="3" class="p-8 text-center text-gray-500 text-sm">No contact messages yet.</td></tr>
                        </tbody></table></div>
                    </section>
                    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-5 flex justify-between items-center"><h2 class="font-semibold text-gray-800">Latest News</h2><Link :href="route('backend.news.index')" class="text-sm text-blue-600">View all</Link></div>
                        <div class="overflow-x-auto"><table class="w-full text-left"><thead class="bg-gray-50 text-xs uppercase text-gray-500"><tr><th class="px-5 py-3">Article / Category</th><th class="px-5 py-3">Status</th><th class="px-5 py-3 text-right">Action</th></tr></thead><tbody class="divide-y divide-gray-100">
                            <tr v-for="article in latestNews" :key="article.id"><td class="px-5 py-4"><p class="text-sm font-medium text-gray-900">{{ article.title }}</p><p class="text-xs text-gray-500 mt-1">{{ article.category?.name || 'Uncategorized' }}</p></td><td class="px-5 py-4"><span class="px-3 py-1 rounded-full text-xs capitalize" :class="article.status === 'published' ? 'bg-green-100 text-green-700' : article.status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600'">{{ article.status }}</span></td><td class="px-5 py-4 text-right"><Link :href="route('backend.news.edit', article.id)" class="text-sm text-blue-600" :aria-label="'Edit ' + article.title">Edit</Link></td></tr>
                            <tr v-if="!latestNews.length"><td colspan="3" class="p-8 text-center text-sm text-gray-500">No news articles yet.</td></tr>
                        </tbody></table></div>
                    </section>
                </div>
                <aside class="space-y-6">
                    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5"><h2 class="font-semibold text-gray-800 mb-4">Quick Actions</h2><div class="grid grid-cols-2 gap-3"><Link v-for="action in actions" :key="action.label" :href="route(action.route, action.params)" class="p-4 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm flex flex-col items-center text-center gap-2"><i :class="'fas fa-' + action.icon" aria-hidden="true"></i>{{ action.label }}</Link></div></section>
                    <section class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5"><h2 class="font-semibold text-gray-800 mb-2">Recently Updated Pages</h2><div v-for="page in recentPages" :key="page.id" class="flex justify-between items-center gap-3 py-4 border-b border-gray-100 last:border-0"><div class="min-w-0"><p class="text-sm font-medium text-gray-900 break-words">{{ page.name || page.page }}</p><p class="text-xs text-gray-500 mt-1">{{ date(page.updated_at) }}</p></div><Link :href="route('backend.pages.edit', page.id)" class="text-sm text-blue-600" :aria-label="'Edit ' + (page.name || page.page)">Edit</Link></div><p v-if="!recentPages.length" class="py-5 text-sm text-gray-500">No pages yet.</p></section>
                </aside>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
