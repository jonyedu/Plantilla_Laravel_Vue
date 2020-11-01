import Vue from "vue";
import { prefix } from "./variables";
import VueRouter from "vue-router";

import IndexCompra from "./components/modulos/compra/indexCompra";

Vue.use(VueRouter);
let prefijo = prefix;
export default new VueRouter({
    routes: [
        {
            path: prefijo +
                "/modulos/compra/mostrar_compra",
            component: IndexCompra
        },
    ],
    mode: "history" //Evita que aparezca # en la ruta
});
