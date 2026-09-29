<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({ categories: { type: Array, required: true } });
const editingId = ref(null);
const form = useForm({ name: '', slug: '', is_active: true });
const deletion = useForm({});
const busy = computed(() => form.processing || deletion.processing);

watch(() => form.name, name => {
    form.slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
});

function reset() {
    editingId.value = null;
    form.reset();
    form.clearErrors();
}

function edit(category) {
    reset();
    deletion.clearErrors();
    editingId.value = category.id;
    Object.assign(form, { name: category.name, slug: category.slug, is_active: category.is_active });
    document.getElementById('categoryName')?.focus();
}

function save() {
    const updating = editingId.value !== null;
    const options = {
        preserveScroll: true,
        onSuccess: () => {
            reset();
            toast.success(updating ? 'Category updated successfully.' : 'Category created successfully.');
        },
    };
    deletion.clearErrors();
    if (updating) form.put(route('backend.news-category.update', editingId.value), options);
    else form.post(route('backend.news-category.store'), options);
}

function remove(category) {
    if (!window.confirm(`Delete “${category.name}”? This cannot be undone.`)) return;
    deletion.clearErrors();
    deletion.delete(route('backend.news-category.destroy', category.id), {
        preserveScroll: true,
        onSuccess: () => {
            if (editingId.value === category.id) reset();
            toast.success('Category deleted successfully.');
        },
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="News Categories" />
        <div id="news-category" class="p-4 md:p-8">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Manage News Categories</h2>
                    <p class="text-sm text-gray-500">Add, edit or remove categories used for news articles</p>
                </div>
                <span class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl font-medium">
                    <i class="fas fa-tag mr-2" aria-hidden="true"></i>{{ categories.length }} categories
                </span>
            </div>

            <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="font-semibold text-gray-700 mb-4">
                    <i class="fas fa-plus-circle text-blue-500 mr-2" aria-hidden="true"></i>{{ editingId ? 'Edit category' : 'Add new category' }}
                </h3>
                <fieldset :disabled="busy" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-2">Category name</label>
                        <input id="categoryName" v-model="form.name" required maxlength="255" placeholder="e.g. Technology" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div>
                        <label for="categorySlug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input id="categorySlug" :value="form.slug" disabled placeholder="technology" class="w-full px-4 py-3 border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed" />
                        <InputError :message="form.errors.slug" class="mt-2" />
                    </div>
                    <div>
                        <label for="categoryStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="categoryStatus" v-model="form.is_active" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                            <option :value="true">Active</option>
                            <option :value="false">Inactive</option>
                        </select>
                        <InputError :message="form.errors.is_active" class="mt-2" />
                    </div>
                </fieldset>
                <div class="mt-6 flex justify-end gap-3">
                    <button v-if="editingId" type="button" @click="reset" :disabled="busy" class="px-5 py-3 border border-gray-200 rounded-xl text-gray-700 disabled:opacity-50">Cancel</button>
                    <button type="submit" :disabled="busy" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-save mr-2" aria-hidden="true"></i>{{ form.processing ? 'Saving...' : editingId ? 'Update Category' : 'Save Category' }}
                    </button>
                </div>
            </form>

            <div v-if="deletion.errors.category" role="alert" class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl">{{ deletion.errors.category }}</div>
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800"><i class="fas fa-list-ul text-gray-500 mr-2" aria-hidden="true"></i>All categories</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ categories.length }} items</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px]">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th v-for="heading in ['Category', 'Slug', 'Articles', 'Status', 'Actions']" :key="heading" scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider" :class="heading === 'Actions' ? 'text-right' : 'text-left'">{{ heading }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="category in categories" :key="category.id">
                                <td class="px-6 py-4 text-gray-900">{{ category.name }}</td>
                                <td class="px-6 py-4 text-sm font-mono text-gray-600">{{ category.slug }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.articles_count }}</td>
                                <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs font-medium" :class="category.is_active ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800'">{{ category.is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button type="button" @click="edit(category)" :disabled="busy" :aria-label="`Edit ${category.name}`" class="p-2 text-blue-600 hover:text-blue-800 disabled:opacity-50"><i class="fas fa-edit" aria-hidden="true"></i></button>
                                    <button type="button" @click="remove(category)" :disabled="busy" :aria-label="`Delete ${category.name}`" class="p-2 text-red-500 hover:text-red-700 disabled:opacity-50"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr v-if="!categories.length"><td colspan="5" class="px-6 py-12 text-center text-gray-500">No categories yet. Add your first category above.</td></tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
