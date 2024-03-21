import{a as w,b as d,r as c,_ as h,j as e}from"./index.js";import{N as E}from"./NavigationLogin.js";import{g as C,a as k}from"./index-dd468b12.js";var A=function(a){return a.mesaage==="Error (auth/too-many-requests): Firebase: Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later. (auth/too-many-requests)."?"Access to this account has been temporarily disabled due to too many failed login attempts. You can immediately restore it by resetting your password or you can try again later.":a.mesaage=="Error (auth/wrong-password): Firebase: The password is invalid or the user does not have a password. (auth/wrong-password)."?"The password is invalid or the user does not have a password.":a.mesaage=="Error (auth/user-not-found): Firebase: There is no user record corresponding to this identifier. The user may have been deleted. (auth/user-not-found)."?"There is no user record corresponding to this identifier. The user may have been deleted.":a.message},F=function(){var o=w(d().mark(function a(t){var i,u,s;return d().wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return i=C(),r.prev=1,r.next=4,k(i,t);case 4:return r.abrupt("return","An email has been sent with a link to reset your password.");case 7:return r.prev=7,r.t0=r.catch(1),u=r.t0.code,s=r.t0.message,r.abrupt("return","Error (".concat(u,"): ").concat(s));case 12:case"end":return r.stop()}},a,null,[[1,7]])}));return function(t){return o.apply(this,arguments)}}();function M(){var o=c.useState(""),a=h(o,2),t=a[0],i=a[1],u=c.useState(""),s=h(u,2),m=s[0],r=s[1],b=c.useState("If you forgot your password, enter your username or email."),p=h(b,2),f=p[0],j=p[1],S=function(){var g=w(d().mark(function n(y){return d().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:y.preventDefault(),F(t).then(function(){var T=new URLSearchParams(window.location.search),v=T.get("redirectTo");setTimeout(function(){v===null?window.location.href="/login":window.location.href=v},5e3),j(A("Check your inbox and spam for ".concat(t))),r("info")});case 2:case"end":return l.stop()}},n)}));return function(y){return g.apply(this,arguments)}}(),x=function(n){n.target.name==="email"&&i(n.target.value)};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"forgot",children:[e.jsx(E,{}),e.jsx("div",{className:"login card",children:e.jsx("form",{children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsx("tbody",{children:e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"email",name:"email",placeholder:"Email",onChange:x,required:!0})})})}),e.jsx("tfoot",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:S,children:e.jsx("h3",{children:"RESET"})})})})]})})}),f!==""&&e.jsx("div",{className:"status-bar card ".concat(m),children:e.jsx("span",{children:f})})]})})}export{M as default};
//# sourceMappingURL=Forgot.js.map
