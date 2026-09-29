<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import InputError from '@/Components/InputError.vue';
import ArticlePreview from './ArticlePreview.vue';
import NewsTable from './NewsTable.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({ articles: Object, article: { type: Object, default: null }, categories: Array, authors: Array, filters: Object });
const page = usePage();
const preview = ref(false);
const defaults = article => ({
    title: article?.title ?? '', slug: article?.slug ?? '', news_category_id: article?.news_category_id ?? '',
    author_id: article?.author_id ?? (article ? '' : page.props.auth.user.id), excerpt: article?.excerpt ?? '', content: article?.content ?? '',
    featured_image: null, og_image: null, published_at: article?.published_at ?? '', status: article?.status ?? 'draft',
    is_featured: article?.is_featured ?? false, meta_title: article?.meta_title ?? '', meta_description: article?.meta_description ?? '', canonical_url: article?.canonical_url ?? '',
});
const form = useForm(defaults(props.article));
const deletion = useForm({});
const busy = computed(() => form.processing || deletion.processing);
const slugify = value => value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
watch(() => form.title, (title, previous) => {
    if (!form.slug || form.slug === slugify(previous)) form.slug = slugify(title);
});
watch(() => props.article?.id, () => {
    form.defaults(defaults(props.article));
    form.reset();
    form.clearErrors();
});
function save() {
    const editing = Boolean(props.article);
    form.transform(data => ({ ...data, ...(editing ? { _method: 'put' } : {}) }))
        .post(route(editing ? 'backend.news.update' : 'backend.news.store', editing ? props.article.id : undefined), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                form.defaults(defaults(null));
                form.reset();
                toast.success(editing ? 'News article updated.' : 'News article created.')
            },
            onError: () => toast.error('Please check the highlighted fields.'),
        });
}
function remove(article) {
    if (!window.confirm(`Delete “${article.title}” and its images? This cannot be undone.`)) return;
    deletion.delete(route('backend.news.destroy', article.id), {
        preserveScroll: true,
        onSuccess: () => toast.success('News article deleted.'),
        onError: () => toast.error('Unable to delete this article.'),
    });
}
function viewAll() {
    document.getElementById('all-news')?.scrollIntoView({ behavior: 'smooth' });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="News" />
        <div class="p-4 md:p-8">
          <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800"><i class="fas fa-newspaper text-blue-500 mr-2" aria-hidden="true"></i>{{ article ? 'Edit News Article' : 'Add News Article' }}</h2>
                    <p class="text-sm text-gray-500">Fill in the fields below to create or update a news article</p>
                </div>
                <!-- <button type="button" @click="viewAll" class="px-4 py-2 text-gray-700 rounded-xl hover:bg-gray-200 text-sm"><i class="fas fa-list mr-2" aria-hidden="true"></i>View All News</button> -->
            </div>
             <form @submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <div v-if="form.hasErrors" role="alert" class="mb-6 p-4 rounded-xl bg-red-50 text-red-700">
                    <p v-for="(error, field) in form.errors" :key="field">{{ error }}</p>
                </div>
                <fieldset :disabled="busy" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="news-title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                            <input id="news-title" v-model="form.title" required maxlength="255" placeholder="e.g. Company Expands into New Market" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                            <InputError :message="form.errors.title" class="mt-2" />
                        </div>
                        <div>
                            <label for="news-slug" class="block text-sm font-medium text-gray-700 mb-2">Slug <span class="text-red-500">*</span></label>
                            <input id="news-slug" v-model="form.slug" required maxlength="255" pattern="[a-z0-9]+(-[a-z0-9]+)*" title="Use lowercase letters, numbers, and hyphens between words." placeholder="company-expands-into-new-market" class="w-full px-4 py-3 border-gray-200 rounded-xl font-mono text-sm focus:ring-blue-500 focus:border-blue-500" />
                            <InputError :message="form.errors.slug" class="mt-2" />
                        </div>
                        <div>
                            <label for="news-category" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                            <select id="news-category" v-model="form.news_category_id" required class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">— Select category —</option><option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}{{ category.is_active ? '' : ' (Inactive)' }}</option>
                            </select>
                            <p v-if="!categories.length" class="text-sm text-gray-500 mt-2"><Link :href="route('backend.news-category.index')" class="text-blue-600 underline">Create a category</Link> before adding news.</p>
                            <InputError :message="form.errors.news_category_id" class="mt-2" />
                        </div>
                        <div>
                            <label for="news-author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <select id="news-author" v-model="form.author_id" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">— No author —</option><option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
                            </select>
                            <InputError :message="form.errors.author_id" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <label for="news-excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea id="news-excerpt" v-model="form.excerpt" rows="2" maxlength="2000" placeholder="Short summary shown in listings..." class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <p class="text-xs text-gray-400 mt-1">Recommended: 120–160 characters</p>
                        <InputError :message="form.errors.excerpt" class="mt-2" />
                    </div>
                    <div>
                        <label for="news-content" class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                        <textarea id="news-content" v-model="form.content" required rows="7" maxlength="200000" placeholder="Write the full article content here..." class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <p class="text-xs text-gray-400 mt-1">Enter text or HTML. Use Preview to see the formatting.</p>
                        <InputError :message="form.errors.content" class="mt-2" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Featured Image</p>
                        <ImageUpload v-model="form.featured_image" :current-url="article?.featured_image_url" :error="form.errors.featured_image" accepted-type="image/jpeg,image/png,image/webp,image/gif" helper-text="Recommended: 1200×630px. JPG, PNG, WebP or GIF, up to 5 MB." />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="news-date" class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                            <input id="news-date" v-model="form.published_at" type="datetime-local" :required="form.status === 'published'" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                            <InputError :message="form.errors.published_at" class="mt-2" />
                        </div>
                        <div>
                            <label for="news-status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="news-status" v-model="form.status" class="w-full px-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"><option value="draft">Draft</option><option value="published">Published</option><option value="archived">Archived</option></select>
                            <InputError :message="form.errors.status" class="mt-2" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Featured</p>
                            <label class="flex items-center gap-3 py-3 text-sm text-gray-600"><input v-model="form.is_featured" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />Mark as featured</label>
                            <InputError :message="form.errors.is_featured" class="mt-2" />
                        </div>
                    </div>
                    <details class="border-t border-gray-200 pt-6" :open="Boolean(form.errors.meta_title || form.errors.meta_description || form.errors.canonical_url || form.errors.og_image)">
                        <summary class="cursor-pointer font-semibold text-gray-800 mb-4">SEO Settings <span class="ml-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-normal">Optional</span></summary>
                        <div class="space-y-4 bg-purple-50/40 border border-purple-100 rounded-xl p-5">
                            <div><label for="news-meta-title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label><input id="news-meta-title" v-model="form.meta_title" maxlength="255" placeholder="SEO title (50–60 chars recommended)" class="w-full px-4 py-3 border-gray-200 rounded-xl" /><InputError :message="form.errors.meta_title" class="mt-2" /></div>
                            <div><label for="news-meta-description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label><textarea id="news-meta-description" v-model="form.meta_description" rows="2" maxlength="2000" placeholder="SEO description (120–160 chars recommended)" class="w-full px-4 py-3 border-gray-200 rounded-xl"></textarea><InputError :message="form.errors.meta_description" class="mt-2" /></div>
                            <div><label for="news-canonical" class="block text-sm font-medium text-gray-700 mb-2">Canonical URL</label><input id="news-canonical" v-model="form.canonical_url" type="url" maxlength="255" placeholder="https://example.com/news/company-expands" class="w-full px-4 py-3 border-gray-200 rounded-xl font-mono text-sm" /><InputError :message="form.errors.canonical_url" class="mt-2" /></div>
                            <div><p class="text-sm font-medium text-gray-700 mb-2">OG Image</p><ImageUpload v-model="form.og_image" :current-url="article?.og_image_url" :error="form.errors.og_image" placeholder="Upload OG Image" accepted-type="image/jpeg,image/png,image/webp,image/gif" helper-text="1200×630px recommended for social sharing. Up to 5 MB." /></div>
                        </div>
                    </details>
                </fieldset>
                <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap justify-end gap-3">
                    <Link v-if="article" :href="route('backend.news.index')" class="px-5 py-3 bg-gray-200 text-gray-700 rounded-xl">Cancel</Link>
                    <button v-else type="button" @click="form.reset(); form.clearErrors()" :disabled="busy" class="px-5 py-3 bg-gray-200 text-gray-700 rounded-xl disabled:opacity-50">Cancel</button>
                    <!-- <button type="button" @click="preview = true" :disabled="busy" class="px-5 py-3 bg-gray-100 border border-gray-200 text-gray-700 rounded-xl disabled:opacity-50"><i class="fas fa-eye mr-2" aria-hidden="true"></i>Preview</button> -->
                    <button type="submit" :disabled="busy || !categories.length" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold disabled:opacity-50"><i class="fas fa-save mr-2" aria-hidden="true"></i>{{ form.processing ? 'Saving...' : 'Save News' }}</button>
                </div>
                <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full mt-3">{{ form.progress.percentage }}%</progress>
            </form>
             <NewsTable :articles="articles" :categories="categories" :filters="filters" :busy="busy" @delete="remove" />
        </div>
    </AuthenticatedLayout>
</template>
