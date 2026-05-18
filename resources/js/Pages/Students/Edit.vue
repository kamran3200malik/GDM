<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    student: Object,
});

const form = useForm({
    first_name: props.student.first_name,
    last_name: props.student.last_name,
    email: props.student.user.email,
    phone: props.student.phone || '',
    address: props.student.address || '',
    date_of_birth: props.student.date_of_birth,
    gender: props.student.gender,
    emergency_contact_name: props.student.emergency_contact_name || '',
    emergency_contact_phone: props.student.emergency_contact_phone || '',
    enrollment_date: props.student.enrollment_date,
    class_level: props.student.class_level,
    section: props.student.section || '',
    is_active: props.student.is_active,
});

const submit = () => {
    form.put(route('admin.students.update', props.student.id));
};
</script>

<template>
    <Head :title="`Edit Student - ${student.full_name}`" />

    <AdminLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Student</h2>
                <div class="flex space-x-3">
                    <Link
                        :href="route('admin.students.show', student.id)"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        View Student
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
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form @submit.prevent="submit">
                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                                    <input
                                        v-model="form.first_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.first_name }"
                                        required
                                    />
                                    <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-600">{{ form.errors.first_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                    <input
                                        v-model="form.last_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.last_name }"
                                        required
                                    />
                                    <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-600">{{ form.errors.last_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                                    <input
                                        v-model="form.date_of_birth"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.date_of_birth }"
                                        required
                                    />
                                    <p v-if="form.errors.date_of_birth" class="mt-1 text-sm text-red-600">{{ form.errors.date_of_birth }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                                    <select
                                        v-model="form.gender"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.gender }"
                                        required
                                    >
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <p v-if="form.errors.gender" class="mt-1 text-sm text-red-600">{{ form.errors.gender }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input
                                        v-model="form.phone"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.phone }"
                                    />
                                    <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea
                                        v-model="form.address"
                                        rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.address }"
                                    ></textarea>
                                    <p v-if="form.errors.address" class="mt-1 text-sm text-red-600">{{ form.errors.address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.email }"
                                        required
                                    />
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                                </div>

                                <div class="flex items-center">
                                    <input
                                        v-model="form.is_active"
                                        type="checkbox"
                                        id="is_active"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    />
                                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                        Active Student
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Class Level *</label>
                                    <select
                                        v-model="form.class_level"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.class_level }"
                                        required
                                    >
                                        <option value="">Select Class</option>
                                        <option value="junior">Junior</option>
                                        <option value="senior">Senior</option>
                                        <option value="advance">Advance</option>
                                    </select>
                                    <p v-if="form.errors.class_level" class="mt-1 text-sm text-red-600">{{ form.errors.class_level }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                                    <input
                                        v-model="form.section"
                                        type="text"
                                        placeholder="e.g., A, B, C"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.section }"
                                    />
                                    <p v-if="form.errors.section" class="mt-1 text-sm text-red-600">{{ form.errors.section }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Enrollment Date *</label>
                                    <input
                                        v-model="form.enrollment_date"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.enrollment_date }"
                                        required
                                    />
                                    <p v-if="form.errors.enrollment_date" class="mt-1 text-sm text-red-600">{{ form.errors.enrollment_date }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Contact -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Emergency Contact</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name</label>
                                    <input
                                        v-model="form.emergency_contact_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.emergency_contact_name }"
                                    />
                                    <p v-if="form.errors.emergency_contact_name" class="mt-1 text-sm text-red-600">{{ form.errors.emergency_contact_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Phone</label>
                                    <input
                                        v-model="form.emergency_contact_phone"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.emergency_contact_phone }"
                                    />
                                    <p v-if="form.errors.emergency_contact_phone" class="mt-1 text-sm text-red-600">{{ form.errors.emergency_contact_phone }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <Link
                                :href="route('admin.students.index')"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                            >
                                Cancel
                            </Link>
                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                :disabled="form.processing"
                            >
                                {{ form.processing ? 'Updating...' : 'Update Student' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
