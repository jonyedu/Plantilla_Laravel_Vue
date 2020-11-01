<template>
  <router-view></router-view>
</template>

<script>
export default {
  props: {
    columnsData: {
      type: Object,
    },
  },
  data: function () {
    return {
      tipoPersonal: "",
    };
  },
  mounted() {
    //getTipoPersonal();
  },
  methods: {
    getTipoPersonal() {
      let that = this;
      let url = "/gestion_hospitalaria/personalMedico/verTipoPersonalMedico";
      axios
        .get(url)
        .then(function (response) {
          that.tipoPersonal = response.data.tipoMedico;
        })
        .catch((error) => {
          //Errores
          loader.hide();
          that.$swal({
            icon: "error",
            title: "Existe un error",
            text: error,
          });
        });
    },
  },
};
</script>


