import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});
window.Toast = Toast;

// Show flash messages as toasts
const showFlashMessages = (page) => {
    if (page.props.flash?.success) {
        Toast.fire({
            icon: 'success',
            title: page.props.flash.success
        });
    }
    if (page.props.flash?.error) {
        Toast.fire({
            icon: 'error',
            title: page.props.flash.error
        });
    }
};

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);

        // Show flash messages on initial load
        showFlashMessages(props.initialPage);

        // Show flash messages on page navigation
        router.on('navigate', (event) => {
            showFlashMessages(event.detail.page);
        });

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
