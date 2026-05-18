<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    students: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const classLevel = ref(props.filters.class_level || '');

const deleteStudent = (student) => {
    if (confirm(`Are you sure you want to delete ${student.full_name}?`)) {
        router.delete(route('admin.students.destroy', student.id));
    }
};

watch([search, classLevel], () => {
    router.get(
        route('admin.students.index'),
        { search: search.value, class_level: classLevel.value },
        { preserveState: true, replace: true }
    );
});

const getStatusColor = (isActive) => {
    return isActive ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100';
};
</script>

<template>
    <Head title="Students" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students Management</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow mb-6 p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input
                                v-model="search"
                                type="text"
                                placeholder="Search by name, email, or student ID..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Class Level</label>
                            <select
                                v-model="classLevel"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">All Classes</option>
                                <option value="junior">Junior</option>
                                <option value="senior">Senior</option>
                                <option value="advance">Advance</option>
                            </select>
                        </div>
                        <div class="flex items-end space-x-3">
                            <Link
                                :href="route('admin.students.index')"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                            >
                                Clear Filters
                            </Link>
                            <Link
                                :href="route('admin.students.create')"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                            >
                                Add New Student
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Students Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Student ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grade
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
                            <tr v-for="student in students.data" :key="student.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ student.student_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ student.full_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ student.phone || 'No phone' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ student.user.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ student.class_level }}{{ student.section ? ' - ' + student.section : '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(student.is_active)}`">
                                        {{ student.is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <Link
                                        :href="route('admin.students.show', student.id)"
                                        class="text-blue-600 hover:text-blue-900 mr-3"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        :href="route('admin.students.edit', student.id)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteStudent(student)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link
                                v-if="students.prev_page_url"
                                :href="students.prev_page_url"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Previous
                            </Link>
                            <span
                                v-else
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-gray-100 cursor-not-allowed"
                            >
                                Previous
                            </span>
                            <Link
                                v-if="students.next_page_url"
                                :href="students.next_page_url"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Next
                            </Link>
                            <span
                                v-else
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-gray-100 cursor-not-allowed"
                            >
                                Next
                            </span>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">{{ students.from }}</span>
                                    to
                                    <span class="font-medium">{{ students.to }}</span>
                                    of
                                    <span class="font-medium">{{ students.total }}</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <template v-for="link in students.links" :key="link.label">
                                        <Link
                                            v-if="link.url"
                                            :href="link.url"
                                            :class="{
                                                'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                'bg-blue-50 border-blue-500 text-blue-600': link.active,
                                                'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active
                                            }"
                                            v-html="link.label"
                                        />
                                        <span
                                            v-else
                                            :class="{
                                                'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                'bg-gray-100 border-gray-300 text-gray-300 cursor-not-allowed': true
                                            }"
                                            v-html="link.label"
                                        />
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
