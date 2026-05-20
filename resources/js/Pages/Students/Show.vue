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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student Details</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <!-- Student Profile Header -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <div v-if="student.image" class="w-20 h-20 rounded-full overflow-hidden">
                                    <img :src="'/storage/' + student.image" alt="Student Image" class="w-full h-full object-cover" />
                                </div>
                                <div v-else class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center">
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
                        <div class="flex space-x-3">
                            <Link
                                :href="route('admin.students.index')"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                            >
                                Back
                            </Link>
                            <Link
                                :href="route('admin.students.edit', student.id)"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                            >
                                Edit
                            </Link>
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
                                    <p class="text-sm text-gray-500">Full Name</p>
                                    <p class="font-medium text-gray-900">{{ student.full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Father's Name</p>
                                    <p class="font-medium text-gray-900">{{ student.father_name || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Mother's Name</p>
                                    <p class="font-medium text-gray-900">{{ student.mother_name || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date of Birth</p>
                                    <p class="font-medium text-gray-900">{{ formatDate(student.dob) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Gender</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ student.gender }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Blood Group</p>
                                    <p class="font-medium text-gray-900">{{ student.bloodgroup || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Religion</p>
                                    <p class="font-medium text-gray-900">{{ student.religion_name || student.religion || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Polio Vaccination</p>
                                    <p class="font-medium text-gray-900">{{ student.polio_vaccination ? 'Yes' : 'No' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Place of Birth</p>
                                    <p class="font-medium text-gray-900">{{ student.place_of_birth_tehseel || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-900">{{ student.user?.email || 'No email' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Mobile No</p>
                                    <p class="font-medium text-gray-900">{{ student.primary_contact?.mobile_no || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Office Phone</p>
                                    <p class="font-medium text-gray-900">{{ student.primary_contact?.office_phone || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">WhatsApp No</p>
                                    <p class="font-medium text-gray-900">{{ student.primary_contact?.whatsapp_no || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Emergency Contact</p>
                                    <p class="font-medium text-gray-900">{{ student.primary_contact?.emergency_contact || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Emergency Contact Relation</p>
                                    <p class="font-medium text-gray-900">{{ student.primary_contact?.emergency_contact_relation || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Current Address -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Address</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500">Address</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.address || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">City</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.city || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Colony</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.colony || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Province</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.province || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">District</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.district || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tehseel</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.tehseel || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Postal Code</p>
                                    <p class="font-medium text-gray-900">{{ student.current_address?.postal_code || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Permanent Address</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500">Address</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.address || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">City</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.city || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Colony</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.colony || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Province</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.province || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">District</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.district || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tehseel</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.tehseel || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Postal Code</p>
                                    <p class="font-medium text-gray-900">{{ student.permanent_address?.postal_code || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Current Class</p>
                                    <p class="font-medium text-gray-900">{{ student.current_class || 'Not assigned' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Current Section</p>
                                    <p class="font-medium text-gray-900">{{ student.current_section || 'Not assigned' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Admission Details -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Admission Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Admission Date</p>
                                    <p class="font-medium text-gray-900">{{ formatDate(student.admission_detail?.admission_date) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Admission Year</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.admission_year || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Admission Type</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ student.admission_detail?.admission_type || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Admission Class</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.admission_class || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Admission Section</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.admission_section || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Prospectus Issued</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.prospectus_issued ? 'Yes' : 'No' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Card Generated Date</p>
                                    <p class="font-medium text-gray-900">{{ formatDate(student.admission_detail?.card_generated_date) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Previous School</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.previous_school || 'Not provided' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500">Admission Notes</p>
                                    <p class="font-medium text-gray-900">{{ student.admission_detail?.admission_notes || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Details -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Guardian Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Category</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ student.guardian_detail?.category || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">PAK No</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.pak_no || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">CNIC Number</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.cnic_number || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Unit</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.unit || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Trade</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.trade || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Section</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.section || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Rank</p>
                                    <p class="font-medium text-gray-900">{{ student.guardian_detail?.rank || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transport Details -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Transport Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Using Van</p>
                                    <p class="font-medium text-gray-900">{{ student.transport?.using_van ? 'Yes' : 'No' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Van Route</p>
                                    <p class="font-medium text-gray-900">{{ student.transport?.van_route || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Driver Name</p>
                                    <p class="font-medium text-gray-900">{{ student.transport?.van_driver_name || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Driver Phone</p>
                                    <p class="font-medium text-gray-900">{{ student.transport?.van_driver_phone || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Transport Fee</p>
                                    <p class="font-medium text-gray-900">{{ student.transport?.transport_fee || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-lg p-6">
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
