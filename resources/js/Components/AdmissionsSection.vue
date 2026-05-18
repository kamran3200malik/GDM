<script setup>
import { computed } from 'vue';

const images = computed(() => ({
    admissions: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1400&q=80',
}));
</script>

<template>
    <section id="admissions" class="py-24 sm:py-32 bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <div class="inline-flex items-center rounded-full bg-gradient-to-r from-green-500 to-teal-500 px-4 py-2 text-sm font-semibold text-white shadow-lg mb-4">
                    <span class="mr-2">🎯</span> Join Us
                </div>
                <h2 class="text-4xl font-bold tracking-tight bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent sm:text-5xl">Admissions</h2>
                <p class="mt-6 text-xl leading-8 text-slate-700">Join our community of learners. Applications are now open for the upcoming academic year.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="mx-auto lg:mx-0">
                        <img :src="images.admissions" alt="Admissions" class="aspect-video rounded-2xl object-cover shadow-xl ring-1 ring-slate-200" loading="lazy" />
                    </div>
                    <div class="mx-auto lg:mx-0">
                        <h3 class="text-lg font-semibold leading-8 tracking-tight text-slate-900">How to Apply</h3>
                        <ol class="mt-6 space-y-4 text-sm leading-6 text-slate-600">
                            <li>Download the application form</li>
                            <li>Submit completed form with required documents</li>
                            <li>Attend the entrance assessment</li>
                            <li>Receive admission decision</li>
                        </ol>
                        <div class="mt-8 flex flex-wrap items-center gap-x-4 gap-y-4">
                            <a href="#contact" class="rounded-full bg-gradient-to-r from-green-500 to-teal-500 px-6 py-3 text-sm font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">Download Prospectus</a>
                            <a href="#contact" class="text-sm font-bold leading-6 text-green-600 bg-green-50 px-6 py-3 rounded-full hover:bg-green-100 transition-all duration-300">Contact Admissions <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
