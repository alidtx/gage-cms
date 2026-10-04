<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { toast } from 'vue3-toastify';
const props = defineProps({ entities: Object, categories: Array, stats: Object, filters: Object });
const search = ref(props.filters.search ?? '');
const category = ref(props.filters.category ?? '');
const creating = ref(false);
onMounted(() => { creating.value = new URLSearchParams(window.location.search).get('create') === '1'; });
const action = useForm({});
const form = useForm({ name: '', slug: '', category: 'security' });
const cards = [
    { key: 'total', label: 'Total Entities', icon: 'building', color: 'bg-blue-100 text-blue-600' },
    { key: 'active', label: 'Active', icon: 'check-circle', color: 'bg-green-100 text-green-600' },
    { key: 'featured', label: 'Featured', icon: 'star', color: 'bg-yellow-100 text-yellow-600' },
    { key: 'inactive', label: 'Inactive', icon: 'eye-slash', color: 'bg-red-100 text-red-600' },
];
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
function toggle(entity) {
    action.patch(route('backend.entities.active', entity.id), { preserveScroll: true, onError: () => toast.error('Unable to change status.') });
}
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Entity Management" />
        <div class="p-4 md:p-8  min-h-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
                <div v-for="card in cards" :key="card.key" class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div><p class="text-gray-500 text-sm">{{ card.label }}</p><p class="text-3xl font-bold text-gray-800 mt-1">{{ stats[card.key] }}</p></div>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" :class="card.color"><i :class="'fas fa-' + card.icon" aria-hidden="true"></i></div>
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div><h2 class="text-xl font-semibold text-gray-800"><i class="fas fa-building text-blue-500 mr-2" aria-hidden="true"></i>Entity Management</h2><p class="text-sm text-gray-500">Manage all GAGE entities from one place</p></div>
                <button type="button" @click="form.reset(); form.clearErrors(); creating = true" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium"><i class="fas fa-plus mr-2" aria-hidden="true"></i>New Entity</button>
            </div>
            <form @submit.prevent="filter" class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 flex flex-wrap gap-3">
                <input v-model="search" aria-label="Search entities" placeholder="Search entities..." maxlength="255" class="flex-1 min-w-[180px] border-gray-200 rounded-xl text-sm" />
                <select v-model="category" aria-label="Category filter" class="border-gray-200 rounded-xl text-sm capitalize"><option value="">All Categories</option><option v-for="item in categories" :key="item" :value="item">{{ item }}</option></select>
                <button class="px-4 py-2 bg-gray-800 text-white rounded-xl text-sm"><i class="fas fa-filter mr-2" aria-hidden="true"></i>Filter</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                <article v-for="entity in entities.data" :key="entity.id" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-2xl overflow-hidden">
                            <img v-if="entity.image_url" :src="entity.image_url" :alt="entity.name" class="w-full h-full object-cover" />
                            <i v-else-if="entity.meta?.icon_type === 'fontawesome'" :class="['fas', entity.meta.icon]" aria-hidden="true"></i>
                            <span v-else>{{ entity.meta?.icon || '🏢' }}</span>
                        </div>
                        <div class="flex gap-1"><span v-if="entity.is_featured" aria-label="Featured" class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">★</span><span class="px-3 py-1 rounded-full text-xs" :class="entity.is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">{{ entity.is_active ? 'Active' : 'Inactive' }}</span></div>
                    </div>
                    <h3 class="font-bold text-gray-800">{{ entity.name }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ entity.meta?.tagline }}</p>
                    <span class="inline-block mt-3 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs capitalize">{{ entity.category }}</span>
                    <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ entity.meta?.short_description }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                        <Link :href="route('backend.entities.edit', entity.id)" class="text-sm text-blue-600 font-medium"><i class="fas fa-edit mr-1" aria-hidden="true"></i>Edit</Link>
                        <div class="flex gap-3">
                            <button type="button" :disabled="action.processing" @click="toggle(entity)" :aria-label="(entity.is_active ? 'Deactivate ' : 'Activate ') + entity.name" class="text-gray-400 hover:text-yellow-600 disabled:opacity-50"><i class="fas fa-power-off" aria-hidden="true"></i></button>
                            <button type="button" :disabled="action.processing" @click="remove(entity)" :aria-label="'Delete ' + entity.name" class="text-gray-400 hover:text-red-600 disabled:opacity-50"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </article>
            </div>
            <p v-if="!entities.data.length" class="bg-white rounded-2xl p-12 text-center text-gray-500">No entities found.</p>
            <nav v-if="entities.last_page > 1" aria-label="Entity pages" class="flex flex-wrap gap-2 mt-6">
                <template v-for="link in entities.links" :key="link.label"><Link v-if="link.url" :href="link.url" class="px-3 py-2 rounded-lg border text-sm" :class="link.active ? 'bg-blue-600 text-white' : 'bg-white text-gray-600'" :aria-current="link.active ? 'page' : undefined" v-html="link.label" /><span v-else class="px-3 py-2 text-gray-400 text-sm" v-html="link.label"></span></template>
            </nav>
        </div>
        <Modal :show="creating" max-width="md" :closeable="!form.processing" @close="creating = false">
            <form @submit.prevent="create" class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Create New Entity</h3>
                <fieldset :disabled="form.processing" class="space-y-4">
                    <label class="block text-sm text-gray-700">Name<input v-model="form.name" required maxlength="255" autofocus placeholder="GAGE New Entity" class="mt-2 w-full border-gray-200 rounded-xl text-sm" /><InputError :message="form.errors.name" /></label>
                    <label class="block text-sm text-gray-700">Slug (optional)<input v-model="form.slug" maxlength="255" placeholder="Generated from the name" class="mt-2 w-full border-gray-200 rounded-xl text-sm" /><InputError :message="form.errors.slug" /></label>
                    <label class="block text-sm text-gray-700">Category<select v-model="form.category" class="mt-2 w-full border-gray-200 rounded-xl text-sm capitalize"><option v-for="item in categories" :key="item" :value="item">{{ item }}</option></select><InputError :message="form.errors.category" /></label>
                </fieldset>
                <div class="flex justify-end gap-3 pt-5"><button type="button" :disabled="form.processing" @click="creating = false" class="px-4 py-2 bg-gray-200 rounded-xl text-sm">Cancel</button><button :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm">{{ form.processing ? 'Creating...' : 'Create' }}</button></div>
            </form>
        </Modal>
    </AuthenticatedLayout>
</template>
