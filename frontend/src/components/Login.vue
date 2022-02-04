<template>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg5 xl4>
            <v-card>
                <v-toolbar dark color="blue ligth-2">
                    <v-toolbar-title>
                        Acceso al Sistema - Prueba
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-text-field v-model="email" autofocus color="accent" label="Email" required>
                    </v-text-field>
                    <v-text-field v-model="password" type="password" color="accent" label="Password" required>
                    </v-text-field>
                </v-card-text>
                <v-card-actions class="px-3 pb-3">
                    <v-flex text-xs-right>
                        <v-btn @click="ingresar()" color="secondary">Ingresar</v-btn>
                    </v-flex>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
import axios from 'axios';
export default {
    data (){
        return{
            email:'',
            password:'',
            errorM:null
        }
    },
    methods:{
        ingresar(){
            axios.post('auth/login',{ email: this.email, password: this.password })
            .then(respuesta =>{
                //console.log(respuesta);
                return respuesta.data;
            })
            .then(data =>{
                this.$store.dispatch("guardarToken", data.access_token);
                this.$store.dispatch("guardarUsuario", data.user);
                this.$router.push({name: 'home'});
            })
            .catch(error =>{
                console.log(error);
            });
        }
    }
}
</script>

