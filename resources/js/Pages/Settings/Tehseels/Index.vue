<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Modal from '@/Components/Modal.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    tehseels: Object,
    districts: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const districtFilter = ref(props.filters.district_id || '');

watch([search, districtFilter], () => {
    router.get(route('admin.settings.tehseels.index'), {
        search: search.value,
        district_id: districtFilter.value,
    }, {
        preserveState: true,
        replace: true,
    });
});

const deleteForm = useForm({});

const deleteTehseel = (tehseel) => {
    Swal.fire({
        title: 'Are you sure?',
        text: `Are you sure you want to delete "${tehseel.name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route('admin.settings.tehseels.destroy', tehseel), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Tehseel has been deleted successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
};

const toggleStatus = (tehseel) => {
    router.post(route('admin.settings.tehseels.toggle', tehseel));
};

// Modal state
const showCreateModal = ref(false);
const showEditModal = ref(false);
const editingTehseel = ref(null);

const createForm = useForm({
    district_id: '',
    name: '',
    code: '',
    is_active: true,
});

const editForm = useForm({
    district_id: '',
    name: '',
    code: '',
    is_active: true,
});

const openCreateModal = () => {
    createForm.reset();
    showCreateModal.value = true;
};

const openEditModal = (tehseel) => {
    editingTehseel.value = tehseel;
    editForm.district_id = tehseel.district_id;
    editForm.name = tehseel.name;
    editForm.code = tehseel.code;
    editForm.is_active = tehseel.is_active;
    showEditModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
    createForm.reset();
};

const closeEditModal = () => {
    showEditModal.value = false;
    editingTehseel.value = null;
    editForm.reset();
};

const submitCreate = () => {
    createForm.post(route('admin.settings.tehseels.store'), {
        onSuccess: () => {
            closeCreateModal();
            Swal.fire({
                title: 'Created!',
                text: 'Tehseel has been created successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
};

const submitEdit = () => {
    editForm.put(route('admin.settings.tehseels.update', editingTehseel.value), {
        onSuccess: () => {
            closeEditModal();
            Swal.fire({
                title: 'Updated!',
                text: 'Tehseel has been updated successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
};
</script>

<template>
    <Head title="Tehseels Setup" />

    <AdminLayout>
        <template #header>
            Tehseels Setup
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Tehseels Management</h2>
                                <p class="text-gray-600 mt-1">Manage tehseels within districts</p>
                            </div>
                            <button @click="openCreateModal" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Add New Tehseel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input 
                                    v-model="search" 
                                    type="text" 
                                    placeholder="Search tehseels..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>
                            <!-- District Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">District</label>
                                <select 
                                    v-model="districtFilter" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">All Districts</option>
                                    <option v-for="district in districts" :key="district.id" :value="district.id">
                                        {{ district.name }}
                                    </option>
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
                                        District
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Code
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
                                <tr v-for="tehseel in tehseels.data" :key="tehseel.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ tehseel.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ tehseel.district?.name || '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ tehseel.code || '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button @click="toggleStatus(tehseel)" class="flex items-center">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                  :class="tehseel.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                                {{ tehseel.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button @click="openEditModal(tehseel)" 
                                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button @click="deleteTehseel(tehseel)" 
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
                            <Link v-if="tehseels.prev_page_url" :href="tehseels.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </Link>
                            <Link v-if="tehseels.next_page_url" :href="tehseels.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700" v-if="tehseels.total > 0">
                                    Showing
                                    <span class="font-medium">{{ tehseels.from || 0 }}</span>
                                    to
                                    <span class="font-medium">{{ tehseels.to || 0 }}</span>
                                    of
                                    <span class="font-medium">{{ tehseels.total }}</span>
                                    results
                                </p>
                                <p class="text-sm text-gray-700" v-else>
                                    No results found
                                </p>
                            </div>
                            <div v-if="tehseels.links && tehseels.links.length > 0">
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <template v-for="link in tehseels.links" :key="link.label">
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
        <Modal :show="showCreateModal" @close="closeCreateModal" max-width="sm">
            <div class="bg-white">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Create New Tehseel</h3>
                </div>
                <form @submit.prevent="submitCreate" class="p-6">
                    <div class="space-y-4">
                        <!-- District -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                District <span class="text-red-500">*</span>
                            </label>
                            <select 
                                v-model="createForm.district_id" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': createForm.errors.district_id }"
                            >
                                <option value="">Select District</option>
                                <option v-for="district in districts" :key="district.id" :value="district.id">
                                    {{ district.name }}
                                </option>
                            </select>
                            <div v-if="createForm.errors.district_id" class="text-red-500 text-sm mt-1">{{ createForm.errors.district_id }}</div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tehseel Name <span class="text-red-500">*</span>
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

                        <!-- Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tehseel Code
                            </label>
                            <input 
                                v-model="createForm.code" 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': createForm.errors.code }"
                            />
                            <div v-if="createForm.errors.code" class="text-red-500 text-sm mt-1">{{ createForm.errors.code }}</div>
                        </div>

                        <!-- Active Status -->
                        <div>
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
                            Create Tehseel
                        </button>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- Edit Modal -->
        <Modal :show="showEditModal" @close="closeEditModal" max-width="sm">
            <div class="bg-white">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Edit Tehseel</h3>
                </div>
                <form @submit.prevent="submitEdit" class="p-6">
                    <div class="space-y-4">
                        <!-- District -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                District <span class="text-red-500">*</span>
                            </label>
                            <select 
                                v-model="editForm.district_id" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': editForm.errors.district_id }"
                            >
                                <option value="">Select District</option>
                                <option v-for="district in districts" :key="district.id" :value="district.id">
                                    {{ district.name }}
                                </option>
                            </select>
                            <div v-if="editForm.errors.district_id" class="text-red-500 text-sm mt-1">{{ editForm.errors.district_id }}</div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tehseel Name <span class="text-red-500">*</span>
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

                        <!-- Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tehseel Code
                            </label>
                            <input 
                                v-model="editForm.code" 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': editForm.errors.code }"
                            />
                            <div v-if="editForm.errors.code" class="text-red-500 text-sm mt-1">{{ editForm.errors.code }}</div>
                        </div>

                        <!-- Active Status -->
                        <div>
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
                            Update Tehseel
                        </button>
                    </div>
                </form>
            </div>
        </Modal>
    </AdminLayout>
</template>
