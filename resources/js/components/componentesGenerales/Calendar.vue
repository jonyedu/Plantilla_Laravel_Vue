<template>
  <div>
    <h1>Agenda de Citas</h1>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="form-group">
        <label for="fecha_cita">Escoja la fecha para citas del día escogido</label>
        <input
          type="date"
          class="form-control"
          id="fecha_cita"
          placeholder="Seleccione la fecha de cita"
          v-model="form.fecha_cita"
          @change="getAgenda()"
        />
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="form-group">
        <label for="fecha_cita">Leyenda de colores:</label>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row ml-3">
              <div class="p-3 mb-2 table-info text-dark">Cita Pasada</div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
              <div class="p-3 mb-2 table-success text-dark">Cita en Curso</div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
              <div class="p-3 mb-2 table-warning text-dark">Cita Futura</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table">
        <thead>
          <tr>
            <th>Especialidad</th>
            <th>Fecha</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Paciente</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            :class="
                            checkCita(
                                cita.ESTADOCITA_HORA_INICIAL,
                                cita.ESTADOCITA_HORA_FINAL,
                                cita.ESTADOCITA_FECHA
                            )
                        "
            v-for="cita in citas"
            v-bind:key="cita.CITA"
          >
            <td>{{ cita.ESPECIALIDAD_NOM }}</td>
            <td>{{ cita.ESTADOCITA_FECHA }}</td>
            <td>{{ cita.ESTADOCITA_HORA_INICIAL }}</td>
            <td>{{ cita.ESTADOCITA_HORA_FINAL }}</td>
            <td>{{ cita.PACIENTE }}</td>
            <td>
              <router-link
                :to="{ name: 'ConsultaExterna', params: {citaId: cita.CITA } }"
              >Ver Paciente</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    this.getTodayDate();
    this.getAgenda();
  },

  data: function () {
    return {
      errores: {
        fecha_cita: "",
      },
      form: {
        fecha_cita: "",
        fecha_actual: "",
      },
      citas: [],
    };
  },
  methods: {
    checkCita(hora_inicial, hora_final, fecha_cita) {
      var now = this.moment().format("HH:mm:ss");
      var nowDate = this.moment().format("YYYY-MM-DD");
      if (fecha_cita < nowDate) {
        return "table-info";
      } else {
        if (fecha_cita > nowDate) {
          return "table-secondary";
        } else {
          if (hora_inicial < now && hora_final > now) {
            return "table-success";
          }
          if (hora_inicial > now && hora_final > now) {
            return "table-warning";
          }

          if (hora_inicial < now && hora_final < now) {
            return "table-info";
          }
        }
      }
    },
    getAgenda() {
      let that = this;
      var loader = that.$loading.show();
      let url = "/gestion_hospitalaria/administracion_cita/cargar_agenda";
      axios
        .post(url, this.form)
        .then(function (response) {
          that.citas = response.data.citas;

          loader.hide();
        })
        .catch((error) => {
          //Errores
          that.$swal({
            icon: "error",
            title: "Existe un error",
            text: error,
          });
          loader.hide();
        });
    },
    getTodayDate() {
      var now = this.moment().format("YYYY-MM-DD");
      this.form.fecha_actual = now;
    },
  },
};
</script>
