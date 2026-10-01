<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
defineProps({ submissions: Object });
const deletion = useForm({});
function remove(item) {
    if (!window.confirm('Delete the message from ' + item.full_name + '? This cannot be undone.')) return;
    deletion.delete(route('backend.contact-submissions.destroy', item.id), { preserveScroll: true, onSuccess: () => toast.success('Message deleted.'), onError: () => toast.error('Unable to delete message.') });
}
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Contact Form" />
        <div class="p-4 md:p-8">
            <div class="mb-6 flex flex-wrap justify-between items-center gap-4"><div><h1 class="text-xl font-semibold text-gray-800">Contact Form</h1><p class="text-sm text-gray-500">View and manage messages received from your contact form.</p></div><Link :href="route('contact.create')" class="text-sm text-blue-600">Open Contact Form</Link></div>
            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 flex justify-between"><h2 class="font-semibold text-gray-800">Contact submissions</h2><span class="text-xs rounded-full bg-gray-100 text-gray-500 px-3 py-1">{{ submissions.total }} messages</span></div>
                <div class="overflow-x-auto"><table class="w-full text-left min-w-[750px]">
                    <thead class="bg-gray-50 border-y border-gray-200"><tr><th v-for="heading in ['Name', 'Email', 'Subject', 'Received', 'Actions']" :key="heading" class="px-6 py-4 text-xs uppercase text-gray-600" scope="col">{{ heading }}</th></tr></thead>
                    <tbody class="divide-y divide-gray-100"><tr v-for="item in submissions.data" :key="item.id">
                        <td class="px-6 py-4 text-gray-900">{{ item.full_name }}</td><td class="px-6 py-4 text-sm text-gray-600">{{ item.email_address }}</td><td class="px-6 py-4 text-sm text-gray-600">{{ item.subject }}</td><td class="px-6 py-4 text-sm text-gray-500">{{ new Date(item.created_at).toLocaleString() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"><Link :href="route('backend.contact-submissions.show', item.id)" :aria-label="'View message from ' + item.full_name" class="text-blue-600 mr-4">View</Link><button type="button" :disabled="deletion.processing" @click="remove(item)" :aria-label="'Delete message from ' + item.full_name" class="text-red-500 disabled:opacity-50">Delete</button></td>
                    </tr><tr v-if="!submissions.data.length"><td colspan="5" class="p-12 text-center text-gray-500">No contact messages yet.</td></tr></tbody>
                </table></div>
                <div class="p-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3 text-sm text-gray-500"><span>Showing {{ submissions.from ?? 0 }}–{{ submissions.to ?? 0 }} of {{ submissions.total }}</span><nav aria-label="Submission pages" class="flex gap-2"><template v-for="link in submissions.links" :key="link.label"><Link v-if="link.url" :href="link.url" :aria-current="link.active ? 'page' : undefined" class="px-3 py-1 border rounded-lg" :class="link.active ? 'bg-blue-600 text-white' : 'border-gray-200'" v-html="link.label" /><span v-else class="px-3 py-1 text-gray-400" v-html="link.label"></span></template></nav></div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
