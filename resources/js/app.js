import './bootstrap';
import { createApp } from 'vue';
import Antd from "./plugins/antvue";
import VueSweetalert2 from "./plugins/sweet-alert2";
import Router from "./router";
import App from "./app.vue";
import Store from "./store";

const app = createApp(App);

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

app.use(Store)
app.use(Router)
app.use(Antd)
app.use(VueSweetalert2)
app.mount('#app');
