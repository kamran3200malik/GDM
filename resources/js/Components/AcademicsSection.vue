<script setup>
import { computed } from 'vue';

const images = computed(() => ({
    academics: 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1400&q=80',
}));
</script>

<template>
    <section id="academics" class="py-24 sm:py-32 bg-gradient-to-br from-orange-50 via-red-50 to-pink-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-orange-500 to-red-500 px-4 py-2 text-sm font-semibold text-white shadow-lg mb-4">
                    <span class="mr-2">🔬</span> Learning
                </div>
                <h2 class="text-4xl font-bold tracking-tight bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent sm:text-5xl">Academics</h2>
                <p class="mt-6 text-xl leading-8 text-slate-700">Comprehensive curriculum designed to challenge and inspire students.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="mx-auto lg:mx-0">
                        <h3 class="text-lg font-semibold leading-8 tracking-tight text-slate-900">Programs Offered</h3>
                        <ul class="mt-6 space-y-4 text-sm leading-6 text-slate-600">
                            <li>Early Childhood Education Only</li>
                            <li>Junior Montessori</li>
                            <li>Senior Montessori</li>
                            <li>Advance Montessori</li>
                        </ul>
                    </div>
                    <div class="mx-auto lg:mx-0">
                        <img :src="images.academics" alt="Academics" class="aspect-video rounded-2xl object-cover shadow-xl ring-1 ring-slate-200" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
