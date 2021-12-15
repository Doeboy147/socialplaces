import { createRouter, createWebHistory } from "vue-router";
import contactForm from "../components/contactForm.vue";
import contactDashboard from "../components/contactDashboard.vue";

const routes = [
    {
        path: "/",
        name: "index",
        component: contactForm,
    },
    {
        path: "/home",
        name: "home.index",
        component: contactDashboard,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
