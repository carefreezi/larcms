import { Notification } from 'element-ui'
import axios from 'axios'
import cookies from "js-cookie";
import { Message } from "element-ui";

export default function({$axios,store, redirect, error: nuxtError }) {
    axios.defaults.headers.Authorization = cookies.get('auth._token.local');

    $axios.onRequest(config => {
        // 向请求头中塞入 token
        if (config.method === 'get') {
            //  给data赋值以绕过if判断
            config.data = true
            config.headers['Content-Type'] = 'application/x-www-form-urlencoded'
        }
        // 向参数中塞入 token
        let data = {}
        if (config.method.toUpperCase() === 'GET') {
            data = config.params || {}
            config.params = data
        } else {
            // POST 需要塞入 data
            data = config.data || {}
            config.data = data
        }
    });

    $axios.onResponse(res => {
        // 返回数据逻辑处理
        if (res.data.status==401){
            Message({
                //  饿了么的消息弹窗组件,类似toast
                message: res.data.msg,
                type: "warning"
            });
        }
        if (res.data.code === 1) {
            // 重定向到 login 页
            redirect('/login')
        }
    });

    $axios.onError(error => {
        switch (error.response.status) {
            case 403:
                // 重定向到 403 页
                redirect('/error/403')
                break;
            case 404:
                // 重定向到 404 页
                redirect('/error/404')
                break;
            case 500:
                // 重定向到 500 页
                redirect('/error/500')
                break;
            default:
                break;
        }
        if (error.response.data.msg != null) {
            Message({
                //  饿了么的消息弹窗组件,类似toast
                message: error.response.data.msg,
                type: "warning"
            });
        } else if (error.response.data.message != null) {
            // cookies.remove('auth._token.local');
            // await this.$auth.logout('local');
            Message({
                //  饿了么的消息弹窗组件,类似toast
                message: 'token已到期,请重新登录！',
                type: "warning"
            });

        } else {
            Message({
                //  饿了么的消息弹窗组件,类似toast
                message: error.response.data.errmsg,
                type: "warning"
            });
        }
    })
}
