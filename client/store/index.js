import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export const state = ()=>({
    webConfig:null
})

export const mutations = {
    setWebConfig(state,config){
        state.webConfig = config;
    }
}

export const actions = {
    async nuxtServerInit({commit},{app}){
        const PostRes = await app.$axios.$post('/api/config')
        if (PostRes.status ==200){
            await commit('setWebConfig',PostRes.data)
        }
    }
}
