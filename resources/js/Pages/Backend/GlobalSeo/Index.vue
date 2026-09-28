<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    globalSetting: Object,
});

const form = useForm({
    site_name: props.globalSetting.site_name ?? '',
    site_description: props.globalSetting.site_description ?? '',
    site_keywords: props.globalSetting.site_keywords ?? '',
    author: props.globalSetting.author ?? '',
    publisher: props.globalSetting.publisher ?? '',
    facebook_app_id: props.globalSetting.facebook_app_id ?? '',
    twitter_site: props.globalSetting.twitter_site ?? '',
    google_analytics_id: props.globalSetting.google_analytics_id ?? '',
    google_tag_manager_id: props.globalSetting.google_tag_manager_id ?? '',
    default_og_image: null,
    default_twitter_image: null,
});

const ogPreview = ref(props.globalSetting.default_og_image_url);
const twitterPreview = ref(props.globalSetting.default_twitter_image_url);

const handleOgImage = (e) => {
    const file = e.target.files[0];
    form.default_og_image = file;
    if (file) ogPreview.value = URL.createObjectURL(file);
};

const handleTwitterImage = (e) => {
    const file = e.target.files[0];
    form.default_twitter_image = file;
    if (file) twitterPreview.value = URL.createObjectURL(file);
};

const submit = () => {
    form.put(route('backend.global-settings.update', props.globalSetting.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Global Seo" />

        <div id="global" class="p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Global SEO Settings</h2>
                    <p class="text-gray-600">Site-wide configuration that applies to all pages</p>
                </div>
                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors disabled:opacity-50"
                >
                    <i class="fas fa-save mr-2"></i>
                    {{ form.processing ? 'Saving...' : 'Save Global Settings' }}
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Site Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Site Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                            <input
                                v-model="form.site_name"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.site_name" class="text-xs text-red-500 mt-1">{{ form.errors.site_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                            <textarea
                                v-model="form.site_description"
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            ></textarea>
                            <p v-if="form.errors.site_description" class="text-xs text-red-500 mt-1">{{ form.errors.site_description }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Site Keywords</label>
                            <input
                                v-model="form.site_keywords"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <span class="text-xs text-gray-500 mt-1">Separate with commas</span>
                            <p v-if="form.errors.site_keywords" class="text-xs text-red-500 mt-1">{{ form.errors.site_keywords }}</p>
                        </div>
                    </div>
                </div>

                <!-- Default Images -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Default Images</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Default OG Image</label>
                            <div class="flex items-center space-x-4">
                                <div class="w-32 h-20 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300 overflow-hidden">
                                    <img v-if="ogPreview" :src="ogPreview" alt="OG Preview" class="w-full h-full object-cover" />
                                    <i v-else class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                                <div>
                                    <label class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors cursor-pointer inline-block">
                                        <i class="fas fa-upload mr-2"></i> Upload
                                        <input type="file" accept="image/*" class="hidden" @change="handleOgImage" />
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">1200x630px recommended</p>
                                    <p v-if="form.errors.default_og_image" class="text-xs text-red-500 mt-1">{{ form.errors.default_og_image }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Default Twitter Image</label>
                            <div class="flex items-center space-x-4">
                                <div class="w-32 h-20 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300 overflow-hidden">
                                    <img v-if="twitterPreview" :src="twitterPreview" alt="Twitter Preview" class="w-full h-full object-cover" />
                                    <i v-else class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                                <div>
                                    <label class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors cursor-pointer inline-block">
                                        <i class="fas fa-upload mr-2"></i> Upload
                                        <input type="file" accept="image/*" class="hidden" @change="handleTwitterImage" />
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">1200x600px recommended</p>
                                    <p v-if="form.errors.default_twitter_image" class="text-xs text-red-500 mt-1">{{ form.errors.default_twitter_image }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social & Analytics -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Social & Analytics</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <input
                                v-model="form.author"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.author" class="text-xs text-red-500 mt-1">{{ form.errors.author }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Publisher</label>
                            <input
                                v-model="form.publisher"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.publisher" class="text-xs text-red-500 mt-1">{{ form.errors.publisher }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Facebook App ID</label>
                            <input
                                v-model="form.facebook_app_id"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.facebook_app_id" class="text-xs text-red-500 mt-1">{{ form.errors.facebook_app_id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Site</label>
                            <input
                                v-model="form.twitter_site"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.twitter_site" class="text-xs text-red-500 mt-1">{{ form.errors.twitter_site }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Google Analytics ID</label>
                            <input
                                v-model="form.google_analytics_id"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.google_analytics_id" class="text-xs text-red-500 mt-1">{{ form.errors.google_analytics_id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Google Tag Manager ID</label>
                            <input
                                v-model="form.google_tag_manager_id"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <p v-if="form.errors.google_tag_manager_id" class="text-xs text-red-500 mt-1">{{ form.errors.google_tag_manager_id }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>