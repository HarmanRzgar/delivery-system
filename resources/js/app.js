import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
// import { createPinia } from 'pinia'

import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
// import {useCartsStore} from "@/store/cartsStore.js";


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
// const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            // .use(pinia)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// const cartsStore = useCartsStore();
// cartsStore.restoreCarts();
