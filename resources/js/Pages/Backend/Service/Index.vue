<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref, watch, onUnmounted } from 'vue';
import { toast } from 'vue3-toastify';
defineProps({ services: Object, entities: Array });
const editing = ref(null);
const imageUrl = ref(null);
const form = useForm({ title: '', description: '', entity_id: '', icon: null });
const iconInput = ref(null);
const localIconUrl = ref(null);
const iconPreview = computed(() => localIconUrl.value || imageUrl.value);
watch(() => form.icon, file => {
    if (localIconUrl.value) URL.revokeObjectURL(localIconUrl.value);
    localIconUrl.value = file ? URL.createObjectURL(new Blob([file], { type: 'image/svg+xml' })) : null;
});
onUnmounted(() => { if (localIconUrl.value) URL.revokeObjectURL(localIconUrl.value); });
const deletion = useForm({});
const busy = computed(() => form.processing || deletion.processing);
function reset() { editing.value = null; imageUrl.value = null; if (iconInput.value) iconInput.value.value = ''; form.reset(); form.clearErrors(); }
function edit(service) {
    reset(); editing.value = service.id; imageUrl.value = service.icon_url;
    for (const key of ['title', 'description', 'entity_id']) form[key] = service[key] ?? '';
    document.getElementById('service-title')?.focus();
}
function save() {
    if (busy.value) return;
    form.transform(data => ({ ...data, ...(editing.value ? { _method: 'put' } : {}) }))
        .post(route(editing.value ? 'backend.services.update' : 'backend.services.store', editing.value || undefined), {
            forceFormData: true, preserveScroll: true,
            onSuccess: () => { reset(); toast.success('Service saved.'); },
            onError: () => toast.error('Please check the highlighted fields.'),
        });
}
function remove(service) {
    if (!window.confirm('Delete “' + service.title + '”?')) return;
    deletion.delete(route('backend.services.destroy', service.id), {
        preserveScroll: true,
        onSuccess: () => { if (editing.value === service.id) reset(); toast.success('Service deleted.'); },
        onError: () => toast.error('Unable to delete service.'),
    });
}
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Service" />
        <div class="p-4 md:p-8 space-y-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Service Management</h1>
                <p class="text-sm text-gray-500">Create, update and manage services.</p>
            </div>
            <form @submit.prevent="save" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-semibold text-gray-800 mb-4">{{ editing ? 'Edit Service' : 'Add Service' }}</h2>
                <fieldset :disabled="busy" class="grid md:grid-cols-2 gap-4">
                    <label v-for="(label, key) in { title: 'Title' }" :key="key"
                        class="block text-sm font-medium text-gray-700">{{ label }}<input :id="'service-' + key"
                            v-model="form[key]" :required="key === 'title'" maxlength="255"
                            class="mt-2 w-full border-gray-200 rounded-xl" />
                        <InputError :message="form.errors[key]" />
                    </label>
                    <label class="block text-sm font-medium text-gray-700">Entity *<select required
                            v-model="form.entity_id" class="mt-2 w-full border-gray-200 rounded-xl">
                            <option value="" disabled>Select entity</option>
                            <option v-for="entity in entities" :key="entity.id" :value="entity.id">{{ entity.name }}
                            </option>
                        </select>
                        <InputError :message="form.errors.entity_id" />
                    </label>
                    <label class="md:col-span-2 block text-sm font-medium text-gray-700">Short description<textarea
                            v-model="form.description" maxlength="160" rows="4"
                            class="mt-2 w-full border-gray-200 rounded-xl"></textarea><span
                            class="text-xs text-gray-500">{{ (form.description || '').length }}/160 characters</span>
                        <InputError :message="form.errors.description" />
                    </label>
                    <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700">SVG Icon<input
                                ref="iconInput" type="file" accept=".svg"
                                @change="form.icon = $event.target.files?.[0] || null"
                                class="block mt-2 text-sm" /></label>
                        <p class="text-xs text-gray-500 mt-2">Static SVG, up to 64 KB. Leave empty to keep the existing
                            icon.</p><img v-if="iconPreview" :src="iconPreview" alt="SVG icon preview" class="w-14 h-14 mt-2"
                            />
                        <InputError :message="form.errors.icon" />
                    </div>
                </fieldset>
                <div class="mt-6 flex justify-end gap-3"><button v-if="editing" type="button" @click="reset"
                        :disabled="busy" class="px-5 py-2 rounded-xl bg-gray-100">Cancel</button><button
                        :disabled="busy" class="px-5 py-2 rounded-xl bg-blue-600 text-white disabled:opacity-50">{{
                            form.processing ? 'Saving...' : 'Save Service' }}</button></div>
            </form>
            <section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-5 flex justify-between">
                    <h2 class="font-semibold text-gray-800">All Services</h2><span class="text-sm text-gray-500">{{
                        services.total }} services</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left">
                        <thead class="bg-gray-50 border-y border-gray-200 text-xs uppercase text-gray-600">
                            <tr>
                                <th v-for="label in ['Icon', 'Title', 'Entity', 'Short description', 'Actions']"
                                    :key="label" class="px-5 py-3" scope="col">{{ label }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="service in services.data" :key="service.id">
                                <td class="px-5 py-4"><img v-if="service.icon_url" :src="service.icon_url"
                                        :alt="service.title" class="w-14 h-14 rounded-lg object-cover" /><span v-else
                                        class="text-gray-400">—</span></td>
                                <td class="px-5 py-4 text-gray-900">{{ service.title }}</td>
                                <td class="px-5 py-4 text-sm text-gray-600">{{ service.entity?.name || '—' }}</td>
                                <td class="px-5 py-4 text-sm text-gray-600">{{ service.description || '—' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap"><button type="button" @click="edit(service)"
                                        :disabled="busy" class="text-blue-600 mr-4">Edit</button><button type="button"
                                        @click="remove(service)" :disabled="busy" class="text-red-500">Delete</button>
                                </td>
                            </tr>
                            <tr v-if="!services.data.length">
                                <td colspan="5" class="p-10 text-center text-gray-500">No services yet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Service pages" class="p-4 flex flex-wrap gap-2 border-t border-gray-100"><template
                        v-for="link in services.links" :key="link.label">
                        <Link v-if="link.url && !busy" :href="link.url" :aria-current="link.active ? 'page' : undefined"
                            class="px-3 py-1 rounded-lg border text-sm"
                            :class="link.active ? 'bg-blue-600 text-white' : 'text-gray-600'" v-html="link.label" />
                        <span v-else class="px-3 py-1 text-gray-400 text-sm" v-html="link.label"></span>
                    </template>
                </nav>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
