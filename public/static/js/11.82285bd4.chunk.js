(this["webpackJsonpberry-material-react-free"]=this["webpackJsonpberry-material-react-free"]||[]).push([[11],{217:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var a=n(62),r=n(45),c=n.n(r),i=n(94);function o(e,t){return u.apply(this,arguments)}function u(){return(u=Object(a.a)(c.a.mark((function e(t,n){var a,r,o;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:for(a=new FormData,r=0;r<t.length;r+=1)o=t[r].name.split(".").at(-1),a.append("file".concat(r),t[r],"".concat(n[r],".").concat(o));return e.next=4,fetch("".concat("https://college.studywoo.com/api","/file"),{method:"post",headers:{Authorization:"Bearer ".concat(Object(i.a)())},body:a});case 4:if(200!==e.sent.status){e.next=7;break}return e.abrupt("return",!0);case 7:return e.abrupt("return",null);case 8:case"end":return e.stop()}}),e)})))).apply(this,arguments)}},220:function(e,t,n){"use strict";n.d(t,"a",(function(){return P}));var a=n(4),r=n(15),c=n(8),i=n(46),o=n(0),u=n(524),l=n(534),s=n(61),d=n(521),f=n(520),b=n(531),p=n(533),j=n(526),h=n(227),O=n(234),g=n(62),m=n(45),v=n.n(m);function x(e,t){return w.apply(this,arguments)}function w(){return w=Object(g.a)(v.a.mark((function e(t,n){var a,r,i,o=arguments;return v.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return a=o.length>2&&void 0!==o[2]?o[2]:"",e.prev=1,e.next=4,fetch("".concat("https://college.studywoo.com/api").concat(n,"?text=").concat(a));case 4:if(200!==(r=e.sent).status){e.next=11;break}return e.next=8,r.json();case 8:r=e.sent,e.next=12;break;case 11:r=null;case 12:e.next=17;break;case 14:return e.prev=14,e.t0=e.catch(1),e.abrupt("return",e.t0);case 17:return r?(i=r.map((function(e){return{label:e[0],id:e[1]}})),t((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:i})}))):t((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:[]})})),e.abrupt("return",null);case 19:case"end":return e.stop()}}),e,null,[[1,14]])}))),w.apply(this,arguments)}var y=n(1),k=["children","role"],C=Object(o.forwardRef)((function(e,t){var n=e.children,a=e.role,r=Object(i.a)(e,k),u=Array.isArray(n)?n.length:0;return Object(y.jsx)("div",{ref:t,children:Object(y.jsx)("div",Object(c.a)(Object(c.a)({},r),{},{children:Object(y.jsx)(O.a,{height:250,width:300,rowHeight:100,overscanCount:5,rowCount:u,rowRenderer:function(e){return Object(o.cloneElement)(n[e.index],{style:e.style})},role:a})}))})})),S=function(e){var t=e.value,n=e.setValue,i=e.fieldName,u=Object(o.useState)(!0),l=Object(r.a)(u,2),s=l[0],d=l[1],f=Object(o.useRef)(null);return Object(y.jsxs)(y.Fragment,{children:[s&&Object(y.jsx)(j.a,{animation:"wave",variant:"rectangular",width:"100%",height:100}),Object(y.jsx)(h.a,{apiKey:"y3kp7mlgbxbgmzn0tjxko3tsgmr6cf5v2i201a4xydpmtcix",onInit:function(e,t){d(!1),f.current=t},onEditorChange:function(e){n((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(a.a)({},i,e))}))},value:t,init:{width:"100%",mobile:{menubar:!0,toolbar_mode:"sliding",theme:"mobile"},selector:"textarea#image-tools",height:500,convert_urls:!1,plugins:["advlist autolink lists link image charmap print preview anchor","searchreplace visualblocks code fullscreen","insertdatetime media table paste imagetools wordcount"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",content_style:"body { font-family:Helvetica,Arial,sans-serif; font-size:14px }"}})]})};function P(e){var t,n,i,j=e.row,h=e.setFields,O=e.fields,g=Object(o.useRef)(null),m=Object(o.useState)({isOpen:!1,options:[],url:"",label:""}),v=Object(r.a)(m,2),w=v[0],k=v[1],P=w.isOpen&&0===w.options.length;return Object(o.useEffect)((function(){P&&x(k,w.url)}),[P,w.url]),Object(o.useEffect)((function(){j.options&&("string"===typeof j.options&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{url:j.options})})),"object"===typeof j.options&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:j.options})})))}),[w.isOpen]),Object(o.useEffect)((function(){w.label.length>0&&j.lazyLoad&&(k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!0})})),g.current&&clearTimeout(g.current),g.current=setTimeout((function(){x(k,w.url,w.label)}),1200))}),[w.label]),"boolean"===j.type?Object(y.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(y.jsx)(p.a,{sx:{marginLeft:1},control:Object(y.jsx)(d.a,{onChange:function(e){h((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(a.a)({},j.field,e.target.checked))}))}}),label:j.field,labelPlacement:"end"})}):"file"===j.type?Object(y.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(y.jsx)(l.a,{onChange:function(e){h((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(a.a)({},j.field,e.target.files))}))},id:j.field,helperText:j.headerName,variant:"outlined",type:"file",inputProps:{multiple:null===(n=null===j||void 0===j?void 0:j.multiple)||void 0===n||n}})}):"search"===j.type?Object(y.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(y.jsx)(f.a,{defaultValue:null===O||void 0===O?void 0:O[j.field],multiple:j.multiple,sx:{width:"100%"},open:w.isOpen,onOpen:function(){(!j.lazyLoad||w.options.length>0)&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!0})}))},onClose:function(){k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!1})}))},options:w.options,loading:P,onChange:function(e,t){if(j.multiple||h((function(e){return Object(c.a)(Object(c.a)({},e),{},Object(a.a)({},j.field,null===t||void 0===t?void 0:t.id))})),j.multiple){var n=t.map((function(e){return function(e,t){if("object"===typeof e)return null===e||void 0===e?void 0:e.id;if("string"===typeof e&&t&&t.length>0){var n=t.filter((function(t){return t.label===e}));return Object(r.a)(n,1)[0].id}return null}(e,w.options)}));h((function(e){return Object(c.a)(Object(c.a)({},e),{},Object(a.a)({},j.field,n))}))}},onInputChange:function(e,t){k((function(e){return Object(c.a)(Object(c.a)({},e),{},{label:t})}))},ListboxComponent:C,renderInput:function(e){return Object(y.jsx)(l.a,Object(c.a)(Object(c.a)({},e),{},{label:j.headerName,InputProps:Object(c.a)(Object(c.a)({},e.InputProps),{},{endAdornment:Object(y.jsxs)(y.Fragment,{children:[P?Object(y.jsx)(b.a,{color:"inherit",size:20}):null,e.InputProps.endAdornment]})})}))}})}):"date"===j.type?Object(y.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(y.jsx)(l.a,{label:j.headerName,type:"date",value:null!==(i=null===O||void 0===O?void 0:O[j.field])&&void 0!==i?i:"",onChange:function(e){return h((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(a.a)({},j.field,e.target.value))}))},sx:{width:220},InputLabelProps:{shrink:!0}})}):"freeText"===j.type?Object(y.jsxs)(u.a,{disablePadding:!0,sx:{my:2,display:"flex",flexDirection:"column",alignItems:"flex-start"},children:[Object(y.jsx)(s.a,{variant:"h4",sx:{color:"gray",mb:2,ml:1.5},children:j.headerName}),Object(y.jsx)(S,{value:null===O||void 0===O?void 0:O[j.field],setValue:h,fieldName:j.field})]}):Object(y.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(y.jsx)(l.a,{fullWidth:!0,value:null!==(t=null===O||void 0===O?void 0:O[j.field])&&void 0!==t?t:"",onChange:function(e){h((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(a.a)({},j.field,e.target.value))}))},label:j.headerName,type:"text",variant:"outlined"})})}},221:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var a=function(){for(var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:8,t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",n="",a=0;a<e;a+=1)n+=t.charAt(Math.floor(Math.random()*t.length));return n};function r(e){var t=Array.from(e),n=[];return t.forEach((function(){var e=a(20);n.push("".concat(e))})),n}},222:function(e,t,n){},223:function(e,t,n){"use strict";n.d(t,"a",(function(){return T}));var a=n(17),r=n(62),c=n(8),i=n(15),o=n(45),u=n.n(o),l=n(0),s=n(204),d=n(61),f=n(525),b=n(213),p=n(531),j=n(220);var h=n(1);function O(e){var t=e.submit,n=e.columns,a=e.fields,r=e.setFields,o=e.closePage,u=e.CustomInput,s=void 0===u?null:u,d=e.customInputProps,O=void 0===d?null:d,g=Object(l.useState)(!1),m=Object(i.a)(g,2),v=m[0],x=m[1],w=Object(l.useRef)(a);return Object(h.jsxs)(h.Fragment,{children:[Object(h.jsx)(b.a,{children:n.map((function(e){return"custom"===e.field?Object(h.jsx)(s,Object(c.a)(Object(c.a)({},O),{},{row:a}),"customInput"):"id"===e.field||e.lock?null:Object(h.jsx)(j.a,{row:e,setFields:r,fields:a},e.field)}))}),Object(h.jsxs)("div",{style:{width:"100%",display:"flex",alignItems:"center",justifyContent:"space-between"},children:[Object(h.jsxs)(f.a,{disabled:v,sx:{color:"secondary.dark",backgroundColor:"white",position:"relative",my:2,"&:hover":{backgroundColor:"secondary.dark",color:"white"}},onClick:function(){x(!0);var e=w.current?function(e,t){var n=Object.keys(e),a=t,r={};return 0===n.length&&0===a.length?null:(n.map((function(n){return e[n]!==t[n]&&(r[n]=a[n]),!1})),r)}(w.current,a):a;a.isUpdate&&t(Object(c.a)(Object(c.a)({},e),{},{isUpdate:!0}),x),a.isUpdate||t(Object(c.a)(Object(c.a)({},e),{},{isUpdate:!1}),x)},children:["Save",v&&Object(h.jsx)(p.a,{size:24,sx:{position:"absolute",top:"50%",left:"50%",marginTop:"-12px",marginLeft:"-12px"}})]}),Object(h.jsx)(f.a,{sx:{my:2,color:"secondary.dark",backgroundColor:"white","&:hover":{backgroundColor:"secondary.dark",color:"white"}},onClick:function(){r(null),o()},children:"Cancel"})]})]})}var g=n(233),m=n(95),v=n(226),x=n.n(v),w=n(225),y=n.n(w);n(222);var k=function(e){var t=e.columns,n=e.rows,r=e.dataHandler,i=e.paginate,o=e.rowsState,u=e.setRowsState,l=e.deleteHandler,s=e.editHandler,d=e.edit,f=e.destroy,b=e.selection,p=e.serverFiltering,j=e.filterModelChangeHandler,O=void 0===j?null:j;function v(){var e;return Object(h.jsxs)(g.d,{children:[Object(h.jsx)(g.c,{}),Object(h.jsx)(g.f,{}),"Admin"===(null===(e=Object(m.b)())||void 0===e?void 0:e.roles)&&Object(h.jsx)(g.e,{})]})}return t=[{field:"actions",type:"actions",width:80,getActions:function(e){var t=[];return d&&t.push(Object(h.jsx)(g.b,{icon:Object(h.jsx)(y.a,{}),label:"Edit",onClick:function(){return s(e)}})),f&&t.push(Object(h.jsx)(g.b,{icon:Object(h.jsx)(x.a,{}),label:"Delete",onClick:function(){return l(e)}})),t}}].concat(Object(a.a)(t)),Object(h.jsx)(h.Fragment,{children:i?Object(h.jsx)("div",{style:{height:600,width:"100%"},children:Object(h.jsx)(g.a,Object(c.a)(Object(c.a)({sx:{backgroundColor:"white"},rows:n,columns:t,pageSize:o.pageSize,rowsPerPageOptions:[o.pageSize],checkboxSelection:b,onSelectionModelChange:r,components:{Toolbar:v},pagination:!0,rowCount:o.count},o),{},{paginationMode:"server",onPageChange:function(e){return u((function(t){return Object(c.a)(Object(c.a)({},t),{},{page:e})}))},onPageSizeChange:function(e){return u((function(t){return Object(c.a)(Object(c.a)({},t),{},{pageSize:e})}))},filterMode:p?"server":"client",onFilterModelChange:p?O:null}))}):Object(h.jsx)("div",{style:{height:600,width:"100%"},children:Object(h.jsx)(g.a,{sx:{backgroundColor:"white"},rows:n,columns:t,loading:o.loading,pageSize:o.pageSize,rowsPerPageOptions:[o.pageSize],checkboxSelection:b,onSelectionModelChange:r,components:{Toolbar:v},filterMode:p?"server":"client",onFilterModelChange:p?O:null})})})},C=n(28),S=n(94),P=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n={};return Object.entries(e).forEach((function(e){n[e[0]]=e[1]})),t&&(n.rows=t),n},N=function(e,t){var n={};return t.forEach((function(t){"boolean"!==t.type||"0"!==e[t.field]&&""!==e[t.field]&&0!==e[t.field]?n[t.field]=e[t.field]:n[t.field]=!1})),n},A=function(){var e=Object(r.a)(u.a.mark((function e(t,n,a,r){var c,i,o,l=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return c=l.length>4&&void 0!==l[4]?l[4]:null,o="post",n.isUpdate?(o="put",i=P(n,r)):i=P(n),e.next=5,fetch(t,{method:o,headers:{Authorization:"Bearer ".concat(Object(S.a)()),"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify(i)});case 5:200!==e.sent.status&&alert("Unexpected error ocurred!"),c();case 8:case"end":return e.stop()}}),e)})));return function(t,n,a,r){return e.apply(this,arguments)}}(),z=function(){var e=Object(r.a)(u.a.mark((function e(t,n){var a;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,fetch("".concat(t,"?page=").concat(n),{headers:{Authorization:"Bearer ".concat(Object(S.a)())}});case 2:if(200!==(a=e.sent).status){e.next=9;break}return e.next=6,a.json();case 6:a=e.sent,e.next=10;break;case 9:a=[[],0];case 10:return e.abrupt("return",a);case 11:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),F=function(){var e=Object(r.a)(u.a.mark((function e(t,n,a){var r,o,l,s,d,f,b,p=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(r=p.length>3&&void 0!==p[3]?p[3]:null,p.length>4&&void 0!==p[4]&&p[4]){e.next=14;break}return e.next=5,fetch(t,{headers:{Authorization:"Bearer ".concat(Object(S.a)()),Accept:"application/json"}});case 5:if(200!==(o=e.sent).status){e.next=12;break}return e.next=9,o.json();case 9:o=e.sent,l=o.map((function(e){return N(e,n)})),a((function(e){return Object(c.a)(Object(c.a)({},e),{},{rows:l})}));case 12:return a((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!1})})),e.abrupt("return",!0);case 14:return e.next=16,z(t,r.page);case 16:return s=e.sent,d=Object(i.a)(s,2),f=d[0],b=d[1],a((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!1,rows:f,count:b})})),e.abrupt("return",!0);case 22:case"end":return e.stop()}}),e)})));return function(t,n,a){return e.apply(this,arguments)}}(),I=function(){var e=Object(r.a)(u.a.mark((function e(t,n){var a,r,c=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return a=c.length>2&&void 0!==c[2]?c[2]:null,r=n,e.next=4,fetch(t,{method:"delete",headers:{Authorization:"Bearer ".concat(Object(S.a)()),"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify({rows:r})});case 4:200!==e.sent.status&&alert("Unexpected error ocurred!"),a();case 7:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),M=n(217),E=n(221);function T(e){var t=e.columns,n=e.url,o=e.title,b=e.paginate,p=void 0!==b&&b,j=e.CustomInput,g=void 0===j?null:j,m=e.customInputProps,v=void 0===m?null:m,x=e.create,w=void 0===x||x,y=e.edit,S=void 0===y||y,P=e.destroy,N=void 0===P||P,z=e.selection,T=void 0===z||z,H=e.serverFiltering,R=void 0!==H&&H,U=Object(l.useRef)({isMounted:!1,prevPage:0}),L=Object(l.useState)(null),B=Object(i.a)(L,2),D=B[0],J=B[1],_=Object(l.useState)(null),V=Object(i.a)(_,2),q=V[0],G=V[1],K=Object(l.useState)(!0),W=Object(i.a)(K,2),Y=W[0],Q=W[1],X=Object(l.useState)({page:0,pageSize:50,rows:[],loading:!0,count:0,paginate:p}),Z=Object(i.a)(X,2),$=Z[0],ee=Z[1],te=Object(l.useState)(),ne=Object(i.a)(te,2),ae=ne[0],re=ne[1],ce=Object(l.useState)(!1),ie=Object(i.a)(ce,2),oe=ie[0],ue=ie[1],le=Object(l.useRef)(!0);Object(l.useEffect)((function(){U.current.isMounted?$.paginate&&!$.loading&&U.current.prevPage!==$.page?(U.current.prevPage=$.page,ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})}))):$.loading&&!oe&&F(n,t,ee,$,$.paginate):(U.current.isMounted=!0,F(n,t,ee,$,$.paginate))}),[$.page,$.paginate,$.loading,oe]),Object(l.useEffect)((function(){var e=!0;if(!le.current)return Object(r.a)(u.a.mark((function a(){return u.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:if(ue(!0),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{paginate:!1,loading:!0})})),e){a.next=4;break}return a.abrupt("return");case 4:return a.next=6,F("".concat(n,"?q=").concat(ae),t,ee);case 6:case"end":return a.stop()}}),a)})))(),function(){e=!1};le.current=!1}),[ae,t,n]);var se=function(){var e=Object(r.a)(u.a.mark((function e(n,c){var o,l;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(o={files:[],names:[]},l=Object.entries(t),e.prev=2,l.forEach(function(){var e=Object(r.a)(u.a.mark((function e(t){var r,c,l,s,d;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:r=Object(i.a)(t,2),r[0],"file"===(c=r[1]).type&&n[c.field]&&(d=Object(E.a)(n[c.field]),(l=o.files).push.apply(l,Object(a.a)(Array.from(n[c.field]))),(s=o.names).push.apply(s,Object(a.a)(d)),n[c.field]=d);case 2:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),!(o.files.length>0)){e.next=11;break}return e.next=7,Object(M.a)(o.files,o.names);case 7:e.sent&&c(),e.next=12;break;case 11:c();case 12:e.next=17;break;case 14:e.prev=14,e.t0=e.catch(2),alert("Failed to upload files");case 17:case"end":return e.stop()}}),e,null,[[2,14]])})));return function(t,n){return e.apply(this,arguments)}}(),de=function(){var e=Object(r.a)(u.a.mark((function e(a,r){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(console.log(a),!(Object.entries(a).length<=1)){e.next=3;break}return e.abrupt("return",alert("All fields are required"));case 3:return se(a,(function(){A(n,a,t,q,(function(){r(!1),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})})),Q(!0)}))})),e.abrupt("return",!0);case 5:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),fe=function(){var e=Object(r.a)(u.a.mark((function e(t){var n;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:J((function(e){return Object(c.a)(Object(c.a)({},e),t.row)})),n=[],null!==q&&q.includes(t.id)?n=Object(a.a)(q):n.push(t.id),G(n),J((function(e){return Object(c.a)(Object(c.a)({},e),{},{isUpdate:!0})})),Q(!1);case 6:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),be=function(){var e=Object(r.a)(u.a.mark((function e(t){var r;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(window.confirm("Confirm Delete!")){e.next=2;break}return e.abrupt("return",!1);case 2:return r=[],null!==q&&q.includes(t.id)?r=Object(a.a)(q):r.push(t.id),I(n,r,(function(){ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})})),Q(!0)})),e.abrupt("return",!0);case 6:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),pe=Object(l.useCallback)((function(e){oe&&void 0===e.items[0].value&&(ue(!1),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{paginate:p,loading:!0})}))),e.items[0].value&&re(e.items[0].value)}),[oe,p]);return Object(h.jsx)(h.Fragment,{children:Object(h.jsxs)(s.a,{container:!0,direction:"column",spacing:C.b,children:[Object(h.jsxs)(s.a,{item:!0,container:!0,justifyContent:"space-between",xs:12,children:[Object(h.jsx)(d.a,{sx:{color:"secondary.main"},variant:"h1",children:o}),w&&Object(h.jsxs)(f.a,{onClick:function(){J(null),Q(!1)},sx:{backgroundColor:"secondary.main",color:"white","&:hover":{backgroundColor:"secondary.light",color:"secondary.main"}},children:["Create New ",o]})]}),Object(h.jsx)(s.a,{item:!0,xs:12,children:Y?Object(h.jsx)(k,{columns:t,rows:$.rows,dataHandler:function(e){if(G(e),e.length>0){var t=$.rows.filter((function(t){return t.id===e[0]}));J(t[0])}},paginate:$.paginate,rowsState:$,setRowsState:ee,deleteHandler:be,editHandler:fe,edit:S,destroy:N,selection:T,serverFiltering:R,filterModelChangeHandler:pe}):Object(h.jsx)(O,{submit:de,columns:t,fields:D,setFields:J,closePage:function(){return Q(!0)},CustomInput:g,customInputProps:v})})]})})}},501:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return u}));var a=n(223),r=n(206),c=n(1),i=[{field:"id",headerName:"ID",width:70,type:"lock"},{field:"avatar",headerName:"Avatar",width:80,type:"file",renderCell:function(e){var t;return Object(c.jsx)(r.a,{src:e.value?"".concat("https://college.studywoo.com/","photos/").concat(e.value,".webp"):"https://ui-avatars.com/api/?name=".concat(null===(t=e.row)||void 0===t?void 0:t.name)})}},{field:"name",headerName:"Name",width:200},{field:"email",headerName:"Email",width:160},{field:"password",headerName:"Password",width:160},{field:"gender",headerName:"Gender",width:160,type:"search",options:[{id:"Male",label:"Male"},{id:"Female",label:"Female"},{id:"Other",label:"Other"}]},{field:"date_of_birth",headerName:"Date Of Birth",width:160,type:"date"},{field:"about",headerName:"About",type:"freeText",width:200},{field:"facebook",headerName:"Facebook",width:200},{field:"instagram",headerName:"Instagram",width:200},{field:"twitter",headerName:"Twitter",width:200},{field:"linkedin",headerName:"Linkedin",width:200},{field:"youtube",headerName:"Youtube",width:200}],o="".concat("https://college.studywoo.com/api","/managment/users-profile");function u(){return Object(c.jsx)(a.a,{columns:i,url:o,title:"Users Profiles",create:!1,destroy:!1})}}}]);
//# sourceMappingURL=11.82285bd4.chunk.js.map