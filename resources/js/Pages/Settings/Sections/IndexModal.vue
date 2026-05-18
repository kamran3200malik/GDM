<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Modal from '@/Components/Modal.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    sections: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const classType = ref(props.filters.class_type || '');

watch([search, classType], () => {
    router.get(route('admin.settings.sections.index'), {
        search: search.value,
        class_type: classType.value,
    }, {
        preserveState: true,
        replace: true,
    });
});

const deleteForm = useForm({});

const deleteSection = (section) => {
    Swal.fire({
        title: 'Are you sure?',
        text: `Are you sure you want to delete "${section.name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route('admin.settings.sections.destroy', section), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Section has been deleted successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
};

const toggleStatus = (section) => {
    router.post(route('admin.settings.sections.toggle', section));
};

// Modal state
const showCreateModal = ref(false);
const showEditModal = ref(false);
const editingSection = ref(null);

const createForm = useForm({
    name: '',
    class_type: 'junior',
    is_active: true,
});

const editForm = useForm({
    name: '',
    class_type: 'junior',
    is_active: true,
});

const openCreateModal = () => {
    createForm.reset();
    showCreateModal.value = true;
};

const openEditModal = (section) => {
    editingSection.value = section;
    editForm.name = section.name;
    editForm.class_type = section.class_type;
    editForm.is_active = section.is_active;
    showEditModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
    createForm.reset();
};

const closeEditModal = () => {
    showEditModal.value = false;
    editingSection.value = null;
    editForm.reset();
};

const submitCreate = () => {
    createForm.post(route('admin.settings.sections.store'), {
        onSuccess: () => {
            closeCreateModal();
            Swal.fire({
                title: 'Created!',
                text: 'Section has been created successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
};

const submitEdit = () => {
    editForm.put(route('admin.settings.sections.update', editingSection.value), {
        onSuccess: () => {
            closeEditModal();
            Swal.fire({
                title: 'Updated!',
                text: 'Section has been updated successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
};
</script>

<template>
    <Head title="Sections Setup" />

    <AdminLayout>
        <template #header>
            Sections Setup
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Sections Management</h2>
                                <p class="text-gray-600 mt-1">Manage class sections with junior/senior/advance classifications</p>
                            </div>
                            <button @click="openCreateModal" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Add New Section
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input 
                                    v-model="search" 
                                    type="text" 
                                    placeholder="Search sections..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Class Type</label>
                                <select 
                                    v-model="classType"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">All Types</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                    <option value="advance">Advance</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Class Type
                                    </th>
                                                                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="section in sections.data" :key="section.id">
                                   
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                              :class="{
                                                  'bg-green-100 text-green-800': section.class_type === 'junior',
                                                  'bg-blue-100 text-blue-800': section.class_type === 'senior',
                                                  'bg-purple-100 text-purple-800': section.class_type === 'advance'
                                              }">
                                            {{ section.class_type }}
                                        </span>
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ section.name }}</div>
                                    </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                        <button @click="toggleStatus(section)" class="flex items-center">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                  :class="section.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                                {{ section.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button @click="openEditModal(section)" 
                                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button @click="deleteSection(section)" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link v-if="sections.prev_page_url" :href="sections.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </Link>
                            <Link v-if="sections.next_page_url" :href="sections.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700" v-if="sections.total > 0">
                                    Showing
                                    <span class="font-medium">{{ sections.from || 0 }}</span>
                                    to
                                    <span class="font-medium">{{ sections.to || 0 }}</span>
                                    of
                                    <span class="font-medium">{{ sections.total }}</span>
                                    results
                                </p>
                                <p class="text-sm text-gray-700" v-else>
                                    No results found
                                </p>
                            </div>
                            <div v-if="sections.links && sections.links.length > 0">
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <template v-for="link in sections.links" :key="link.label">
                                        <Link v-if="link.url" :href="link.url"
                                              :class="{
                                                  'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                  'bg-blue-50 border-blue-500 text-blue-600 z-10': link.active,
                                                  'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active
                                              }"
                                              v-html="link.label">
                                        </Link>
                                        <span v-else
                                              :class="{
                                                  'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                  'bg-white border-gray-300 text-gray-300 cursor-not-allowed': true
                                              }"
                                              v-html="link.label">
                                        </span>
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <Modal :show="showCreateModal" @close="closeCreateModal" max-width="2xl">
            <div class="bg-white">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Create New Section</h3>
                </div>
                <form @submit.prevent="submitCreate" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                       
                        <!-- Class Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Class Type <span class="text-red-500">*</span>
                            </label>
                            <select 
                                v-model="createForm.class_type" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': createForm.errors.class_type }"
                            >
                                <option value="junior">Junior</option>
                                <option value="senior">Senior</option>
                                <option value="advance">Advance</option>
                            </select>
                            <div v-if="createForm.errors.class_type" class="text-red-500 text-sm mt-1">{{ createForm.errors.class_type }}</div>
                        </div>
                       
                       
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Section Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                v-model="createForm.name" 
                                type="text" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': createForm.errors.name }"
                            />
                            <div v-if="createForm.errors.name" class="text-red-500 text-sm mt-1">{{ createForm.errors.name }}</div>
                        </div>

                       

                        
                        
                        <!-- Active Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input 
                                    v-model="createForm.is_active" 
                                    type="checkbox" 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                />
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="closeCreateModal"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                :disabled="createForm.processing"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50">
                            Create Section
                        </button>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- Edit Modal -->
        <Modal :show="showEditModal" @close="closeEditModal" max-width="2xl">
            <div class="bg-white">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Edit Section</h3>
                </div>
                <form @submit.prevent="submitEdit" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Class Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Class Type <span class="text-red-500">*</span>
                            </label>
                            <select 
                                v-model="editForm.class_type" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': editForm.errors.class_type }"
                            >
                                <option value="junior">Junior</option>
                                <option value="senior">Senior</option>
                                <option value="advance">Advance</option>
                            </select>
                            <div v-if="editForm.errors.class_type" class="text-red-500 text-sm mt-1">{{ editForm.errors.class_type }}</div>
                        </div>
                        
                        
                        
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Section Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                v-model="editForm.name" 
                                type="text" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': editForm.errors.name }"
                            />
                            <div v-if="editForm.errors.name" class="text-red-500 text-sm mt-1">{{ editForm.errors.name }}</div>
                        </div>



                        
                        
                        <!-- Active Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input 
                                    v-model="editForm.is_active" 
                                    type="checkbox" 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                />
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="closeEditModal"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                :disabled="editForm.processing"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50">
                            Update Section
                        </button>
                    </div>
                </form>
            </div>
        </Modal>
    </AdminLayout>
</template>
