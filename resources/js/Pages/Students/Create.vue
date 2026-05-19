<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';

const props = defineProps({
    units: Array,
    ranks: Array,
    trades: Array,
    sections: Array,
    religions: Array,
    provinces: Array,
    districts: Array,
    tehseels: Array,
});

const currentStep = ref(1);
const imagePreview = ref(null);

// Computed property for filtered admission sections
const filteredAdmissionSections = computed(() => {
    if (!form.admission_class) {
        return props.sections;
    }
    // Convert title case to lowercase for database comparison
    const classType = form.admission_class.toLowerCase();
    return props.sections.filter(section => section.class_type === classType);
});

// Computed property for filtered current sections
const filteredCurrentSections = computed(() => {
    if (!form.class) {
        return props.sections;
    }
    // Convert title case to lowercase for database comparison
    const classType = form.class.toLowerCase();
    return props.sections.filter(section => section.class_type === classType);
});

const form = useForm({
    // Student core fields
    form_number: '',
    student_name: '',
    father_name: '',
    mother_name: '',
    dob: '',
    gender: '',
    class: '',
    place_of_birth_tehseel_id: '',
    image: '',
    religion: '',
    bloodgroup: '',
    polio_vaccination: false,

    // Guardian Detail fields
    category: '',
    pak_no: '',
    cnic_number: '',
    unit_id: '',
    trade_id: '',
    section: '',
    rank_id: '',

    // Current Address fields
    current_address: '',
    current_city: '',
    current_district_id: '',
    current_tehseel_id: '',
    current_province_id: '',
    current_postal_code: '',
    current_colony: 'AMF',

    // Permanent Address fields
    permanent_address: '',
    permanent_city: '',
    permanent_district_id: '',
    permanent_tehseel_id: '',
    permanent_province_id: '',
    permanent_postal_code: '',
    permanent_colony: 'AMF',

    // Contact fields
    office_phone: '',
    whatsapp_no: '',
    mobile_no: '',
    emergency_contact: '',
    emergency_contact_relation: '',

    // Admission Detail fields
    admission_date: '',
    admission_year: '',
    admission_type: '',
    admission_class: '',
    admission_section_id: '',
    current_admission_date: '',
    prospectus_issued: false,
    card_generated_date: '',
    previous_school: '',
    admission_notes: '',

    // Transport fields
    using_van: false,
    van_route: '',
    van_driver_name: '',
    van_driver_phone: '',
    transport_fee: '',
});

const submit = () => {
    form.post(route('admin.students.store'));
};

const saveAndNext = () => {
    if (currentStep.value < 5) {
        currentStep.value++;
    }
};

const previousStep = () => {
    currentStep.value--;
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    form.image = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.value = null;
    }
};

// Watchers to clear section selections when class changes
watch(() => form.admission_class, (newValue) => {
    form.admission_section_id = '';
});

watch(() => form.class, (newValue) => {
    form.current_section_id = '';
});

// Auto-format guardian CNIC number
watch(() => form.cnic_number, (newValue) => {
    if (!newValue) return;

    // Remove all non-digit characters
    let cleaned = newValue.replace(/\D/g, '');

    // Limit to 13 digits (5 + 7 + 1)
    if (cleaned.length > 13) {
        cleaned = cleaned.substring(0, 13);
    }

    // Format as XXXXX-XXXXXXX-X
    let formatted = '';
    if (cleaned.length > 0) {
        formatted = cleaned.substring(0, 5);
        if (cleaned.length > 5) {
            formatted += '-' + cleaned.substring(5, 12);
            if (cleaned.length > 12) {
                formatted += '-' + cleaned.substring(12);
            }
        }
    }

    form.cnic_number = formatted;
});

const getStepTitle = () => {
    switch(currentStep.value) {
        case 1: return 'Student Information';
        case 2: return 'Academic Information';
        case 3: return 'Father Information';
        case 4: return 'Contact Information';
        case 5: return 'Review & Submit';
        default: return 'Student Information';
    }
};
</script>

<template>
    <Head title="Create Student" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Student</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <!-- Step Indicator -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white text-sm font-medium">
                                    1
                                </div>
                                <div class="ml-2 text-sm font-medium text-gray-900">Student Information</div>
                            </div>
                            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium" :class="currentStep >= 2 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-500'">
                                    2
                                </div>
                                <div class="ml-2 text-sm font-medium" :class="currentStep >= 2 ? 'text-gray-900' : 'text-gray-500'">Academic Information</div>
                            </div>
                            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium" :class="currentStep >= 3 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-500'">
                                    3
                                </div>
                                <div class="ml-2 text-sm font-medium" :class="currentStep >= 3 ? 'text-gray-900' : 'text-gray-500'">Father Information</div>
                            </div>
                            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium" :class="currentStep >= 4 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-500'">
                                    4
                                </div>
                                <div class="ml-2 text-sm font-medium" :class="currentStep >= 4 ? 'text-gray-900' : 'text-gray-500'">Contact Information</div>
                            </div>
                            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium" :class="currentStep >= 5 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-500'">
                                    5
                                </div>
                                <div class="ml-2 text-sm font-medium" :class="currentStep >= 5 ? 'text-gray-900' : 'text-gray-500'">Review & Submit</div>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="currentStep === 5 ? submit() : saveAndNext()">
                        <!-- Step 1: Student Information -->
                        <div v-if="currentStep === 1" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Student Information</h3>
                                <Link
                                    :href="route('admin.students.index')"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                                >
                                    Back to Students
                                </Link>
                            </div>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Father Name *</label>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mother Name *</label>
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
                                        v-model="form.religion"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.religion }"
                                    >
                                        <option value="">Select Religion</option>
                                        <option v-for="religion in props.religions" :key="religion.id" :value="religion.name">{{ religion.name }}</option>
                                    </select>
                                    <p v-if="form.errors.religion" class="mt-1 text-sm text-red-600">{{ form.errors.religion }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Form Number *</label>
                                    <input
                                        v-model="form.form_number"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.form_number }"
                                        required
                                    />
                                    <p v-if="form.errors.form_number" class="mt-1 text-sm text-red-600">{{ form.errors.form_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth (Tehseel)</label>
                                    <select
                                        v-model="form.place_of_birth_tehseel_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.place_of_birth_tehseel_id }"
                                    >
                                        <option value="">Select Tehseel</option>
                                        <option v-for="tehseel in props.tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                    </select>
                                    <p v-if="form.errors.place_of_birth_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.place_of_birth_tehseel_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Image</label>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div v-if="imagePreview" class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-300">
                                                <img :src="imagePreview" alt="Student preview" class="w-full h-full object-cover" />
                                            </div>
                                            <div v-else class="w-20 h-20 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <input
                                                type="file"
                                                @input="handleImageUpload"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                :class="{ 'border-red-500': form.errors.stu_image }"
                                                accept="image/*"
                                            />
                                            <p v-if="form.errors.stu_image" class="mt-1 text-sm text-red-600">{{ form.errors.stu_image }}</p>
                                            <p v-if="form.stu_image" class="mt-1 text-sm text-gray-600">Selected: {{ form.stu_image.name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-end mt-6">
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Next Step
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Academic Information -->
                        <div v-if="currentStep === 2" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Academic Information</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                               
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Type</label>
                                    <select
                                        v-model="form.admission_type"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_type }"
                                    >
                                        <option value="">Select Admission Type</option>
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
                                        <option value="">Select Admission Class</option>
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
                                        @change="form.admission_section_id = $event.target.value"
                                    >
                                        <option value="">Select Admission Section</option>
                                        <option v-for="section in filteredAdmissionSections" :key="section.id" :value="section.id">{{ section.name }}</option>
                                    </select>
                                    <p v-if="form.errors.admission_section_id" class="mt-1 text-sm text-red-600">{{ form.errors.admission_section_id }}</p>
                                    <p v-if="form.admission_class && filteredAdmissionSections.length === 0" class="mt-1 text-sm text-yellow-600">
                                        No sections available for {{ form.admission_class }} class
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Class</label>
                                    <select
                                        v-model="form.class"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.class }"
                                    >
                                        <option value="">Select Class</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Advance">Advance</option>
                                    </select>
                                    <p v-if="form.errors.class" class="mt-1 text-sm text-red-600">{{ form.errors.class }}</p>
                                </div>
                                
                               
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Section</label>
                                    <select
                                        v-model="form.current_section_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_section_id }"
                                        @change="form.current_section_id = $event.target.value"
                                    >
                                        <option value="">Select Section</option>
                                        <option v-for="section in filteredCurrentSections" :key="section.id" :value="section.id">{{ section.name }}</option>
                                    </select>
                                    <p v-if="form.errors.current_section_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_section_id }}</p>
                                    <p v-if="form.class && filteredCurrentSections.length === 0" class="mt-1 text-sm text-yellow-600">
                                        No sections available for {{ form.class }} class
                                    </p>
                                </div>
                               
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Date *</label>
                                    <input
                                        v-model="form.admission_date"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.admission_date }"
                                        required
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
                                        min="2000"
                                        :max="new Date().getFullYear() + 1"
                                    />
                                    <p v-if="form.errors.admission_year" class="mt-1 text-sm text-red-600">{{ form.errors.admission_year }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Admission Date</label>
                                    <input
                                        v-model="form.current_admission_date"
                                        type="date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.current_admission_date }"
                                    />
                                    <p v-if="form.errors.current_admission_date" class="mt-1 text-sm text-red-600">{{ form.errors.current_admission_date }}</p>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-6">
                                <button
                                    type="button"
                                    @click="previousStep"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Previous
                                </button>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Next Step
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Additional Information -->
                        <div v-if="currentStep === 3" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Father Information</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select
                                        v-model="form.category"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.category }"
                                    >
                                        <option value="">Select Category</option>
                                        <option value="Officer">Officer</option>
                                        <option value="civilian">Civilian</option>
                                        <option value="CNE">CNE</option>
                                    </select>
                                    <p v-if="form.errors.category" class="mt-1 text-sm text-red-600">{{ form.errors.category }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit</label>
                                    <select
                                        v-model="form.unit_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.unit_id }"
                                    >
                                        <option value="">Select Unit</option>
                                        <option v-for="unit in props.units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
                                    </select>
                                    <p v-if="form.errors.unit_id" class="mt-1 text-sm text-red-600">{{ form.errors.unit_id }}</p>
                                </div>



                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pak Number</label>
                                    <input
                                        v-model="form.pak_no"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.pak_no }"
                                    />
                                    <p v-if="form.errors.pak_no" class="mt-1 text-sm text-red-600">{{ form.errors.pak_no }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rank/Position</label>
                                    <select
                                        v-model="form.rank_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.rank_id }"
                                    >
                                        <option value="">Select Rank</option>
                                        <option v-for="rank in props.ranks" :key="rank.id" :value="rank.id">{{ rank.name }}</option>
                                    </select>
                                    <p v-if="form.errors.rank_id" class="mt-1 text-sm text-red-600">{{ form.errors.rank_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Trade/Specialization</label>
                                    <select
                                        v-model="form.trade_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.trade_id }"
                                    >
                                        <option value="">Select Trade</option>
                                        <option v-for="trade in props.trades" :key="trade.id" :value="trade.id">{{ trade.name }}</option>
                                    </select>
                                    <p v-if="form.errors.trade_id" class="mt-1 text-sm text-red-600">{{ form.errors.trade_id }}</p>
                                </div>
                                                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CNIC Number</label>
                                    <input
                                        v-model="form.cnic_number"
                                        type="text"
                                        placeholder="XXXXX-XXXXXXX-X"
                                        maxlength="15"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.cnic_number }"
                                    />
                                    <p v-if="form.errors.cnic_number" class="mt-1 text-sm text-red-600">{{ form.errors.cnic_number }}</p>
                                </div>


                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                                    <input
                                        v-model="form.section"
                                        type="text"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{ 'border-red-500': form.errors.section }"
                                    />
                                    <p v-if="form.errors.section" class="mt-1 text-sm text-red-600">{{ form.errors.section }}</p>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-6">
                                <button
                                    type="button"
                                    @click="previousStep"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Previous
                                </button>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Next Step
                                </button>
                            </div>
                        </div>

                        <!-- Step 4: Contact & Address Information -->
                        <div v-if="currentStep === 4" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Contact & Address Information</h3>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-800 mb-3">Contact Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Number</label>
                                        <input
                                            v-model="form.whatsapp_no"
                                            type="tel"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.whatsapp_no }"
                                        />
                                        <p v-if="form.errors.whatsapp_no" class="mt-1 text-sm text-red-600">{{ form.errors.whatsapp_no }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                                        <input
                                            v-model="form.mobile_no"
                                            type="tel"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.mobile_no }"
                                        />
                                        <p v-if="form.errors.mobile_no" class="mt-1 text-sm text-red-600">{{ form.errors.mobile_no }}</p>
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
                                    <div>
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

                            <!-- Permanent Address -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-800 mb-3">Permanent Address</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                        <select
                                            v-model="form.permanent_province_id"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.permanent_province_id }"
                                        >
                                            <option value="">Select Province</option>
                                            <option v-for="province in props.provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
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
                                            <option v-for="district in props.districts" :key="district.id" :value="district.id">{{ district.name }}</option>
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
                                            <option v-for="tehseel in props.tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                        </select>
                                        <p v-if="form.errors.permanent_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_tehseel_id }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Colony</label>
                                        <select
                                            v-model="form.permanent_colony"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.permanent_colony }"
                                        >
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input
                                            v-model="form.permanent_city"
                                            type="text"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.permanent_city }"
                                        />
                                        <p v-if="form.errors.permanent_city" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_city }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <textarea
                                            v-model="form.permanent_address"
                                            rows="2"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.permanent_address }"
                                        ></textarea>
                                        <p v-if="form.errors.permanent_address" class="mt-1 text-sm text-red-600">{{ form.errors.permanent_address }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Address -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold text-gray-800 mb-3">Current Address</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                        <select
                                            v-model="form.current_province_id"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.current_province_id }"
                                        >
                                            <option value="">Select Province</option>
                                            <option v-for="province in props.provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
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
                                            <option v-for="district in props.districts" :key="district.id" :value="district.id">{{ district.name }}</option>
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
                                            <option v-for="tehseel in props.tehseels" :key="tehseel.id" :value="tehseel.id">{{ tehseel.name }}</option>
                                        </select>
                                        <p v-if="form.errors.current_tehseel_id" class="mt-1 text-sm text-red-600">{{ form.errors.current_tehseel_id }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Colony</label>
                                        <select
                                            v-model="form.current_colony"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.current_colony }"
                                        >
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input
                                            v-model="form.current_city"
                                            type="text"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.current_city }"
                                        />
                                        <p v-if="form.errors.current_city" class="mt-1 text-sm text-red-600">{{ form.errors.current_city }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <textarea
                                            v-model="form.current_address"
                                            rows="2"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            :class="{ 'border-red-500': form.errors.current_address }"
                                        ></textarea>
                                        <p v-if="form.errors.current_address" class="mt-1 text-sm text-red-600">{{ form.errors.current_address }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-6">
                                <button
                                    type="button"
                                    @click="previousStep"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Previous
                                </button>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Next Step
                                </button>
                            </div>
                        </div>

                        <!-- Step 5: Review & Submit -->
                        <div v-if="currentStep === 5" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Review & Submit</h3>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="font-semibold text-gray-900 mb-4">Student Information Summary</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium">Form Number:</span> {{ form.form_number }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Name:</span> {{ form.student_name }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Father Name:</span> {{ form.father_name }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Mother Name:</span> {{ form.mother_name }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Date of Birth:</span> {{ form.dob }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Gender:</span> {{ form.gender }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Blood Group:</span> {{ form.bloodgroup || 'Not specified' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Religion:</span> {{ form.religion || 'Not specified' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Class:</span> {{ form.class || 'Not specified' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Admission Date:</span> {{ form.admission_date }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Admission Type:</span> {{ form.admission_type || 'Not specified' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Current Admission Date:</span> {{ form.current_admission_date || 'Not specified' }}
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <p class="text-sm text-yellow-800">
                                    Please review all the information above before submitting. Click "Create Student" to complete the registration.
                                </p>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between">
                                <button
                                    type="button"
                                    @click="previousStep"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    Previous
                                </button>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-green-500 hover:bg-green-600 disabled:bg-gray-400 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200"
                                >
                                    <span v-if="form.processing">Creating...</span>
                                    <span v-else>Create Student</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
