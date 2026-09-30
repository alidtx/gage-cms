<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({
    islandReachSetting: { type: Object, required: true }
});

const locationTypes = [
    { value: 'island', label: 'Island' },
    { value: 'resort', label: 'Resort' },
    { value: 'city', label: 'City' },
    { value: 'airport', label: 'Airport' },
    { value: 'harbor', label: 'Harbor' },
    { value: 'other', label: 'Other' },
];

const form = useForm({
    name: props.islandReachSetting.name ?? '',
    atoll: props.islandReachSetting.atoll ?? '',
    description: props.islandReachSetting.description ?? '',
    latitude: props.islandReachSetting.latitude ?? '',
    longitude: props.islandReachSetting.longitude ?? '',
    location_type: props.islandReachSetting.location_type ?? 'island',
    is_featured: Boolean(props.islandReachSetting.is_featured),
    marker_color: props.islandReachSetting.marker_color ?? '#3388ff',
    marker_icon: props.islandReachSetting.marker_icon ?? '',
    sort_order: props.islandReachSetting.sort_order ?? 0,
    is_active: Boolean(props.islandReachSetting.is_active),
});

const busy = computed(() => form.processing);

// Auto-generate sort order hint when empty
watch(() => form.sort_order, (val) => {
    if (val === null || val === undefined || val === '') {
        form.sort_order = 0;
    }
});

function save() {
    form.put(route('backend.island-reach-location.update', props.islandReachSetting.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Island reach setting updated successfully.');
        },
    });
}

function resetForm() {
    form.reset();
    form.clearErrors();
    toast.info('Form reset to original values.');
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Island Reach Setting" />
        <div id="island-reach-setting" class="p-4 md:p-8">
            <!-- Header -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Island Reach Setting</h2>
                    <p class="text-sm text-gray-500">Configure the island reach location details and map marker</p>
                </div>
                <span class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl font-medium">
                    <i class="fas fa-map-marked-alt mr-2" aria-hidden="true"></i>
                    {{ islandReachSetting.is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <!-- Form Card -->
            <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="font-semibold text-gray-700 mb-4">
                    <i class="fas fa-edit text-blue-500 mr-2" aria-hidden="true"></i>Edit island reach location
                </h3>

                <fieldset :disabled="busy" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="name"
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
                        <label for="atoll" class="block text-sm font-medium text-gray-700 mb-2">Atoll</label>
                        <input
                            id="atoll"
                            v-model="form.atoll"
                            maxlength="255"
                            placeholder="e.g. Kaafu"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.atoll" class="mt-2" />
                    </div>

                    <!-- Location Type -->
                    <div>
                        <label for="location_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Location Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="location_type"
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
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input
                            id="latitude"
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
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input
                            id="longitude"
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
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input
                            id="sort_order"
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
                        <label for="marker_color" class="block text-sm font-medium text-gray-700 mb-2">Marker Color</label>
                        <div class="flex items-center gap-2">
                            <input
                                id="marker_color"
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
                        <label for="marker_icon" class="block text-sm font-medium text-gray-700 mb-2">Marker Icon</label>
                        <input
                            id="marker_icon"
                            v-model="form.marker_icon"
                            maxlength="255"
                            placeholder="e.g. fa-map-marker-alt"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors.marker_icon" class="mt-2" />
                    </div>

                    <!-- Description (full width) -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="4"
                            placeholder="Short description about this island reach location..."
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 resize-y"
                        ></textarea>
                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>

                    <!-- Is Featured -->
                    <div>
                        <label for="is_featured" class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                        <select
                            id="is_featured"
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
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            id="is_active"
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
                        type="button"
                        @click="resetForm"
                        :disabled="busy"
                        class="px-5 py-3 border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                    >
                        <i class="fas fa-undo mr-2" aria-hidden="true"></i>Reset
                    </button>
                    <button
                        type="submit"
                        :disabled="busy"
                        class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fas fa-save mr-2" aria-hidden="true"></i>
                        {{ form.processing ? 'Saving...' : 'Update Setting' }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>