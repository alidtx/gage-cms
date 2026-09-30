<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({
    socialLink: { type: Object, required: true },
});

const form = useForm({
    facebook:  props.socialLink.facebook  ?? '',
    linkedin:  props.socialLink.linkedin  ?? '',
    youtube:   props.socialLink.youtube   ?? '',
    instagram: props.socialLink.instagram ?? '',
    whatsapp:  props.socialLink.whatsapp  ?? '',
});

const busy = computed(() => form.processing);

const platforms = [
    { key: 'facebook',  label: 'Facebook',  icon: 'fab fa-facebook-f',  placeholder: 'https://facebook.com/yourpage',  color: 'text-blue-600'   },
    { key: 'linkedin',  label: 'LinkedIn',  icon: 'fab fa-linkedin-in', placeholder: 'https://linkedin.com/company/...', color: 'text-sky-700'    },
    { key: 'youtube',   label: 'YouTube',   icon: 'fab fa-youtube',     placeholder: 'https://youtube.com/@channel',    color: 'text-red-600'    },
    { key: 'instagram', label: 'Instagram', icon: 'fab fa-instagram',   placeholder: 'https://instagram.com/yourpage',  color: 'text-pink-600'   },
    { key: 'whatsapp',  label: 'WhatsApp',  icon: 'fab fa-whatsapp',    placeholder: '+960 7777777',                    color: 'text-green-600'  },
];

function save() {
    form.put(route('backend.social-link.update', props.socialLink.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Social links updated successfully.');
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
        <Head title="Social Links" />
        <div id="social-link" class="p-4 md:p-8">
            <!-- Header -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Social Links</h2>
                    <p class="text-sm text-gray-500">Manage your social media profile links</p>
                </div>
                <span class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl font-medium">
                    <i class="fas fa-share-alt mr-2" aria-hidden="true"></i>
                    {{ platforms.filter(p => form[p.key]).length }} / {{ platforms.length }} configured
                </span>
            </div>

            <!-- Form Card -->
            <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="font-semibold text-gray-700 mb-4">
                    <i class="fas fa-link text-blue-500 mr-2" aria-hidden="true"></i>Edit social links
                </h3>

                <fieldset :disabled="busy" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="platform in platforms" :key="platform.key">
                        <label :for="platform.key" class="block text-sm font-medium text-gray-700 mb-2">
                            <i :class="[platform.icon, platform.color, 'mr-2']" aria-hidden="true"></i>
                            {{ platform.label }}
                        </label>
                        <input
                            :id="platform.key"
                            v-model="form[platform.key]"
                            type="text"
                            :placeholder="platform.placeholder"
                            class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <InputError :message="form.errors[platform.key]" class="mt-2" />
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
                        {{ form.processing ? 'Saving...' : 'Update Social Links' }}
                    </button>
                </div>
            </form>

            <!-- Preview Card -->
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800">
                        <i class="fas fa-eye text-gray-500 mr-2" aria-hidden="true"></i>Preview
                    </h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Live preview</span>
                </div>
                <div class="p-6 flex flex-wrap gap-3">
                    <a
                        v-for="platform in platforms"
                        :key="platform.key"
                        :href="form[platform.key] || '#'"
                        target="_blank"
                        rel="noopener noreferrer"
                        :class="[
                            'inline-flex items-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium transition',
                            form[platform.key]
                                ? 'border-gray-200 hover:bg-gray-50 ' + platform.color
                                : 'border-gray-100 text-gray-300 cursor-not-allowed pointer-events-none'
                        ]"
                    >
                        <i :class="platform.icon" aria-hidden="true"></i>
                        {{ platform.label }}
                    </a>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>