<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>





<template>
      <AuthenticatedLayout>
        <Head title="Basic SEO" />
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
      </AuthenticatedLayout>
</template>