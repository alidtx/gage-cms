<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { toast } from 'vue3-toastify';
const props = defineProps({ entities: Object, categories: Array, filters: Object });
const search = ref(props.filters.search ?? '');
const category = ref(props.filters.category ?? '');
const creating = ref(false);
onMounted(() => { creating.value = new URLSearchParams(window.location.search).get('create') === '1'; });
const action = useForm({});
const form = useForm({ name: '', slug: '', category: 'security', short_description: '', link: '', image: null });
watch(() => form.name, name => {
    form.slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
});
function filter() {
    router.get(route('backend.entities.index'), { search: search.value, category: category.value }, { preserveState: true, preserveScroll: true });
}
function create() {
    form.post(route('backend.entities.store'), { onSuccess: () => { creating.value = false; toast.success('Entity created.'); } });
}
function remove(entity) {
    if (!window.confirm('Delete “' + entity.name + '”? It will be removed from the entity list.')) return;
    action.delete(route('backend.entities.destroy', entity.id), { preserveScroll: true, onSuccess: () => toast.success('Entity deleted.'), onError: () => toast.error('Unable to delete entity.') });
}
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Entity Management" />
        <div class="p-4 md:p-8  min-h-full">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800"><i class="fas fa-building text-blue-500 mr-2"
                            aria-hidden="true"></i>Entity Management</h2>
                    <p class="text-sm text-gray-500">Manage all GAGE entities from one place</p>
                </div>
                <button type="button" @click="form.reset(); form.clearErrors(); creating = true"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium"><i class="fas fa-plus mr-2"
                        aria-hidden="true"></i>New Entity</button>
            </div>
            <form @submit.prevent="filter"
                class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 flex flex-wrap gap-3">
                <input v-model="search" aria-label="Search entities" placeholder="Search entities..." maxlength="255"
                    class="flex-1 min-w-[180px] border-gray-200 rounded-xl text-sm" />
                <select v-model="category" aria-label="Category filter"
                    class="border-gray-200 rounded-xl text-sm capitalize">
                    <option value="">All Categories</option>
                    <option v-for="item in categories" :key="item" :value="item">{{ item }}</option>
                </select>
                <button class="px-4 py-2 bg-gray-800 text-white rounded-xl text-sm"><i class="fas fa-filter mr-2"
                        aria-hidden="true"></i>Filter</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                <article v-for="entity in entities.data" :key="entity.id"
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md">
                    <div class="flex items-start justify-between mb-3">
                        <div
                            class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-2xl overflow-hidden">
                            <img v-if="entity.image_url" :src="entity.image_url" :alt="entity.name"
                                class="w-full h-full object-cover" />
                            <span v-else>🏢</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-gray-800">{{ entity.name }}</h3>
                    <span
                        class="inline-block mt-3 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs capitalize">{{
                        entity.category }}</span>
                    <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ entity.short_description }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                        <Link :href="route('backend.entities.edit', entity.id)"
                            class="text-sm text-blue-600 font-medium"><i class="fas fa-edit mr-1"
                                aria-hidden="true"></i>Edit</Link>
                        <div class="flex gap-3">
                            <button type="button" :disabled="action.processing" @click="remove(entity)"
                                :aria-label="'Delete ' + entity.name"
                                class="text-gray-400 hover:text-red-600 disabled:opacity-50"><i class="fas fa-trash-alt"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                </article>
            </div>
            <p v-if="!entities.data.length" class="bg-white rounded-2xl p-12 text-center text-gray-500">No entities
                found.</p>
            <nav v-if="entities.last_page > 1" aria-label="Entity pages" class="flex flex-wrap gap-2 mt-6">
                <template v-for="link in entities.links" :key="link.label">
                    <Link v-if="link.url" :href="link.url" class="px-3 py-2 rounded-lg border text-sm"
                        :class="link.active ? 'bg-blue-600 text-white' : 'bg-white text-gray-600'"
                        :aria-current="link.active ? 'page' : undefined" v-html="link.label" /><span v-else
                        class="px-3 py-2 text-gray-400 text-sm" v-html="link.label"></span>
                </template>
            </nav>
        </div>
        <Modal :show="creating" max-width="md" :closeable="!form.processing" @close="creating = false">
            <form @submit.prevent="create" class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Create New Entity</h3>
                <fieldset :disabled="form.processing" class="space-y-4">
                    <label class="block text-sm text-gray-700">Name<input v-model="form.name" required maxlength="255"
                            autofocus placeholder="GAGE New Entity"
                            class="mt-2 w-full border-gray-200 rounded-xl text-sm" />
                        <InputError :message="form.errors.name" />
                    </label>
                    <label class="block text-sm text-gray-700">Slug<input :value="form.slug" readonly maxlength="255"
                            placeholder="Generated from the name"
                            class="mt-2 w-full border-gray-200 rounded-xl text-sm" />
                        <InputError :message="form.errors.slug" />
                    </label>
                    <label class="block text-sm text-gray-700">Category<select v-model="form.category"
                            class="mt-2 w-full border-gray-200 rounded-xl text-sm capitalize">
                            <option v-for="item in categories" :key="item" :value="item">{{ item }}</option>
                        </select>
                        <InputError :message="form.errors.category" />
                    </label>
                    <label class="block text-sm text-gray-700">Short description<textarea
                            v-model="form.short_description" maxlength="140"
                            class="mt-2 w-full border-gray-200 rounded-xl text-sm"></textarea>
                        <span class="block text-xs text-gray-500">{{ (form.short_description || '').length }}/140 characters</span>
                        <InputError :message="form.errors.short_description" />
                    </label>
                    <label class="block text-sm text-gray-700">Link<input v-model="form.link"
                            placeholder="/gage-security" class="mt-2 w-full border-gray-200 rounded-xl text-sm" />
                        <InputError :message="form.errors.link" />
                    </label>
                    <div>
                        <p class="text-sm text-gray-700 mb-2">Image</p>
                        <ImageUpload v-model="form.image" :error="form.errors.image" />
                    </div>
                </fieldset>
                <div class="flex justify-end gap-3 pt-5"><button type="button" :disabled="form.processing"
                        @click="creating = false"
                        class="px-4 py-2 bg-gray-200 rounded-xl text-sm">Cancel</button><button
                        :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm">{{
                            form.processing ? 'Creating...' : 'Create' }}</button></div>
            </form>
        </Modal>
    </AuthenticatedLayout>
</template>
