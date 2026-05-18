<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const showingSidebar = ref(true);
const showingSettingsSubmenu = ref(false);
const { props } = usePage();
const auth = props.auth;
const userRole = props.userRole || 'Admin';

const menuItems = [
    {
        name: 'Dashboard',
        href: route('dashboard'),
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>',
        active: route().current('dashboard')
    },
    {
        name: 'Students',
        href: '/admin/students',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>',
        active: route().current('admin.students')
    },
    {
        name: 'Teachers',
        href: '/admin/teachers',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>',
        active: route().current('admin.teachers')
    },
    {
        name: 'Classes',
        href: '#',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>',
        active: false
    },
    {
        name: 'Attendance',
        href: '#',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>',
        active: false
    },
    {
        name: 'Reports',
        href: '#',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m9 3h.01"></path>',
        active: false
    },
    {
        name: 'Settings',
        href: '#',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>',
        active: false,
        hasSubmenu: true,
        submenu: [
            {
                name: 'Sections Setup',
                href: route('admin.settings.sections.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>'
            },
            {
                name: 'Unit Setup',
                href: route('admin.settings.units.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>'
            },
            {
                name: 'Rank Setup',
                href: route('admin.settings.ranks.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>'
            },
            {
                name: 'Trade Setup',
                href: route('admin.settings.trades.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A3.003 3.003 0 0118 15.255a3.003 3.003 0 01-3-3 3.003 3.003 0 013-3 3.003 3.003 0 013 3zM18 6.255a3.003 3.003 0 01-3 3 3.003 3.003 0 01-3-3 3.003 3.003 0 013-3 3.003 3.003 0 013 3zM6.75 6.255a3.003 3.003 0 01-3 3 3.003 3.003 0 01-3-3 3.003 3.003 0 013-3 3.003 3.003 0 013 3zM6.75 13.255a3.003 3.003 0 01-3 3 3.003 3.003 0 01-3-3 3.003 3.003 0 013-3 3.003 3.003 0 013 3z"></path>'
            },
            {
                name: 'Religion Setup',
                href: route('admin.settings.religions.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
            },
            {
                name: 'Province Setup',
                href: route('admin.settings.provinces.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>'
            },
            {
                name: 'District Setup',
                href: route('admin.settings.districts.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>'
            },
            {
                name: 'Activity Logs',
                href: route('admin.settings.activity-logs.index'),
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>'
            }
        ]
    }
];
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 flex">
            <!-- Sidebar -->
            <div :class="`bg-gray-900 text-white transition-all duration-300 ${showingSidebar ? 'w-64' : 'w-16'} flex-shrink-0`">
                <div class="flex flex-col h-full">
                    <!-- Logo and Toggle -->
                    <div class="flex items-center justify-between p-4 border-b border-gray-800">
                        <div v-if="showingSidebar" class="flex items-center">
                            <Link :href="route('dashboard')" class="flex items-center space-x-3">
                                <ApplicationLogo class="h-8 w-auto fill-current text-white" />
                                <span class="text-xl font-bold">Admin</span>
                            </Link>
                        </div>
                        <button 
                            @click="showingSidebar = !showingSidebar"
                            class="p-2 rounded-lg hover:bg-gray-800 transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="flex-1 p-4 space-y-2">
                        <template v-for="item in menuItems" :key="item.name">
                            <!-- Regular menu items -->
                            <div v-if="!item.hasSubmenu">
                                <Link 
                                    :href="item.href"
                                    :class="`flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors ${
                                        item.active 
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    }`"
                                >
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-html="item.icon"></svg>
                                    <span v-if="showingSidebar" class="font-medium">{{ item.name }}</span>
                                </Link>
                            </div>
                            
                            <!-- Settings menu with submenu -->
                            <div v-else>
                                <button 
                                    @click="showingSettingsSubmenu = !showingSettingsSubmenu"
                                    :class="`w-full flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors ${
                                        item.active 
                                            ? 'bg-blue-600 text-white' 
                                            : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                    }`"
                                >
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-html="item.icon"></svg>
                                    <span v-if="showingSidebar" class="font-medium flex-1 text-left">{{ item.name }}</span>
                                    <svg v-if="showingSidebar" class="w-4 h-4 transition-transform" :class="{ 'rotate-90': showingSettingsSubmenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Submenu items -->
                                <div v-if="showingSidebar && showingSettingsSubmenu" class="ml-4 mt-1 space-y-1">
                                    <Link 
                                        v-for="subItem in item.submenu" 
                                        :key="subItem.name"
                                        :href="subItem.href"
                                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-gray-300 hover:bg-gray-800 hover:text-white"
                                    >
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-html="subItem.icon"></svg>
                                        <span class="text-sm">{{ subItem.name }}</span>
                                    </Link>
                                </div>
                            </div>
                        </template>
                    </nav>

                    <!-- User Info -->
                    <div class="p-4 border-t border-gray-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-sm font-bold">{{ auth.user.name.charAt(0).toUpperCase() }}</span>
                            </div>
                            <div v-if="showingSidebar" class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate">{{ auth.user.name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ userRole }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
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
                                <!-- Notifications -->
                                <button class="p-2 text-gray-400 hover:text-gray-500 relative">
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
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
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
                <main class="flex-1 overflow-auto">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
