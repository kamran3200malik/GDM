<script setup>
import { ref, computed } from 'vue';

const currentHeroImage = ref(0);

const heroImages = computed(() => [
    '/storage/hero/1.jpg',
    '/storage/hero/2.jpg',
    '/storage/hero/10.jpg',
    '/storage/hero/4.jpg',
    '/storage/hero/5.jpg',
    '/storage/hero/6.jpg',
    '/storage/hero/7.jpg',
]);

const appTitle = computed(() => 'Golden Days Montessori');

// Auto-cycle carousel
setInterval(() => {
    currentHeroImage.value = (currentHeroImage.value + 1) % heroImages.value.length;
}, 4000);
</script>

<template>
    <section id="home" class="relative overflow-hidden -mx-6">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-600 to-blue-600 opacity-90"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 h-32 w-32 rounded-full bg-yellow-400 opacity-20 blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 h-40 w-40 rounded-full bg-pink-400 opacity-20 blur-3xl animate-pulse" style="animation-delay: 1s"></div>
            <div class="absolute top-40 right-20 h-24 w-24 rounded-full bg-blue-400 opacity-20 blur-3xl animate-pulse" style="animation-delay: 2s"></div>
        </div>
        
        <Transition name="fade" mode="out-in">
            <img 
                :key="currentHeroImage"
                :src="heroImages[currentHeroImage]" 
                alt="School campus" 
                class="absolute inset-0 h-full w-full object-cover mix-blend-overlay" 
                loading="lazy" 
            />
        </Transition>

        <!-- Carousel indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
            <button
                v-for="(image, index) in heroImages"
                :key="index"
                @click="currentHeroImage = index"
                class="w-2 h-2 rounded-full transition-all duration-300"
                :class="currentHeroImage === index ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/70'"
                :aria-label="`Go to slide ${index + 1}`"
            ></button>
        </div>
        
        <div class="relative mx-auto max-w-7xl px-6 py-24 sm:py-32">
            <div class="max-w-3xl">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-yellow-400 to-orange-400 px-4 py-2 text-sm font-semibold text-white shadow-lg">
                    <span class="mr-2">🎓</span> Now Enrolling for 2025-2026
                </div>
                <h1 class="mt-6 text-5xl font-bold tracking-tight text-white sm:text-7xl bg-gradient-to-r from-white to-yellow-200 bg-clip-text text-transparent whitespace-nowrap">Welcome to {{ appTitle }}</h1>
                <p class="mt-6 text-xl leading-8 text-white/90">Providing quality education and nurturing young minds for a brighter future with innovative learning and holistic development.</p>
                <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
                    <a href="#admissions" class="rounded-full bg-gradient-to-r from-yellow-400 to-orange-400 px-8 py-4 text-sm font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">Apply Now</a>
                    <a href="#about" class="text-sm font-bold leading-6 text-white bg-white/20 backdrop-blur px-6 py-4 rounded-full hover:bg-white/30 transition-all duration-300">Learn more <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1000ms ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
