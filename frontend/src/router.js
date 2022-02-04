import Vue from 'vue'
import Router from 'vue-router'
import store from './store'
import Home from './views/Home.vue'
import Login from './components/Login.vue'
import Producto from './components/Producto.vue'
import ListaProducto from './components/ListaProducto.vue'

Vue.use(Router)

var router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        administrador: true,
        usuario: true,
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        libre: true
      }
    },
    {
      path: '/producto',
      name: 'producto',
      component: Producto,
      meta: {
        administrador: true,
      }
    },
    {
      path: '/lista-producto',
      name: 'listaProducto',
      component: ListaProducto,
      meta: {
        administrador: true,
      }
    },
  ]
})
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.libre)){
    next();
  } else if ( store.state.usuario && store.state.usuario.rol == 'Administrador'){
    if (to.matched.some(record => record.meta.administrador)){
      next();
    }
  } else if ( store.state.usuario && store.state.usuario.rol == 'Usuario'){
    if (to.matched.some(record => record.meta.usuario)){
      next();
    }
  } else{
    next({name: 'login'});
  }
})
export default router
