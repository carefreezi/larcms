import Vue from 'vue'
import VueLazyLoad from 'vue-lazyload'
Vue.use(VueLazyLoad, {
    preLoad: 1.33, // 预加载的宽高比，4:3
    error: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', // 加载失败时使用的图片
    loading: 'https://larcms.oss-cn-beijing.aliyuncs.com/ball-loading.svg?versionId=CAEQERiBgIDih_211xciIDg4MTE3YWMwMGQ5NDQ4MTI4NjJhZDg0NmM2Yjc2MDg3', // 加载时的loading图
    attempt: 2 //尝试加载次数

})
