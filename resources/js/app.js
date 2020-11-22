require('./bootstrap');

import Vue from "vue";
import App from "./components/App";
import VModal from "vue-js-modal";
import VueGoodTablePlugin from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import router from "./router";
import VueRouter from "vue-router";
import Loading from "vue-loading-overlay";
import VueSweetalert2 from "vue-sweetalert2";
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import { funcionesGlobales } from "./funciones.js";
import swal from 'sweetalert2';
import Paintable from 'vue-paintable';
import VueHtml2Canvas from 'vue-html2canvas';
import RegeneratorRuntime from "regenerator-runtime";

window.Swal = swal;

Vue.prototype.$funcionesGlobales = funcionesGlobales;

Vue.use(Loading);
Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueGoodTablePlugin);
Vue.use(VModal);
Vue.use(VueFormWizard);
Vue.use(VueHtml2Canvas);
Vue.use(RegeneratorRuntime);
Vue.use(Paintable, {
    // optional methods
    setItem(key, image) {
      localStorage.setItem(key, image);
    },
    // you also can use async
    getItem(key) {
      return localStorage.getItem(key);
    },
    removeItem(key) {
      localStorage.removeItem(key);
    }
});

Vue.component("v-select", vSelect);

Vue.component(
    "menuComponente",
    require("./components/componentesGenerales/MenuComponent.vue").default
);
Vue.component(
    "vue-painttable",
    require("./components/componentesGenerales/VuePaintableComponent.vue").default
);
Vue.component(
    "vuetable-component",
    require("./components/componentesGenerales/VueTableComponent.vue").default
);

new Vue({
    el: "#app",
    components: {
        App
    },
    router
})
