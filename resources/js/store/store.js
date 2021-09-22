import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        isAdmin: false
    },
    mutations: {
        change(state, val) {
            state.isAdmin = val;
            console.log('bal felse');
        }
    },
    getters: {
        isAdmin: state => state.isAdmin
    }
})
