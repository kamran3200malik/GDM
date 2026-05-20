<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '../Components/Header.vue';
import HeroSection from '../Components/HeroSection.vue';
import AboutSection from '../Components/AboutSection.vue';
import AdmissionsSection from '../Components/AdmissionsSection.vue';
import AcademicsSection from '../Components/AcademicsSection.vue';
import FacilitiesSection from '../Components/FacilitiesSection.vue';
import GallerySection from '../Components/GallerySection.vue';
import ContactSection from '../Components/ContactSection.vue';
import Footer from '../Components/Footer.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    auth: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 text-slate-900">
        <div class="mx-auto max-w-7xl px-6">
            <Header :auth="auth" />
            <main>
                <HeroSection />
                <AboutSection />
                <AdmissionsSection />
                <AcademicsSection />
                <FacilitiesSection />
                <GallerySection />
                <ContactSection />
            </main>
            <Footer />
        </div>
    </div>
</template>
