<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>


<template>
     <AuthenticatedLayout>
       <Head title="News Category"/>
       <div id="news-category" class="p-8">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Manage News Categories</h3>
                        <p class="text-sm text-gray-500">Add, edit or remove categories used for news articles</p>
                    </div>
                    <div class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl font-medium">
                        <i class="fas fa-tag mr-2"></i>6 categories
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h4 class="text-md font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-plus-circle text-blue-500 mr-2"></i>Add new category
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category name</label>
                            <input type="text" id="categoryName" placeholder="e.g. Technology" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                            <input type="text" id="categorySlug" placeholder="technology" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="categoryStatus" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button id="saveCategoryBtn" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors shadow-sm flex items-center gap-2">
                            <i class="fas fa-save"></i> Save Category
                        </button>
                    </div>

                    <p class="text-xs text-gray-400 mt-3 text-right"><i class="fas fa-info-circle mr-1"></i>Click save to add category (demo)</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h4 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-list-ul text-gray-500 mr-2"></i>All categories
                        </h4>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">6 items</span>
                    </div>
                    <div class="table-container overflow-x-auto">
                        <table class="w-full min-w-[700px]">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Parent</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Articles</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTableBody">
                                <!-- row 1 -->
                                <tr class="table-row border-b border-gray-100" data-id="1">
                                    <td class="px-6 py-4 font-medium text-gray-800">Technology</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">technology</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">24</td>
                                    <td class="px-6 py-4"><span class="badge badge-success">Active</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="1"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="1"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="table-row border-b border-gray-100" data-id="2">
                                    <td class="px-6 py-4 font-medium text-gray-800">Business</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">business</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">18</td>
                                    <td class="px-6 py-4"><span class="badge badge-success">Active</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="2"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="2"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- row 3 -->
                                <tr class="table-row border-b border-gray-100" data-id="3">
                                    <td class="px-6 py-4 font-medium text-gray-800">Health</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">health</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">12</td>
                                    <td class="px-6 py-4"><span class="badge badge-success">Active</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="3"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="3"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- row 4 -->
                                <tr class="table-row border-b border-gray-100" data-id="4">
                                    <td class="px-6 py-4 font-medium text-gray-800">Sports</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">sports</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">9</td>
                                    <td class="px-6 py-4"><span class="badge badge-success">Active</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="4"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="4"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- row 5 -->
                                <tr class="table-row border-b border-gray-100" data-id="5">
                                    <td class="px-6 py-4 font-medium text-gray-800">Entertainment</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">entertainment</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">15</td>
                                    <td class="px-6 py-4"><span class="badge badge-warning">Inactive</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="5"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="5"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- row 6 -->
                                <tr class="table-row" data-id="6">
                                    <td class="px-6 py-4 font-medium text-gray-800">Science</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">science</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">—</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">7</td>
                                    <td class="px-6 py-4"><span class="badge badge-success">Active</span></td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <button class="edit-category text-blue-600 hover:text-blue-800 transition-colors" title="Edit" data-id="6"><i class="fas fa-edit"></i></button>
                                        <button class="delete-category text-red-500 hover:text-red-700 transition-colors" title="Delete" data-id="6"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 flex items-center justify-between border-t border-gray-200 bg-gray-50/50">
                        <span class="text-sm text-gray-500">Showing 6 categories</span>
                        <div class="flex space-x-1 text-xs text-gray-400">
                            <i class="fas fa-chevron-left"></i>
                            <span class="mx-1">1</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>

     </AuthenticatedLayout>


</template>