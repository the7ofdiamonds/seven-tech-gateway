import{u as h,r as s,_ as r,j as e,k as q,m as _e,n as Pe,o as be,h as ye,p as Le,q as Me,l as De,s as Ue,t as Ae}from"./index.js";import"./Login.js";import{u as Re}from"./useDispatch.js";import"./NavigationLogin.js";function Oe(){var t=Re(),w=h(function(n){return n.login}),N=w.profileImage,E=w.displayName,G=N||localStorage.getItem("profile_image"),J=E||localStorage.getItem("display_name"),c=h(function(n){return n.change});c.changeLoading,c.changeError,c.changeSuccessMessage;var m=c.changeErrorMessage,i=h(function(n){return n.email});i.emailLoading,i.emailError,i.emailSuccessMessage,i.emailErrorMessage;var u=h(function(n){return n.password});u.passwordLoading,u.passwordError,u.passwordSuccessMessage;var v=u.passwordErrorMessage,d=h(function(n){return n.logout});d.logoutLoading,d.logoutError;var f=d.logoutSuccessMessage,p=d.logoutErrorMessage,g=h(function(n){return n.account});g.accountLoading,g.accountError,g.accountSuccessMessage;var x=g.accountErrorMessage,V="Jamel",z="Lyons",B=s.useState(V),_=r(B,2),C=_[0],H=_[1],K=s.useState(z),P=r(K,2),j=P[0],Q=P[1],W="TestUser",X=s.useState(W),b=r(X,2),S=b[0],Y=b[1],Z=s.useState(""),y=r(Z,2),L=y[0],$=y[1],ee=s.useState(""),M=r(ee,2),D=M[0],ae=M[1],ne=7186172583,se=s.useState(ne),U=r(se,2),A=U[0],te=U[1],re=s.useState(""),R=r(re,2),k=R[0],oe=R[1],le=s.useState(""),T=r(le,2),he=T[0],o=T[1],ce=s.useState(""),F=r(ce,2),I=F[0],l=F[1];s.useEffect(function(){f&&(o("success"),l(f))},[f]),s.useEffect(function(){p?(o("error"),l(p)):m?(o("error"),l(m)):v?(o("error"),l(v)):x&&(o("error"),l(x))},[m,v,p,x]);var ie=function(a){a.preventDefault(),console.log(a.target.value),a.target.name=="firstname"&&H(a.target.value)},ue=function(a){a.preventDefault(),console.log(a.target.value),a.target.name=="lastname"&&Q(a.target.value)},de=function(a){a.preventDefault(),(C!=""||j!="")&&t(_e({firstNameChange:C,lastNameChange:j}))},ge=function(a){a.preventDefault(),Y(S)},me=function(a){a.preventDefault(),t(Pe(S))},O=function(a){a.preventDefault(),a.target.name=="password"&&$(a.target.value),a.target.name=="confirmPassword"&&ae(a.target.value)},ve=function(a){a.preventDefault(),L==D&&t(be())},fe=function(a){a.preventDefault(),localStorage.getItem("email")!=""?t(ye(Se)):(o("error"),l("An email is required to reset password."))},pe=function(a){a.preventDefault(),te(a.target.value)},xe=function(a){a.preventDefault(),t(Le(A))},Ce=function(a){a.preventDefault(),oe(a.target.value)},je=function(a){a.preventDefault(),t(Me(k))},Se="jamel.c.lyons@gmail.com",we=function(){t(De()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})},Ne=function(){q!=null&&t(Ue()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})},Ee=function(){t(Ae())};return e.jsx(e.Fragment,{children:e.jsxs("section",{className:"dashboard",children:[e.jsx("h2",{className:"title",children:"Dashboard"}),e.jsxs("div",{children:[e.jsx("div",{children:e.jsx("img",{src:"".concat(G),alt:""})}),e.jsx("span",{children:J})]}),e.jsxs("table",{children:[e.jsx("thead",{children:e.jsx("th",{children:e.jsx("h2",{children:"Settings"})})}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsxs("tr",{className:"change-name",children:[e.jsx("input",{type:"text",name:"firstname",placeholder:"First Name",value:C,onChange:ie}),e.jsx("input",{type:"text",name:"lastname",placeholder:"Last Name",value:j,onChange:ue}),e.jsx("button",{onClick:de,children:e.jsx("h3",{children:"Change Name"})})]}),e.jsx("tr",{}),e.jsxs("tr",{className:"change-username",children:[e.jsx("input",{type:"text",name:"username",placeholder:"Username",value:S,onChange:ge}),e.jsx("button",{onClick:me,children:e.jsx("h3",{children:"Change Username"})})]}),e.jsxs("tr",{className:"change-password",children:[e.jsx("input",{type:"password",name:"password",placeholder:"Password",value:L,onChange:O}),e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",value:D,onChange:O}),e.jsx("button",{onClick:ve,children:e.jsx("h3",{children:"Change Password"})})]}),e.jsx("tr",{className:"forgot-password",children:e.jsx("button",{onClick:fe,children:e.jsx("h3",{children:"Forgot Password"})})}),e.jsxs("tr",{className:"change-phone",children:[e.jsx("input",{type:"text",name:"phone",placeholder:"Phone Number",value:A,onChange:pe}),e.jsx("button",{onClick:xe,children:e.jsx("h3",{children:"Change Phone"})})]}),e.jsxs("tr",{className:"remove-email",children:[e.jsx("input",{type:"text",name:"email",placeholder:"Email",value:k,onChange:Ce}),e.jsx("button",{onClick:je,children:e.jsx("h3",{children:"Remove Email"})})]})]})]})})})}),e.jsxs("tr",{className:"logout",children:[e.jsx("button",{onClick:we,children:e.jsx("h3",{children:"LOG OUT"})}),q!=null&&e.jsx("button",{onClick:Ne,children:e.jsx("h3",{children:"LOG OUT ALL"})})]}),e.jsx("tr",{className:"remove-account",children:e.jsx("button",{onClick:Ee,children:e.jsx("h3",{children:"REMOVE ACCOUNT"})})})]}),e.jsx("tfoot",{children:I!==""&&e.jsx("div",{className:"status-bar card ".concat(he),children:e.jsx("span",{children:I})})})]})]})})}export{Oe as default};
//# sourceMappingURL=Dashboard.js.map
