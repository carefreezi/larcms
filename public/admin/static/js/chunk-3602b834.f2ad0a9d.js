(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-3602b834"],{"0a6b":function(e,t,o){},5752:function(e,t,o){"use strict";o("0a6b")},"99ac":function(e,t,o){"use strict";o.r(t);var i=function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("div",{staticClass:"app-container"},[o("div",{directives:[{name:"loading",rawName:"v-loading",value:e.loadings,expression:"loadings"}],staticClass:"alls"},[o("el-tabs",{attrs:{type:"border-card"}},[o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-setting"}),e._v(" 系统设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"100px"}},[e._l(e.opForm.list_option,(function(t,i){return["localhost","api","title","subtitle","keywords","description"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["description"!=t.option_name?o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e(),"description"==t.option_name?o("el-input",{attrs:{type:"textarea",autosize:{minRows:4,maxRows:8}},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["logo_light","logo_dark","ico"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["logo_light"==t.option_name?o("el-upload",{staticClass:"avatar-uploader",attrs:{action:"/api/admin/upload_img","show-file-list":!1,"on-success":e.handleAvatarSuccess,"before-upload":e.beforeAvatarUpload}},[t.option_name?o("img",{staticClass:"avatar",attrs:{src:t.option_value}}):o("i",{staticClass:"el-icon-plus avatar-uploader-icon"})]):e._e(),"logo_dark"==t.option_name?o("el-upload",{staticClass:"avatar-uploader",attrs:{action:"/api/admin/upload_img","show-file-list":!1,"on-success":e.handleAvatarSuccesser,"before-upload":e.beforeAvatarUploader}},[t.option_name?o("img",{staticClass:"avatar",attrs:{src:t.option_value}}):o("i",{staticClass:"el-icon-plus avatar-uploader-icon"})]):e._e(),"ico"==t.option_name?o("el-upload",{staticClass:"avatar-uploader",attrs:{action:"/api/admin/upload_img","show-file-list":!1,"on-success":e.handleIcoSuccess,"before-upload":e.beforeIcoUploader}},[t.option_name?o("img",{staticClass:"avatar",attrs:{src:t.option_value}}):o("i",{staticClass:"el-icon-plus avatar-uploader-icon"})]):e._e()],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-shopping-bag-1"}),e._v(" 支付设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"130px"}},[e._l(e.opForm.list_option,(function(t,i){return["pay_is_lar"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-select",{attrs:{placeholder:"请选择"},on:{change:e.currentSelPay},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}},[o("el-option",{attrs:{label:"官方支付",value:"gf"}}),o("el-option",{attrs:{label:"易支付",value:"yzf"}})],1)],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["alipay_select"].includes(t.option_name)&&"gf"==e.pay_select?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-select",{attrs:{placeholder:"请选择"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}},[o("el-option",{attrs:{label:"支付宝网页支付",value:"0"}}),o("el-option",{attrs:{label:"支付宝扫码支付",value:"1"}})],1)],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["alipay_app_id","ali_public_key","alipay_private_key","wechat_app_id","wechat_mch_id","wechat_key"].includes(t.option_name)&&"gf"==e.pay_select?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["yzf_address","yzf_id","yzf_key"].includes(t.option_name)&&"yzf"==e.pay_select?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-user"}),e._v(" 登录/注册设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["jifen_is_open"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["jifen_is_open"==t.option_name?o("el-switch",{attrs:{"active-value":"yes","inactive-value":"no"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["QQ_LOGIN"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["QQ_LOGIN"==t.option_name?o("el-switch",{attrs:{"active-value":"true","inactive-value":"false"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["QQ_KEY","QQ_SECRET","QQ_REDIRECT_URI"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-alert",{attrs:{title:"QQ登录的回调地址为http://xxx.com/QQlogin",type:"info","show-icon":""}}),e._l(e.opForm.list_option,(function(t,i){return["WECHAT_LOGIN"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["WECHAT_LOGIN"==t.option_name?o("el-switch",{attrs:{"active-value":"true","inactive-value":"false"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["WEIXIN_KEY","WEIXIN_SECRET","WEIXIN_REDIRECT_URI"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-alert",{attrs:{title:"微信登录的回调地址为http://xxx.com/WechatLogin",type:"info","show-icon":""}}),e._l(e.opForm.list_option,(function(t,i){return["WEIBO_LOGIN"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["WEIBO_LOGIN"==t.option_name?o("el-switch",{attrs:{"active-value":"true","inactive-value":"false"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["WEIBO_KEY","WEIBO_SECRET","WEIBO_REDIRECT_URI"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-alert",{attrs:{title:"微博登录的回调地址为http://xxx.com/WEIBOlogin",type:"info","show-icon":""}}),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-brush"}),e._v(" 底部设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["copyright","about_us","weibo","wechat"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["copyright"!=t.option_name&&"about_us"!=t.option_name?o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e(),"copyright"==t.option_name||"about_us"==t.option_name?o("el-input",{attrs:{type:"textarea",autosize:{minRows:4,maxRows:8}},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-house"}),e._v(" 首页设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["banner_types"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-select",{attrs:{placeholder:"请选择"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}},[o("el-option",{attrs:{label:"默认式轮播",value:"1"}}),o("el-option",{attrs:{label:"卡片式轮播",value:"2"}}),o("el-option",{attrs:{label:"颠倒式轮播",value:"3"}})],1)],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-message"}),e._v(" 邮箱设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["MAIL_HOST","MAIL_PORT","MAIL_USERNAME","MAIL_PASSWORD","MAIL_ENCRYPTION","MAIL_FROM_ADDRESS"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-discover"}),e._v(" Oss设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["oss"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["oss"==t.option_name?o("el-select",{attrs:{placeholder:"请选择"},on:{change:e.currentSel},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}},[o("el-option",{attrs:{label:"本地上传",value:"local"}}),o("el-option",{attrs:{label:"阿里oss上传",value:"alioss"}}),o("el-option",{attrs:{label:"七牛云上传",value:"qiniuoss"}})],1):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["ALIYUN_ACCESS_ID","ALIYUN_ACCESS_KEY","ALIYUN_BUCKET","ALIYUN_ENDPOINT","ALIYUN_SSL"].includes(t.option_name)&&"alioss"==e.oss_select?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},["ALIYUN_SSL"==t.option_name?o("el-switch",{attrs:{"active-value":"true","inactive-value":"false"},model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e(),"oss"!=t.option_name&&"ALIYUN_SSL"!=t.option_name?o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}}):e._e()],1):e._e()})),e._l(e.opForm.list_option,(function(t,i){return["QINIU_ACCESS_KEY","QINIU_SECRET_KEY","QINIU_BUCKET","QINIU_DOMAIN"].includes(t.option_name)&&"qiniuoss"==e.oss_select?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1),o("el-tab-pane",[o("span",{attrs:{slot:"label"},slot:"label"},[o("i",{staticClass:"el-icon-coin"}),e._v(" 积分设置")]),o("el-form",{ref:"opForm",staticClass:"demo-ruleForm",attrs:{model:e.opForm,rules:e.rules,"label-width":"160px"}},[e._l(e.opForm.list_option,(function(t,i){return["birthday_default","invitation_default"].includes(t.option_name)?o("el-form-item",{key:i,attrs:{label:e.statusFilter(t.option_name),prop:"list_option."+i+".option_value",rules:{required:!0,message:e.statusFilter(t.option_name)+"数据不得为空",trigger:"blur"}}},[o("el-input",{model:{value:t.option_value,callback:function(o){e.$set(t,"option_value",o)},expression:"item.option_value"}})],1):e._e()})),o("el-form-item",[o("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.optionSub("opForm")}}},[e._v("立即提交")])],1)],2)],1)],1)],1)])},l=[],a=o("b189"),s={name:"Options",data:function(){return{loadings:!0,opForm:{list_option:[]},rules:{},oss_select:"",pay_select:""}},created:function(){var e=this;Object(a["a"])().then((function(t){e.opForm.list_option=t.data,e.loadings=!1;for(var o=0;o<=t.data.length;o++)"oss"==t.data[o].option_name&&(e.oss_select=t.data[o].option_value),"pay_is_lar"==t.data[o].option_name&&(e.pay_select=t.data[o].option_value)}))},methods:{statusFilter:function(e){var t={localhost:{type:"主域名"},api:{type:"API域名"},title:{type:"网站名称"},subtitle:{type:"副标题"},keywords:{type:"关键词"},description:{type:"网站描述"},logo_light:{type:"顶部LOGO"},logo_dark:{type:"底部LOGO"},alipay_app_id:{type:"支付宝PID"},ali_public_key:{type:"支付宝公匙"},alipay_private_key:{type:"支付宝私匙"},wechat_app_id:{type:"微信支付APPID"},wechat_mch_id:{type:"微信公众号ID"},wechat_key:{type:"微信支付KEY"},QQ_KEY:{type:"QQ登录KEY"},QQ_SECRET:{type:"QQ登录SECRET"},QQ_REDIRECT_URI:{type:"QQ登录回调"},WEIXIN_KEY:{type:"微信登录KEY"},WEIXIN_SECRET:{type:"微信登录SECRET"},WEIXIN_REDIRECT_URI:{type:"微信登录回调"},WEIBO_KEY:{type:"微博登录KEY"},WEIBO_SECRET:{type:"微博登录SECRET"},WEIBO_REDIRECT_URI:{type:"微博登录回调"},copyright:{type:"版权信息"},about_us:{type:"关于我们"},weibo:{type:"微博链接"},wechat:{type:"微信链接"},banner_types:{type:"轮播图样式"},MAIL_HOST:{type:"邮箱地址"},MAIL_PORT:{type:"邮箱端口"},MAIL_USERNAME:{type:"邮箱用户名"},MAIL_PASSWORD:{type:"邮箱密码"},MAIL_ENCRYPTION:{type:"邮箱加密协议"},MAIL_FROM_ADDRESS:{type:"邮箱发送地址"},oss:{type:"上传选择"},ALIYUN_ACCESS_ID:{type:"Access Key ID"},ALIYUN_ACCESS_KEY:{type:"Access Key Secret"},ALIYUN_BUCKET:{type:"bucket名"},ALIYUN_ENDPOINT:{type:"OSS节点"},ALIYUN_SSL:{type:"开启https"},QINIU_ACCESS_KEY:{type:"Access Key"},QINIU_SECRET_KEY:{type:"Access Key Secret"},QINIU_BUCKET:{type:"bucket名"},QINIU_DOMAIN:{type:"OSS节点"},QQ_LOGIN:{type:"开启QQ登录"},WECHAT_LOGIN:{type:"开启微信登录"},WEIBO_LOGIN:{type:"开启微博登录"},ico:{type:"ico图标"},alipay_select:{type:"支付宝支付方式"},pay_is_lar:{type:"支付渠道设置"},yzf_address:{type:"易支付地址"},yzf_id:{type:"易支付商户ID"},yzf_key:{type:"易支付商户密匙"},jifen_is_open:{type:"邀请码注册"},invitation_default:{type:"邀请码注册积分"},birthday_default:{type:"用户生日积分"}};return t[e].type},optionSub:function(e){var t=this;this.$refs[e].validate((function(e){if(!e)return console.log("error submit!!"),!1;Object(a["b"])(t.opForm.list_option).then((function(e){200==e.status&&t.$message.success(e.msg)}))}))},handleAvatarSuccess:function(e,t){200==e.status&&this.$message.success(e.msg);for(var o=0;o<this.opForm.list_option.length;o++)"logo_light"==this.opForm.list_option[o].option_name&&(this.opForm.list_option[o].option_value=e.files.file)},beforeAvatarUpload:function(e){var t="image/jpeg"===e.type||"image/jpg"===e.type||"image/png"===e.type||"image/PNG"===e.type||"image/JPG"===e.type,o=e.size/1024/1024<2;return t?o?void 0:(this.$message.error("上传图片大小不能超过 2MB!"),t&&o):(this.$message.error("上传图片只能是 JPG或者PNG 格式!"),t&&o)},handleAvatarSuccesser:function(e,t){200==e.status&&this.$message.success(e.msg);for(var o=0;o<this.opForm.list_option.length;o++)"logo_dark"==this.opForm.list_option[o].option_name&&(this.opForm.list_option[o].option_value=e.files.file)},beforeAvatarUploader:function(e){var t="image/jpeg"===e.type||"image/jpg"===e.type||"image/png"===e.type||"image/PNG"===e.type||"image/JPG"===e.type,o=e.size/1024/1024<2;return t?o?void 0:(this.$message.error("上传图片大小不能超过 2MB!"),t&&o):(this.$message.error("上传图片只能是 JPG或者PNG 格式!"),t&&o)},handleIcoSuccess:function(e,t){200==e.status&&this.$message.success(e.msg);for(var o=0;o<this.opForm.list_option.length;o++)"ico"==this.opForm.list_option[o].option_name&&(this.opForm.list_option[o].option_value=e.files.file)},beforeIcoUploader:function(e){var t="image/jpeg"===e.type||"image/jpg"===e.type||"image/png"===e.type||"image/PNG"===e.type||"image/JPG"===e.type||"image/x-icon"===e.type,o=e.size/1024/1024<2;return t?o?void 0:(this.$message.error("上传图片大小不能超过 2MB!"),t&&o):(this.$message.error("上传图片只能是 JPG/PNG/ICO 格式!"),t&&o)},currentSel:function(e){this.oss_select=e},currentSelPay:function(e){this.pay_select=e}}},n=s,r=(o("5752"),o("2877")),p=Object(r["a"])(n,i,l,!1,null,"55cbdbce",null);t["default"]=p.exports},b189:function(e,t,o){"use strict";o.d(t,"a",(function(){return l})),o.d(t,"b",(function(){return a}));var i=o("b775");function l(){return Object(i["a"])({url:"/admin/fetchOptions",method:"get"})}function a(e){return Object(i["a"])({url:"/admin/fetchOptionsUp",method:"post",data:{data:e}})}}}]);