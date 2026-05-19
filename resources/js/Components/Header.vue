<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    auth: {
        type: Object,
        default: null,
    },
});

const mobileMenuOpen = ref(false);

const navItems = computed(() => [
    { label: 'Home', href: '#home' },
    { label: 'About', href: '#about' },
    { label: 'Admissions', href: '#admissions' },
    { label: 'Academics', href: '#academics' },
    { label: 'Facilities', href: '#facilities' },
    { label: 'Gallery', href: '#gallery' },
    { label: 'Contact', href: '#contact' },
    { label: props.auth ? 'Dashboard' : 'Login', href: props.auth ? '/dashboard' : '/login' },
]);

const appTitle = computed(() => 'GDM School');

function closeMobileMenu() {
    mobileMenuOpen.value = false;
}
</script>

<template>
    <header class="sticky top-0 z-50 -mx-6 border-b border-white/20 bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 shadow-2xl">
        <div class="flex items-center justify-between px-6 py-4">
            <!-- Logo Section -->
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur-lg opacity-30 animate-pulse"></div>
                    <div class="relative grid h-12 w-12 place-items-center rounded-2xl bg-gradient-to-br from-purple-600 to-pink-600 text-white shadow-2xl">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3L2 9l10 6 10-6-10-6Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M2 9v6l10 6 10-6V9" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="leading-tight">
                    <div class="text-lg font-black tracking-tight text-white">{{ appTitle }}</div>
                    <div class="text-sm text-white/90 font-semibold">Excellence in Education</div>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-4 lg:flex">
                <a
                    v-for="(item, index) in navItems"
                    :key="item.href"
                    :href="item.href"
                    class="group relative rounded-xl bg-white/20 backdrop-blur px-4 py-2.5 text-sm font-bold text-white shadow-md transition-all duration-300 hover:bg-white/30 hover:shadow-lg hover:scale-105 hover:-translate-y-0.5"
                >
                    <span class="relative z-10 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-white/50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
                        {{ item.label }}
                    </span>
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="flex items-center gap-3">
                <!-- <div class="hidden lg:flex items-center gap-2">
                    <div class="h-px w-8 bg-gradient-to-r from-purple-600 to-pink-600"></div>
                    <div class="text-xs font-bold text-purple-600">MENU</div>
                    <div class="h-px w-8 bg-gradient-to-r from-purple-600 to-pink-600"></div>
                </div> -->
                <button
                    type="button"
                    class="relative inline-flex items-center justify-center rounded-2xl bg-white/20 backdrop-blur p-3 text-white shadow-lg transition-all duration-300 hover:bg-white/30 hover:scale-110 hover:shadow-xl lg:hidden"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :aria-expanded="mobileMenuOpen"
                    aria-label="Toggle navigation"
                >
                    <svg v-if="!mobileMenuOpen" class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <svg v-else class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div v-if="mobileMenuOpen" class="border-t border-purple-200/50 bg-white/95 backdrop-blur-xl lg:hidden">
                <div class="px-6 py-6">
                    <div class="grid gap-3">
                        <a
                            v-for="(item, index) in navItems"
                            :key="item.href"
                            :href="item.href"
                            class="group relative flex items-center rounded-2xl bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 text-sm font-bold text-slate-700 transition-all duration-300 hover:from-purple-100 hover:to-pink-100 hover:text-purple-700 hover:shadow-lg hover:scale-105"
                            @click="closeMobileMenu"
                            :style="`animation-delay: ${index * 50}ms`"
                        >
                            <div class="absolute left-3 top-1/2 h-2 w-2 -translate-y-1/2 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            <span class="ml-4">{{ item.label }}</span>
                            <div class="ml-auto">
                                <svg class="h-4 w-4 text-purple-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </Transition>
    </header>
</template>
