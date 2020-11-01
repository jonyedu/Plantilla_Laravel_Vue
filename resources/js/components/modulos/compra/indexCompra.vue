<template>
    <div class="content-wrapper">
        <h1>Titulo</h1>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            variable: "",
            form: {
                frm_id: "0001"
            }
        };
    },
    mounted: function() {
        /* Metodo que inicia cuando el usuario entrar al formulario */
    },
    beforeDestroy: function() {
        /* Metodo que inicia cuando el usuario sale del formulario */
    },
    methods: {
        /* Declaracion de los metodos */
        metodo1() {
            /* Metodo sin parametro */
        },
        metodo2(parametro) {
            /* Metodo con parametro */
        },
        metodoConAxios() {
            /* Metodo que realiza peticiones al servidor */
            let that = this;
            let url = "/url";
            axios
                .post(url, that.form)
                .then(function(response) {})
                .catch(error => {});
        }
    }
};
</script>
