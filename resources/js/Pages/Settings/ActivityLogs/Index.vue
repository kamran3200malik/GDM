<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    logs: Object,
    modules: Array,
    actions: Array,
    filters: Object,
});

const search = ref(props.filters.search || '');
const module = ref(props.filters.module || '');
const action = ref(props.filters.action || '');
const showDetails = ref(null);

watch([search, module, action], () => {
    router.get(route('admin.settings.activity-logs.index'), {
        search: search.value,
        module: module.value,
        action: action.value,
    }, {
        preserveState: true,
        replace: true,
    });
});

const getActionBadgeClass = (action) => {
    const classes = {
        'created': 'bg-green-100 text-green-800',
        'updated': 'bg-blue-100 text-blue-800',
        'deleted': 'bg-red-100 text-red-800',
        'toggled': 'bg-yellow-100 text-yellow-800',
    };
    return classes[action] || 'bg-gray-100 text-gray-800';
};

const getModuleIcon = (module) => {
    const icons = {
        'sections': '📚',
        'units': '🏢',
        'ranks': '🎖️',
        'trades': '🔧',
        'religions': '⛪',
    };
    return icons[module] || '📋';
};
</script>

<template>
    <Head title="Activity Logs" />

    <AdminLayout>
        <template #header>
            Activity Logs
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input 
                                    v-model="search" 
                                    type="text" 
                                    placeholder="Search logs..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Module</label>
                                <select 
                                    v-model="module"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">All Modules</option>
                                    <option v-for="mod in modules" :key="mod" :value="mod">
                                        {{ mod.charAt(0).toUpperCase() + mod.slice(1) }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Action</label>
                                <select 
                                    v-model="action"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">All Actions</option>
                                    <option v-for="act in actions" :key="act" :value="act">
                                        {{ act.charAt(0).toUpperCase() + act.slice(1) }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <Link 
                                    :href="route('admin.settings.activity-logs.index')"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors"
                                >
                                    Clear Filters
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logs Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Timestamp
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Module
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        IP Address
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-if="!logs?.data || logs.data.length === 0">
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="mt-2 text-sm">No activity logs found</p>
                                            <p class="text-xs text-gray-400 mt-1">Start performing actions to see logs here</p>
                                        </div>
                                    </td>
                                </tr>
                                <template v-else>
                                    <template v-for="log in logs.data" :key="log.id">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ new Date(log.created_at).toLocaleString() }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ log.user?.name || 'Unknown' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                      :class="getActionBadgeClass(log.action)">
                                                    {{ log.action }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center text-sm text-gray-900">
                                                    <span class="mr-2">{{ getModuleIcon(log.module) }}</span>
                                                    {{ log.module.charAt(0).toUpperCase() + log.module.slice(1) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 max-w-md">{{ log.description }}</div>
                                                <div v-if="log.old_values || log.new_values" class="mt-1">
                                                    <button 
                                                        @click="showDetails = showDetails === log.id ? null : log.id"
                                                        class="text-xs text-blue-600 hover:text-blue-800"
                                                    >
                                                        {{ showDetails === log.id ? 'Hide' : 'Show' }} Details
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-mono text-xs">{{ log.ip_address }}</div>
                                            </td>
                                        </tr>
                                        <tr v-if="showDetails === log.id" :key="`details-${log.id}`">
                                            <td colspan="6" class="px-6 py-4 bg-gray-50">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div v-if="log.old_values">
                                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Old Values:</h4>
                                                        <pre class="text-xs bg-white p-2 rounded border overflow-auto max-h-40">{{ JSON.stringify(log.old_values, null, 2) }}</pre>
                                                    </div>
                                                    <div v-if="log.new_values">
                                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">New Values:</h4>
                                                        <pre class="text-xs bg-white p-2 rounded border overflow-auto max-h-40">{{ JSON.stringify(log.new_values, null, 2) }}</pre>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link v-if="logs?.prev_page_url" :href="logs.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </Link>
                            <Link v-if="logs?.next_page_url" :href="logs.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700" v-if="logs?.total > 0">
                                    Showing
                                    <span class="font-medium">{{ logs?.from || 0 }}</span>
                                    to
                                    <span class="font-medium">{{ logs?.to || 0 }}</span>
                                    of
                                    <span class="font-medium">{{ logs?.total }}</span>
                                    results
                                </p>
                                <p class="text-sm text-gray-700" v-else>
                                    No results found
                                </p>
                            </div>
                            <div v-if="logs?.links && logs.links.length > 0">
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <template v-for="link in logs.links" :key="link.label">
                                        <Link v-if="link.url" :href="link.url"
                                              :class="{
                                                  'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                  'bg-blue-50 border-blue-500 text-blue-600 z-10': link.active,
                                                  'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active
                                              }"
                                              v-html="link.label">
                                        </Link>
                                        <span v-else
                                              :class="{
                                                  'relative inline-flex items-center px-4 py-2 border text-sm font-medium': true,
                                                  'bg-white border-gray-300 text-gray-300 cursor-not-allowed': true
                                              }"
                                              v-html="link.label">
                                        </span>
                                    </template>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
pre {
    white-space: pre-wrap;
    word-wrap: break-word;
}
</style>
