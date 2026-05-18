<script setup>
import { computed } from 'vue';

const appTitle = computed(() => 'ABC School');
</script>

<template>
    <footer class="border-t border-purple-200 bg-gradient-to-r from-purple-100 to-pink-100 py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <div>
                    <h3 class="text-lg font-bold leading-6 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ appTitle }}</h3>
                    <p class="mt-2 text-sm leading-6 text-purple-700 font-medium">Excellence in Education</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-slate-900">Quick Links</h3>
                    <ul role="list" class="mt-2 space-y-2 text-sm leading-6 text-slate-600">
                        <li><a href="#about" class="hover:text-blue-600">About</a></li>
                        <li><a href="#admissions" class="hover:text-blue-600">Admissions</a></li>
                        <li><a href="#academics" class="hover:text-blue-600">Academics</a></li>
                        <li><a href="#contact" class="hover:text-blue-600">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-slate-900">Resources</h3>
                    <ul role="list" class="mt-2 space-y-2 text-sm leading-6 text-slate-600">
                        <li><a href="#gallery" class="hover:text-blue-600">Gallery</a></li>
                        <li><a href="#facilities" class="hover:text-blue-600">Facilities</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-slate-900">Legal</h3>
                    <ul role="list" class="mt-2 space-y-2 text-sm leading-6 text-slate-600">
                        <li><a href="#" class="hover:text-blue-600">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-600">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-slate-200 pt-8">
                <p class="text-xs leading-5 text-slate-500">&copy; 2025 {{ appTitle }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>
