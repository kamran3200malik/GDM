<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    student: Object,
    units: Array,
    ranks: Array,
    trades: Array,
    sections: Array,
    religions: Array,
    provinces: Array,
    districts: Array,
    tehseels: Array,
});

const form = useForm({
    // Personal Information
    student_name: props.student.student_name,
    father_name: props.student.father_name,
    mother_name: props.student.mother_name,
    dob: props.student.dob,
    gender: props.student.gender,
    image: null,
    bloodgroup: props.student.bloodgroup,
    polio_vaccination: props.student.polio_vaccination,
    religion_id: props.student.religion_id,
    place_of_birth_tehseel_id: props.student.place_of_birth_tehseel_id,
    current_class: props.student.current_class,
    current_section_id: props.student.current_section_id,
    is_active: props.student.is_active,

    // Contact Information
    office_phone: props.student.primary_contact?.office_phone || '',
    whatsapp_no: props.student.primary_contact?.whatsapp_no || '',
    mobile_no: props.student.primary_contact?.mobile_no || '',
    emergency_contact: props.student.primary_contact?.emergency_contact || '',
    emergency_contact_relation: props.student.primary_contact?.emergency_contact_relation || '',

    // Current Address
    current_colony: props.student.current_address?.colony || '',
    current_address: props.student.current_address?.address || '',
    current_city: props.student.current_address?.city || '',
    current_province_id: props.student.current_address?.province_id || '',
    current_district_id: props.student.current_address?.district_id || '',
    current_tehseel_id: props.student.current_address?.tehseel_id || '',
    current_postal_code: props.student.current_address?.postal_code || '',

    // Permanent Address
    permanent_colony: props.student.permanent_address?.colony || '',
    permanent_address: props.student.permanent_address?.address || '',
    permanent_city: props.student.permanent_address?.city || '',
    permanent_province_id: props.student.permanent_address?.province_id || '',
    permanent_district_id: props.student.permanent_address?.district_id || '',
    permanent_tehseel_id: props.student.permanent_address?.tehseel_id || '',
    permanent_postal_code: props.student.permanent_address?.postal_code || '',

    // Admission Details
    admission_date: props.student.admission_detail?.admission_date || '',
    admission_year: props.student.admission_detail?.admission_year || '',
    admission_type: props.student.admission_detail?.admission_type || '',
    admission_class: props.student.admission_detail?.admission_class || '',
    admission_section_id: props.student.admission_detail?.admission_section_id || '',
    prospectus_issued: props.student.admission_detail?.prospectus_issued || false,
    card_generated_date: props.student.admission_detail?.card_generated_date || '',
    previous_school: props.student.admission_detail?.previous_school || '',
    admission_notes: props.student.admission_detail?.admission_notes || '',

    // Guardian Details
    guardian_category: props.student.guardian_detail?.category || '',
    guardian_pak_no: props.student.guardian_detail?.pak_no || '',
    guardian_cnic_number: props.student.guardian_detail?.cnic_number || '',
    guardian_unit_id: props.student.guardian_detail?.unit_id || '',
    guardian_trade_id: props.student.guardian_detail?.trade_id || '',
    guardian_section: props.student.guardian_detail?.section || '',
    guardian_rank_id: props.student.guardian_detail?.rank_id || '',

    // Transport Details
    using_van: props.student.transport?.using_van || false,
    van_route: props.student.transport?.van_route || '',
    van_driver_name: props.student.transport?.van_driver_name || '',
    van_driver_phone: props.student.transport?.van_driver_phone || '',
    transport_fee: props.student.transport?.transport_fee || '',
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        image: data.image instanceof File ? data.image : undefined,
    })).put(route('admin.students.update', props.student.id), {
        onSuccess: () => {
            Toast.fire({
                icon: 'success',
                title: 'Student updated successfully'
            });
        },
        onError: () => {
            Toast.fire({
                icon: 'error',
                title: 'Error updating student'
            });
        }
    });
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
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form @submit.prevent="submit">
                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Name *</label>
                                    <input
                                        v-model="form.student_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.student_name }"
                                        required
                                    />
                                    <p v-if="form.errors.student_name" class="mt-1 text-sm text-red-600">{{ form.errors.student_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name *</label>
                                    <input
                                        v-model="form.father_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.father_name }"
                                        required
                                    />
                                    <p v-if="form.errors.father_name" class="mt-1 text-sm text-red-600">{{ form.errors.father_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name *</label>
                                    <input
                                        v-model="form.mother_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.mother_name }"
                                        required
                                    />
                                    <p v-if="form.errors.mother_name" class="mt-1 text-sm text-red-600">{{ form.errors.mother_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                                    <input
                                        v-model="form.dob"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.dob }"
                                        required
                                    />
                                    <p v-if="form.errors.dob" class="mt-1 text-sm text-red-600">{{ form.errors.dob }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                    <input
                                        type="file"
                                        @input="form.image = $event.target.files[0]"
                                        accept="image/*"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.image }"
                                    />
                                    <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
                                    <div v-if="student.image" class="mt-2">
                                        <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                                        <img :src="'/storage/' + student.image" alt="Student Image" class="h-20 w-20 object-cover rounded" />
                                    </div>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                                    <select
                                        v-model="form.bloodgroup"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.bloodgroup }"
                                    >
                                        <option value="">Select Blood Group</option>
                                        <option value="A+ve">A+</option>
                                        <option value="A-ve">A-</option>
                                        <option value="B+ve">B+</option>
                                        <option value="B-ve">B-</option>
                                        <option value="AB+ve">AB+</option>
                                        <option value="AB-ve">AB-</option>
                                        <option value="O+ve">O+</option>
                                        <option value="O-ve">O-</option>
                                    </select>
                                    <p v-if="form.errors.bloodgroup" class="mt-1 text-sm text-red-600">{{ form.errors.bloodgroup }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                                    <select
                                        v-model="form.religion_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.religion_id }"
                                    >
                                        <option value="">Select Religion</option>
                                        <option v-for="religion in religions" :key="religion.id" :value="religion.id">{{ religion.name }}</option>
                                    </select>
                                    <p v-if="form.errors.religion_id" class="mt-1 text-sm text-red-600">{{ form.errors.religion_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                                    <select
                                        v-model="form.place_of_birth_tehseel_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.place_of_birth_tehseel_id }"
                                    >
                                        <option value="">Select Tehseel</option>
                                        <option v-for="tehseel in tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                    </select>
                                    <p v-if="form.errors.place_of_birth_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.place_of_birth_tehseel_id }}</p>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        v-model="form.polio_vaccination"
                                        type="checkbox"
                                        id="polio_vaccination"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    />
                                    <label for="polio_vaccination" class="ml-2 block text-sm text-gray-700">
                                        Polio Vaccination
                                    </label>
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

                        <!-- Contact Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mobile No</label>
                                    <input
                                        v-model="form.mobile_no"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.mobile_no }"
                                    />
                                    <p v-if="form.errors.mobile_no" class="mt-1 text-sm text-red-600">{{ form.errors.mobile_no }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Office Phone</label>
                                    <input
                                        v-model="form.office_phone"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.office_phone }"
                                    />
                                    <p v-if="form.errors.office_phone" class="mt-1 text-sm text-red-600">{{ form.errors.office_phone }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp No</label>
                                    <input
                                        v-model="form.whatsapp_no"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.whatsapp_no }"
                                    />
                                    <p v-if="form.errors.whatsapp_no" class="mt-1 text-sm text-red-600">{{ form.errors.whatsapp_no }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact</label>
                                    <input
                                        v-model="form.emergency_contact"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.emergency_contact }"
                                    />
                                    <p v-if="form.errors.emergency_contact" class="mt-1 text-sm text-red-600">{{ form.errors.emergency_contact }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Relation</label>
                                    <input
                                        v-model="form.emergency_contact_relation"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.emergency_contact_relation }"
                                    />
                                    <p v-if="form.errors.emergency_contact_relation" class="mt-1 text-sm text-red-600">{{ form.errors.emergency_contact_relation }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Current Address -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Address</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea
                                        v-model="form.current_address"
                                        rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_address }"
                                    ></textarea>
                                    <p v-if="form.errors.current_address" class="mt-1 text-sm text-red-600">{{ form.errors.current_address }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input
                                        v-model="form.current_city"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_city }"
                                    />
                                    <p v-if="form.errors.current_city" class="mt-1 text-sm text-red-600">{{ form.errors.current_city }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Colony</label>
                                    <select
                                        v-model="form.current_colony"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_colony }"
                                    >
                                        <option value="">Select Colony</option>
                                        <option value="AMF">AMF</option>
                                        <option value="MRF">MRF</option>
                                        <option value="APF">APF</option>
                                        <option value="ARF">ARF</option>
                                        <option value="BASE">BASE</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                    <p v-if="form.errors.current_colony" class="mt-1 text-sm text-red-600">{{ form.errors.current_colony }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <select
                                        v-model="form.current_province_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_province_id }"
                                    >
                                        <option value="">Select Province</option>
                                        <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                    </select>
                                    <p v-if="form.errors.current_province_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_province_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <select
                                        v-model="form.current_district_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_district_id }"
                                    >
                                        <option value="">Select District</option>
                                        <option v-for="district in districts" :key="district.id" :value="district.id">{{ district.name }}</option>
                                    </select>
                                    <p v-if="form.errors.current_district_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_district_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tehseel</label>
                                    <select
                                        v-model="form.current_tehseel_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_tehseel_id }"
                                    >
                                        <option value="">Select Tehseel</option>
                                        <option v-for="tehseel in tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                    </select>
                                    <p v-if="form.errors.current_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_tehseel_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input
                                        v-model="form.current_postal_code"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_postal_code }"
                                    />
                                    <p v-if="form.errors.current_postal_code" class="mt-1 text-sm text-red-600">{{ form.errors.current_postal_code }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Permanent Address</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea
                                        v-model="form.permanent_address"
                                        rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_address }"
                                    ></textarea>
                                    <p v-if="form.errors.permanent_address" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_address }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input
                                        v-model="form.permanent_city"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_city }"
                                    />
                                    <p v-if="form.errors.permanent_city" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_city }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Colony</label>
                                    <select
                                        v-model="form.permanent_colony"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_colony }"
                                    >
                                        <option value="">Select Colony</option>
                                        <option value="AMF">AMF</option>
                                        <option value="MRF">MRF</option>
                                        <option value="APF">APF</option>
                                        <option value="ARF">ARF</option>
                                        <option value="BASE">BASE</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                    <p v-if="form.errors.permanent_colony" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_colony }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <select
                                        v-model="form.permanent_province_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_province_id }"
                                    >
                                        <option value="">Select Province</option>
                                        <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                    </select>
                                    <p v-if="form.errors.permanent_province_id" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_province_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <select
                                        v-model="form.permanent_district_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_district_id }"
                                    >
                                        <option value="">Select District</option>
                                        <option v-for="district in districts" :key="district.id" :value="district.id">{{ district.name }}</option>
                                    </select>
                                    <p v-if="form.errors.permanent_district_id" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_district_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tehseel</label>
                                    <select
                                        v-model="form.permanent_tehseel_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_tehseel_id }"
                                    >
                                        <option value="">Select Tehseel</option>
                                        <option v-for="tehseel in tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                    </select>
                                    <p v-if="form.errors.permanent_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_tehseel_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input
                                        v-model="form.permanent_postal_code"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.permanent_postal_code }"
                                    />
                                    <p v-if="form.errors.permanent_postal_code" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_postal_code }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Class</label>
                                    <select
                                        v-model="form.current_class"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_class }"
                                    >
                                        <option value="">Select Class</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Advance">Advance</option>
                                    </select>
                                    <p v-if="form.errors.current_class" class="mt-1 text-sm text-red-600">{{ form.errors.current_class }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Section</label>
                                    <select
                                        v-model="form.current_section_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_section_id }"
                                    >
                                        <option value="">Select Section</option>
                                        <option v-for="section in sections" :key="section.id" :value="section.id">{{ section.name }}</option>
                                    </select>
                                    <p v-if="form.errors.current_section_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_section_id }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Admission Details -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Admission Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Date</label>
                                    <input
                                        v-model="form.admission_date"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_date }"
                                    />
                                    <p v-if="form.errors.admission_date" class="mt-1 text-sm text-red-600">{{ form.errors.admission_date }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Year</label>
                                    <input
                                        v-model="form.admission_year"
                                        type="number"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_year }"
                                    />
                                    <p v-if="form.errors.admission_year" class="mt-1 text-sm text-red-600">{{ form.errors.admission_year }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Type</label>
                                    <select
                                        v-model="form.admission_type"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_type }"
                                    >
                                        <option value="">Select Type</option>
                                        <option value="new_admission">New Admission</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="readmission">Readmission</option>
                                    </select>
                                    <p v-if="form.errors.admission_type" class="mt-1 text-sm text-red-600">{{ form.errors.admission_type }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Class</label>
                                    <select
                                        v-model="form.admission_class"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_class }"
                                    >
                                        <option value="">Select Class</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Advance">Advance</option>
                                    </select>
                                    <p v-if="form.errors.admission_class" class="mt-1 text-sm text-red-600">{{ form.errors.admission_class }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Section</label>
                                    <select
                                        v-model="form.admission_section_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_section_id }"
                                    >
                                        <option value="">Select Section</option>
                                        <option v-for="section in sections" :key="section.id" :value="section.id">{{ section.name }}</option>
                                    </select>
                                    <p v-if="form.errors.admission_section_id" class="mt-1 text-sm text-red-600">{{ form.errors.admission_section_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Card Generated Date</label>
                                    <input
                                        v-model="form.card_generated_date"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.card_generated_date }"
                                    />
                                    <p v-if="form.errors.card_generated_date" class="mt-1 text-sm text-red-600">{{ form.errors.card_generated_date }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Previous School</label>
                                    <input
                                        v-model="form.previous_school"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.previous_school }"
                                    />
                                    <p v-if="form.errors.previous_school" class="mt-1 text-sm text-red-600">{{ form.errors.previous_school }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Notes</label>
                                    <textarea
                                        v-model="form.admission_notes"
                                        rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_notes }"
                                    ></textarea>
                                    <p v-if="form.errors.admission_notes" class="mt-1 text-sm text-red-600">{{ form.errors.admission_notes }}</p>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        v-model="form.prospectus_issued"
                                        type="checkbox"
                                        id="prospectus_issued"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    />
                                    <label for="prospectus_issued" class="ml-2 block text-sm text-gray-700">
                                        Prospectus Issued
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Details -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Guardian Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select
                                        v-model="form.guardian_category"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_category }"
                                    >
                                        <option value="">Select Category</option>
                                        <option value="Officer">Officer</option>
                                        <option value="civilian">Civilian</option>
                                        <option value="CNE">CNE</option>
                                    </select>
                                    <p v-if="form.errors.guardian_category" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_category }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">PAK No</label>
                                    <input
                                        v-model="form.guardian_pak_no"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_pak_no }"
                                    />
                                    <p v-if="form.errors.guardian_pak_no" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_pak_no }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CNIC Number</label>
                                    <input
                                        v-model="form.guardian_cnic_number"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_cnic_number }"
                                    />
                                    <p v-if="form.errors.guardian_cnic_number" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_cnic_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit</label>
                                    <select
                                        v-model="form.guardian_unit_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_unit_id }"
                                    >
                                        <option value="">Select Unit</option>
                                        <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
                                    </select>
                                    <p v-if="form.errors.guardian_unit_id" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_unit_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Trade</label>
                                    <select
                                        v-model="form.guardian_trade_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_trade_id }"
                                    >
                                        <option value="">Select Trade</option>
                                        <option v-for="trade in trades" :key="trade.id" :value="trade.id">{{ trade.name }}</option>
                                    </select>
                                    <p v-if="form.errors.guardian_trade_id" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_trade_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                                    <input
                                        v-model="form.guardian_section"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_section }"
                                    />
                                    <p v-if="form.errors.guardian_section" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_section }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rank</label>
                                    <select
                                        v-model="form.guardian_rank_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.guardian_rank_id }"
                                    >
                                        <option value="">Select Rank</option>
                                        <option v-for="rank in ranks" :key="rank.id" :value="rank.id">{{ rank.name }}</option>
                                    </select>
                                    <p v-if="form.errors.guardian_rank_id" class="mt-1 text-sm text-red-600">{{ form.errors.guardian_rank_id }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transport Details -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Transport Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-center">
                                    <input
                                        v-model="form.using_van"
                                        type="checkbox"
                                        id="using_van"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    />
                                    <label for="using_van" class="ml-2 block text-sm text-gray-700">
                                        Using Van
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Van Route</label>
                                    <input
                                        v-model="form.van_route"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.van_route }"
                                    />
                                    <p v-if="form.errors.van_route" class="mt-1 text-sm text-red-600">{{ form.errors.van_route }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Name</label>
                                    <input
                                        v-model="form.van_driver_name"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.van_driver_name }"
                                    />
                                    <p v-if="form.errors.van_driver_name" class="mt-1 text-sm text-red-600">{{ form.errors.van_driver_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Phone</label>
                                    <input
                                        v-model="form.van_driver_phone"
                                        type="tel"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.van_driver_phone }"
                                    />
                                    <p v-if="form.errors.van_driver_phone" class="mt-1 text-sm text-red-600">{{ form.errors.van_driver_phone }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Transport Fee</label>
                                    <input
                                        v-model="form.transport_fee"
                                        type="number"
                                        step="0.01"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.transport_fee }"
                                    />
                                    <p v-if="form.errors.transport_fee" class="mt-1 text-sm text-red-600">{{ form.errors.transport_fee }}</p>
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
