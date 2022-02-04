import Vue from 'vue'
import Vuex from 'vuex'
import router from './router'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null,
    usuario: null
  },
  mutations: {
    setToken(state,token){
      state.token=token;
    },
    setUsuario(state,usuario){
      state.usuario=usuario;
    }
  },
  actions: {
    guardarToken({commit}, token){
      commit("setToken", token)
      localStorage.setItem("token", token)
    },
    guardarUsuario({commit}, user){
      commit("setUsuario", user)
      localStorage.setItem("user", JSON.stringify(user))
    },
    autoLogin({commit}){
      let user = localStorage.getItem("user");
      if(user) {
        commit("setUsuario", JSON.parse(user));
      }
      router.push({name: 'home'});
    },
    salir({commit}){
      commit("setToken", null);
      commit("setUsuario", null);
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      router.push({name: 'login'});
    }
  }
})
