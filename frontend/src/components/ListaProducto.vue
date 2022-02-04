<template>
    <v-layout align-start>
        <v-flex>
            <v-toolbar flat color="white">
                <v-toolbar-title>Lista De Productos</v-toolbar-title>
                <v-divider
                    class="mx-2"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-text-field class="text-xs-center" v-model="search" append-icon="search" 
                label="Búsqueda" single-line hide-details></v-text-field>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Nuevo</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                        </v-card-title>            
                        <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs6 sm6 md6>
                                    <v-select v-model="producto" outline
                                        :items="productos"
                                        item-text="nombre"
                                        item-value="id"
                                        label="Producto">
                                    </v-select>
                                </v-flex>
                                <v-flex xs6 sm6 mdd6>
                                    <v-text-field v-model="cantidad" label="Cantidad" outline>                                        
                                    </v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        </v-card-text>            
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
                        <v-btn color="blue darken-1" flat @click="guardar">Guardar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
            <v-data-table
                :headers="headers"
                :items="listaProductos"
                :search="search"
                class="elevation-1"
            >
                <template v-slot:items="props">
                    <td>{{ props.item.codigo }}</td>
                    <td>{{ props.item.nombre }}</td>
                    <td>{{ props.item.cantidad }}</td>    
                    <td class="ml-4 layout px-0">
                        <v-icon
                            small
                            class="mr-2"
                            @click="editItem(props.item)"
                        >
                            edit
                        </v-icon>
                        <v-icon
                            small
                            class="mr-2"
                            @click="deleteItem(props.item.idList)"
                        >
                            delete
                        </v-icon>
                    </td>       
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>
<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';
    export default {
        data(){
            return{
                dialog: false,
                search:'',
                productos:[],
                headers: [
                    { text: 'Código',value: 'codigo', sortable: false},
                    { text: 'Nombre',value: 'nombre', sortable: true},
                    { text: 'Cantidad',value: 'cantidad', sortable: true},
                    { text: 'Opciones', value: 'opciones', sortable: false },
                ],
                editedIndex: -1,
                id:'',
                producto:'',
                listaProductos:[],
                cantidad: '',
                valida:0,
                validaMensaje:[],
                adModal:0,
                adAccion:0,
                adNombre:'',
                adId:''
            }
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Nuevo registro' : 'Editar registro'
            }
        },
        watch: {
            dialog (val) {
                val || this.close()
            }
        },
        created () {
            this.listar();
            this.selectProducto();
        },
        methods: {
            selectProducto(){
                let me = this;          
                axios.get('producto/index').then(function (response){
                    me.productos = response.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            listar(){
                let me = this;           
                axios.get(`lista-producto/index/${this.$store.state.usuario.id}`).then(function (response){
                    me.listaProductos = response.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            limpiar(){
                this.id = '';
                this.producto = '';
                this.cantidad = '';
                this.editedIndex = -1;
            },
            guardar(){
                let me = this;
                if (this.editedIndex >-1){
                    axios.put(`lista-producto/update/${me.id}`,
                    {
                        'producto':this.producto,
                        'cantidad':this.cantidad,
                        'user':this.$store.state.usuario.id,
                    })
                    .then(function(response){
                        Swal.fire(
                            'Modificado!',
                            'Su registro ha sido modificado.',
                            'success'
                        )
                        me.limpiar();
                        me.close();
                        me.listar();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
                }else{
                    axios.post('lista-producto/store',
                    {
                        'producto':this.producto,
                        'cantidad':this.cantidad,
                        'user':this.$store.state.usuario.id,
                    })
                    .then(function(response){
                        Swal.fire(
                            'Registrado!',
                            'Su registro ha sido creado.',
                            'success'
                        )
                        me.limpiar();
                        me.close();
                        me.listar();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
                }
            },
            editItem (item) {
                this.id = item.idList;
                this.producto = item.idPro;
                this.cantidad = item.cantidad;
                this.dialog = true;
                this.editedIndex = 1;
            },
            deleteItem(id){
                let me = this;
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(`lista-producto/delete/${id}`).then(function (response){
                            Swal.fire(
                                'Eliminado!',
                                'Su registro ha sido eliminado.',
                                'success'
                            );
                            me.listar();
                        }).catch(function(error){
                            console.log(error);
                        });
                    }
                })
            },
            close () {
                this.dialog = false;
            }
        }
    }
</script>
