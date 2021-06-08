<template>
    <div>
        <h1 class="text-center">Gestión Empleados</h1>
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
                                <label>DNI: <input v-model="empleado.dni" type="text" name="dni"
                                                   placeholder="Introduzca su DNI"
                                                   pattern="[0-9]{8}[A-Za-z]{1}" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.dni">{{ errores.dni[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="empleado.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca su nombre"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="empleado.apellidos" type="text" name="apellidos"
                                                         placeholder="Introduzca su/s apellido/s"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Dirección: <input v-model="empleado.direccion" type="text" name="direccion"
                                                         placeholder="Introduzca su dirección"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.direccion">{{ errores.direccion[0] }}</span></label><br/>
                                <label>Teléfono: <input v-model="empleado.telefono" type="tel" name="telefono"
                                                        placeholder="Introduzca su teléfono" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.telefono">{{ errores.telefono[0] }}</span></label><br/>
                                <label>Estudios: <input v-model="empleado.estudios"  name="estudios"
                                                        placeholder="Introduzca sus estudios" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.estudios">{{ errores.estudios[0] }}</span></label><br/>

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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Estudios</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="emp in empleados" :key="emp.id">
                    <th scope="row">{{ emp.id }}</th>
                    <td class="p-2 border-r text-center">{{ emp.dni }}</td>
                    <td class="p-2 border-r text-center">{{ emp.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ emp.apellidos }}</td>
                    <td class="p-2 border-r text-center">{{ emp.direccion }}</td>
                    <td class="p-2 border-r text-center">{{ emp.telefono }}</td>
                    <td class="p-2 border-r text-center">{{ emp.estudios }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(emp);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(emp.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Empleado.vue",
    data() {
        return {

            empleados: [],
            empleado: {
                dni: '',
                nombre: '',
                apellidos: '',
                direccion: '',
                telefono: '',
                estudios: '',
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
            let res = await axios.get('/empleados');
            this.empleados = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/empleados/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/empleados/' + this.id, this.empleado);
                } else {
                    let res = await axios.post('/empleados', this.empleado);
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
                this.tituloModal = "Modificar Empleado";
                this.empleado.dni = data.dni;
                this.empleado.nombre = data.nombre;
                this.empleado.apellidos = data.apellidos;
                this.empleado.direccion = data.direccion;
                this.empleado.telefono = data.telefono;
                this.empleado.estudios = data.estudios;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Empleado";
                this.empleado.dni = '';
                this.empleado.nombre = '';
                this.empleado.apellidos = '';
                this.empleado.direccion = '';
                this.empleado.telefono = '';
                this.empleado.estudios = '';
            }
        },
        cerrarModal() {
            this.modal = 0;
        },

    },
    created() {
        this.listar();
    },
}
</script>

<style scoped>

.mostrar {
    display: list-item;
    opacity: 1;
    background: #2b3145;
}

</style>
