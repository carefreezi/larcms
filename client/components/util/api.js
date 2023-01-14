import axios from 'axios'
import Vue from 'vue'
const qs = require('qs')
const api = {
    async get (url, data) {
        try {
            let res = await axios.get(url, {params: data})
            res = res.data
            return new Promise((resolve) => {
                if (res.code === 0) {
                    resolve(res)
                } else {
                    resolve(res)
                }
            })
        } catch (err) {
            alert('服务器出错')
            console.log(err)
        }
    },
    async post (url, data) {
        try {
            let res = await axios.post(url, qs.stringify(data))
            res = res.data
            return new Promise((resolve, reject) => {
                if (res.code === 0) {
                    resolve(res)
                } else {
                    reject(res)
                }
            })
        } catch (err) {
            // return (e.message)
            alert('服务器出错')
            console.log(err)
        }
    },

}
// http request 拦截器
axios.interceptors.request.use(
    config => {
        if (localStorage.JWT_TOKEN) {  // 判断是否存在token，如果存在的话，则每个http header都加上token
            config.headers.Authorization = `token ${localStorage.JWT_TOKEN}`;
        }
        return config;
    },
    err => {
        return Promise.reject(err);
    });

// http response 拦截器
axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response) {
            console.log('axios:' + error.response.status);
            switch (error.response.status) {
                case 401:
                    // 返回 401 清除token信息并跳转到登录页面
                    store.commit('LOG_OUT');
                    router.replace({
                        path: 'login',
                        query: {redirect: router.currentRoute.fullPath}
                    });
            }
        }
        return Promise.reject(error.response.data);   // 返回接口返回的错误信息
    });

Vue.prototype.$http = axios;
export { api }
