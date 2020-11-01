require('./bootstrap');

window.Vue = require('vue')

import App from "./components/App.vue";
import router from "./router";
import VueRouter from "vue-router";

Vue.use(VueRouter);

Vue.component(
    "menuComponente",
    require("./components/componentesGenerales/MenuComponent.vue").default
);

new Vue({
    el: "#app",
    components: {
        App
    },
    router
})
