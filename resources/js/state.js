import Vue from 'vue';

export const state = Vue.observable({
    token: null
})

export const mutations = {
    setToken(newvalue) {
        state.token = newvalue;
    }
}