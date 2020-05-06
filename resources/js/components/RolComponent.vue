<!-- HTML -->
<template>
    <main>
        <!--  -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Rols</li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="card mt-3 pb-3 border-secondary">
                <div class="card-header bg-secondary text-white">Rols</div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <button
                                class="btn btn-primary"
                                @click="abrirModal('insert')"
                            >
                                Afegir rol
                            </button>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div
                            class="col-md-3 mt-3"
                            v-for="rol in rols"
                            :key="rol.id"
                        >
                            <!--   -->
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="text-bold" v-text="rol.nom"></h5>
                                    <!--  -->

                                    <div
                                        class="btn-group float-right"
                                        role="group"
                                        aria-label="Basic example"
                                    >
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            @click="abrirModal('update', rol)"
                                        >
                                            Editar
                                        </button>
                                        <!--  -->
                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            @click="abrirModal('delete', rol)"
                                        >
                                            Eliminar
                                        </button>
                                        <!--  -->
                                        <button
                                            class="btn btn-sm btn-outline-info"
                                            v-on:click="mostrarUsuaris(rol.id)"
                                        >
                                            Usuaris
                                        </button>
                                        <!-- -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div
            class="modal fade"
            id="modelId"
            :class="{ mostrar: modal }"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-text="tituloModal"></h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            action
                            method="post"
                            enctype="multipart/form-data"
                            class="form-horizontal"
                        >
                            <div class="form-group row">
                                <label
                                    class="col-md-3 form-control-label"
                                    for="text-input"
                                    >Nom</label
                                >
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        ref="nom"
                                        v-model="rol.nom"
                                        class="form-control"
                                        placeholder="Nom del rol"
                                    />
                                </div>
                            </div>
                            <!-- ERRORES!! -->
                            <div v-show="errorRol" class="form-group row">
                                <div class="offset-3 col-md-9">
                                    <p
                                        class="text-danger"
                                        v-for="error in mensajesError"
                                        :key="error"
                                        v-text="error"
                                    ></p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- BOTONES -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="cerrarModal()"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            v-if="tipusAccio == 1"
                            class="btn btn-primary"
                            @click="insertRol()"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            v-if="tipusAccio == 2"
                            class="btn btn-primary"
                            @click="updateRol()"
                        >
                            Actualitzar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------- MODAL BORRAR ------------------------->
        <div
            class="modal fade"
            tabindex="-1"
            :class="{ mostrar: modal_esborrar }"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" v-text="tituloModal"></h5>
                        <button
                            type="button"
                            class="close"
                            @click="cerrarModal()"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Segur que vols eliminar el rol?</p>
                        <div v-show="errorRecurs" class="form-group row">
                            <div class="offset-3 col-md-9">
                                <p
                                    class="text-danger"
                                    v-for="error in mensajesError"
                                    :key="error"
                                    v-text="error"
                                ></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="cerrarModal('delete')"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="deleteRol()"
                        >
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<!-- JS -->
<script>
export default {
    // datos del componente
    data() {
        return {
            rols: null,
            usuaris: null,
            rol: {
                id: null,
                nom: null
            },
            usuari: {
                id: null,
                nom: null,
                e_mail: null,
                password: null,
                id_rol: null
            },
            modal: 0, //si esta a 0 no esta abierto el modal
            tituloModal: "",
            tipusAccio: 0,
            errorRol: false,
            mensajesError: []
        };
    },
    //cuando se crea el componente
    created() {
        this.mostrarRols();
    },
    // todos los metodos del componente
    methods: {
        mostrarRols() {
            //se guarda los componentes en la variable me
            let me = this;
            //con el axios llama a la api /rol y le responde enviando el json con los datos
            //y se convierte en una lista de roles
            axios
                .get("/rol")
                .then(function(response) {
                    me.rols = response.data;
                })
                //si va mal
                .catch(function(error) {
                    console.log(error);
                });
        },
        mostrarUsuaris() {
            //se guarda los componentes en la variable me
            let me = this;
            //con el axios llama a la api /rol y le responde enviando el json con los datos
            //y se convierte en una lista de roles
            axios
                .get("/usuaris")
                .then(function(response) {
                    me.usuaris = response.data;
                })
                //si va mal
                .catch(function(error) {
                    console.log(error);
                });
        },
        abrirModal(accion, data = []) {
            switch (accion) {
                case "insert": {
                    this.modal = 1;
                    this.tituloModal = "Insertar Rol";
                    this.tipusAccio = 1;

                    break;
                }
                case "update": {
                    this.modal = 1;
                    this.tituloModal = "Modificar rol";
                    this.tipusAccio = 2;
                    this.rol.id = data["id"];
                    this.rol.nom = data["nom"];

                    break;
                }
                case "delete": {
                    this.modal_esborrar = 1;
                    this.tituloModal = "Eliminar recurs";
                    this.rol.id = data["id"];
                    this.rol.nom = data["nom"];

                    break;
                }
            }
        },
        cerrarModal(accion = "") {
            switch (accion) {
                case "delete": {
                    this.modal_esborrar = 0;
                    this.tituloModal = "";
                    this.errorRol = false;
                    this.rol.id = null;
                    this.rol.nom = null;

                    break;
                }
                default: {
                    this.modal = 0;
                    this.tituloModal = "";
                    this.errorRol = false;
                    this.rol.id = null;
                    this.rol.nom = null;

                    break;
                }
            }
            this.errorRol = false;
            this.mensajesError = [];
        },
        insertRol() {
            let me = this;
            axios
                .post("/rol", this.rol)
                .then(function(response) {
                    me.cerrarModal();
                    me.mostrarRols();
                })
                .catch(function(error) {
                    me.errorRol = true;
                    me.missatge = error.response.data;
                    me.errorRol = true;
                    me.mensajsError.push(me.missatge.error);
                });
        },
        updateRol() {
            let me = this;
            axios
                .put("/rol/" + this.rol.id, this.rol)
                .then(function(response) {
                    me.cerrarModal();
                    me.mostrarRols();
                })
                .catch(function(error) {
                    me.missatge = error.response.data;
                    me.errorRol = true;
                    me.mensajesError.push(me.missatge.error);
                });
        },
        deleteRol() {
            let me = this;
            axios
                .delete("/rol/" + this.rol.id)
                .then(function(response) {
                    me.cerrarModal("delete");
                    me.mostrarRols();
                })
                .catch(function(error) {
                    me.missatge = error.response.data;
                    me.errorRol = true;
                    me.mensajesError.push(me.missatge.error);
                });
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>

<style>
.modal-title {
    font-variant: small-caps;
}
.modal-content {
    width: 100% !important;
    position: absolute !important;
    top: 200px !important;
}
.mostrar {
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
}
</style>
