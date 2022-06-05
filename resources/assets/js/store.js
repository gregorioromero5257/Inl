import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        state_info: {}
    },
    mutations: {
        AddState(state,value){
            state.state_info = value
        }
    },
    getters: {

    },
    actions: {

    }
});

export default store;