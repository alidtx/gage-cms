<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import Modal from '@/Components/Modal.vue';
import Field from '../Entity/EntityField.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const props = defineProps({ pageContent: Object });
const copy = value => JSON.parse(JSON.stringify(value));
function contentDefaults(value) {
    const data = copy(value && !Array.isArray(value) ? value : {});
    data.hero = { title_line_1: '', title_highlight: '', subtitle: '', ...data.hero };
    data.hero.badge = { text: '', icon: '', ...data.hero.badge };
    data.hero.primary_cta = { text: '', href: '', ...data.hero.primary_cta };
    data.hero.trust_badges ??= [];
    for (const field of ['sections', 'team', 'partners', 'faqs']) data[field] ??= [];
    data.contact = { phone: '', email: '', address: '', facebook: '', linkedin: '', instagram: '', ...data.contact };
    return data;
}
const form = useForm({
    name: props.pageContent.name, slug: props.pageContent.slug,
    is_active: props.pageContent.is_active, is_featured: props.pageContent.is_featured, sort_order: props.pageContent.sort_order,
    content: contentDefaults(props.pageContent.content),
    meta: { tagline: '', short_description: '', icon: '🏢', icon_type: 'emoji', primary_color: '#2563eb', secondary_color: '#111827', ...props.pageContent.meta },
    image: null,
});
const tab = ref('hero');
const tabs = ['hero', 'sections', 'team', 'partners', 'contact', 'faq', 'seo', 'raw'];
const raw = ref('');
const rawError = ref('');
const preview = ref(false);
const liveJson = computed(() => JSON.stringify(form.content, null, 2));
const trustBadges = computed({
    get: () => form.content.hero.trust_badges.join(', '),
    set: value => { form.content.hero.trust_badges = value.split(',').map(item => item.trim()).filter(Boolean); },
});
function changeTab(next) {
    if (tab.value === 'raw' && next !== 'raw' && !applyJson()) return;
    if (next === 'raw') raw.value = liveJson.value;
    tab.value = next;
}
function applyJson() {
    try {
        const value = JSON.parse(raw.value);
        if (!value || Array.isArray(value) || typeof value !== 'object') throw new Error('Content must be a JSON object.');
        for (const key of ['hero', 'contact']) {
            if (value[key] !== undefined && (!value[key] || typeof value[key] !== 'object' || Array.isArray(value[key]))) throw new Error(key + ' must be an object.');
        }
        for (const key of ['sections', 'team', 'partners', 'faqs']) {
            if (value[key] !== undefined && (!Array.isArray(value[key]) || value[key].some(item => !item || typeof item !== 'object' || Array.isArray(item)))) throw new Error(key + ' must be an array of objects.');
        }
        for (const faq of value.faqs || []) {
            if (typeof faq.question !== 'string' || typeof faq.answer !== 'string') throw new Error('Each FAQ must contain a question and answer as text.');
        }
        for (const section of value.sections || []) {
            if (section.items !== undefined && (!Array.isArray(section.items) || section.items.some(item => !item || typeof item !== 'object' || Array.isArray(item)))) throw new Error('Section items must be objects.');
        }
        for (const member of value.team || []) {
            if (member.tags !== undefined && (!Array.isArray(member.tags) || member.tags.some(tag => typeof tag !== 'string'))) throw new Error('Team tags must be a list of text.');
        }
        if (value.hero?.trust_badges !== undefined && (!Array.isArray(value.hero.trust_badges) || value.hero.trust_badges.some(item => typeof item !== 'string'))) throw new Error('Trust badges must be a list of text.');
        for (const key of ['badge', 'primary_cta']) {
            if (value.hero?.[key] !== undefined && (!value.hero[key] || typeof value.hero[key] !== 'object' || Array.isArray(value.hero[key]))) throw new Error('Hero ' + key + ' must be an object.');
        }
        form.content = contentDefaults(value);
        rawError.value = '';
        return true;
    } catch (error) { rawError.value = error.message; return false; }
}
function save() {
    if (form.processing || (tab.value === 'raw' && !applyJson())) return;
    form.transform(data => ({ ...data, _method: 'put', content: JSON.stringify(data.content), meta: JSON.stringify(data.meta) }))
        .post(route('backend.pages.update', props.pageContent.id), {
            forceFormData: true, preserveScroll: true,
            onSuccess: () => { form.image = null; form.defaults(); toast.success('Page saved.'); },
            onError: () => toast.error('Please check the highlighted errors.'),
        });
}
function move(items, index, offset) {
    const target = index + offset;
    if (target < 0 || target >= items.length) return;
    [items[index], items[target]] = [items[target], items[index]];
}
function showPreview() {
    if (tab.value === 'raw' && !applyJson()) return;
    preview.value = true;
}
</script>
<template>
    <AuthenticatedLayout>
        <Head :title="'Edit ' + pageContent.name" />
        <form @submit.prevent="save" class="p-4 md:p-8 bg-gray-50 min-h-full">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <Link :href="route('backend.pages.index')" aria-label="Back to pages" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center"><i class="fas fa-arrow-left" aria-hidden="true"></i></Link>
                    <div><h2 class="text-xl font-semibold text-gray-800">{{ form.name }}</h2><p class="text-sm text-gray-500">Editing page · <span class="font-mono text-xs">{{ form.slug }}</span></p></div>
                </div>
                <div class="flex gap-3"><button type="button" @click="showPreview" class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm"><i class="fas fa-eye mr-2" aria-hidden="true"></i>Preview</button><button :disabled="form.processing" class="px-5 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold disabled:opacity-50">{{ form.processing ? 'Saving...' : 'Save Changes' }}</button></div>
            </div>
            <div v-if="Object.keys(form.errors).length" role="alert" class="bg-red-50 text-red-700 p-4 rounded-xl mb-5"><p v-for="(message, field) in form.errors" :key="field">{{ field }}: {{ message }}</p></div>
            <fieldset :disabled="form.processing">
                <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                    <h3 class="font-semibold text-gray-800 mb-4"><i class="fas fa-info-circle text-blue-500 mr-2" aria-hidden="true"></i>Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <Field v-model="form.name" label="Name" /><Field v-model="form.slug" label="Slug" />
                        <Field v-model="form.meta.tagline" label="Tagline" /><Field v-model="form.meta.icon" label="Icon (emoji or Font Awesome class)" />
                        <label class="block text-sm font-medium text-gray-700">Icon type<select v-model="form.meta.icon_type" class="mt-2 w-full border-gray-200 rounded-xl text-sm"><option value="emoji">Emoji</option><option value="fontawesome">Font Awesome</option></select></label>
                        <div class="md:col-span-3"><Field v-model="form.meta.short_description" label="Short description" multiline /></div>
                    </div>
                    <div class="flex flex-wrap items-center gap-6 mt-4">
                        <label class="flex items-center gap-2 text-sm"><input v-model="form.is_active" type="checkbox" class="rounded text-blue-600" />Active</label>
                        <label class="flex items-center gap-2 text-sm"><input v-model="form.is_featured" type="checkbox" class="rounded text-yellow-500" />Featured</label>
                        <label class="flex items-center gap-2 text-sm ml-auto">Sort order<input v-model.number="form.sort_order" type="number" min="0" max="2147483647" class="w-24 border-gray-200 rounded-lg text-sm" /></label>
                    </div>
                </section>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    <section class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div role="tablist" aria-label="Page content" class="flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                            <button v-for="item in tabs" :key="item" type="button" role="tab" :aria-selected="tab === item" @click="changeTab(item)" class="px-4 py-3 text-sm font-semibold capitalize whitespace-nowrap border-b-2" :class="tab === item ? 'text-blue-600 border-blue-600 bg-white' : 'text-gray-500 border-transparent'">{{ item === 'raw' ? 'Raw JSON' : item === 'seo' ? 'SEO' : item === 'faq' ? 'FAQ' : item }}</button>
                        </div>
                        <div class="p-6 space-y-4" role="tabpanel" :aria-label="tab">
                            <template v-if="tab === 'hero'">
                                <div class="grid sm:grid-cols-2 gap-4"><Field v-model="form.content.hero.badge.text" label="Badge Text" /><Field v-model="form.content.hero.badge.icon" label="Badge Icon" /></div>
                                <Field v-model="form.content.hero.title_line_1" label="Title Line 1" /><Field v-model="form.content.hero.title_highlight" label="Title Highlight (colored part)" /><Field v-model="form.content.hero.subtitle" label="Subtitle" multiline />
                                <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 grid sm:grid-cols-2 gap-4"><Field v-model="form.content.hero.primary_cta.text" label="Primary CTA text" /><Field v-model="form.content.hero.primary_cta.href" label="Primary CTA link" /></div>
                                <Field v-model="trustBadges" label="Trust badges (comma-separated)" />
                                <div><p class="text-sm font-medium text-gray-700 mb-2">Background Image</p><ImageUpload v-model="form.image" :current-url="pageContent.image_url" :error="form.errors.image" helper-text="JPG, PNG, WebP or GIF, up to 5 MB" /></div>
                            </template>
                            <template v-else-if="tab === 'sections'">
                                <div class="flex justify-between gap-4 items-center"><p class="text-sm text-gray-500">Dynamic content sections for this page.</p><button type="button" @click="form.content.sections.push({ key: '', type: 'cards', title: '', subtitle: '', items: [] })" class="text-sm text-blue-600 font-semibold">+ Add Section</button></div>
                                <div v-for="(section, index) in form.content.sections" :key="index" class="border border-gray-200 rounded-xl p-4 bg-gray-50 space-y-3">
                                    <div class="flex items-center justify-between"><h4 class="font-semibold text-gray-700">{{ section.title || 'New section' }}</h4><div class="flex gap-3"><button type="button" :disabled="index === 0" @click="move(form.content.sections, index, -1)" aria-label="Move section up" class="disabled:opacity-30">↑</button><button type="button" :disabled="index === form.content.sections.length - 1" @click="move(form.content.sections, index, 1)" aria-label="Move section down" class="disabled:opacity-30">↓</button><button type="button" @click="form.content.sections.splice(index, 1)" class="text-red-500 text-sm">Delete</button></div></div>
                                    <div class="grid sm:grid-cols-2 gap-3"><Field v-model="section.key" label="Key" /><Field v-model="section.type" label="Type" /><Field v-model="section.title" label="Title" /><Field v-model="section.subtitle" label="Subtitle" /></div>
                                    <div class="border-t border-gray-200 pt-3"><div class="flex justify-between text-sm"><span>Items ({{ section.items?.length || 0 }})</span><button type="button" @click="(section.items ??= []).push({ title: '', icon: '', description: '' })" class="text-blue-600">+ Add Item</button></div>
                                        <div v-for="(item, itemIndex) in section.items" :key="itemIndex" class="bg-white rounded-lg border border-gray-200 p-3 mt-3 space-y-2">
                                            <div class="grid sm:grid-cols-2 gap-2"><Field v-model="item.title" label="Title" /><Field v-model="item.icon" label="Icon" /></div><Field v-model="item.description" label="Short description" />
                                            <div class="flex justify-end gap-3 text-xs"><button type="button" @click="move(section.items, itemIndex, -1)" :disabled="itemIndex === 0">Move up</button><button type="button" @click="move(section.items, itemIndex, 1)" :disabled="itemIndex === section.items.length - 1">Move down</button><button type="button" @click="section.items.splice(itemIndex, 1)" class="text-red-500">Remove item</button></div>
                                        </div>
                                    </div>
                                </div>
                                <p v-if="!form.content.sections.length" class="text-sm text-gray-400 py-6 text-center">No sections yet.</p>
                            </template>
                            <template v-else-if="tab === 'team'">
                                <div class="flex justify-between gap-4"><p class="text-sm text-gray-500">Team members for this page.</p><button type="button" @click="form.content.team.push({ name: '', role: '', bio: '', image: '', tags: [] })" class="text-sm text-blue-600">+ Add Member</button></div>
                                <div v-for="(member, index) in form.content.team" :key="index" class="border border-gray-200 rounded-xl p-4 space-y-3">
                                    <div class="grid sm:grid-cols-2 gap-3"><Field v-model="member.name" label="Name" /><Field v-model="member.role" label="Role" /></div><Field v-model="member.bio" label="Biography" multiline /><Field v-model="member.image" label="Photo URL" />
                                    <Field :model-value="(member.tags || []).join(', ')" @update:model-value="member.tags = $event.split(',').map(value => value.trim()).filter(Boolean)" label="Tags (comma-separated)" />
                                    <button type="button" @click="form.content.team.splice(index, 1)" class="text-sm text-red-500">Remove member</button>
                                </div>
                            </template>
                            <template v-else-if="tab === 'partners'">
                                <div class="flex justify-between gap-4"><p class="text-sm text-gray-500">Logos shown in the Trusted Brands section.</p><button type="button" @click="form.content.partners.push({ name: '', logo: '' })" class="text-sm text-blue-600">+ Add Partner</button></div>
                                <div class="grid sm:grid-cols-2 gap-3"><div v-for="(partner, index) in form.content.partners" :key="index" class="border border-gray-200 rounded-xl p-4 space-y-3"><Field v-model="partner.name" label="Name" /><Field v-model="partner.logo" label="Logo URL" /><button type="button" @click="form.content.partners.splice(index, 1)" class="text-sm text-red-500">Remove partner</button></div></div>
                            </template>
                            <template v-else-if="tab === 'contact'">
                                <div class="grid sm:grid-cols-2 gap-4"><Field v-model="form.content.contact.phone" label="Phone" /><Field v-model="form.content.contact.email" label="Email" type="email" /></div><Field v-model="form.content.contact.address" label="Address" multiline />
                                <Field v-for="social in ['facebook', 'linkedin', 'instagram']" :key="social" v-model="form.content.contact[social]" :label="social + ' URL'" />
                            </template>
                            <template v-else-if="tab === 'faq'">
                                <div class="flex items-center justify-between gap-4"><p class="text-sm text-gray-500">Frequently asked questions for this page.</p><button type="button" @click="form.content.faqs.push({ question: '', answer: '' })" class="text-sm font-semibold text-blue-600">+ Add FAQ</button></div>
                                <div v-for="(faq, index) in form.content.faqs" :key="index" class="border border-gray-200 rounded-xl p-4 space-y-3">
                                    <div class="flex justify-between items-center"><h4 class="font-semibold text-gray-700">FAQ {{ index + 1 }}</h4><div class="flex gap-3 text-sm"><button type="button" :disabled="index === 0" @click="move(form.content.faqs, index, -1)" aria-label="Move FAQ up" class="disabled:opacity-30">↑</button><button type="button" :disabled="index === form.content.faqs.length - 1" @click="move(form.content.faqs, index, 1)" aria-label="Move FAQ down" class="disabled:opacity-30">↓</button><button type="button" @click="form.content.faqs.splice(index, 1)" class="text-red-500">Remove</button></div></div>
                                    <Field v-model="faq.question" label="Question" /><Field v-model="faq.answer" label="Answer" multiline />
                                </div>
                                <p v-if="!form.content.faqs.length" class="text-sm text-gray-400 text-center py-6">No FAQs yet. Add your first question above.</p>
                            </template>
                            <template v-else-if="tab === 'seo'">
                                <div class="bg-purple-50/40 border border-purple-100 rounded-xl p-5 space-y-4"><Field v-model="form.meta.meta_title" label="Meta Title (50–60 characters recommended)" /><Field v-model="form.meta.meta_description" label="Meta Description (120–160 characters recommended)" multiline /><Field v-model="form.meta.meta_keywords" label="Meta Keywords" /><div class="grid sm:grid-cols-2 gap-4"><Field v-model="form.meta.primary_color" label="Primary Color" type="color" /><Field v-model="form.meta.secondary_color" label="Secondary Color" type="color" /></div></div>
                            </template>
                            <template v-else>
                                <p class="text-sm text-gray-500">Edit the complete content object. Additional sections are preserved.</p>
                                <textarea v-model="raw" aria-label="Content JSON" spellcheck="false" rows="22" class="w-full rounded-xl font-mono text-xs bg-gray-900 text-green-300 p-4"></textarea>
                                <p v-if="rawError" role="alert" class="text-sm text-red-600">{{ rawError }}</p><button type="button" @click="applyJson" class="px-4 py-2 bg-gray-800 text-white rounded-xl text-sm">Apply JSON</button>
                            </template>
                        </div>
                    </section>
                    <aside class="space-y-6">
                        <div class="bg-gray-900 rounded-2xl overflow-hidden"><div class="px-4 py-3 border-b border-gray-800 flex justify-between text-xs text-gray-400"><span><span class="text-red-400">●</span> <span class="text-yellow-400">●</span> <span class="text-green-400">●</span> <span class="ml-2 font-mono">content.json</span></span><span>Live</span></div><pre class="p-4 text-xs text-gray-300 overflow-auto max-h-[600px]">{{ liveJson }}</pre></div>
                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-sm text-blue-800"><h3 class="font-semibold mb-3">Tips</h3><p>Use tabs to edit each section. Add and reorder sections to fit this page. Save Changes to persist your edits.</p></div>
                    </aside>
                </div>
            </fieldset>
        </form>
        <Modal :show="preview" max-width="2xl" @close="preview = false">
            <div class="p-6 space-y-5">
                <div class="flex justify-between items-center"><h3 class="font-semibold">Page content preview</h3><button type="button" @click="preview = false" aria-label="Close preview">✕</button></div>
                <img v-if="pageContent.image_url" :src="pageContent.image_url" alt="" class="w-full max-h-64 object-cover rounded-xl" />
                <p class="text-sm text-gray-500">{{ form.content.hero.badge.text }}</p><h2 class="text-3xl font-bold">{{ form.content.hero.title_line_1 }} <span :style="{ color: /^#[0-9a-f]{6}$/i.test(form.meta.primary_color) ? form.meta.primary_color : '#2563eb' }">{{ form.content.hero.title_highlight }}</span></h2><p>{{ form.content.hero.subtitle }}</p>
                <span v-if="form.content.hero.primary_cta.text" class="inline-block rounded-xl bg-blue-600 text-white px-4 py-2">{{ form.content.hero.primary_cta.text }}</span>
                <div v-for="(section, index) in form.content.sections" :key="index" class="border-t pt-4"><h3 class="text-xl font-semibold">{{ section.title }}</h3><p>{{ section.subtitle }}</p><div v-for="(item, i) in section.items" :key="i" class="mt-3"><h4 class="font-medium">{{ item.title }}</h4><p class="text-gray-600">{{ item.description }}</p></div></div>
                <section v-if="form.content.faqs.length" class="border-t pt-4 space-y-3"><h3 class="text-xl font-semibold">Frequently Asked Questions</h3><details v-for="(faq, index) in form.content.faqs" :key="index" class="border border-gray-200 rounded-xl p-4"><summary class="cursor-pointer font-medium text-gray-800">{{ faq.question }}</summary><p class="mt-3 text-gray-600 whitespace-pre-line">{{ faq.answer }}</p></details></section>
                <div v-if="form.content.team.length" class="border-t pt-4"><h3 class="font-semibold">Team</h3><p v-for="(member, i) in form.content.team" :key="i">{{ member.name }} — {{ member.role }}</p></div>
                <div v-if="form.content.partners.length" class="border-t pt-4"><h3 class="font-semibold">Partners</h3><p>{{ form.content.partners.map(partner => partner.name).join(', ') }}</p></div>
                <div class="border-t pt-4"><p>{{ form.content.contact.phone }} {{ form.content.contact.email }}</p><p>{{ form.content.contact.address }}</p></div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

