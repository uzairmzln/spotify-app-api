import { createApp } from 'vue/dist/vue.esm-bundler.js';
import './bootstrap';
import dashboard from './components/dashboard.vue';

createApp({
    components: {
        dashboard
    }
}).mount('#app');