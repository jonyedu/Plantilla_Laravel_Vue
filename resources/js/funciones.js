export const funcionesGlobales = {
    //Metodo para Obtener la fecha de actualización de contraseña del usuario
    validarCambioClavePorFecha: (
        usCod,
        fullIdentificacion,
        id,
        fechaCambioClave,
        tiempoActualizacionClave
    ) => {
        if (fechaCambioClave == "0000-00-00") {
            Swal.fire({
                icon: "warning",
                title: "Actualización de Contraseña",
                text: "Su contraseña está caducada, debe ser actualizada.",
                footer:
                    '<a href="/LeonBecerra/gestion_hospitalaria/cambio_clave?mostrar=1&id=' +
                    id +
                    "&fullIdentificacion=" +
                    fullIdentificacion +
                    "&usCod=" +
                    usCod +
                    '">Actualizar Contraseña</a>'
            });
            //prueba
            return;
        }
        //Obtenemos el # Mes Actual
        var date = new Date();
        //Mes
        var m = date.getMonth() + 1;

        //Convertimos a Date fechaCambioClave
        var fecha = new Date(fechaCambioClave);
        //Obtenemos el # Mes de fechaCambioClave
        var mesCambioClave = fecha.getMonth() + 1;

        //Obtenemos la diferencia entre meses
        var noMes = parseInt(m) - parseInt(mesCambioClave);
        if (noMes >= tiempoActualizacionClave) {
            Swal.fire({
                icon: "warning",
                title: "Actualización de Contraseña",
                text: "Su contraseña está caducado, debe ser actualizada.",
                footer:
                    '<a href="/LeonBecerra/gestion_hospitalaria/cambio_clave?mostrar=1&id=' +
                    id +
                    "&fullIdentificacion=" +
                    fullIdentificacion +
                    "&usCod=" +
                    usCod +
                    '">Actualizar Clave</a>'
            });
        }
    },
    registrarLogForm: (nombreModulo, nombreForm, accion) => {
        let url = "/datos_generales/logs/registrar_log_usuario";
        let form = {
            modulo_nombre: nombreModulo,
            formulario_nombre: nombreForm,
            accion: accion
        };
        axios
            .post(url, form)
            .then(function(response) {
                /* console.log("RESPONSE LOG");
                console.log("LOG REGISTRADO");
                console.log(response); */
            })
            .catch(error => {
                //Errores de validación
                /* console.log("ERRORESSSS");
                console.log(error); */
                this.$swal({
                    icon: "error",
                    title: "Existen errores",
                    text: error
                });
            });
    },
    addCeroToLeft: (number, width) => {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */
        var zero = "0"; /* String de cero */

        if (width <= length) {
            if (number < 0) {
                return "-" + numberOutput.toString();
            } else {
                return numberOutput.toString();
            }
        } else {
            if (number < 0) {
                return (
                    "-" + zero.repeat(width - length) + numberOutput.toString()
                );
            } else {
                return zero.repeat(width - length) + numberOutput.toString();
            }
        }
    },
    //Metodo para Convertir la Palabra en Mayuscula
    toCapitalAllWords: palabra => {
        if (palabra != null) {
            var valor = palabra.toString();
            return valor.toUpperCase();
        } else {
            return (valor = "");
        }
    },
    //Metodo para Convertir la Primera letra de una Palabra en Mayuscula
    toCapitalFirstWords: palabra => {
        if (palabra != null) {
            var valor = palabra.toString();
            return valor.charAt(0).toUpperCase() + valor.slice(1).toLowerCase();
        } else {
            return (valor = "");
        }
    },
    //Metodo para Convertir la Primera letra de una Oracion en Mayuscula
    toCapitalFirstAllWords: palabra => {
        if (palabra != null) {
            var pieces = palabra.split(" ");
            for (var i = 0; i < pieces.length; i++) {
                var j = pieces[i].charAt(0).toUpperCase();
                pieces[i] = j + pieces[i].substr(1).toLowerCase();
            }
            return pieces.join(" ");
        } else {
            return (pieces = "");
        }
    }
};
