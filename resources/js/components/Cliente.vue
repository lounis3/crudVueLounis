<template>
    <div>
        <h1 class="text-center">Gestión Clientes</h1>
        <hr>

        <div class="container">

            <button @click="modificar=false, abrirModal();" type="button" class="btn btn-primary my-3">Nuevo</button>


            <div class="modal" :class="{mostrar:modal}">
                <div class="modal-dialog">


                    <div class="modal-content">
                        <div class="modal-header">
                            <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title">{{ tituloModal }}</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label>DNI: <input v-model="cliente.dni" type="text" name="dni"
                                                   placeholder="Introduzca su DNI"
                                                   pattern="[0-9]{8}[A-Za-z]{1}" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.dni">{{ errores.dni[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="cliente.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca su nombre"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="cliente.apellidos" type="text" name="apellidos"
                                                         placeholder="Introduzca su/s apellido/s"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Dirección: <input v-model="cliente.direccion" type="text" name="direccion"
                                                         placeholder="Introduzca su dirección"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.direccion">{{ errores.direccion[0] }}</span></label><br/>
                                <label>Teléfono: <input v-model="cliente.telefono" type="tel" name="telefono"
                                                        placeholder="Introduzca su teléfono" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.telefono">{{ errores.telefono[0] }}</span></label><br/>
                                <label>País: <input v-model="cliente.pais" type="text" name="pais"
                                                    placeholder="Introduzca su país" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.pais">{{ errores.pais[0] }}</span></label><br/>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cancelar
                            </button>
                            <button @click="guardar()" type="button" class="btn btn-success" data-dismiss="modal">
                                Guardar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="table w-full p-2">
            <table style="margin: 0 auto;" class="table-fixed table-striped">
                <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">#</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">DNI</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Apellidos</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Dirección</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Teléfono</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">País</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="cli in clientes" :key="cli.id">
                    <th scope="row">{{ cli.id }}</th>
                    <td class="p-2 border-r text-center">{{ cli.dni }}</td>
                    <td class="p-2 border-r text-center">{{ cli.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ cli.apellidos }}</td>
                    <td class="p-2 border-r text-center">{{ cli.direccion }}</td>
                    <td class="p-2 border-r text-center">{{ cli.telefono }}</td>
                    <td class="p-2 border-r text-center">{{ cli.pais }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(cli);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(cli.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cliente.vue",
    data() {
        return {

            clientes: [],
            cliente: {
                dni: '',
                nombre: '',
                apellidos: '',
                direccion: '',
                telefono: '',
                pais: '',
            },
            id: 0,
            modificar: true,
            modal: 0,
            tituloModal: '',
            errores: [],

        }
    },
    methods: {
        async listar() {
            let res = await axios.get('/clientes');
            this.clientes = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/clientes/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/clientes/' + this.id, this.cliente);
                } else {
                    let res = await axios.post('/clientes', this.cliente);
                }
                this.cerrarModal();
                this.listar();
            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }


        },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Cliente";
                this.cliente.dni = data.dni;
                this.cliente.nombre = data.nombre;
                this.cliente.apellidos = data.apellidos;
                this.cliente.direccion = data.direccion;
                this.cliente.telefono = data.telefono;
                this.cliente.pais = data.pais;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Cliente";
                this.cliente.dni = '';
                this.cliente.nombre = '';
                this.cliente.apellidos = '';
                this.cliente.direccion = '';
                this.cliente.telefono = '';
                this.cliente.pais = '';
            }
        },
        cerrarModal() {
            this.modal = 0;
        }
    },
    created() {
        this.listar();
    },
}

</script>

<style>

.mostrar {
    display: list-item;
    opacity: 1;
    background: #2b3145;
}
</style>
