<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    student: Object,
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const getStatusColor = (isActive) => {
    return isActive ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100';
};
</script>

<template>
    <Head :title="`Student - ${student.full_name}`" />

    <AdminLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student Details</h2>
                <div class="flex space-x-3">
                    <Link
                        :href="route('admin.students.edit', student.id)"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        Edit Student
                    </Link>
                    <Link
                        :href="route('admin.students.index')"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        Back to Students
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <!-- Student Profile Header -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900">{{ student.full_name }}</h1>
                            <p class="text-gray-600">{{ student.student_id }}</p>
                            <div class="flex items-center mt-2 space-x-4">
                                <span :class="`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(student.is_active)}`">
                                    {{ student.is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ student.class_level }}{{ student.section ? ' - ' + student.section : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Personal Information -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">First Name</p>
                                    <p class="font-medium text-gray-900">{{ student.first_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Name</p>
                                    <p class="font-medium text-gray-900">{{ student.last_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date of Birth</p>
                                    <p class="font-medium text-gray-900">{{ formatDate(student.date_of_birth) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Gender</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ student.gender }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium text-gray-900">{{ student.phone || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-900">{{ student.user.email }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500">Address</p>
                                    <p class="font-medium text-gray-900">{{ student.address || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Class Level</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ student.class_level }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Section</p>
                                    <p class="font-medium text-gray-900">{{ student.section || 'Not assigned' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Enrollment Date</p>
                                    <p class="font-medium text-gray-900">{{ formatDate(student.enrollment_date) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Emergency Contact</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Contact Name</p>
                                    <p class="font-medium text-gray-900">{{ student.emergency_contact_name || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Contact Phone</p>
                                    <p class="font-medium text-gray-900">{{ student.emergency_contact_phone || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <Link
                                    :href="route('admin.students.edit', student.id)"
                                    class="w-full bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-left inline-block"
                                >
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Information
                                </Link>
                                <button class="w-full bg-green-50 hover:bg-green-100 text-green-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-left">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    View Reports
                                </button>
                                <button class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-left">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Attendance History
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
