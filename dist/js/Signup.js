import{r as s,_ as t,u as ge,a as fe,b as Se,j as e,c as xe,d as U,s as ve}from"./index.js";import{N as je}from"./NavigationLoginComponent.js";import{u as _e,S as we}from"./StatusBarComponent.js";function Ee(){var F="signup",L=s.useState(""),x=t(L,2),R=x[0],A=x[1],B=s.useState(""),v=t(B,2),D=v[0],G=v[1],Y=s.useState(""),j=t(Y,2),u=j[0],I=j[1],$=s.useState(""),_=t($,2),o=_[0],z=_[1],H=s.useState(""),w=t(H,2),J=w[0],K=w[1],O=s.useState(""),y=t(O,2),Q=y[0],V=y[1],W=s.useState(""),N=t(W,2),X=N[0],Z=N[1],ee=s.useState(""),C=t(ee,2),ae=C[0],se=C[1],te=s.useState(""),k=t(te,2),ne=k[0],re=k[1],ue=s.useState(""),E=t(ue,2),ie=E[0],oe=E[1],ce=s.useState("Enter the username, email, and password of your choice to sign up."),T=t(ce,2),b=T[0],c=T[1],le=s.useState(""),q=t(le,2),me=q[0],l=q[1],g=_e(),r=ge(function(i){return i.signup}),pe=r.signupStatusCode,m=r.signupSuccessMessage,f=r.signupErrorMessage,p=r.loginSuccessMessage,P=r.loginStatusCode,d=r.accessToken,h=r.refreshToken;s.useEffect(function(){if(u!==""&&o!==""&&u===o){var i="You have successfully entered your password twice.";c(i),l("success")}else if(u!==""&&u!==o){var a="You have not entered your password twice.";c(a),l("error")}},[u,o]),s.useEffect(function(){pe==201&&m&&(l("success"),c(m))},[m]),s.useEffect(function(){P==201&&p&&d&&h&&setTimeout(function(){l("success"),c(p)},3e3)},[P,p,d,h]),s.useEffect(function(){f&&(l("error"),c(f))},[f]),s.useEffect(function(){(m!=""||p!="")&&oe("modal-overlay")},[m,p]),s.useEffect(function(){d&&h&&(g(fe(d)),g(Se(h)))},[g,d,h]);var de={username:R,email:D,password:u,confirmPassword:o,nicename:J,nickname:Q,firstname:X,lastname:ae,phone:ne,location:"here"},he=function(){var i=xe(U().mark(function a(M){return U().wrap(function(S){for(;;)switch(S.prev=S.next){case 0:M.preventDefault(),g(ve(de));case 2:case"end":return S.stop()}},a)}));return function(M){return i.apply(this,arguments)}}(),n=function(a){a.target.name==="username"?A(a.target.value):a.target.name==="email"?G(a.target.value):a.target.name==="password"?I(a.target.value):a.target.name==="confirm-password"?z(a.target.value):a.target.name==="nicename"?K(a.target.value):a.target.name==="nickname"?V(a.target.value):a.target.name==="firstname"?Z(a.target.value):a.target.name==="lastname"?se(a.target.value):a.target.name==="phone"&&re(a.target.value)};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"signup",children:[e.jsx(je,{page:F}),e.jsx("div",{className:"signup card",children:e.jsx("form",{children:e.jsxs("table",{children:[e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsxs("td",{children:[e.jsx("input",{className:"input-username",type:"text",name:"username",placeholder:"Username",onChange:n,required:!0}),e.jsx("input",{className:"input-email",type:"email",name:"email",placeholder:"Email",onChange:n,required:!0})]})}),e.jsx("tr",{children:e.jsxs("td",{children:[e.jsx("input",{className:"input-password",type:"password",name:"password",placeholder:"Password",onChange:n,required:!0}),e.jsx("input",{className:"input-password",type:"password",name:"confirm-password",placeholder:"Confirm Password",onChange:n,required:!0})]})}),e.jsx("tr",{children:e.jsxs("td",{children:[e.jsx("input",{className:"input-name",type:"text",name:"nicename",placeholder:"Nice Name (eg. /nicename)",onChange:n,required:!0}),e.jsx("input",{className:"input-name",type:"text",name:"nickname",placeholder:"Nickname",onChange:n,required:!0})]})}),e.jsx("tr",{children:e.jsxs("td",{children:[e.jsx("input",{className:"input-name",type:"text",name:"firstname",placeholder:"First Name",onChange:n,required:!0}),e.jsx("input",{className:"input-name",type:"text",name:"lastname",placeholder:"Last Name",onChange:n,required:!0})]})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{className:"input-phone",type:"tel",name:"phone",placeholder:"Phone",onChange:n,required:!0})})})]}),e.jsx("tfoot",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:he,id:"signup_btn",children:e.jsx("h3",{children:"SIGN UP"})})})})]})})}),e.jsx("span",{className:ie,children:b!==""&&e.jsx(we,{messageType:me,message:b})})]})})}export{Ee as default};
//# sourceMappingURL=Signup.js.map
