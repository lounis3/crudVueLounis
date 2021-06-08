<template>
    <div>
        <h1 class="text-center">Gestión Facturas</h1>
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
<!--                                <label>ID: <input v-model="factura.id" type="text" name="id"
                                                   placeholder="Introduzca el ID de la factura" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.id">{{ errores.id[0] }}</span></label><br/>-->
                                <label>Fecha: <input v-model="factura.fecha" type="date" name="fecha"
                                                      placeholder="Introduzca la fecha de la factura"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.fecha">{{ errores.fecha[0] }}</span></label><br/>
                                <label>Descripción: <input v-model="factura.descripcion" type="text" name="descripcion"
                                                         placeholder="Introduzca la descripción"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.descripcion">{{ errores.descripcion[0] }}</span></label><br/>
                                <label>Precio Total: <input v-model="factura.precioTotal" type="text" name="precioTotal"
                                                         placeholder="Introduzca el precio de la factura"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.precioTotal">{{ errores.precioTotal[0] }}</span></label><br/>
                                <label>ID Cliente: <input v-model="factura.cliente_id" type="number" name="id_cliente"
                                                            placeholder="Introduzca el ID del Cliente"
                                                            class="my-1">
                                    <span class="text-danger" v-if="errores.cliente_id">{{ errores.cliente_id[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Fecha</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Descripcion</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Precio Total</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">ID Cliente</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="fac in facturas" :key="fac.id">
                    <th scope="row">{{ fac.id }}</th>
                    <td class="p-2 border-r text-center">{{ fac.fecha }}</td>
                    <td class="p-1 border-r text-center">{{ fac.description }}</td>
                    <td class="p-2 border-r text-center">{{ fac.precioTotal }}</td>
                    <td class="p-2 border-r text-center">{{ fac.cliente_id }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(fac);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(fac.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Factura.vue",
    data() {
        return {

            facturas: [],
            factura: {
                id: '',
                fecha: '',
                descripcion: '',
                precioTotal: '',
                cliente_id:'',
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
            let res = await axios.get('/facturas');
            this.facturas = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/facturas/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/facturas/' + this.id, this.factura);
                } else {
                    let res = await axios.post('/facturas', this.factura);
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
                this.tituloModal = "Modificar Factura";
                this.factura.fecha = data.fecha;
                this.factura.descripcion = data.descripcion;
                this.factura.precioTotal = data.precioTotal;
                this.factura.cliente_id = data.cliente_id;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Factura";
                this.factura.fecha = '';
                this.factura.descripcion = '';
                this.factura.precioTotal = '';
                this.factura.cliente_id = '';
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
