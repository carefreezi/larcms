import Vue from 'vue'
import Logins from '@/components/Login.vue'
import Notfound from '@/components/Notfound.vue'
import Clipboard from 'clipboard';
Vue.prototype.Clipboard=Clipboard;
Vue.component('Logins',Logins)
Vue.component('Notfound',Notfound)
const LoginBox = Vue.extend(Logins)
LoginBox.install = function () {
    let instance = new LoginBox({
    }).$mount()
    Vue.nextTick(() => {
        instance.dialogLogin = true
    })
}
export { LoginBox }

Vue.prototype.WebConfigs = function (option_names) {
    var _this = this;
    for (var i = 0; i <= this.$store.state.webConfig.length; i++) {
        if (option_names == _this.$store.state.webConfig[i].option_name) {
            return _this.$store.state.webConfig[i].option_value;
        }
    }
}

