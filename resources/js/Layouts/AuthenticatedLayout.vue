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

        <main class="flex-1 overflow-y-auto bg-gray-50">

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