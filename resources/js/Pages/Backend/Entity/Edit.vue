<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import Field from './EntityField.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import { toast } from 'vue3-toastify';
const props = defineProps({ entity: Object, categories: Array });
const form = useForm({
    name: props.entity.name, slug: props.entity.slug, category: props.entity.category,
    short_description: props.entity.short_description ?? '', link: props.entity.link ?? '', image: null
});
watch(() => form.name, name => {
    form.slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
});
function save() {
    form.transform(data => ({ ...data, _method: 'put' })).post(route('backend.entities.update', props.entity.id), {
        forceFormData: true, preserveScroll: true,
        onSuccess: () => { form.image = null; form.defaults(); toast.success('Entity saved.'); },
        onError: () => toast.error('Please check the highlighted errors.'),
    });
}
</script>
<template>
    <AuthenticatedLayout>

        <Head :title="'Edit ' + entity.name" />
        <form @submit.prevent="save" class="p-4 md:p-8">
            <div class="flex items-center justify-between gap-4 mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Edit Entity</h2>
                <Link :href="route('backend.entities.index')" class="text-sm text-blue-600">Back to entities</Link>
            </div>
            <div v-if="Object.keys(form.errors).length" role="alert" class="bg-red-50 text-red-700 p-4 rounded-xl mb-5">
                <p v-for="(message, field) in form.errors" :key="field">{{ message }}</p>
            </div>
            <fieldset :disabled="form.processing" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <Field v-model="form.name" label="Name" />
                <label class="block text-sm font-medium text-gray-700">Slug<input :value="form.slug" readonly
                        class="mt-2 w-full border-gray-200 rounded-xl text-sm bg-gray-50" /></label>
                <label class="block text-sm font-medium text-gray-700">Category<select v-model="form.category"
                        class="mt-2 w-full border-gray-200 rounded-xl text-sm capitalize">
                        <option v-for="item in categories" :key="item" :value="item">{{ item }}</option>
                    </select></label>
                <Field v-model="form.short_description" label="Short description" multiline />
                <Field v-model="form.link" label="Link" />
                <p class="text-xs text-gray-500">Use a page path such as /gage-security or a full https:// address.</p>
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">Image</p>
                    <ImageUpload v-model="form.image" :current-url="entity.image_url" :error="form.errors.image"
                        helper-text="JPG, PNG, WebP or GIF, up to 5 MB" />
                </div>
                <button :disabled="form.processing"
                    class="px-5 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold disabled:opacity-50">{{
                        form.processing ? 'Saving...' : 'Save Changes' }}</button>
            </fieldset>
        </form>
    </AuthenticatedLayout>
</template>
