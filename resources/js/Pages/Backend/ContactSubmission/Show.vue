<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({ submission: Object });
const deletion = useForm({});
function remove(item) {
    if (window.confirm('Delete this message? This cannot be undone.')) deletion.delete(route('backend.contact-submissions.destroy', item.id));
}
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Contact Message" />
        <div class="p-4 md:p-8">
            <Link :href="route('backend.contact-submissions.index')" class="text-blue-600 text-sm">← Back to Contact Form</Link>
            <article class="mt-6 max-w-4xl bg-white border border-gray-100 rounded-2xl shadow-sm p-6 md:p-8">
                <h1 class="text-2xl font-semibold text-gray-900 break-words">{{ submission.subject }}</h1>
                <dl class="grid sm:grid-cols-2 gap-5 my-6 text-sm">
                    <div><dt class="text-gray-500">Full name</dt><dd class="mt-1 text-gray-900">{{ submission.full_name }}</dd></div>
                    <div><dt class="text-gray-500">Email address</dt><dd class="mt-1 text-gray-900 break-words">{{ submission.email_address }}</dd></div>
                    <div><dt class="text-gray-500">Phone number</dt><dd class="mt-1 text-gray-900">{{ submission.phone_number || 'Not provided' }}</dd></div>
                    <div><dt class="text-gray-500">Received</dt><dd class="mt-1 text-gray-900">{{ new Date(submission.created_at).toLocaleString() }}</dd></div>
                </dl>
                <h2 class="font-semibold text-gray-800 border-t pt-6">Message</h2><p class="mt-3 text-gray-700 whitespace-pre-wrap break-words">{{ submission.message }}</p>
                <button type="button" :disabled="deletion.processing" @click="remove(submission)" class="mt-8 rounded-xl px-4 py-2 bg-red-50 text-red-600 disabled:opacity-50">Delete Message</button>
            </article>
        </div>
    </AuthenticatedLayout>
</template>
