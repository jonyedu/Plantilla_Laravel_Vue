<template>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="custom-navigation">
                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                    <template v-if="horizontalNavigation">
                        <div class="btn-group" role="group">
                            <button
                                type="button"
                                class="btn btn-outline-success"
                                @click="
                                    isActive = !isActive

                                "
                            >
                                <!-- Firma -->
                                <i class="fas fa-file-signature"></i>
                            </button>
                            <template v-if="isActive">
                                <!-- <button
                                    type="button"
                                    class="btn btn-outline-success"
                                    @click="$refs.paintable.cancelDrawing"
                                >
                                    Cancelar
                                    <i class="fas fa-ban"></i>
                                </button> -->
                                <button
                                    type="button"
                                    class="btn btn-outline-success"
                                    @click="useEraser = !useEraser"
                                >
                                    <!-- Editar -->
                                    <i
                                        v-if="!useEraser"
                                        class="fas fa-edit"
                                    ></i>
                                    <!-- Borrar -->
                                    <i v-else class="fas fa-highlighter"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-outline-success"
                                    @click="deleteCanvas()"
                                >
                                    <!-- Eliminar -->
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <template v-if="showUndoRedo">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success"
                                        @click="$refs.paintable.undoDrawingStep"
                                    >
                                        <!-- Deshacer -->
                                        <i class="fas fa-undo-alt"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-success"
                                        @click="$refs.paintable.redoDrawingStep"
                                    >
                                        <!-- Rehacer -->
                                        <i class="fas fa-redo-alt"></i>
                                    </button>
                                </template>
                                <template v-if="showLineWidth">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success"
                                        @click="isLineWidth = !isLineWidth"
                                    >
                                        <!-- Grosor de Línea -->
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                </template>
                                <button
                                    type="button"
                                    class="btn btn-outline-success"
                                    @click="saveCancas()"
                                >
                                    <!-- Guardar -->
                                    <i class="fas fa-save"></i>
                                </button>
                            </template>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <button
                                type="button"
                                class="btn btn-outline-success btn-block"
                                @click="isActive = !isActive"
                            >
                                Firmar
                            </button>
                        </div>
                        <template v-if="isActive">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success btn-block"
                                        @click="$refs.paintable.cancelDrawing"
                                    >
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success btn-block"
                                        @click="useEraser = !useEraser"
                                    >
                                        {{ !useEraser ? "Borrador" : "Lápiz" }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success btn-block"
                                        @click="$refs.paintable.clearCanvas"
                                    >
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <template v-if="showUndoRedo">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-block"
                                            @click="
                                                $refs.paintable.undoDrawingStep
                                            "
                                        >
                                            Deshacer
                                        </button>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-block"
                                            @click="
                                                $refs.paintable.redoDrawingStep
                                            "
                                        >
                                            Rehacer
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <div class="row">
                                <template v-if="showLineWidth">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button
                                            type="button"
                                            class="btn btn-outline-success btn-block"
                                            @click="isLineWidth = !isLineWidth"
                                        >
                                            Grosor de Línea
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <button
                                        type="button"
                                        class="btn btn-outline-success btn-block"
                                        @click="
                                            $refs.paintable.saveCurrentCanvasToStorage(
                                                (isActive = !isActive)
                                            )
                                        "
                                    >
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </template>
                    </template>
                </div>
                <div
                    class="col-lg-12 col-md-12 col-sm-12 text-left controls"
                    v-if="isActive && isLineWidth"
                >
                    {{ dynamicLineWidth }}px<br />
                    <input
                        type="range"
                        @input="dynamicLineWidth = +$event.target.value"
                        min="1"
                        max="100"
                    />
                    <input type="color" v-model="color" /><br /><br />
                </div>
            </div>
            <div ref="printMe">
                <paintable
                    id="firma"
                    :showUndoRedo="showUndoRedo"
                    :colors="colors"
                    :showLineWidth="showLineWidth"
                    :alwaysOnTop="alwaysOnTop"
                    :factor="factor"
                    :lineWidthEraser="lineWidthEraser"
                    :limite="limite"
                    :active="isActive"
                    :width="width"
                    :height="height"
                    :disableNavigation="disableNavigation"
                    :hide="hidePaintable"
                    :horizontalNavigation="horizontalNavigation"
                    :navigation="navigation"
                    :name="isFirstPaintable ? 'my-screen' : 'my-second-screen'"
                    :lineWidth="dynamicLineWidth"
                    :useEraser="useEraser"
                    :color="color"
                    class="paint"
                    ref="paintable"
                    @toggle-paintable="toggledPaintable"
                >
                    <img
                        style="margin-left:auto;margin-right:auto;"
                        :src="rutaImagen"
                        width="100%"
                        height="200%"
                    />
                </paintable>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        /* mostrar el botón deshacer y rehacer */
        showUndoRedo: {
            type: Boolean,
            required: false,
            default: true
        },
        /* Mostrar botón para establecer el ancho de línea */
        showLineWidth: {
            type: Boolean,
            required: false,
            default: true
        },
        /* variedad de colores elegibles */
        colors: {
            type: Array,
            required: false,
            default: () => [
                "black",
                "#f00",
                "#4481c7",
                "rgba(255, 235, 59, 0.4)",
                "#999",
                "green"
            ]
        },
        /* establecer lienzo siempre como capa superior */
        alwaysOnTop: {
            type: Boolean,
            required: false,
            default: true
        },
        /* establecer un factor de escala si es necesario */
        factor: {
            type: Number,
            required: false,
            default: 1
        },
        /* establecer el ancho de la línea del borrador */
        lineWidthEraser: {
            type: Number,
            required: false,
            default: 20
        },
        /* mostrar la navegación horizontal o verticalmente */
        horizontalNavigation: {
            type: Boolean,
            required: false,
            default: true
        },
        /* establecer el umbral en el que se activa un evento (ver eventos) */
        limite: {
            type: Number,
            required: false,
            default: 0
        },
        /* identificador único */
        isFirstPaintable: {
            type: String,
            required: true,
            default: ""
        },
        /* ocultar navegación */
        disableNavigation: {
            type: Boolean,
            required: false,
            default: false
        },
        /* ocultar la pintura completa */
        /* hidePaintable: {
            type: Boolean,
            required: false,
            default: false
        }, */
        /* ancho del lienzo */
        width: {
            type: Number,
            required: false,
            default: window.innerWidth
        },
        /* altura del lienzo */
        height: {
            type: Number,
            required: false,
            default: window.innerHeight
        },
        rutaImagen: {
            type: String,
            required: false,
            default: ""
        }
    },
    methods: {
        toggledPaintable(isActive) {
            this.isActive = isActive;
        },
        async print() {
            const el = this.$refs.printMe;
            const options = {
                type: "dataURL"
            };
            this.output = await this.$html2canvas(el, options);
            this.$emit("getOutput", this.output);
            this.$swal({
                icon: "success",
                title: "Firma Realizada Correctamente",
                text: "Se generó correctamente la firma."
            });
        },
        saveCancas: function() {
            this.print();
            this.$refs.paintable.saveCurrentCanvasToStorage();
            this.isActive = !this.isActive;
            this.respuestaImgFirma = 1;
            this.$emit("RespuestaImgFirma", this.respuestaImgFirma);
        },
        deleteCanvas: function() {
            this.$refs.paintable.clearCanvas();
        }
    },
    mounted: function() {},
    data: function() {
        return {
            isActive: false,
            useEraser: false,
            isLineWidth: false,
            hidePaintable: false,
            dynamicLineWidth: 5,
            color: "#000000",
            newUrl: "",
            output: null,
            respuestaImgFirma: 0
        };
    },
    computed: {
        navigation() {
            return {
                "draw-save": {
                    body: "click here!",
                    activeBody: "<strong>save</strong>"
                },
                color: {
                    body: "color"
                }
            };
        },
        /* cambiarEstadoHidePaintable: function(params){
            if(this.isActive == false){
                console.log("entra");
                //this.hidePaintable = !this.hidePaintable;
            }
            return this.hidePaintable;
        } */
    }
};
</script>
<style>
body {
    font-family: Helvetica, Arial, sans-serif;
    position: initial !important;
}
/* .control {
    margin: 20px;
} */
.paint {
    border: 2px solid #000;
    border-radius: 5px;
    margin: 40px auto;
    box-sizing: border-box;
    display: block;
    width: auto;
    height: auto;
    position: relative !important;
    overflow: hidden;
}
.custom-navigation .controls {
    margin: 10px 0 0 0;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
}
</style>
