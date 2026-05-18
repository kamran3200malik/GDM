<script setup>
import { computed } from 'vue';

const images = computed(() => ({
    gallery1: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80',
    gallery2: 'https://images.unsplash.com/photo-1509062295473-7491c795ec0d?auto=format&fit=crop&w=800&q=80',
    gallery3: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
}));
</script>

<template>
    <section id="gallery" class="py-24 sm:py-32 bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-purple-500 to-pink-500 px-4 py-2 text-sm font-semibold text-white shadow-lg mb-4">
                    <span class="mr-2">🎨</span> Memories
                </div>
                <h2 class="text-4xl font-bold tracking-tight bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent sm:text-5xl">Gallery</h2>
                <p class="mt-6 text-xl leading-8 text-slate-700">A glimpse into life at ABC School.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="group relative overflow-hidden rounded-3xl shadow-2xl ring-4 ring-white/50 hover:scale-105 transition-all duration-300">
                        <img :src="images.gallery1" alt="Gallery 1" class="aspect-video w-full object-cover" loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="group relative overflow-hidden rounded-3xl shadow-2xl ring-4 ring-white/50 hover:scale-105 transition-all duration-300">
                        <img :src="images.gallery2" alt="Gallery 2" class="aspect-video w-full object-cover" loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="group relative overflow-hidden rounded-3xl shadow-2xl ring-4 ring-white/50 hover:scale-105 transition-all duration-300">
                        <img :src="images.gallery3" alt="Gallery 3" class="aspect-video w-full object-cover" loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
