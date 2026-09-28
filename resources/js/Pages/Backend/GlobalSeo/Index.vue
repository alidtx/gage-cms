<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>




<template>
   
    <AuthenticatedLayout>
     <Head title="Global Seo"/>

      <div id="global" class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Global SEO Settings</h2>
                        <p class="text-gray-600">Site-wide configuration that applies to all pages</p>
                    </div>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i> Save Global Settings
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Site Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Site Information</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                                <input type="text" value="Your Company Name" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                                <textarea rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">Delivering excellence in services across multiple industries with a commitment to quality and innovation.</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Site Keywords</label>
                                <input type="text" value="services, innovation, quality, industry leader" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                <span class="text-xs text-gray-500 mt-1">Separate with commas</span>
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
                                    <div class="w-32 h-20 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                    <div>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors">
                                            <i class="fas fa-upload mr-2"></i> Upload
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">1200x630px recommended</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Default Twitter Image</label>
                                <div class="flex items-center space-x-4">
                                    <div class="w-32 h-20 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                    <div>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-300 transition-colors">
                                            <i class="fas fa-upload mr-2"></i> Upload
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">1200x600px recommended</p>
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
                                <input type="text" value="Your Company" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Publisher</label>
                                <input type="text" value="Your Company" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Facebook App ID</label>
                                <input type="text" value="123456789012345" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Site</label>
                                <input type="text" value="@yourcompany" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Google Analytics ID</label>
                                <input type="text" value="UA-123456789-1" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Google Tag Manager ID</label>
                                <input type="text" value="GTM-XXXXXXXX" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>


</template>