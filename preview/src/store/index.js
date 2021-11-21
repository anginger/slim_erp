import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loaded: false,
    ready: false,
    modifiable: false,
    user: null
  },
  mutations: {
    setLoaded(state, status) {
      state.loaded = status
    },
    setReady(state, status) {
      state.ready = status
    },
    setModifiable(state, status) {
      state.modifiable = status
    },
    setUser(state, user) {
      state.user = user
    }
  },
})
