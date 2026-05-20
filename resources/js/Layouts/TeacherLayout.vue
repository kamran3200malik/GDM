<script setup>
import { ref, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

const showingSidebar = ref(true);
const showingClassesSubmenu = ref(false);
const { props } = usePage();
const auth = props.auth;

const menuItems = [
    {
        name: 'Dashboard',
        href: route('dashboard'),
        icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        active: route().current('dashboard')
    },
    {
        name: 'My Classes',
        href: '#',
        icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        active: false,
        hasSubmenu: true,
        submenu: [
            {
                name: 'Class List',
                href: '/teacher/classes',
                icon: 'M4 6h16M4 10h16M4 14h16M4 18h16'
            },
            {
                name: 'Class Schedule',
                href: '/teacher/schedule',
                icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
            },
            {
                name: 'Subject Management',
                href: '/teacher/subjects',
                icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
            }
        ]
    },
    {
        name: 'Students',
        href: '/teacher/students',
        icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        active: route().current('teacher.students')
    },
    {
        name: 'Attendance',
        href: '/teacher/attendance',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
        active: route().current('teacher.attendance')
    },
    {
        name: 'Assignments',
        href: '/teacher/assignments',
        icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        active: route().current('teacher.assignments')
    },
    {
        name: 'Grades',
        href: '/teacher/grades',
        icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        active: route().current('teacher.grades')
    },
    {
        name: 'Exam Results',
        href: '/teacher/exams',
        icon: 'M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m9 3h.01',
        active: route().current('teacher.exams')
    },
    {
        name: 'Messages',
        href: '/teacher/messages',
        icon: 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
        active: route().current('teacher.messages'),
        badge: 3
    },
    {
        name: 'Reports',
        href: '/teacher/reports',
        icon: 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        active: route().current('teacher.reports')
    },
    {
        name: 'Settings',
        href: route('profile.edit'),
        icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
        active: route().current('profile.edit')
    }
];
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-50 flex">
            <!-- Sidebar -->
            <div :class="`bg-gradient-to-b from-emerald-800 to-emerald-900 text-white transition-all duration-300 ease-in-out ${showingSidebar ? 'w-72' : 'w-20'} flex-shrink-0 shadow-xl`">
                <div class="flex flex-col h-full">
                    <!-- Logo and Toggle -->
                    <div class="flex items-center justify-between p-4 border-b border-emerald-700/50">
                        <div v-if="showingSidebar" class="flex items-center">
                            <Link :href="route('dashboard')" class="flex items-center space-x-3 group">
                                <ApplicationLogo class="h-10 w-auto fill-current text-white transition-transform group-hover:scale-105" />
                                <div>
                                    <span class="text-xl font-bold block">School</span>
                                    <span class="text-xs text-emerald-200 block">Teacher Portal</span>
                                </div>
                            </Link>
                        </div>
                        <button 
                            @click="showingSidebar = !showingSidebar"
                            class="p-2 rounded-lg hover:bg-emerald-700/50 transition-all duration-200 hover:rotate-180"
                            :class="showingSidebar ? 'ml-auto' : 'mx-auto'"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                        <template v-for="item in menuItems" :key="item.name">
                            <!-- Regular menu items -->
                            <div v-if="!item.hasSubmenu">
                                <Link 
                                    :href="item.href"
                                    :class="`flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group relative ${
                                        item.active 
                                            ? 'bg-white text-emerald-800 shadow-lg' 
                                            : 'text-emerald-100 hover:bg-emerald-700/50 hover:text-white'
                                    }`"
                                >
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon"></path>
                                    </svg>
                                    <span v-if="showingSidebar" class="font-medium">{{ item.name }}</span>
                                    <span v-if="item.badge && showingSidebar" class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ item.badge }}</span>
                                    <!-- Tooltip for collapsed state -->
                                    <div v-if="!showingSidebar" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50">
                                        {{ item.name }}
                                    </div>
                                </Link>
                            </div>
                            
                            <!-- Menu items with submenu -->
                            <div v-else>
                                <button 
                                    @click="showingClassesSubmenu = !showingClassesSubmenu"
                                    :class="`w-full flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group relative ${
                                        item.active 
                                            ? 'bg-white text-emerald-800 shadow-lg' 
                                            : 'text-emerald-100 hover:bg-emerald-700/50 hover:text-white'
                                    }`"
                                >
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon"></path>
                                    </svg>
                                    <span v-if="showingSidebar" class="font-medium flex-1 text-left">{{ item.name }}</span>
                                    <svg v-if="showingSidebar" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-90': showingClassesSubmenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <!-- Tooltip for collapsed state -->
                                    <div v-if="!showingSidebar" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50">
                                        {{ item.name }}
                                    </div>
                                </button>
                                
                                <!-- Submenu items -->
                                <div v-if="showingSidebar && showingClassesSubmenu" class="ml-4 mt-1 space-y-1">
                                    <Link 
                                        v-for="subItem in item.submenu" 
                                        :key="subItem.name"
                                        :href="subItem.href"
                                        class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-emerald-200 hover:bg-emerald-700/50 hover:text-white group"
                                    >
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="subItem.icon"></path>
                                        </svg>
                                        <span class="text-sm">{{ subItem.name }}</span>
                                    </Link>
                                </div>
                            </div>
                        </template>
                    </nav>

                    <!-- User Info -->
                    <div class="p-4 border-t border-emerald-700/50 bg-emerald-900/50">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg overflow-hidden bg-gradient-to-br from-emerald-400 to-emerald-600">
                                <img 
                                    :src="auth.user.avatar_url" 
                                    :alt="auth.user.name"
                                    class="w-full h-full object-cover"
                                    @error="$event.target.style.display='none'; $event.target.nextElementSibling.style.display='flex'"
                                />
                                <span class="text-sm font-bold hidden">{{ auth.user.name.charAt(0).toUpperCase() }}</span>
                            </div>
                            <div v-if="showingSidebar" class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate text-white">{{ auth.user.name }}</p>
                                <p class="text-xs text-emerald-200 truncate">Teacher</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Navigation -->
                <nav class="bg-white shadow-sm border-b border-gray-200">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex items-center">
                                <!-- Page Title -->
                                <h1 class="text-xl font-semibold text-gray-900">
                                    <slot name="header" />
                                </h1>
                            </div>

                            <div class="flex items-center space-x-4">
                                <!-- Search -->
                                <div class="relative hidden md:block">
                                    <input type="text" placeholder="Search..." class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Notifications -->
                                <button class="p-2 text-gray-400 hover:text-gray-500 relative hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                </button>

                                <!-- Settings Dropdown -->
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:bg-gray-100 focus:outline-none"
                                            >
                                                <img 
                                                    :src="auth.user.avatar_url" 
                                                    :alt="auth.user.name"
                                                    class="w-8 h-8 rounded-full object-cover mr-2"
                                                    @error="$event.target.style.display='none'"
                                                />
                                                {{ auth.user.name }}
                                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="flex-1 overflow-auto p-6">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
