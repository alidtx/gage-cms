<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
const sent = ref(false);
const form = useForm({ full_name: '', email_address: '', phone_number: '', subject: '', message: '' });
function submit() {
    sent.value = false;
    form.post(route('contact.store'), { preserveScroll: true, onSuccess: () => { form.reset(); sent.value = true; } });
}
</script>
<template>
    <main class="min-h-screen bg-gray-50 px-4 py-12">
        <Head title="Contact Us" />
        <form @submit.prevent="submit" class="max-w-2xl mx-auto bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h1 class="text-3xl font-semibold text-gray-900">Contact Us</h1>
            <p class="mt-2 mb-6 text-gray-500">Send us a message and our team will get back to you.</p>
            <p v-if="sent" role="status" class="mb-6 rounded-xl bg-green-50 p-4 text-green-800">Thank you. Your message has been received.</p>
            <fieldset :disabled="form.processing" class="space-y-4">
                <label v-for="(label, field) in { full_name: 'Full name', email_address: 'Email address', phone_number: 'Phone number (optional)', subject: 'Subject' }" :key="field" class="block text-sm font-medium text-gray-700">
                    {{ label }}<input v-model="form[field]" :type="field === 'email_address' ? 'email' : field === 'phone_number' ? 'tel' : 'text'" :required="field !== 'phone_number'" maxlength="255" class="mt-2 w-full rounded-xl border-gray-200" /><InputError :message="form.errors[field]" />
                </label>
                <label class="block text-sm font-medium text-gray-700">Message<textarea v-model="form.message" required maxlength="10000" rows="6" class="mt-2 w-full rounded-xl border-gray-200"></textarea><InputError :message="form.errors.message" /></label>
                <button :disabled="form.processing" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-medium disabled:opacity-50">{{ form.processing ? 'Sending...' : 'Send Message' }}</button>
            </fieldset>
        </form>
    </main>
</template>
