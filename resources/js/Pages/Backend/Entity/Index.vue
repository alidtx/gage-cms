<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

defineProps({ entities: Object });
const editingId = ref(null);
const currentImage = ref(null);
const form = useForm({ title: '', bio: '', description: '', badge: '', image: null });
const deletion = useForm({});
const busy = computed(() => form.processing || deletion.processing);
function reset() {
    editingId.value = null;
    currentImage.value = null;
    form.reset();
    form.clearErrors();
}
function edit(entity) {
    reset();
    editingId.value = entity.id;
    currentImage.value = entity.image_url;
    Object.assign(form, { title: entity.title, bio: entity.bio ?? '', description: entity.description ?? '', badge: entity.badge ?? '' });
    document.getElementById('entity-title')?.focus();
}
function save() {
    if (busy.value) return;
    const updating = editingId.value !== null;
    form.transform(data => ({ ...data, ...(updating ? { _method: 'put' } : {}) }))
        .post(route(updating ? 'backend.entities.update' : 'backend.entities.store', updating ? editingId.value : undefined), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => { reset(); toast.success(updating ? 'Entity updated.' : 'Entity created.'); },
            onError: () => toast.error('Please check the highlighted fields.'),
        });
}
function remove(entity) {
    if (!window.confirm('Delete “' + entity.title + '”? Its profile and uploaded image will also be removed.')) return;
    deletion.delete(route('backend.entities.destroy', entity.id), {
        preserveScroll: true,
        onSuccess: () => { if (editingId.value === entity.id) reset(); toast.success('Entity deleted.'); },
        onError: () => toast.error('Unable to delete this entity.'),
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Entities" />
        <div class="p-4 md:p-8">
            <div class="flex items-center justify-between gap-4 mb-6">
                <div><h2 class="text-xl font-semibold text-gray-800">Manage Entities</h2><p class="text-sm text-gray-500">Add, edit or remove entities</p></div>
                <span class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl">{{ entities.total }} entities</span>
            </div>
            <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="font-semibold text-gray-800 mb-4">{{ editingId ? 'Edit entity' : 'Add new entity' }}</h3>
                <fieldset :disabled="busy" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="entity-title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input id="entity-title" v-model="form.title" required maxlength="255" class="w-full border-gray-200 rounded-xl px-4 py-3" />
                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>
                    <div>
                        <label for="entity-badge" class="block text-sm font-medium text-gray-700 mb-2">Badge</label>
                        <input id="entity-badge" v-model="form.badge" maxlength="255" placeholder="e.g. Partner" class="w-full border-gray-200 rounded-xl px-4 py-3" />
                        <InputError :message="form.errors.badge" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="entity-bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea id="entity-bio" v-model="form.bio" maxlength="255" rows="2" placeholder="A short introduction" class="w-full border-gray-200 rounded-xl px-4 py-3"></textarea>
                        <InputError :message="form.errors.bio" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="entity-description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="entity-description" v-model="form.description" maxlength="10000" rows="5" class="w-full border-gray-200 rounded-xl px-4 py-3"></textarea>
                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <p class="block text-sm font-medium text-gray-700 mb-2">Image</p>
                        <ImageUpload v-model="form.image" :current-url="currentImage" :error="form.errors.image" accepted-type="image/jpeg,image/png,image/webp,image/gif" helper-text="JPG, PNG, WebP or GIF, up to 5 MB" />
                    </div>
                </fieldset>
                <div class="mt-6 flex justify-end gap-3">
                    <button v-if="editingId" type="button" :disabled="busy" @click="reset" class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 disabled:opacity-50">Cancel</button>
                    <button type="submit" :disabled="busy" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold disabled:opacity-50">{{ form.processing ? 'Saving...' : editingId ? 'Update Entity' : 'Save Entity' }}</button>
                </div>
            </form>
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800">All entities</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ entities.total }} items</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[650px] text-left">
                        <thead class="bg-gray-50 border-b border-gray-200"><tr>
                            <th v-for="heading in ['Image', 'Title', 'Bio', 'Badge', 'Actions']" :key="heading" scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase" :class="{ 'text-right': heading === 'Actions' }">{{ heading }}</th>
                        </tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="entity in entities.data" :key="entity.id">
                                <td class="px-6 py-4"><img v-if="entity.image_url" :src="entity.image_url" :alt="entity.title" class="w-14 h-14 object-cover rounded-lg" /><span v-else class="text-gray-400">—</span></td>
                                <td class="px-6 py-4 text-gray-900">{{ entity.title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs break-words">{{ entity.bio || '—' }}</td>
                                <td class="px-6 py-4"><span v-if="entity.badge" class="px-3 py-1 rounded-full text-xs bg-blue-50 text-blue-700">{{ entity.badge }}</span><span v-else class="text-gray-400">—</span></td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button type="button" :disabled="busy" @click="edit(entity)" :aria-label="'Edit ' + entity.title" class="p-2 text-blue-600 disabled:opacity-50"><i class="fas fa-edit" aria-hidden="true"></i></button>
                                    <button type="button" :disabled="busy" @click="remove(entity)" :aria-label="'Delete ' + entity.title" class="p-2 text-red-500 disabled:opacity-50"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr v-if="!entities.data.length"><td colspan="5" class="p-10 text-center text-gray-500">No entities yet. Add your first entity above.</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex flex-wrap justify-between items-center gap-3 text-sm text-gray-500">
                    <span>Showing {{ entities.from ?? 0 }}–{{ entities.to ?? 0 }} of {{ entities.total }} entities</span>
                    <nav aria-label="Entity pages" class="flex gap-2">
                        <template v-for="link in entities.links" :key="link.label">
                            <Link v-if="link.url && !busy" :href="link.url" :aria-current="link.active ? 'page' : undefined" class="px-3 py-1 border rounded-lg" :class="link.active ? 'bg-blue-600 text-white border-blue-600' : 'border-gray-200'" v-html="link.label" />
                            <span v-else class="px-3 py-1 border border-gray-100 rounded-lg text-gray-400" v-html="link.label"></span>
                        </template>
                    </nav>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
