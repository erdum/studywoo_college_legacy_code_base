(this["webpackJsonpberry-material-react-free"]=this["webpackJsonpberry-material-react-free"]||[]).push([[10],{217:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var r=n(62),a=n(45),c=n.n(a),i=n(94);function o(e,t){return u.apply(this,arguments)}function u(){return(u=Object(r.a)(c.a.mark((function e(t,n){var r,a,o;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:for(r=new FormData,a=0;a<t.length;a+=1)o=t[a].name.split(".").at(-1),r.append("file".concat(a),t[a],"".concat(n[a],".").concat(o));return e.next=4,fetch("".concat("https://college.studywoo.com/api","/file"),{method:"post",headers:{Authorization:"Bearer ".concat(Object(i.a)())},body:r});case 4:if(200!==e.sent.status){e.next=7;break}return e.abrupt("return",!0);case 7:return e.abrupt("return",null);case 8:case"end":return e.stop()}}),e)})))).apply(this,arguments)}},220:function(e,t,n){"use strict";n.d(t,"a",(function(){return P}));var r=n(4),a=n(15),c=n(8),i=n(46),o=n(0),u=n(524),s=n(534),l=n(61),d=n(521),f=n(520),b=n(531),j=n(533),p=n(526),O=n(227),h=n(234),v=n(62),g=n(45),x=n.n(g);function m(e,t){return y.apply(this,arguments)}function y(){return y=Object(v.a)(x.a.mark((function e(t,n){var r,a,i,o=arguments;return x.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=o.length>2&&void 0!==o[2]?o[2]:"",e.prev=1,e.next=4,fetch("".concat("https://college.studywoo.com/api").concat(n,"?text=").concat(r));case 4:if(200!==(a=e.sent).status){e.next=11;break}return e.next=8,a.json();case 8:a=e.sent,e.next=12;break;case 11:a=null;case 12:e.next=17;break;case 14:return e.prev=14,e.t0=e.catch(1),e.abrupt("return",e.t0);case 17:return a?(i=a.map((function(e){return{label:e[0],id:e[1]}})),t((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:i})}))):t((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:[]})})),e.abrupt("return",null);case 19:case"end":return e.stop()}}),e,null,[[1,14]])}))),y.apply(this,arguments)}var w=n(1),k=["children","role"],C=Object(o.forwardRef)((function(e,t){var n=e.children,r=e.role,a=Object(i.a)(e,k),u=Array.isArray(n)?n.length:0;return Object(w.jsx)("div",{ref:t,children:Object(w.jsx)("div",Object(c.a)(Object(c.a)({},a),{},{children:Object(w.jsx)(h.a,{height:250,width:300,rowHeight:100,overscanCount:5,rowCount:u,rowRenderer:function(e){return Object(o.cloneElement)(n[e.index],{style:e.style})},role:r})}))})})),S=function(e){var t=e.value,n=e.setValue,i=e.fieldName,u=Object(o.useState)(!0),s=Object(a.a)(u,2),l=s[0],d=s[1],f=Object(o.useRef)(null);return Object(w.jsxs)(w.Fragment,{children:[l&&Object(w.jsx)(p.a,{animation:"wave",variant:"rectangular",width:"100%",height:100}),Object(w.jsx)(O.a,{apiKey:"y3kp7mlgbxbgmzn0tjxko3tsgmr6cf5v2i201a4xydpmtcix",onInit:function(e,t){d(!1),f.current=t},onEditorChange:function(e){n((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(r.a)({},i,e))}))},value:t,init:{width:"100%",mobile:{menubar:!0,toolbar_mode:"sliding",theme:"mobile"},selector:"textarea#image-tools",height:500,convert_urls:!1,plugins:["advlist autolink lists link image charmap print preview anchor","searchreplace visualblocks code fullscreen","insertdatetime media table paste imagetools wordcount"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",content_style:"body { font-family:Helvetica,Arial,sans-serif; font-size:14px }"}})]})};function P(e){var t,n,i,p=e.row,O=e.setFields,h=e.fields,v=Object(o.useRef)(null),g=Object(o.useState)({isOpen:!1,options:[],url:"",label:""}),x=Object(a.a)(g,2),y=x[0],k=x[1],P=y.isOpen&&0===y.options.length;return Object(o.useEffect)((function(){P&&m(k,y.url)}),[P,y.url]),Object(o.useEffect)((function(){p.options&&("string"===typeof p.options&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{url:p.options})})),"object"===typeof p.options&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{options:p.options})})))}),[y.isOpen]),Object(o.useEffect)((function(){y.label.length>0&&p.lazyLoad&&(k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!0})})),v.current&&clearTimeout(v.current),v.current=setTimeout((function(){m(k,y.url,y.label)}),1200))}),[y.label]),"boolean"===p.type?Object(w.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(w.jsx)(j.a,{sx:{marginLeft:1},control:Object(w.jsx)(d.a,{onChange:function(e){O((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(r.a)({},p.field,e.target.checked))}))}}),label:p.field,labelPlacement:"end"})}):"file"===p.type?Object(w.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(w.jsx)(s.a,{onChange:function(e){O((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(r.a)({},p.field,e.target.files))}))},id:p.field,helperText:p.headerName,variant:"outlined",type:"file",inputProps:{multiple:null===(n=null===p||void 0===p?void 0:p.multiple)||void 0===n||n}})}):"search"===p.type?Object(w.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(w.jsx)(f.a,{defaultValue:null===h||void 0===h?void 0:h[p.field],multiple:p.multiple,sx:{width:"100%"},open:y.isOpen,onOpen:function(){(!p.lazyLoad||y.options.length>0)&&k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!0})}))},onClose:function(){k((function(e){return Object(c.a)(Object(c.a)({},e),{},{isOpen:!1})}))},options:y.options,loading:P,onChange:function(e,t){if(p.multiple||O((function(e){return Object(c.a)(Object(c.a)({},e),{},Object(r.a)({},p.field,null===t||void 0===t?void 0:t.id))})),p.multiple){var n=t.map((function(e){return function(e,t){if("object"===typeof e)return null===e||void 0===e?void 0:e.id;if("string"===typeof e&&t&&t.length>0){var n=t.filter((function(t){return t.label===e}));return Object(a.a)(n,1)[0].id}return null}(e,y.options)}));O((function(e){return Object(c.a)(Object(c.a)({},e),{},Object(r.a)({},p.field,n))}))}},onInputChange:function(e,t){k((function(e){return Object(c.a)(Object(c.a)({},e),{},{label:t})}))},ListboxComponent:C,renderInput:function(e){return Object(w.jsx)(s.a,Object(c.a)(Object(c.a)({},e),{},{label:p.headerName,InputProps:Object(c.a)(Object(c.a)({},e.InputProps),{},{endAdornment:Object(w.jsxs)(w.Fragment,{children:[P?Object(w.jsx)(b.a,{color:"inherit",size:20}):null,e.InputProps.endAdornment]})})}))}})}):"date"===p.type?Object(w.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(w.jsx)(s.a,{label:p.headerName,type:"date",value:null!==(i=null===h||void 0===h?void 0:h[p.field])&&void 0!==i?i:"",onChange:function(e){return O((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(r.a)({},p.field,e.target.value))}))},sx:{width:220},InputLabelProps:{shrink:!0}})}):"freeText"===p.type?Object(w.jsxs)(u.a,{disablePadding:!0,sx:{my:2,display:"flex",flexDirection:"column",alignItems:"flex-start"},children:[Object(w.jsx)(l.a,{variant:"h4",sx:{color:"gray",mb:2,ml:1.5},children:p.headerName}),Object(w.jsx)(S,{value:null===h||void 0===h?void 0:h[p.field],setValue:O,fieldName:p.field})]}):Object(w.jsx)(u.a,{disablePadding:!0,sx:{my:2},children:Object(w.jsx)(s.a,{fullWidth:!0,value:null!==(t=null===h||void 0===h?void 0:h[p.field])&&void 0!==t?t:"",onChange:function(e){O((function(t){return Object(c.a)(Object(c.a)({},t),{},Object(r.a)({},p.field,e.target.value))}))},label:p.headerName,type:"text",variant:"outlined"})})}},221:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var r=function(){for(var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:8,t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",n="",r=0;r<e;r+=1)n+=t.charAt(Math.floor(Math.random()*t.length));return n};function a(e){var t=Array.from(e),n=[];return t.forEach((function(){var e=r(20);n.push("".concat(e))})),n}},222:function(e,t,n){},223:function(e,t,n){"use strict";n.d(t,"a",(function(){return H}));var r=n(17),a=n(62),c=n(8),i=n(15),o=n(45),u=n.n(o),s=n(0),l=n(204),d=n(61),f=n(525),b=n(213),j=n(531),p=n(220);var O=n(1);function h(e){var t=e.submit,n=e.columns,r=e.fields,a=e.setFields,o=e.closePage,u=e.CustomInput,l=void 0===u?null:u,d=e.customInputProps,h=void 0===d?null:d,v=Object(s.useState)(!1),g=Object(i.a)(v,2),x=g[0],m=g[1],y=Object(s.useRef)(r);return Object(O.jsxs)(O.Fragment,{children:[Object(O.jsx)(b.a,{children:n.map((function(e){return"custom"===e.field?Object(O.jsx)(l,Object(c.a)(Object(c.a)({},h),{},{row:r}),"customInput"):"id"===e.field||e.lock?null:Object(O.jsx)(p.a,{row:e,setFields:a,fields:r},e.field)}))}),Object(O.jsxs)("div",{style:{width:"100%",display:"flex",alignItems:"center",justifyContent:"space-between"},children:[Object(O.jsxs)(f.a,{disabled:x,sx:{color:"secondary.dark",backgroundColor:"white",position:"relative",my:2,"&:hover":{backgroundColor:"secondary.dark",color:"white"}},onClick:function(){m(!0);var e=y.current?function(e,t){var n=Object.keys(e),r=t,a={};return 0===n.length&&0===r.length?null:(n.map((function(n){return e[n]!==t[n]&&(a[n]=r[n]),!1})),a)}(y.current,r):r;r.isUpdate&&t(Object(c.a)(Object(c.a)({},e),{},{isUpdate:!0}),m),r.isUpdate||t(Object(c.a)(Object(c.a)({},e),{},{isUpdate:!1}),m)},children:["Save",x&&Object(O.jsx)(j.a,{size:24,sx:{position:"absolute",top:"50%",left:"50%",marginTop:"-12px",marginLeft:"-12px"}})]}),Object(O.jsx)(f.a,{sx:{my:2,color:"secondary.dark",backgroundColor:"white","&:hover":{backgroundColor:"secondary.dark",color:"white"}},onClick:function(){a(null),o()},children:"Cancel"})]})]})}var v=n(233),g=n(95),x=n(226),m=n.n(x),y=n(225),w=n.n(y);n(222);var k=function(e){var t=e.columns,n=e.rows,a=e.dataHandler,i=e.paginate,o=e.rowsState,u=e.setRowsState,s=e.deleteHandler,l=e.editHandler,d=e.edit,f=e.destroy,b=e.selection,j=e.serverFiltering,p=e.filterModelChangeHandler,h=void 0===p?null:p;function x(){var e;return Object(O.jsxs)(v.d,{children:[Object(O.jsx)(v.c,{}),Object(O.jsx)(v.f,{}),"Admin"===(null===(e=Object(g.b)())||void 0===e?void 0:e.roles)&&Object(O.jsx)(v.e,{})]})}return t=[{field:"actions",type:"actions",width:80,getActions:function(e){var t=[];return d&&t.push(Object(O.jsx)(v.b,{icon:Object(O.jsx)(w.a,{}),label:"Edit",onClick:function(){return l(e)}})),f&&t.push(Object(O.jsx)(v.b,{icon:Object(O.jsx)(m.a,{}),label:"Delete",onClick:function(){return s(e)}})),t}}].concat(Object(r.a)(t)),Object(O.jsx)(O.Fragment,{children:i?Object(O.jsx)("div",{style:{height:600,width:"100%"},children:Object(O.jsx)(v.a,Object(c.a)(Object(c.a)({sx:{backgroundColor:"white"},rows:n,columns:t,pageSize:o.pageSize,rowsPerPageOptions:[o.pageSize],checkboxSelection:b,onSelectionModelChange:a,components:{Toolbar:x},pagination:!0,rowCount:o.count},o),{},{paginationMode:"server",onPageChange:function(e){return u((function(t){return Object(c.a)(Object(c.a)({},t),{},{page:e})}))},onPageSizeChange:function(e){return u((function(t){return Object(c.a)(Object(c.a)({},t),{},{pageSize:e})}))},filterMode:j?"server":"client",onFilterModelChange:j?h:null}))}):Object(O.jsx)("div",{style:{height:600,width:"100%"},children:Object(O.jsx)(v.a,{sx:{backgroundColor:"white"},rows:n,columns:t,loading:o.loading,pageSize:o.pageSize,rowsPerPageOptions:[o.pageSize],checkboxSelection:b,onSelectionModelChange:a,components:{Toolbar:x},filterMode:j?"server":"client",onFilterModelChange:j?h:null})})})},C=n(28),S=n(94),P=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n={};return Object.entries(e).forEach((function(e){n[e[0]]=e[1]})),t&&(n.rows=t),n},z=function(e,t){var n={};return t.forEach((function(t){"boolean"!==t.type||"0"!==e[t.field]&&""!==e[t.field]&&0!==e[t.field]?n[t.field]=e[t.field]:n[t.field]=!1})),n},A=function(){var e=Object(a.a)(u.a.mark((function e(t,n,r,a){var c,i,o,s=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return c=s.length>4&&void 0!==s[4]?s[4]:null,o="post",n.isUpdate?(o="put",i=P(n,a)):i=P(n),e.next=5,fetch(t,{method:o,headers:{Authorization:"Bearer ".concat(Object(S.a)()),"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify(i)});case 5:200!==e.sent.status&&alert("Unexpected error ocurred!"),c();case 8:case"end":return e.stop()}}),e)})));return function(t,n,r,a){return e.apply(this,arguments)}}(),F=function(){var e=Object(a.a)(u.a.mark((function e(t,n){var r;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,fetch("".concat(t,"?page=").concat(n),{headers:{Authorization:"Bearer ".concat(Object(S.a)())}});case 2:if(200!==(r=e.sent).status){e.next=9;break}return e.next=6,r.json();case 6:r=e.sent,e.next=10;break;case 9:r=[[],0];case 10:return e.abrupt("return",r);case 11:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),I=function(){var e=Object(a.a)(u.a.mark((function e(t,n,r){var a,o,s,l,d,f,b,j=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(a=j.length>3&&void 0!==j[3]?j[3]:null,j.length>4&&void 0!==j[4]&&j[4]){e.next=14;break}return e.next=5,fetch(t,{headers:{Authorization:"Bearer ".concat(Object(S.a)()),Accept:"application/json"}});case 5:if(200!==(o=e.sent).status){e.next=12;break}return e.next=9,o.json();case 9:o=e.sent,s=o.map((function(e){return z(e,n)})),r((function(e){return Object(c.a)(Object(c.a)({},e),{},{rows:s})}));case 12:return r((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!1})})),e.abrupt("return",!0);case 14:return e.next=16,F(t,a.page);case 16:return l=e.sent,d=Object(i.a)(l,2),f=d[0],b=d[1],r((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!1,rows:f,count:b})})),e.abrupt("return",!0);case 22:case"end":return e.stop()}}),e)})));return function(t,n,r){return e.apply(this,arguments)}}(),M=function(){var e=Object(a.a)(u.a.mark((function e(t,n){var r,a,c=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=c.length>2&&void 0!==c[2]?c[2]:null,a=n,e.next=4,fetch(t,{method:"delete",headers:{Authorization:"Bearer ".concat(Object(S.a)()),"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify({rows:a})});case 4:200!==e.sent.status&&alert("Unexpected error ocurred!"),r();case 7:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),N=n(217),E=n(221);function H(e){var t=e.columns,n=e.url,o=e.title,b=e.paginate,j=void 0!==b&&b,p=e.CustomInput,v=void 0===p?null:p,g=e.customInputProps,x=void 0===g?null:g,m=e.create,y=void 0===m||m,w=e.edit,S=void 0===w||w,P=e.destroy,z=void 0===P||P,F=e.selection,H=void 0===F||F,R=e.serverFiltering,T=void 0!==R&&R,q=Object(s.useRef)({isMounted:!1,prevPage:0}),U=Object(s.useState)(null),L=Object(i.a)(U,2),D=L[0],B=L[1],_=Object(s.useState)(null),J=Object(i.a)(_,2),V=J[0],K=J[1],Q=Object(s.useState)(!0),W=Object(i.a)(Q,2),G=W[0],X=W[1],Y=Object(s.useState)({page:0,pageSize:50,rows:[],loading:!0,count:0,paginate:j}),Z=Object(i.a)(Y,2),$=Z[0],ee=Z[1],te=Object(s.useState)(),ne=Object(i.a)(te,2),re=ne[0],ae=ne[1],ce=Object(s.useState)(!1),ie=Object(i.a)(ce,2),oe=ie[0],ue=ie[1],se=Object(s.useRef)(!0);Object(s.useEffect)((function(){q.current.isMounted?$.paginate&&!$.loading&&q.current.prevPage!==$.page?(q.current.prevPage=$.page,ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})}))):$.loading&&!oe&&I(n,t,ee,$,$.paginate):(q.current.isMounted=!0,I(n,t,ee,$,$.paginate))}),[$.page,$.paginate,$.loading,oe]),Object(s.useEffect)((function(){var e=!0;if(!se.current)return Object(a.a)(u.a.mark((function r(){return u.a.wrap((function(r){for(;;)switch(r.prev=r.next){case 0:if(ue(!0),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{paginate:!1,loading:!0})})),e){r.next=4;break}return r.abrupt("return");case 4:return r.next=6,I("".concat(n,"?q=").concat(re),t,ee);case 6:case"end":return r.stop()}}),r)})))(),function(){e=!1};se.current=!1}),[re,t,n]);var le=function(){var e=Object(a.a)(u.a.mark((function e(n,c){var o,s;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(o={files:[],names:[]},s=Object.entries(t),e.prev=2,s.forEach(function(){var e=Object(a.a)(u.a.mark((function e(t){var a,c,s,l,d;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:a=Object(i.a)(t,2),a[0],"file"===(c=a[1]).type&&n[c.field]&&(d=Object(E.a)(n[c.field]),(s=o.files).push.apply(s,Object(r.a)(Array.from(n[c.field]))),(l=o.names).push.apply(l,Object(r.a)(d)),n[c.field]=d);case 2:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()),!(o.files.length>0)){e.next=11;break}return e.next=7,Object(N.a)(o.files,o.names);case 7:e.sent&&c(),e.next=12;break;case 11:c();case 12:e.next=17;break;case 14:e.prev=14,e.t0=e.catch(2),alert("Failed to upload files");case 17:case"end":return e.stop()}}),e,null,[[2,14]])})));return function(t,n){return e.apply(this,arguments)}}(),de=function(){var e=Object(a.a)(u.a.mark((function e(r,a){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(console.log(r),!(Object.entries(r).length<=1)){e.next=3;break}return e.abrupt("return",alert("All fields are required"));case 3:return le(r,(function(){A(n,r,t,V,(function(){a(!1),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})})),X(!0)}))})),e.abrupt("return",!0);case 5:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}(),fe=function(){var e=Object(a.a)(u.a.mark((function e(t){var n;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:B((function(e){return Object(c.a)(Object(c.a)({},e),t.row)})),n=[],null!==V&&V.includes(t.id)?n=Object(r.a)(V):n.push(t.id),K(n),B((function(e){return Object(c.a)(Object(c.a)({},e),{},{isUpdate:!0})})),X(!1);case 6:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),be=function(){var e=Object(a.a)(u.a.mark((function e(t){var a;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(window.confirm("Confirm Delete!")){e.next=2;break}return e.abrupt("return",!1);case 2:return a=[],null!==V&&V.includes(t.id)?a=Object(r.a)(V):a.push(t.id),M(n,a,(function(){ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{loading:!0})})),X(!0)})),e.abrupt("return",!0);case 6:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),je=Object(s.useCallback)((function(e){oe&&void 0===e.items[0].value&&(ue(!1),ee((function(e){return Object(c.a)(Object(c.a)({},e),{},{paginate:j,loading:!0})}))),e.items[0].value&&ae(e.items[0].value)}),[oe,j]);return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)(l.a,{container:!0,direction:"column",spacing:C.b,children:[Object(O.jsxs)(l.a,{item:!0,container:!0,justifyContent:"space-between",xs:12,children:[Object(O.jsx)(d.a,{sx:{color:"secondary.main"},variant:"h1",children:o}),y&&Object(O.jsxs)(f.a,{onClick:function(){B(null),X(!1)},sx:{backgroundColor:"secondary.main",color:"white","&:hover":{backgroundColor:"secondary.light",color:"secondary.main"}},children:["Create New ",o]})]}),Object(O.jsx)(l.a,{item:!0,xs:12,children:G?Object(O.jsx)(k,{columns:t,rows:$.rows,dataHandler:function(e){if(K(e),e.length>0){var t=$.rows.filter((function(t){return t.id===e[0]}));B(t[0])}},paginate:$.paginate,rowsState:$,setRowsState:ee,deleteHandler:be,editHandler:fe,edit:S,destroy:z,selection:H,serverFiltering:T,filterModelChangeHandler:je}):Object(O.jsx)(h,{submit:de,columns:t,fields:D,setFields:B,closePage:function(){return X(!0)},CustomInput:v,customInputProps:x})})]})})}},281:function(e,t,n){"use strict";var r=n(63);Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=r(n(64)),c=n(1),i=(0,a.default)((0,c.jsx)("path",{d:"M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"}),"Add");t.default=i},495:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return j}));var r=n(223),a=n(225),c=n.n(a),i=n(281),o=n.n(i),u=n(226),s=n.n(u),l=n(1),d=[{title:"Create New Faq",icon:Object(l.jsx)(o.a,{})},{title:"Delete Faq",icon:Object(l.jsx)(s.a,{})},{title:"Edit Faq",icon:Object(l.jsx)(c.a,{})}],f=[{field:"id",headerName:"ID",width:80},{field:"posted_on",headerName:"Posted On",width:200,type:"search",options:"/page-list",lazyLoad:!0},{field:"question",headerName:"Question",width:200},{field:"answer",headerName:"Answer",width:200}],b="".concat("https://college.studywoo.com/api","/managment/faq");function j(){return Object(l.jsx)(r.a,{columns:f,options:d,url:b,title:"Faqs"})}}}]);
//# sourceMappingURL=10.25197bc2.chunk.js.map