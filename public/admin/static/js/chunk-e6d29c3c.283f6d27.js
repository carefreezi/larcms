(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-e6d29c3c"],{6883:function(t,n,e){"use strict";e.r(n);var r=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"app-container"},[e("el-form",{ref:"ruleForm",staticClass:"demo-ruleForm",attrs:{model:t.ruleForm,rules:t.rules,"label-width":"100px"}},[e("el-form-item",{attrs:{label:"原密码",prop:"password"}},[e("el-input",{attrs:{type:"password"},model:{value:t.ruleForm.password,callback:function(n){t.$set(t.ruleForm,"password",n)},expression:"ruleForm.password"}})],1),e("el-form-item",{attrs:{label:"新密码",prop:"tpassword"}},[e("el-input",{attrs:{type:"password"},model:{value:t.ruleForm.tpassword,callback:function(n){t.$set(t.ruleForm,"tpassword",n)},expression:"ruleForm.tpassword"}})],1),e("el-form-item",{attrs:{label:"二次密码",prop:"trpassword"}},[e("el-input",{attrs:{type:"password"},model:{value:t.ruleForm.trpassword,callback:function(n){t.$set(t.ruleForm,"trpassword",n)},expression:"ruleForm.trpassword"}})],1),e("el-form-item",[e("el-button",{attrs:{type:"primary"},on:{click:function(n){return t.submitForm("ruleForm")}}},[t._v("立即更新")]),e("el-button",{on:{click:function(n){return t.resetForm("ruleForm")}}},[t._v("重置")])],1)],1)],1)},u=[],a=e("bfb4"),o={name:"reset",data:function(){return{ruleForm:{password:"",tpassword:"",trpassword:"",token:""},rules:{password:[{required:!0,message:"请输入原密码",trigger:"blur"}],tpassword:[{required:!0,message:"请输入新密码",trigger:"blur"}],trpassword:[{required:!0,message:"请二次输入新密码",trigger:"blur"}]}}},created:function(){this.token=this.$store.state.user.token},methods:{submitForm:function(t){var n=this;this.$refs[t].validate((function(t){if(!t)return console.log("error submit!!"),!1;Object(a["Cb"])(n.token,n.ruleForm.password,n.ruleForm.tpassword,n.ruleForm.trpassword).then((function(t){200==t.status&&n.$message.success(t.msg)}))}))},resetForm:function(t){this.$refs[t].resetFields()}}},d=o,i=e("2877"),c=Object(i["a"])(d,r,u,!1,null,"c43a90d0",null);n["default"]=c.exports},bfb4:function(t,n,e){"use strict";e.d(n,"W",(function(){return u})),e.d(n,"E",(function(){return a})),e.d(n,"X",(function(){return o})),e.d(n,"v",(function(){return d})),e.d(n,"nb",(function(){return i})),e.d(n,"eb",(function(){return c})),e.d(n,"fb",(function(){return f})),e.d(n,"ob",(function(){return s})),e.d(n,"S",(function(){return m})),e.d(n,"mb",(function(){return l})),e.d(n,"ub",(function(){return h})),e.d(n,"rb",(function(){return p})),e.d(n,"L",(function(){return b})),e.d(n,"vb",(function(){return O})),e.d(n,"sb",(function(){return j})),e.d(n,"M",(function(){return g})),e.d(n,"db",(function(){return w})),e.d(n,"I",(function(){return F})),e.d(n,"cb",(function(){return k})),e.d(n,"H",(function(){return y})),e.d(n,"p",(function(){return C})),e.d(n,"x",(function(){return D})),e.d(n,"i",(function(){return U})),e.d(n,"ab",(function(){return v})),e.d(n,"G",(function(){return I})),e.d(n,"bb",(function(){return V})),e.d(n,"Gb",(function(){return _})),e.d(n,"h",(function(){return L})),e.d(n,"Y",(function(){return S})),e.d(n,"F",(function(){return q})),e.d(n,"Z",(function(){return A})),e.d(n,"Fb",(function(){return M})),e.d(n,"g",(function(){return $})),e.d(n,"T",(function(){return x})),e.d(n,"D",(function(){return P})),e.d(n,"U",(function(){return B})),e.d(n,"Eb",(function(){return H})),e.d(n,"N",(function(){return N})),e.d(n,"A",(function(){return W})),e.d(n,"O",(function(){return G})),e.d(n,"j",(function(){return Q})),e.d(n,"Q",(function(){return T})),e.d(n,"C",(function(){return E})),e.d(n,"R",(function(){return J})),e.d(n,"Db",(function(){return z})),e.d(n,"wb",(function(){return K})),e.d(n,"f",(function(){return R})),e.d(n,"Bb",(function(){return X})),e.d(n,"o",(function(){return Y})),e.d(n,"r",(function(){return Z})),e.d(n,"y",(function(){return tt})),e.d(n,"lb",(function(){return nt})),e.d(n,"s",(function(){return et})),e.d(n,"c",(function(){return rt})),e.d(n,"V",(function(){return ut})),e.d(n,"kb",(function(){return at})),e.d(n,"Cb",(function(){return ot})),e.d(n,"ib",(function(){return dt})),e.d(n,"qb",(function(){return it})),e.d(n,"K",(function(){return ct})),e.d(n,"t",(function(){return ft})),e.d(n,"z",(function(){return st})),e.d(n,"u",(function(){return mt})),e.d(n,"b",(function(){return lt})),e.d(n,"a",(function(){return ht})),e.d(n,"l",(function(){return pt})),e.d(n,"w",(function(){return bt})),e.d(n,"hb",(function(){return Ot})),e.d(n,"J",(function(){return jt})),e.d(n,"gb",(function(){return gt})),e.d(n,"pb",(function(){return wt})),e.d(n,"P",(function(){return Ft})),e.d(n,"jb",(function(){return kt})),e.d(n,"B",(function(){return yt})),e.d(n,"tb",(function(){return Ct})),e.d(n,"e",(function(){return Dt})),e.d(n,"Ab",(function(){return Ut})),e.d(n,"n",(function(){return vt})),e.d(n,"q",(function(){return It})),e.d(n,"d",(function(){return Vt})),e.d(n,"zb",(function(){return _t})),e.d(n,"m",(function(){return Lt})),e.d(n,"xb",(function(){return St})),e.d(n,"yb",(function(){return qt})),e.d(n,"k",(function(){return At}));var r=e("b775");function u(t){return Object(r["a"])({url:"/admin/fetchLink",method:"get",params:t})}function a(t){return Object(r["a"])({url:"/admin/fetchDelLink",method:"post",data:{id:t}})}function o(t){return Object(r["a"])({url:"/admin/fetchLinkId",method:"post",data:{id:t}})}function d(t,n){return Object(r["a"])({url:"/admin/fetchCreateLink",method:"post",data:{name:t,link:n}})}function i(t,n,e){return Object(r["a"])({url:"/admin/fetchUpdataLink",method:"post",data:{id:t,name:n,link:e}})}function c(){return Object(r["a"])({url:"/admin/fetchSign",method:"get"})}function f(){return Object(r["a"])({url:"/admin/fetchSignBu",method:"get"})}function s(t,n){return Object(r["a"])({url:"/admin/fetchUpdataSign",method:"post",data:{signs:t,jifen_bu:n}})}function m(){return Object(r["a"])({url:"/admin/fetchGift",method:"get"})}function l(t){return Object(r["a"])({url:"/admin/fetchUpdataGift",method:"post",data:{gifts:t}})}function h(){return Object(r["a"])({url:"/admin/fetchVip",method:"get"})}function p(t){return Object(r["a"])({url:"/admin/fetchUpdataVip",method:"post",data:{query:t}})}function b(t){return Object(r["a"])({url:"/admin/fetchDelVip",method:"post",data:{id:t}})}function O(){return Object(r["a"])({url:"/admin/fetchVipQs",method:"get"})}function j(t){return Object(r["a"])({url:"/admin/fetchUpdataVipQs",method:"post",data:{query:t}})}function g(t){return Object(r["a"])({url:"/admin/fetchDelVipQs",method:"post",data:{id:t}})}function w(t){return Object(r["a"])({url:"/admin/fetchPostOrders",method:"get",params:t})}function F(t){return Object(r["a"])({url:"/admin/fetchDelPosts",method:"post",data:{id:t}})}function k(t){return Object(r["a"])({url:"/admin/fetchOrders",method:"get",params:t})}function y(t){return Object(r["a"])({url:"/admin/fetchDelOrders",method:"post",data:{id:t}})}function C(t){return Object(r["a"])({url:"/admin/fetchAccounts",method:"get",params:t})}function D(t){return Object(r["a"])({url:"/admin/fetchDelAccounts",method:"post",data:{id:t}})}function U(t,n){return Object(r["a"])({url:"/admin/addNotice",method:"post",data:{title:t,content:n}})}function v(t){return Object(r["a"])({url:"/admin/fetchNotice",method:"get",params:t})}function I(t){return Object(r["a"])({url:"/admin/fetchDelNotice",method:"post",data:{id:t}})}function V(t){return Object(r["a"])({url:"/admin/fetchNoticeId",method:"post",data:{id:t}})}function _(t,n,e){return Object(r["a"])({url:"/admin/updataNotice",method:"post",data:{id:t,title:n,content:e}})}function L(t,n,e){return Object(r["a"])({url:"/admin/addMessage",method:"post",data:{title:t,content:n,user_id:e}})}function S(t){return Object(r["a"])({url:"/admin/fetchMessage",method:"get",params:t})}function q(t){return Object(r["a"])({url:"/admin/fetchDelMessage",method:"post",data:{id:t}})}function A(t){return Object(r["a"])({url:"/admin/fetchMessageId",method:"post",data:{id:t}})}function M(t,n,e,u){return Object(r["a"])({url:"/admin/updataMessage",method:"post",data:{id:t,title:n,content:e,user_id:u}})}function $(t,n){return Object(r["a"])({url:"/admin/addHelp",method:"post",data:{title:t,content:n}})}function x(t){return Object(r["a"])({url:"/admin/fetchHelp",method:"get",params:t})}function P(t){return Object(r["a"])({url:"/admin/fetchDelHelp",method:"post",data:{id:t}})}function B(t){return Object(r["a"])({url:"/admin/fetchHelpId",method:"post",data:{id:t}})}function H(t,n,e){return Object(r["a"])({url:"/admin/updataHelp",method:"post",data:{id:t,title:n,content:e}})}function N(t){return Object(r["a"])({url:"/admin/fetchFeed",method:"get",params:t})}function W(t){return Object(r["a"])({url:"/admin/fetchDelFeed",method:"post",data:{id:t}})}function G(t){return Object(r["a"])({url:"/admin/fetchFeedId",method:"post",data:{id:t}})}function Q(t,n,e){return Object(r["a"])({url:"/admin/createFoot",method:"post",data:{title:t,content:n,type_id:e}})}function T(t){return Object(r["a"])({url:"/admin/fetchFoot",method:"get",params:t})}function E(t){return Object(r["a"])({url:"/admin/fetchDelFoot",method:"post",data:{id:t}})}function J(t){return Object(r["a"])({url:"/admin/fetchFootId",method:"post",data:{id:t}})}function z(t,n,e,u){return Object(r["a"])({url:"/admin/updataFoot",method:"post",data:{id:t,title:n,content:e,type_id:u}})}function K(t){return Object(r["a"])({url:"/admin/fetchWithdrawal",method:"get",params:t})}function R(t){return Object(r["a"])({url:"/admin/acceptWithdrawal",method:"post",data:{id:t}})}function X(t){return Object(r["a"])({url:"/admin/refuseWithdrawal",method:"post",data:{id:t}})}function Y(t){return Object(r["a"])({url:"/admin/delsWithdrawal",method:"post",data:{id:t}})}function Z(t){return Object(r["a"])({url:"/admin/fetchBanner",method:"get",params:{banner_type:t}})}function tt(t){return Object(r["a"])({url:"/admin/fetchDelBanner",method:"post",data:{id:t}})}function nt(t){return Object(r["a"])({url:"/admin/fetchUpdataBanner",method:"post",data:{banners:t}})}function et(){return Object(r["a"])({url:"/admin/fetchCateOrid",method:"get"})}function rt(t){return Object(r["a"])({url:"/admin/UpdataCates",method:"post",data:{cates:t}})}function ut(){return Object(r["a"])({url:"/admin/fetchLayout",method:"get"})}function at(t,n){return Object(r["a"])({url:"/admin/fetchUpLayout",method:"post",data:{hidelist:t,showlist:n}})}function ot(t,n,e,u){return Object(r["a"])({url:"/admin/resetPassword",method:"post",data:{token:t,password:n,tpassword:e,trpassword:u}})}function dt(){return Object(r["a"])({url:"/admin/fetchTopurl",method:"get"})}function it(t){return Object(r["a"])({url:"/admin/fetchUpdataTopurl",method:"post",data:{query:t}})}function ct(t){return Object(r["a"])({url:"/admin/fetchDelTopurl",method:"post",data:{id:t}})}function ft(t){return Object(r["a"])({url:"/admin/fetchComment",method:"get",params:t})}function st(t){return Object(r["a"])({url:"/admin/fetchDelComment",method:"post",data:{id:t}})}function mt(t){return Object(r["a"])({url:"/admin/fetchCommentId",method:"post",data:{id:t}})}function lt(t){return Object(r["a"])({url:"/admin/PassCommentId",method:"post",data:{id:t}})}function ht(t){return Object(r["a"])({url:"/admin/FailCommentId",method:"post",data:{id:t}})}function pt(t){return Object(r["a"])({url:"/admin/deleteListComment",method:"post",data:{allId:t}})}function bt(t,n,e,u){return Object(r["a"])({url:"/admin/fetchCreateSpecial",method:"post",data:{name:t,other:n,description:e,cover:u}})}function Ot(t){return Object(r["a"])({url:"/admin/fetchSpecial",method:"get",params:t})}function jt(t){return Object(r["a"])({url:"/admin/fetchDelSpe",method:"post",data:{id:t}})}function gt(t){return Object(r["a"])({url:"/admin/fetchSpeId",method:"post",data:{id:t}})}function wt(t,n,e,u,a){return Object(r["a"])({url:"/admin/fetchUpdataSpe",method:"post",data:{id:t,name:n,other:e,description:u,cover:a}})}function Ft(){return Object(r["a"])({url:"/admin/fetchFeedMeta",method:"get"})}function kt(t){return Object(r["a"])({url:"/admin/fetchUpFeedMeta",method:"post",data:{feeds:t}})}function yt(t){return Object(r["a"])({url:"/admin/fetchDelFeeds",method:"post",data:{ids:t}})}function Ct(t){return Object(r["a"])({url:"/admin/fetchVerify",method:"get",params:t})}function Dt(t){return Object(r["a"])({url:"/admin/acceptVerify",method:"post",data:{id:t}})}function Ut(t){return Object(r["a"])({url:"/admin/refuseVerify",method:"post",data:{id:t}})}function vt(t){return Object(r["a"])({url:"/admin/delsVerify",method:"post",data:{id:t}})}function It(t){return Object(r["a"])({url:"/admin/fetchAuthUser",method:"get",params:t})}function Vt(t){return Object(r["a"])({url:"/admin/acceptAuthUser",method:"post",data:{id:t}})}function _t(t){return Object(r["a"])({url:"/admin/refuseAuthUser",method:"post",data:{id:t}})}function Lt(t){return Object(r["a"])({url:"/admin/delsAuthUser",method:"post",data:{id:t}})}function St(){return Object(r["a"])({url:"/admin/getChats",method:"post"})}function qt(t){return Object(r["a"])({url:"/admin/getPointChat",method:"post",data:{id:t}})}function At(t){return Object(r["a"])({url:"/admin/delPointChat",method:"post",data:{id:t}})}}}]);