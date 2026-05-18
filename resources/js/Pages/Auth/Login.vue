<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    service_number: '',
    password: '',
    remember: false,
});

const currentSlide = ref(0);
const slides = [
    {
        title: 'Welcome to GDM School Management System',
        description: 'Streamline your educational institution with our comprehensive management solution.',
        image: '/storage/hero/7.jpg'
    },
    {
        title: 'Efficient Student Management',
        description: 'Track student progress, attendance, and performance all in one place.',
        image: '/storage/hero/1.jpg'
    },
    {
        title: 'Smart Classroom Tools',
        description: 'Modern tools for teachers to manage classrooms and engage students effectively.',
        image: '/storage/hero/2.jpg'
    }
];

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
};

const prevSlide = () => {
    currentSlide.value = currentSlide.value === 0 ? slides.length - 1 : currentSlide.value - 1;
};

const goToSlide = (index) => {
    currentSlide.value = index;
};

onMounted(() => {
    setInterval(nextSlide, 5000);
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen flex bg-gray-50">
        <Head title="Log in" />
        
        <!-- Left Side - Carousel -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 relative overflow-hidden">
            <div class="absolute inset-0">
                <transition name="slide-fade" mode="out-in">
                    <img 
                        :key="currentSlide"
                        :src="slides[currentSlide].image" 
                        :alt="slides[currentSlide].title"
                        class="w-full h-full object-cover"
                    />
                </transition>
            </div>
            <div class="absolute inset-0 bg-black opacity-40"></div>
            
            <!-- Carousel Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-white p-12">
                <div class="max-w-2xl text-center">
                    <transition name="slide-fade" mode="out-in">
                        <div :key="currentSlide" class="space-y-6">
                            <h2 class="text-4xl font-bold mb-4">{{ slides[currentSlide].title }}</h2>
                            <p class="text-xl text-blue-100">{{ slides[currentSlide].description }}</p>
                        </div>
                    </transition>
                    
                    <!-- Carousel Indicators -->
                    <div class="flex justify-center space-x-2 mt-8">
                        <button
                            v-for="(slide, index) in slides"
                            :key="index"
                            @click="goToSlide(index)"
                            :class="[
                                'w-3 h-3 rounded-full transition-all duration-300',
                                currentSlide === index ? 'bg-white w-8' : 'bg-white bg-opacity-50 hover:bg-opacity-75'
                            ]"
                        ></button>
                    </div>
                    
                    <!-- Carousel Navigation -->
                    <div class="flex justify-between items-center mt-12 px-8">
                        <button
                            @click="prevSlide"
                            class="p-3 rounded-full bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button
                            @click="nextSlide"
                            class="p-3 rounded-full bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-transparent via-white to-transparent transform rotate-12"></div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">School Management</h1>
                </div>
                
                <!-- Login Form Container -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                        <p class="text-gray-600">Sign in to your account</p>
                    </div>
                    
                    <!-- Status Message -->
                    <div v-if="status" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600">{{ status }}</p>
                    </div>
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="service_number" value="Service Number" class="text-gray-700 font-medium" />
                            <TextInput
                                id="service_number"
                                type="text"
                                class="mt-2 block w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.service_number"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your service number"
                            />
                            <InputError class="mt-2" :message="form.errors.service_number" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Password" class="text-gray-700 font-medium" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-2 block w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                                    
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-blue-600 hover:text-blue-500 font-medium"
                            >
                                Forgot password?
                            </Link>
                        </div>

                        <div>
                            <PrimaryButton
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-medium py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02]"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Signing in...
                                </span>
                                <span v-else>Sign In</span>
                            </PrimaryButton>
                        </div>
                    </form>
                    
                    <!-- Mobile Carousel Preview -->
                    <div class="lg:hidden mt-8 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg">
                        <div class="text-center">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">{{ slides[currentSlide].title }}</h3>
                            <p class="text-xs text-gray-600">{{ slides[currentSlide].description }}</p>
                            <div class="flex justify-center space-x-1 mt-3">
                                <button
                                    v-for="(slide, index) in slides"
                                    :key="index"
                                    @click="goToSlide(index)"
                                    :class="[
                                        'w-2 h-2 rounded-full transition-all duration-300',
                                        currentSlide === index ? 'bg-blue-600 w-6' : 'bg-gray-300'
                                    ]"
                                ></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
