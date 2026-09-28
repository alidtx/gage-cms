<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    basicSeo: {
        type: Object,
        required: true,
    },
});

/* ---------- Custom schema → pretty string ---------- */
const schemaString = props.basicSeo.custom_schema
    ? JSON.stringify(props.basicSeo.custom_schema, null, 2)
    : '';

/* ---------- Form ---------- */
const form = useForm({
    _method: 'PUT',
    title:              props.basicSeo.title ?? '',
    meta_description:   props.basicSeo.meta_description ?? '',
    keywords:           props.basicSeo.keywords ?? '',

    og_title:           props.basicSeo.og_title ?? '',
    og_type:            props.basicSeo.og_type ?? 'website',
    og_description:     props.basicSeo.og_description ?? '',

    canonical_url:      props.basicSeo.canonical_url ?? '',

    schema_type:        props.basicSeo.schema_type ?? 'Service',
    custom_schema:      schemaString,

    twitter_title:      props.basicSeo.twitter_title ?? '',
    twitter_card_type:  props.basicSeo.twitter_card_type ?? 'summary_large_image',
    twitter_description:props.basicSeo.twitter_description ?? '',

    // The file — sent only when user picks a new one
    social_share_image: null,
});

/* ---------- Image preview (server value + local override) ---------- */
const localImagePreview = ref(null); // set when user picks a new file

const imagePreview = computed(() =>
    localImagePreview.value ?? props.basicSeo.media?.url ?? null
);

function onImageChange(e) {
    const file = e.target.files?.[0] ?? null;
    form.social_share_image = file;

    // Clean up old blob URL if any
    if (localImagePreview.value) URL.revokeObjectURL(localImagePreview.value);

    localImagePreview.value = file ? URL.createObjectURL(file) : null;
}

/* ---------- Character counters ---------- */
const titleCount = computed(() => (form.title || '').length);
const descCount  = computed(() => (form.meta_description || '').length);

const titleStatus = computed(() => {
    if (titleCount.value === 0) return 'text-gray-500';
    return titleCount.value >= 50 && titleCount.value <= 60
        ? 'text-green-600'
        : 'text-amber-600';
});

const descStatus = computed(() => {
    if (descCount.value === 0) return 'text-gray-500';
    return descCount.value >= 120 && descCount.value <= 160
        ? 'text-green-600'
        : 'text-amber-600';
});

/* ---------- Preview host ---------- */
const previewUrl = computed(() => {
    if (!form.canonical_url) return 'example.com';
    try {
        return new URL(form.canonical_url).hostname;
    } catch {
        return form.canonical_url;
    }
});

/* ---------- Submit ---------- */
function submit() {
    form.post(route('backend.basic-seo.update', props.basicSeo.id), {
        forceFormData: true,       // required for file uploads
        preserveScroll: true,
        onSuccess: () => {
            // Clear local state so the page shows the newly-uploaded server image
            if (localImagePreview.value) URL.revokeObjectURL(localImagePreview.value);
            localImagePreview.value = null;
            form.social_share_image = null;
        },
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Basic SEO" />

        <div id="edit" class="p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Edit SEO Settings</h2>
                    <p class="text-gray-600">
                        Digital Marketing Services
                        <span class="text-gray-400">|</span>
                        <span class="text-sm text-blue-600">Last updated: 2 hours ago</span>
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <button
                        type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-colors"
                    >
                        <i class="fas fa-eye mr-2"></i> Preview
                    </button>
                    <button
                        type="button"
                        @click="submit"
                        :disabled="form.processing"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <i class="fas fa-save mr-2"></i>
                        {{ form.processing ? 'Saving...' : 'Save Changes' }}
                    </button>
                </div>
            </div>

            <!-- Flash -->
            <div
                v-if="$page.props.flash?.success"
                class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm"
            >
                <i class="fas fa-check-circle mr-2"></i>{{ $page.props.flash.success }}
            </div>

            <form @submit.prevent="submit" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">

                    <!-- Basic SEO -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic SEO</h3>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input
                                v-model="form.title"
                                type="text"
                                maxlength="70"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <div class="flex justify-between mt-1">
                                <span class="text-xs text-gray-500">Recommended: 50-60 characters</span>
                                <span class="text-xs font-medium" :class="titleStatus">
                                    {{ titleCount }} / 70 characters
                                </span>
                            </div>
                            <p v-if="form.errors.title" class="text-xs text-red-600 mt-1">
                                {{ form.errors.title }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea
                                v-model="form.meta_description"
                                rows="2"
                                maxlength="160"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            ></textarea>
                            <div class="flex justify-between mt-1">
                                <span class="text-xs text-gray-500">Recommended: 120-160 characters</span>
                                <span class="text-xs font-medium" :class="descStatus">
                                    {{ descCount }} / 160 characters
                                </span>
                            </div>
                            <p v-if="form.errors.meta_description" class="text-xs text-red-600 mt-1">
                                {{ form.errors.meta_description }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                            <input
                                v-model="form.keywords"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            />
                            <span class="text-xs text-gray-500 mt-1">Separate keywords with commas</span>
                        </div>
                    </div>

                    <!-- Open Graph -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Open Graph (Social Media)</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Title</label>
                                <input
                                    v-model="form.og_title"
                                    type="text"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Type</label>
                                <select
                                    v-model="form.og_type"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                >
                                    <option value="website">website</option>
                                    <option value="article">article</option>
                                    <option value="product">product</option>
                                    <option value="service">service</option>
                                    <option value="video">video</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">OG Description</label>
                            <textarea
                                v-model="form.og_description"
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            ></textarea>
                        </div>

                        <!-- Social share image (upload) -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Social Share Image
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="w-32 h-20 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <img
                                        v-if="imagePreview"
                                        :src="imagePreview"
                                        class="w-full h-full object-cover"
                                        alt="Social share preview"
                                    />
                                    <i v-else class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                                <div>
                                    <label class="cursor-pointer px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors inline-block">
                                        <i class="fas fa-upload mr-2"></i> Upload Image
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="hidden"
                                            @change="onImageChange"
                                        />
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">Recommended: 1200×630px (JPG/PNG/WebP, max 4MB)</p>
                                    <p v-if="form.errors.social_share_image" class="text-xs text-red-600 mt-1">
                                        {{ form.errors.social_share_image }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Twitter Cards -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Twitter Cards</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Title</label>
                                <input
                                    v-model="form.twitter_title"
                                    type="text"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Card Type</label>
                                <select
                                    v-model="form.twitter_card_type"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                >
                                    <option value="summary_large_image">summary_large_image</option>
                                    <option value="summary">summary</option>
                                    <option value="app">app</option>
                                    <option value="player">player</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Description</label>
                            <textarea
                                v-model="form.twitter_description"
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Advanced Settings -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Advanced Settings</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Canonical URL</label>
                                <input
                                    v-model="form.canonical_url"
                                    type="url"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                />
                                <p v-if="form.errors.canonical_url" class="text-xs text-red-600 mt-1">
                                    {{ form.errors.canonical_url }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Schema Type</label>
                                <select
                                    v-model="form.schema_type"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                >
                                    <option>Article</option>
                                    <option>Service</option>
                                    <option>Product</option>
                                    <option>NewsArticle</option>
                                    <option>JobPosting</option>
                                    <option>FAQPage</option>
                                    <option>Custom</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Custom Schema (JSON-LD)</label>
                            <textarea
                                v-model="form.custom_schema"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder='{ "@context": "https://schema.org", "@type": "Service" }'
                            ></textarea>
                            <span class="text-xs text-gray-500 mt-1 block">
                                Must be valid JSON. Stored in the <code>custom_schema</code> JSON column.
                            </span>
                            <p v-if="form.errors.custom_schema" class="text-xs text-red-600 mt-1">
                                {{ form.errors.custom_schema }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Live Preview -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Search Preview</h4>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-blue-600 text-sm hover:underline cursor-pointer truncate">
                                {{ form.canonical_url || 'https://example.com/services/digital-marketing' }}
                            </p>
                            <h3 class="text-xl text-blue-800 font-medium hover:underline cursor-pointer mt-1 line-clamp-2">
                                {{ form.title || 'Your Meta Title' }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                {{ form.meta_description || 'Your meta description will appear here.' }}
                            </p>
                        </div>

                        <hr class="my-4 border-gray-200" />

                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Social Preview</h4>
                        <div class="bg-gray-50 rounded-xl overflow-hidden">
                            <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
                                <img v-if="imagePreview" :src="imagePreview" class="w-full h-full object-cover" alt="Social preview" />
                                <i v-else class="fas fa-image text-4xl text-white opacity-50"></i>
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-gray-500">{{ previewUrl }}</p>
                                <h4 class="font-semibold text-gray-800 text-sm line-clamp-2">
                                    {{ form.og_title || form.title || 'Your OG Title' }}
                                </h4>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                    {{ form.og_description || form.meta_description || 'Your OG description...' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>