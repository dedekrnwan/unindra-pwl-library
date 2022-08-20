import './bootstrap';
import { createApp } from 'vue';
import Router from "./router";
import App from "./app.vue";
import Store from "./store";
import {Antd, VueSweetalert2} from './plugins'

const app = createApp(App);

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

app.use(Store)
app.use(Router)
app.use(Antd)
app.use(VueSweetalert2)
app.mount('#app');
