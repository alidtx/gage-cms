<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const openDropdown = ref(null);

const toggleDropdown = (key) => {
    openDropdown.value = openDropdown.value === key ? null : key;
};

const isOpen = (key) => openDropdown.value === key;
</script>

<template>
    <div class="flex h-screen overflow-hidden">

        <!-- ============================================ -->
        <!-- SIDEBAR -->
        <!-- ============================================ -->
        <aside class="sidebar w-64 flex-shrink-0 overflow-y-auto">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-rocket text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">Gage CMS</h1>
                        <p class="text-gray-400 text-xs">v2.0.0</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="#dashboard" class="sidebar-item active flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-chart-pie w-5"></i>
                    <span>Dashboard</span>
                    <span class="ml-auto bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">12</span>
                </a>

                <!-- ========== DROPDOWN 1: Content Management ========== -->
                <div>
                    <button type="button"
                            class="dropdown-trigger sidebar-item w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors"
                            :class="{ 'is-open': isOpen('content') }"
                            @click="toggleDropdown('content')">
                        <i class="fas fa-layer-group w-5"></i>
                        <span>Content</span>
                        <i class="fas fa-chevron-right chevron ml-auto text-xs text-gray-500 transition-transform"
                           :class="{ 'rotate-90': isOpen('content') }"></i>
                    </button>
                    <div class="dropdown-panel" :class="{ 'open': isOpen('content') }">
                        <a href="#pages" class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-file-alt w-4"></i>
                            <span>All Pages</span>
                        </a>
                        <a href="#edit" class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-edit w-4"></i>
                            <span>Edit SEO</span>
                        </a>
                        <a href="#sitemap" class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-sitemap w-4"></i>
                            <span>Sitemap</span>
                        </a>
                    </div>
                </div>

                <!-- ========== DROPDOWN 2: SEO Tools ========== -->
                <div>
                    <button type="button"
                            class="dropdown-trigger sidebar-item w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors"
                            :class="{ 'is-open': isOpen('seo') }"
                            @click="toggleDropdown('seo')">
                        <i class="fas fa-toolbox w-5"></i>
                        <span>SEO Tools</span>
                        <i class="fas fa-chevron-right chevron ml-auto text-xs text-gray-500 transition-transform"
                           :class="{ 'rotate-90': isOpen('seo') }"></i>
                    </button>
                    <div class="dropdown-panel" :class="{ 'open': isOpen('seo') }">
                        <a href="#global" class="sub-item flex items-center space-x-3 px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <i class="fas fa-globe w-4"></i>
                            <span>Global Settings</span>
                        </a>
                        <a href="#redirects" class="sub-item flex items-center justify-between px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-random w-4"></i>
                                <span>Redirects</span>
                            </span>
                            <span class="bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full">8</span>
                        </a>
                        <a href="#analysis" class="sub-item flex items-center justify-between px-4 py-2.5 rounded-lg text-gray-400 text-sm transition-colors">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-search w-4"></i>
                                <span>SEO Analysis</span>
                            </span>
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">3</span>
                        </a>
                    </div>
                </div>

                <hr class="border-gray-700 my-4" />

                <a href="#settings" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 transition-colors">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- ============================================ -->
        <!-- MAIN CONTENT -->
        <!-- ============================================ -->
        <main class="flex-1 overflow-y-auto bg-gray-50">

            <!-- Top Bar -->
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
                        <button class="text-gray-400 hover:text-gray-600 transition-colors relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">John Doe</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

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