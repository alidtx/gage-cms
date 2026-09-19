<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const openDropdown = ref(null);

const toggleDropdown = (key) => {
    openDropdown.value = openDropdown.value === key ? null : key;
};

const isOpen = (key) => openDropdown.value === key;

const showNotifications = ref(false);
const notificationRef = ref(null);

const toggleNotifications = () => {
    showNotifications.value = !showNotifications.value;
};

const closeNotifications = () => {
    showNotifications.value = false;
};


const handleClickOutside = (event) => {
    if (
        showNotifications.value &&
        notificationRef.value &&
        !notificationRef.value.contains(event.target)
    ) {
        closeNotifications();
    }
};


const handleEscape = (event) => {
    if (event.key === 'Escape') closeNotifications();
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
    document.addEventListener('keydown', handleEscape);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
    document.removeEventListener('keydown', handleEscape);
});


const notifications = ref([
    {
        id: 1,
        title: 'New page published',
        message: '"About Us" was published successfully.',
        time: '2 min ago',
        icon: 'fa-file-alt',
        color: 'bg-blue-500',
        unread: true,
    },
    {
        id: 2,
        title: 'SEO issue detected',
        message: '3 pages are missing meta descriptions.',
        time: '15 min ago',
        icon: 'fa-exclamation-triangle',
        color: 'bg-red-500',
        unread: true,
    },
    {
        id: 3,
        title: 'Redirect added',
        message: 'A new 301 redirect was created.',
        time: '1 hour ago',
        icon: 'fa-random',
        color: 'bg-yellow-500',
        unread: false,
    },
]);

const unreadCount = ref(notifications.value.filter((n) => n.unread).length);

const markAllAsRead = () => {
    notifications.value.forEach((n) => (n.unread = false));
    unreadCount.value = 0;
};
</script>

<template>
    <div class="flex h-screen overflow-hidden">

        <aside class="sidebar w-64 flex-shrink-0 overflow-y-auto">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                        <i class="text-white text-xl">G</i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">Gage CMS</h1>
                        <p class="text-gray-400 text-xs">v2.0.0</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-1">

                <a href="#dashboard"
                    class="sidebar-item active flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-chart-pie w-5"></i>
                    <span>Dashboard</span>
                    <span class="ml-auto bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">12</span>
                </a>
                <div>
                    <button type="button"
                        class="dropdown-trigger sidebar-item w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors"
                        :class="{ 'is-open': isOpen('content') }" @click="toggleDropdown('content')">
                        <i class="fas fa-layer-group w-5"></i>
                        <span>Content</span>
                        <i class="fas fa-chevron-right chevron ml-auto text-xs text-gray-500 transition-transform"
                            :class="{ 'rotate-90': isOpen('content') }"></i>
                    </button>
                    <div class="dropdown-panel" :class="{ 'open': isOpen('content') }">
                        <a href="#pages"
                            class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-file-alt w-4"></i>
                            <span>All Pages</span>
                        </a>
                        <a href="#edit"
                            class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-edit w-4"></i>
                            <span>Edit SEO</span>
                        </a>
                        <a href="#sitemap"
                            class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-sitemap w-4"></i>
                            <span>Sitemap</span>
                        </a>
                    </div>
                </div>

                <div>
                    <button type="button"
                        class="dropdown-trigger sidebar-item w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors"
                        :class="{ 'is-open': isOpen('seo') }" @click="toggleDropdown('seo')">
                        <i class="fas fa-toolbox w-5"></i>
                        <span>SEO Tools</span>
                        <i class="fas fa-chevron-right chevron ml-auto text-xs text-gray-500 transition-transform"
                            :class="{ 'rotate-90': isOpen('seo') }"></i>
                    </button>
                    <div class="dropdown-panel" :class="{ 'open': isOpen('seo') }">
                        <a href="#global"
                            class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-globe w-4"></i>
                            <span>Global Settings</span>
                        </a>
                        <a href="#redirects"
                            class="sub-item flex items-center justify-between px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-random w-4"></i>
                                <span>Redirects</span>
                            </span>
                            <span class="bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full">8</span>
                        </a>
                        <a href="#analysis"
                            class="sub-item flex items-center justify-between px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-search w-4"></i>
                                <span>SEO Analysis</span>
                            </span>
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">3</span>
                        </a>
                    </div>
                </div>

                <hr class="border-gray-700 my-4" />

                <a href="#settings"
                    class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>
                <Link :href="route('logout')" method="post" as="button"
                    class="sidebar-item w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </Link>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto bg-gray-100">

            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-2xl font-bold text-gray-800">Gage CMS</h2>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Live</span>
                    </div>
                    <div class="flex items-center space-x-6">

                        <div class="relative" ref="notificationRef">
                            <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors relative"
                                :class="{ 'text-blue-600': showNotifications }" @click.stop="toggleNotifications"
                                aria-haspopup="true" :aria-expanded="showNotifications">
                                <i class="fas fa-bell text-xl"></i>
                                <span v-if="unreadCount > 0"
                                    class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>

                            <transition enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                                <div v-if="showNotifications"
                                    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 overflow-hidden">
                                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                                        <h3 class="text-sm font-semibold text-gray-800">
                                            Notifications
                                            <span v-if="unreadCount > 0" class="ml-1 text-xs text-blue-600">
                                                ({{ unreadCount }} new)
                                            </span>
                                        </h3>
                                        <button v-if="unreadCount > 0" type="button"
                                            class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                                            @click="markAllAsRead">
                                            Mark all read
                                        </button>
                                    </div>

                                    <div class="max-h-96 overflow-y-auto">
                                        <template v-if="notifications.length">
                                            <a v-for="n in notifications" :key="n.id" href="#"
                                                class="flex items-start space-x-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-b-0"
                                                :class="{ 'bg-blue-50/50': n.unread }">
                                                <div class="flex-shrink-0 w-9 h-9 rounded-full flex items-center justify-center text-white"
                                                    :class="n.color">
                                                    <i class="fas text-sm" :class="n.icon"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-gray-800 truncate">
                                                        {{ n.title }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">
                                                        {{ n.message }}
                                                    </p>
                                                    <p class="text-xs text-gray-400 mt-1">{{ n.time }}</p>
                                                </div>
                                                <span v-if="n.unread"
                                                    class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-2"></span>
                                            </a>
                                        </template>
                                        <div v-else class="px-4 py-8 text-center text-sm text-gray-500">
                                            No notifications
                                        </div>
                                    </div>

                                    <div class="px-4 py-2 border-t border-gray-100 text-center">
                                        <a href="#" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            View all notifications
                                        </a>
                                    </div>
                                </div>
                            </transition>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                AT
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Ali Taleb</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
         <!-- This is where the main content will be rendered -->
              <div id="edit" class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Edit SEO Settings</h2>
                        <p class="text-gray-600">Digital Marketing Services <span class="text-gray-400">|</span> <span class="text-sm text-blue-600">Last updated: 2 hours ago</span></p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                            <i class="fas fa-eye mr-2"></i> Preview
                        </button>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic SEO -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic SEO</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                <input type="text" value="Digital Marketing Services - Grow Your Business Online" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                       maxlength="70" />
                                <div class="flex justify-between mt-1">
                                    <span class="text-xs text-gray-500">Recommended: 50-60 characters</span>
                                    <span class="text-xs text-green-600 font-medium">58 / 70 characters</span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                <textarea rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" maxlength="160">We provide expert digital marketing services including SEO, PPC, social media, and content marketing to help your business grow online.</textarea>
                                <div class="flex justify-between mt-1">
                                    <span class="text-xs text-gray-500">Recommended: 120-160 characters</span>
                                    <span class="text-xs text-green-600 font-medium">142 / 160 characters</span>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                                <input type="text" value="digital marketing, SEO, PPC, social media marketing, content marketing" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                <span class="text-xs text-gray-500 mt-1">Separate keywords with commas</span>
                            </div>
                        </div>
                        
                        <!-- Open Graph -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Open Graph (Social Media)</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Title</label>
                                    <input type="text" value="Digital Marketing Services - Grow Your Business Online" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Type</label>
                                    <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                        <option>website</option>
                                        <option selected>article</option>
                                        <option>product</option>
                                        <option>service</option>
                                        <option>video</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Description</label>
                                <textarea rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">We provide expert digital marketing services including SEO, PPC, social media, and content marketing to help your business grow online.</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Image</label>
                                <div class="flex items-center space-x-4">
                                    <div class="w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                    <div>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors">
                                            <i class="fas fa-upload mr-2"></i> Upload Image
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">Recommended: 1200x630px</p>
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
                                    <input type="text" value="Digital Marketing Services - Grow Your Business Online" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Card Type</label>
                                    <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                        <option selected>summary_large_image</option>
                                        <option>summary</option>
                                        <option>app</option>
                                        <option>player</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Description</label>
                                <textarea rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">We provide expert digital marketing services including SEO, PPC, social media, and content marketing to help your business grow online.</textarea>
                            </div>
                        </div>
                        
                        <!-- Advanced Settings -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Advanced Settings</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Canonical URL</label>
                                    <input type="url" value="https://example.com/services/digital-marketing" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Schema Type</label>
                                    <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                        <option>Article</option>
                                        <option selected>Service</option>
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
                                <textarea rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder='{ "@context": "https://schema.org", "@type": "Service", ... }'>{
                                "@context": "https://schema.org",
                                "@type": "Service",
                                "name": "Digital Marketing Services",
                                "description": "We provide expert digital marketing services...",
                                "provider": {
                                    "@type": "Organization",
                                    "name": "Your Company Name"
                                }
                            }</textarea>
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Robots Directives</label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" />
                                        <span class="text-sm text-gray-700">Index</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" />
                                        <span class="text-sm text-gray-700">Follow</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" />
                                        <span class="text-sm text-gray-700">Noarchive</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" />
                                        <span class="text-sm text-gray-700">Nosnippet</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar - Preview -->
                    <div class="space-y-6">
                        <!-- Search Preview -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Search Preview</h4>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-blue-600 text-sm hover:underline cursor-pointer">https://example.com/services/digital-marketing</p>
                                <h3 class="text-xl text-blue-800 font-medium hover:underline cursor-pointer mt-1">Digital Marketing Services - Grow Your Business Online</h3>
                                <p class="text-sm text-gray-600 mt-1">We provide expert digital marketing services including SEO, PPC, social media, and content marketing to help your business grow online.</p>
                            </div>
                            
                            <hr class="my-4 border-gray-200" />
                            
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Social Preview</h4>
                            <div class="bg-gray-50 rounded-xl overflow-hidden">
                                <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-white opacity-50"></i>
                                </div>
                                <div class="p-4">
                                    <p class="text-xs text-gray-500">yourcompany.com</p>
                                    <h4 class="font-semibold text-gray-800 text-sm">Digital Marketing Services - Grow Your Business Online</h4>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">We provide expert digital marketing services including SEO, PPC, social media, and content marketing...</p>
                                </div>
                            </div>
                            
                            <button class="w-full mt-4 px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-medium hover:bg-blue-100 transition-colors text-sm">
                                <i class="fas fa-sync-alt mr-2"></i> Preview SEO Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
.dropdown-panel {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.3s ease, opacity 0.2s ease;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

.dropdown-panel.open {
    max-height: 500px;
    opacity: 1;
}

.chevron.rotate-90 {
    transform: rotate(90deg);
}

.dropdown-trigger.is-open {
    color: #fff;
    background-color: rgba(59, 130, 246, 0.15);
}
</style>