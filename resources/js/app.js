import { createApp } from 'vue/dist/vue.esm-bundler.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import './bootstrap';
import dashboard from './components/dashboard.vue';
import section1 from './components/section1.vue';
import section2 from './components/section2.vue';

createApp(dashboard).mount('#app');
createApp(section1).mount('#section1');
createApp(section2).mount('#section2');
// createApp({
//     components: {
//         dashboard
//     }
// }).mount('#app');