(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-11177076"],{"16fc":function(t,i,e){"use strict";e.r(i);var n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"components-container"},[t._m(0),e("div",{staticClass:"editor-container"},[e("dnd-list",{attrs:{list1:t.list1,list2:t.list2,"list1-title":"List","list2-title":"Article pool"}})],1)])},a=[function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("aside",[t._v("drag-list base on "),e("a",{attrs:{href:"https://github.com/SortableJS/Vue.Draggable",target:"_blank"}},[t._v("Vue.Draggable")])])}],s=(e("a434"),function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{staticClass:"dndList"},[e("div",{staticClass:"dndList-list",style:{width:t.width1}},[e("h3",[t._v(t._s(t.list1Title))]),e("draggable",{staticClass:"dragArea",attrs:{"set-data":t.setData,list:t.list1,group:"article"}},t._l(t.list1,(function(i){return e("div",{key:i.id,staticClass:"list-complete-item"},[e("div",{staticClass:"list-complete-item-handle"},[t._v(" "+t._s(i.id)+"["+t._s(i.author)+"] "+t._s(i.title)+" ")]),e("div",{staticStyle:{position:"absolute",right:"0px"}},[e("span",{staticStyle:{float:"right","margin-top":"-20px","margin-right":"5px"},on:{click:function(e){return t.deleteEle(i)}}},[e("i",{staticClass:"el-icon-delete",staticStyle:{color:"#ff4949"}})])])])})),0)],1),e("div",{staticClass:"dndList-list",style:{width:t.width2}},[e("h3",[t._v(t._s(t.list2Title))]),e("draggable",{staticClass:"dragArea",attrs:{list:t.list2,group:"article"}},t._l(t.list2,(function(i){return e("div",{key:i.id,staticClass:"list-complete-item"},[e("div",{staticClass:"list-complete-item-handle2",on:{click:function(e){return t.pushEle(i)}}},[t._v(" "+t._s(i.id)+" ["+t._s(i.author)+"] "+t._s(i.title)+" ")])])})),0)],1)])}),r=[],l=e("b85c"),u=e("1980"),c=e.n(u),o={name:"DndList",components:{draggable:c.a},props:{list1:{type:Array,default:function(){return[]}},list2:{type:Array,default:function(){return[]}},list1Title:{type:String,default:"list1"},list2Title:{type:String,default:"list2"},width1:{type:String,default:"48%"},width2:{type:String,default:"48%"}},methods:{isNotInList1:function(t){return this.list1.every((function(i){return t.id!==i.id}))},isNotInList2:function(t){return this.list2.every((function(i){return t.id!==i.id}))},deleteEle:function(t){var i,e=Object(l["a"])(this.list1);try{for(e.s();!(i=e.n()).done;){var n=i.value;if(n.id===t.id){var a=this.list1.indexOf(n);this.list1.splice(a,1);break}}}catch(s){e.e(s)}finally{e.f()}this.isNotInList2(t)&&this.list2.unshift(t)},pushEle:function(t){var i,e=Object(l["a"])(this.list2);try{for(e.s();!(i=e.n()).done;){var n=i.value;if(n.id===t.id){var a=this.list2.indexOf(n);this.list2.splice(a,1);break}}}catch(s){e.e(s)}finally{e.f()}this.isNotInList1(t)&&this.list1.push(t)},setData:function(t){t.setData("Text","")}}},d=o,f=(e("7f49"),e("2877")),p=Object(f["a"])(d,s,r,!1,null,"005c1ad2",null),h=p.exports,m=e("2423"),_={name:"DndListDemo",components:{DndList:h},data:function(){return{list1:[],list2:[]}},created:function(){this.getData()},methods:{getData:function(){var t=this;this.listLoading=!0,Object(m["j"])().then((function(i){t.list1=i.data.items.splice(0,5),t.list2=i.data.items}))}}},b=_,g=Object(f["a"])(b,n,a,!1,null,null,null);i["default"]=g.exports},2423:function(t,i,e){"use strict";e.d(i,"l",(function(){return a})),e.d(i,"j",(function(){return s})),e.d(i,"k",(function(){return r})),e.d(i,"b",(function(){return l})),e.d(i,"a",(function(){return u})),e.d(i,"d",(function(){return c})),e.d(i,"c",(function(){return o})),e.d(i,"i",(function(){return d})),e.d(i,"h",(function(){return f})),e.d(i,"n",(function(){return p})),e.d(i,"p",(function(){return h})),e.d(i,"r",(function(){return m})),e.d(i,"o",(function(){return _})),e.d(i,"q",(function(){return b})),e.d(i,"g",(function(){return g})),e.d(i,"f",(function(){return v}));var n=e("b775");function a(){return Object(n["a"])({url:"/admin/portal",method:"get"})}function s(t){return Object(n["a"])({url:"/admin/list",method:"get",params:t})}function r(t){return Object(n["a"])({url:"/admin/list_two",method:"get",params:t})}function l(t){return Object(n["a"])({url:"/admin/PassPostId",method:"post",data:{id:t}})}function u(t){return Object(n["a"])({url:"/admin/FailPostId",method:"post",data:{id:t}})}function c(t,i){return Object(n["a"])({url:"/admin/SelectCate",method:"post",data:{id:t,query:i}})}function o(t,i){return Object(n["a"])({url:"/admin/SearchPost",method:"post",data:{content:t,query:i}})}function d(t){return Object(n["a"])({url:"/admin/del_detail",method:"post",data:{id:t}})}function f(t,i,e,a,s,r,l,u,c,o,d,f,p,h,m,_,b){return Object(n["a"])({url:"/admin/create_post",method:"post",data:{title:t,author:i,content:e,price:a,vip_price:s,tags:r,cate_id:l,isvip_level:u,web_url:c,dw_url:o,style_type:d,traction:f,trac:p,cover:h,special:m,integral:_,status:b}})}function p(t,i,e,a,s,r,l,u,c,o,d,f,p,h,m,_,b,g){return Object(n["a"])({url:"/admin/update_post",method:"post",data:{id:t,title:i,author:e,content:a,price:s,vip_price:r,tags:l,cate_id:u,isvip_level:c,web_url:o,dw_url:d,style_type:f,traction:p,trac:h,cover:m,special:_,integral:b,status:g}})}function h(){return Object(n["a"])({url:"/admin/get_cate",method:"post"})}function m(){return Object(n["a"])({url:"/admin/get_vip",method:"post"})}function _(){return Object(n["a"])({url:"/admin/get_author",method:"post"})}function b(){return Object(n["a"])({url:"/admin/get_special",method:"post"})}function g(t){return Object(n["a"])({url:"/admin/fetchArticle",method:"post",data:{ids:t}})}function v(t){return Object(n["a"])({url:"/admin/deleteListPost",method:"post",data:{allId:t}})}},"7f49":function(t,i,e){"use strict";e("b447")},b447:function(t,i,e){}}]);