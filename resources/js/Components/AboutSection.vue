<script setup>
import { computed } from 'vue';

const appTitle = computed(() => 'ABC School');
const images = computed(() => ({
    about: 'https://images.unsplash.com/photo-1588072432836-7fb78b26b8a5?auto=format&fit=crop&w=1400&q=80',
}));
</script>

<template>
    <section id="about" class="py-24 sm:py-32 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-500 to-purple-500 px-4 py-2 text-sm font-semibold text-white shadow-lg mb-4">
                    <span class="mr-2">📚</span> Our Story
                </div>
                <h2 class="text-4xl font-bold tracking-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent sm:text-5xl">About {{ appTitle }}</h2>
                <p class="mt-6 text-xl leading-8 text-slate-700">Dedicated to academic excellence, character development, and preparing students for future challenges.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-2">
                    <div class="mx-auto lg:mx-0">
                        <h3 class="text-lg font-semibold leading-8 tracking-tight text-slate-900">Our Mission</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">To provide a nurturing environment that fosters intellectual growth, creativity, and moral values.</p>
                        <dl class="mt-6 space-y-4 text-sm leading-6 text-slate-600">
                            <div class="flex gap-x-3">
                                <dt class="font-semibold text-slate-900">Students</dt>
                                <dd>1,200+</dd>
                            </div>
                            <div class="flex gap-x-3">
                                <dt class="font-semibold text-slate-900">Teachers</dt>
                                <dd>75+</dd>
                            </div>
                            <div class="flex gap-x-3">
                                <dt class="font-semibold text-slate-900">Programs</dt>
                                <dd>15+</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="mx-auto lg:mx-0">
                        <img :src="images.about" alt="Classroom" class="aspect-video rounded-2xl object-cover shadow-xl ring-1 ring-slate-200" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
