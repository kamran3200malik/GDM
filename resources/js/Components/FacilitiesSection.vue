<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const imageList = [
    'https://images.unsplash.com/photo-1596464716127-f2a82984de30?auto=format&fit=crop&w=1400&q=80',
    'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1400&q=80',
    'https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?auto=format&fit=crop&w=1400&q=80',
];

const currentIndex = ref(0);
let intervalId = null;

const currentImage = computed(() => imageList[currentIndex.value]);

const rotateImage = () => {
    currentIndex.value = (currentIndex.value + 1) % imageList.length;
};

onMounted(() => {
    intervalId = setInterval(rotateImage, 4500);
});

onUnmounted(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});
</script>

<template>
    <section id="facilities" class="py-24 sm:py-32 bg-gradient-to-br from-cyan-50 via-blue-50 to-indigo-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 px-4 py-2 text-sm font-semibold text-white shadow-lg mb-4">
                    <span class="mr-2">🏫</span> Campus
                </div>
                <h2 class="text-4xl font-bold tracking-tight bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent sm:text-5xl">Facilities</h2>
                <p class="mt-6 text-xl leading-8 text-slate-700">Modern facilities to support learning and development.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="mx-auto lg:mx-0">
                        <img :src="currentImage" alt="Facilities" class="aspect-video rounded-2xl object-cover shadow-xl ring-1 ring-slate-200" loading="lazy" />
                    </div>
                    <div class="mx-auto lg:mx-0">
                        <h3 class="text-lg font-semibold leading-8 tracking-tight text-slate-900">Our Facilities</h3>
                        <ul class="mt-6 space-y-4 text-sm leading-6 text-slate-600">
                            <li>Sensorial Learning Materials</li>
                            <li>Practical Life Activities Area</li>
                            <li>Language Development Corner</li>
                            <li>Mathematics Learning Area</li>
                            <li>Art & Creative Expression Space</li>
                            <li>Indoor & Outdoor Play Area</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
