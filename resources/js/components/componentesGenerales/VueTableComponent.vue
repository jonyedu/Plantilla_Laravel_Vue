<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <vue-good-table
                max-height="400px"
                :columns="columns"
                :rows="rowsData"
                :line-numbers="true"
                :search-options="{
                    enabled: true,
                    placeholder: 'Buscar...'
                }"
                :pagination-options="{
                    enabled: true,
                    mode: 'remote', //pages
                    dropdownAllowAll: true,
                    perPageDropdown: [5, 10, 15, 20],
                    nextLabel: 'siguiente',
                    prevLabel: 'anterior',
                    rowsPerPageLabel: 'Filas por página',
                    ofLabel: 'de',
                    pageLabel: 'página', // para el modo 'páginas'
                    allLabel: 'Todas'
                }"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'actions'">
                        <div v-if="modificarButton && anularButton">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="handleModificarClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-edit"></i>
                                </span>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="handleAnularClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button>
                        </div>
                        <div v-if="anularButton && !modificarButton">
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="handleAnularClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button>
                        </div>
                        <div v-if="!anularButton && modificarButton">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="handleModificarClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-edit"></i>
                                </span>
                            </button>
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'picture'">
                        <div>
                            <img
                                class="w-50"
                                :src="props.row.US_FOTO_URL"
                                alt
                                srcset
                            />
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'logoHospital'">
                        <div>
                            <img
                                style="display:block;margin:auto;height: 35px; width: 500px;"
                                class="w-50"
                                :src="props.row.HOSPITAL_LOGO"
                                alt
                                srcset
                            />
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'info'">
                        <span v-if="infoButton">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="handleInfoClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-info-circle"></i>
                                </span>
                            </button>
                        </span>
                    </span>
                    <span v-else-if="props.column.field == 'seleccionar'">
                        <span v-if="seleccionarButton">
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="handleSeleccionarClick(props.row)"
                            >
                                <span>
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                            </button>
                        </span>
                    </span>
                    <span v-else-if="props.column.field == 'derivar'">
                        <span v-if="derivarButton">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                @click="handleDerivarClick(props.row)"
                            >
                                <span>
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                            </button>
                        </span>
                    </span>
                    <span v-else-if="props.column.field == 'generar_ticket'">
                        <span v-if="generarTicketButton">
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="handleGenerarTicket(props.row)"
                            >
                                <span>
                                    <i class="fas fa-ticket-alt"></i>
                                </span>
                            </button>
                        </span>
                    </span>
                    <span v-else-if="props.column.field == 'US_IDENT_HTML'">
                        <div>
                            <div>Sistemas</div>
                            <div>{{ props.row.US_COD }}</div>
                            <div>Usuarios</div>
                            <div>{{ props.row.US_CED }}</div>
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'tipo_estado_cita'">
                        <div
                            v-if="
                                props.row.tipo_estado_cita == 'Consulta Externa'
                            "
                        >
                            <span style="font-weight: bold; color: blue;">{{
                                props.row.tipo_estado_cita
                            }}</span>
                        </div>
                        <div
                            v-else-if="
                                props.row.tipo_estado_cita == 'Emergencia'
                            "
                        >
                            <span style="font-weight: bold; color: red;">{{
                                props.row.tipo_estado_cita
                            }}</span>
                        </div>
                        <div
                            v-else-if="
                                props.row.tipo_estado_cita == 'Hospitalización'
                            "
                        >
                            <span style="font-weight: bold; color: yellow;">{{
                                props.row.tipo_estado_cita
                            }}</span>
                        </div>
                    </span>
                    <!-- Para mostrar color en los estados de Signos Vitales -->
                    <span v-else-if="props.column.field == 'signo_vital'">
                        <div
                            v-if="
                                props.row.signo_vital == 'Registrado'
                            "
                        >
                            <span style="font-weight: bold; color: #0C9C05;">{{
                                props.row.signo_vital
                            }}</span>
                        </div>
                        <div
                            v-else-if="
                                props.row.signo_vital == 'Pendiente'
                            "
                        >
                            <span style="font-weight: bold; color: red;">{{
                                props.row.signo_vital
                            }}</span>
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'estado_actual'">
                        <div>
                            <span style="font-weight: bold; color: blue;">{{
                                props.row.estado_actual
                            }}</span>
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'col_cantidad'">
                        <div @click.left="handleInputEdit(props.row)">
                            <input
                                @keyup.enter="handleInputEdit(props.row)"
                                type="number"
                                class="form-control"
                                v-model="props.row.col_cantidad"
                            />
                        </div>
                    </span>
                    <span v-else>
                        <div @click="handleRowClick(props.row)">
                            {{ props.formattedRow[props.column.field] }}
                        </div>
                    </span>
                </template>  
                <div slot="emptystate" align="center">
                    No hay datos para monstrar en la tabla
                </div>
            </vue-good-table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        columnsData: {
            type: Array,
            required: true
        },
        tituloData: {
            type: String
        },
        rowsData: {
            type: Array,
            required: true
        },
        derivarButton: {
            type: Boolean,
            default: false
        },
        seleccionarButton: {
            type: Boolean,
            default: false
        },
        anularButton: {
            type: Boolean,
            required: true
        },
        modificarButton: {
            type: Boolean,
            required: true
        },
        infoButton: {
            type: Boolean,
            required: false,
            default: false
        },
        picture: {
            type: Boolean,
            required: false,
            default: false
        },
        logoHospital: {
            type: Boolean,
            required: false,
            default: false
        },
        inputEdit: {
            type: Boolean,
            required: false,
            default: false
        },
        generarTicketButton: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    created() {
        this.$props.columnsData;

        if (this.$props.anularButton || this.$props.modificarButton) {
            //Se recorre el array para comprobar que no se tenga los botones de modificar
            let encontrado = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "actions") {
                    encontrado = true;
                    return;
                }
            }
            if (!encontrado) {
                this.$data.columns.unshift({
                    label: "Acciones",
                    field: "actions",
                    html: true
                });
            }
        }

        if (this.$props.picture || this.$props.picture) {
            let encontradoPicture = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "picture") {
                    encontradoPicture = true;
                    return;
                }
            }
            if (!encontradoPicture) {
                this.$data.columns.unshift({
                    label: "Foto de Perfil",
                    field: "picture",
                    html: true
                });
            }
        }
        //Logo del Hospital
        if (this.$props.logoHospital) {
            let encontradoPicture = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "picture") {
                    encontradoPicture = true;
                    return;
                }
            }
            if (!encontradoPicture) {
                this.$data.columns.unshift({
                    label: "Logo del Hospital",
                    field: "logoHospital",
                    html: true,
                    width: "20%"
                });
            }
        }
        //Caja de texto editable
        if (this.$props.inputEdit) {
            let encontradoText = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "text") {
                    encontradoText = true;
                    return;
                }
            }
            if (!encontradoText) {
                this.$data.columns.push({
                    label: "Cantidad",
                    field: "col_cantidad",
                    html: true
                });
            }
        }
        if (this.$props.infoButton || this.$props.infoButton) {
            //Se recorre el array para comprobar que no se tenga los botones de modificar
            let encontradoInfo = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "info") {
                    encontradoInfo = true;
                    return;
                }
            }
            if (!encontradoInfo) {
                this.$data.columns.unshift({
                    label: "Info",
                    field: "info",
                    html: true
                });
            }
        }
        if (this.$props.seleccionarButton || this.$props.seleccionarButton) {
            //Se recorre el array para comprobar que no se tenga los botones de modificar
            let encontradoSeleccionar = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "seleccionar") {
                    encontradoSeleccionar = true;
                    return;
                }
            }
            if (!encontradoSeleccionar) {
                this.$data.columns.unshift({
                    label: "Seleccionar",
                    field: "seleccionar",
                    html: true
                });
            }
        }
        if (this.$props.derivarButton || this.$props.derivarButton) {
            //Se recorre el array para comprobar que no se tenga los botones de modificar
            let encontradoDerivar = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "derivar") {
                    encontradoDerivar = true;
                    return;
                }
            }
            if (!encontradoDerivar) {
                this.$data.columns.unshift({
                    label: "Derivar",
                    field: "derivar",
                    html: true
                });
            }
        }
        if (this.$props.generarTicketButton) {
            let encontradoTicket = false;
            for (let i = 0; i < this.$data.columns.length; i++) {
                if (this.$data.columns[i].field == "generar_ticket") {
                    encontradoTicket = true;
                    return;
                }
            }
            if (!encontradoTicket) {
                this.$data.columns.unshift({
                    label: "Generar Ticket",
                    field: "generar_ticket",
                    html: true
                });
            }
        }
    },
    mounted() {
        this.rows = this.$props.rowsData;
    },
    methods: {
        handleSeleccionarClick(value) {
            this.$emit("handleSeleccionarClick", value);
        },
        handleModificarClick(value) {
            this.$emit("handleModificarClick", value);
        },
        handleAnularClick(value) {
            this.$emit("handleAnularClick", value);
        },
        handleInfoClick(value) {
            this.$emit("handleInfoClick", value);
        },
        handleDerivarClick(value) {
            this.$emit("handleDerivarClick", value);
        },
        handleRowClick(value) {
            this.$emit("handleRowClick", value);
        },
        handleGenerarTicket(value) {
            this.$emit("handleGenerarTicket", value);
        },
        handleInputEdit(value) {
            this.$emit("handleInputEdit", value);
        }
    },
    data() {
        return {
            titulo: this.$props.tituloData,
            columns: this.$props.columnsData
        };
    }
};
</script>
