require("./bootstrap");
import { createApp } from "vue";
import router  from "./router";
import contactForm from './components/contactForm.vue';
import contactDashboard from './components/contactDashboard.vue';

createApp({
    components: {
        contactDashboard,
        contactForm
    },
}).use(router).mount("#app");

