<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({
    islandReachSettings: { type: Array, required: true },
});

const locationTypes = [
    { value: 'island',  label: 'Island'  },
    { value: 'resort',  label: 'Resort'  },
    { value: 'city',    label: 'City'    },
    { value: 'airport', label: 'Airport' },
    { value: 'harbor',  label: 'Harbor'  },
    { value: 'other',   label: 'Other'   },
];

const editingId = ref(null);
const deletion  = useForm({});

const form = useForm({
    name: '',
    atoll: '',
    description: '',
    latitude: '',
    longitude: '',
    location_type: 'island',
    is_featured: false,
    marker_color: '#3388ff',
    marker_icon: '',
    sort_order: 0,
    is_active: true,
});

const busy = computed(() => form.processing || deletion.processing);

function reset() {
    editingId.value = null;
    form.reset();
    form.clearErrors();
}

function edit(setting) {
    reset();
    deletion.clearErrors();
    editingId.value = setting.id;
    Object.assign(form, {
        name: setting.name ?? '',
        atoll: setting.atoll ?? '',
        description: setting.description ?? '',
        latitude: setting.latitude ?? '',
        longitude: setting.longitude ?? '',
        location_type: setting.location_type ?? 'island',
        is_featured: Boolean(setting.is_featured),
        marker_color: setting.marker_color ?? '#3388ff',
        marker_icon: setting.marker_icon ?? '',
        sort_order: setting.sort_order ?? 0,
        is_active: Boolean(setting.is_active),
    });
    document.getElementById('islandName')?.focus();
}

function save() {
    const updating = editingId.value !== null;
    const options = {
        preserveScroll: true,
        onSuccess: () => {
            reset();
            toast.success(updating ? 'Setting updated successfully.' : 'Setting created successfully.');
        },
    };
    deletion.clearErrors();
    if (updating) {
        form.put(route('backend.island-reach-location.update', editingId.value), options);
    } else {
        form.post(route('backend.island-reach-location.store'), options);
    }
}

function remove(setting) {
    if (!window.confirm(`Delete “${setting.name}”? This cannot be undone.`)) return;
    deletion.clearErrors();
    deletion.delete(route('backend.island-reach-location.destroy', setting.id), {
        preserveScroll: true,
        onSuccess: () => {
            if (editingId.value === setting.id) reset();
            toast.success('Setting deleted successfully.');
        },
    });
}

const typeLabel = (value) =>
    locationTypes.find((t) => t.value === value)?.label ?? value;
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Island Reach Settings" />
        <div id="island-reach-setting" class="p-4 md:p-8">
            <!-- Header -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Island Reach Settings</h2>
                    <p class="text-sm text-gray-500">Add, edit or remove island reach locations and their map markers</p>
                </div>
                <span class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl font-medium">
                    <i class="fas fa-map-marked-alt mr-2" aria-hidden="true"></i>
                    {{ islandReachSettings.length }} locations
                </span>
            </div>

            <!-- Form Card -->
            <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="font-semibold text-gray-700 mb-4">
                    <i class="fas fa-plus-circle text-blue-500 mr-2" aria-hidden="true"></i>
                    {{ editingId ? 'Edit island reach location' : 'Add new island reach location' }}
                </h3>

                <fieldset :disabled="busy" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="islandName" class="block text-sm font-medium text-gray-700 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="islandName"
                            v-model="form.name"
                            required
                            maxlength="255"
                            placeholder="e.g. Malé Island"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <!-- Atoll -->
                    <div>
                        <label for="islandAtoll" class="block text-sm font-medium text-gray-700 mb-2">Atoll</label>
                        <input
                            id="islandAtoll"
                            v-model="form.atoll"
                            maxlength="255"
                            placeholder="e.g. Kaafu"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.atoll" class="mt-2" />
                    </div>

                    <!-- Location Type -->
                    <div>
                        <label for="islandType" class="block text-sm font-medium text-gray-700 mb-2">
                            Location Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="islandType"
                            v-model="form.location_type"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option v-for="type in locationTypes" :key="type.value" :value="type.value">
                                {{ type.label }}
                            </option>
                        </select>
                        <InputError :message="form.errors.location_type" class="mt-2" />
                    </div>

                    <!-- Latitude -->
                    <div>
                        <label for="islandLatitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input
                            id="islandLatitude"
                            v-model="form.latitude"
                            type="number"
                            step="any"
                            placeholder="e.g. 4.1755000"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.latitude" class="mt-2" />
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label for="islandLongitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input
                            id="islandLongitude"
                            v-model="form.longitude"
                            type="number"
                            step="any"
                            placeholder="e.g. 73.5089000"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.longitude" class="mt-2" />
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="islandSortOrder" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input
                            id="islandSortOrder"
                            v-model.number="form.sort_order"
                            type="number"
                            min="0"
                            placeholder="0"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.sort_order" class="mt-2" />
                    </div>

                    <!-- Marker Color -->
                    <div>
                        <label for="islandMarkerColor" class="block text-sm font-medium text-gray-700 mb-2">Marker Color</label>
                        <div class="flex items-center gap-2">
                            <input
                                id="islandMarkerColor"
                                v-model="form.marker_color"
                                type="color"
                                class="h-11 w-14 p-1 border border-gray-200 rounded-xl cursor-pointer"
                            />
                            <input
                                :value="form.marker_color"
                                readonly
                                class="flex-1 px-4 py-3 border-gray-200 rounded-xl bg-gray-100 text-gray-500 font-mono text-sm cursor-not-allowed"
                            />
                        </div>
                        <InputError :message="form.errors.marker_color" class="mt-2" />
                    </div>

                    <!-- Marker Icon -->
                    <div>
                        <label for="islandMarkerIcon" class="block text-sm font-medium text-gray-700 mb-2">Marker Icon</label>
                        <input
                            id="islandMarkerIcon"
                            v-model="form.marker_icon"
                            maxlength="255"
                            placeholder="e.g. fa-map-marker-alt"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.marker_icon" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label for="islandDescription" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea
                            id="islandDescription"
                            v-model="form.description"
                            rows="4"
                            placeholder="Short description about this island reach location..."
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 resize-y"
                        ></textarea>
                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>

                    <!-- Is Featured -->
                    <div>
                        <label for="islandFeatured" class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                        <select
                            id="islandFeatured"
                            v-model="form.is_featured"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option :value="true">Yes</option>
                            <option :value="false">No</option>
                        </select>
                        <InputError :message="form.errors.is_featured" class="mt-2" />
                    </div>

                    <!-- Is Active -->
                    <div>
                        <label for="islandStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            id="islandStatus"
                            v-model="form.is_active"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option :value="true">Active</option>
                            <option :value="false">Inactive</option>
                        </select>
                        <InputError :message="form.errors.is_active" class="mt-2" />
                    </div>
                </fieldset>

                <!-- Actions -->
                <div class="mt-6 flex justify-end gap-3">
                    <button
                        v-if="editingId"
                        type="button"
                        @click="reset"
                        :disabled="busy"
                        class="px-5 py-3 border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        :disabled="busy"
                        class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fas fa-save mr-2" aria-hidden="true"></i>
                        {{ form.processing ? 'Saving...' : editingId ? 'Update Setting' : 'Save Setting' }}
                    </button>
                </div>
            </form>

            <!-- Deletion Error -->
            <div
                v-if="deletion.errors.setting"
                role="alert"
                class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl"
            >
                {{ deletion.errors.setting }}
            </div>

            <!-- List -->
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800">
                        <i class="fas fa-list-ul text-gray-500 mr-2" aria-hidden="true"></i>All island reach locations
                    </h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        {{ islandReachSettings.length }} items
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px]">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th
                                    v-for="heading in ['Name', 'Atoll', 'Type', 'Coordinates', 'Order', 'Status', 'Actions']"
                                    :key="heading"
                                    scope="col"
                                    class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    :class="heading === 'Actions' ? 'text-right' : 'text-left'"
                                >
                                    {{ heading }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="setting in islandReachSettings" :key="setting.id">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="inline-block h-3 w-3 rounded-full border border-gray-200"
                                            :style="{ backgroundColor: setting.marker_color || '#3388ff' }"
                                            aria-hidden="true"
                                        ></span>
                                        <div>
                                            <div class="text-gray-900 font-medium">{{ setting.name }}</div>
                                            <div v-if="setting.is_featured" class="text-xs text-amber-600">
                                                <i class="fas fa-star mr-1" aria-hidden="true"></i>Featured
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ setting.atoll || '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                        {{ typeLabel(setting.location_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-mono text-gray-500">
                                    <span v-if="setting.latitude !== null && setting.longitude !== null">
                                        {{ Number(setting.latitude).toFixed(4) }}, {{ Number(setting.longitude).toFixed(4) }}
                                    </span>
                                    <span v-else>—</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ setting.sort_order }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium"
                                        :class="setting.is_active ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800'"
                                    >
                                        {{ setting.is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button
                                        type="button"
                                        @click="edit(setting)"
                                        :disabled="busy"
                                        :aria-label="`Edit ${setting.name}`"
                                        class="p-2 text-blue-600 hover:text-blue-800 disabled:opacity-50"
                                    >
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <button
                                        type="button"
                                        @click="remove(setting)"
                                        :disabled="busy"
                                        :aria-label="`Delete ${setting.name}`"
                                        class="p-2 text-red-500 hover:text-red-700 disabled:opacity-50"
                                    >
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="!islandReachSettings.length">
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    No island reach locations yet. Add your first location above.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>