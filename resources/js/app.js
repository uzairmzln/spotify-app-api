import { createApp } from 'vue/dist/vue.esm-bundler.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import './bootstrap';
import dashboard from './components/dashboard.vue';

createApp({
    components: {
        dashboard
    }
}).mount('#app');