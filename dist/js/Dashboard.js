import{u as l,r as s,_ as i,j as e,k as Ae,m as Ue,n as Fe,o as Ie,p as Oe,h as Re,q as qe,l as Be,s as Ge,t as Ve}from"./index.js";import{S as ze,L as He}from"./LoginComponent.js";import{u as se}from"./useDispatch.js";import"./NavigationLoginComponent.js";function Je(){var t=se(),d=l(function(n){return n.change}),_=d.changeLoading;d.changeError;var p=d.changeSuccessMessage,N=d.changeErrorMessage,E=d.changeStatusCode,f=l(function(n){return n.email}),L=f.emailLoading;f.emailError;var P=f.emailSuccessMessage,C=f.emailErrorMessage,M=f.emailStatusCode,g=l(function(n){return n.password}),T=g.passwordLoading;g.passwordError;var y=g.passwordSuccessMessage,v=g.passwordErrorMessage,b=g.passwordStatusCode,m=l(function(n){return n.logout});m.logoutLoading,m.logoutError;var S=m.logoutSuccessMessage,h=m.logoutErrorMessage,c=l(function(n){return n.account}),k=c.accountLoading;c.accountError;var D=c.accountSuccessMessage,x=c.accountErrorMessage,j=c.accountStatusCode,w=c.email,A=c.username,O=c.firstname,r=c.lastname,te=c.phone,ne=s.useState(O),z=i(ne,2),R=z[0],re=z[1],oe=s.useState(r),H=i(oe,2),q=H[0],ce=H[1],ue=s.useState(A),J=i(ue,2),B=J[0],ie=J[1],le=s.useState(""),K=i(le,2),U=K[0],he=K[1],de=s.useState(""),Q=i(de,2),F=Q[0],ge=Q[1],fe=s.useState(te),W=i(fe,2),G=W[0],me=W[1],Se=s.useState(""),X=i(Se,2);X[0],X[1];var pe=s.useState(""),Y=i(pe,2),Ce=Y[0],Z=Y[1],ve=s.useState(""),$=i(ve,2),xe=$[0],u=$[1],je=s.useState(""),ee=i(je,2),I=ee[0],o=ee[1];s.useEffect(function(){(k||_||L||T)&&o("")},[t,k,_,L,T]),s.useEffect(function(){S&&(u("success"),o(S))},[t,S]),s.useEffect(function(){p&&(u("success"),o(p))},[t,p]),s.useEffect(function(){P&&(u("success"),o(P))},[t,P]),s.useEffect(function(){y&&(u("success"),o(y))},[t,y]),s.useEffect(function(){D&&(u("success"),o(D))},[t,D]),s.useEffect(function(){h&&(u("error"),o(h))},[t,h]),s.useEffect(function(){h&&(u("error"),o(h))},[t,h]),s.useEffect(function(){N&&E!=403&&(u("error"),o(N))},[t,N]),s.useEffect(function(){C&&M!=403&&(u("error"),o(C))},[t,C]),s.useEffect(function(){v&&b!=403&&(u("error"),o(v))},[t,v]),s.useEffect(function(){x&&j!=403&&(u("error"),o(x))},[t,x]),s.useEffect(function(){(E!=403||M!=403||b!=403||j!=403)&&I!=""&&(Z("modal-overlay"),setTimeout(function(){Z("")},3e3))},[t,E,M,b,j,I]);var we=function(a){a.preventDefault(),a.target.name=="firstname"&&re(a.target.value)},_e=function(a){a.preventDefault(),a.target.name=="lastname"&&ce(a.target.value)},Ne=function(a){a.preventDefault(),(R!==""||q!=="")&&t(Ae({firstNameChange:R,lastNameChange:q})).then(function(V){V.payload.statusCode==201&&(t(Ue(V.payload.firstname)),t(Fe(V.payload.lastname)))})},Ee=function(a){a.preventDefault(),a.target.name=="username"&&ie(a.target.value)},Le=function(a){a.preventDefault(),B!=""&&t(Ie(B))},ae=function(a){a.preventDefault(),a.target.name=="password"&&he(a.target.value),a.target.name=="confirmPassword"&&ge(a.target.value)},Pe=function(a){a.preventDefault(),U==F&&U!=""&&F!=""&&t(Oe({password:U,confirmPassword:F}))},Me=function(a){a.preventDefault(),w!=""||localStorage.getItem("email")!=""?t(Re(w||localStorage.getItem("email"))):(u("error"),o("An email is required to reset password."))},ye=function(a){a.preventDefault(),a.target.name=="phone"&&me(a.target.value)},be=function(a){a.preventDefault(),G!=""&&t(qe(G))},ke=function(){t(Be()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})},De=function(){t(Ge()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})},Te=function(){t(Ve())};return e.jsx(e.Fragment,{children:e.jsxs("table",{className:"settings",children:[e.jsx("thead",{children:e.jsx("th",{children:e.jsx("h2",{children:"Settings"})})}),e.jsx("tbody",{children:e.jsx("tr",{children:e.jsx("td",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsxs("tr",{className:"change-name",children:[e.jsx("input",{type:"text",name:"firstname",placeholder:"First Name",value:R,onChange:we}),e.jsx("input",{type:"text",name:"lastname",placeholder:"Last Name",value:q,onChange:_e}),e.jsx("button",{onClick:Ne,children:e.jsx("h3",{children:"Change Name"})})]}),e.jsx("tr",{}),e.jsxs("tr",{className:"change-username",children:[e.jsx("input",{type:"text",name:"username",placeholder:"Username",value:B,onChange:Ee}),e.jsx("button",{onClick:Le,children:e.jsx("h3",{children:"Change Username"})})]}),e.jsxs("tr",{className:"change-phone",children:[e.jsx("input",{type:"text",name:"phone",placeholder:"Phone Number",value:G,onChange:ye}),e.jsx("button",{onClick:be,children:e.jsx("h3",{children:"Change Phone"})})]}),e.jsxs("tr",{className:"change-password",children:[e.jsx("input",{type:"password",name:"password",placeholder:"Password",value:U,onChange:ae}),e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",value:F,onChange:ae}),e.jsx("button",{onClick:Pe,children:e.jsx("h3",{children:"Change Password"})})]})]})]})})})})}),e.jsxs("tfoot",{children:[e.jsx("tr",{className:"forgot-password",children:e.jsx("button",{onClick:Me,children:e.jsx("h3",{children:"Forgot Password"})})}),e.jsxs("tr",{className:"logout",children:[e.jsx("button",{onClick:ke,children:e.jsx("h3",{children:"LOG OUT"})}),e.jsx("button",{onClick:De,children:e.jsx("h3",{children:"LOG OUT ALL"})})]}),e.jsx("tr",{className:"remove-account",children:e.jsx("button",{onClick:Te,children:e.jsx("h3",{children:"REMOVE ACCOUNT"})})}),e.jsx("span",{className:Ce,children:I!==""&&e.jsx(ze,{messageType:xe,message:I})})]})]})})}function Ye(){var t=se(),d=l(function(r){return r.login}),_=d.profileImage,p=d.displayName,N=_||localStorage.getItem("profile_image"),E=p||localStorage.getItem("display_name"),f=l(function(r){return r.change}),L=f.changeStatusCode,P=l(function(r){return r.email}),C=P.emailStatusCode,M=l(function(r){return r.password}),g=M.passwordStatusCode,T=l(function(r){return r.login});T.loginStatusCode;var y=l(function(r){return r.account}),v=y.accountStatusCode,b=s.useState(""),m=i(b,2),S=m[0],h=m[1],c=s.useState(!1),k=i(c,2),D=k[0],x=k[1],j=l(function(r){return r.login}),w=j.accessToken,A=j.refreshToken;s.useEffect(function(){w&&A&&x(!1)},[w,A]),s.useEffect(function(){(L==403||C==403||g==403||v==403)&&x(!0)},[t,L,C,g,v]);var O=function(){S==!1&&h(!0),S==!0&&h(!1)};return e.jsxs(e.Fragment,{children:[e.jsx("h2",{className:"title",children:"Dashboard"}),e.jsxs("div",{className:"header",children:[e.jsx("div",{className:"profile-image",children:e.jsx("img",{src:"".concat(N),alt:""})}),e.jsx("h2",{className:"display-name",children:E}),e.jsx("div",{className:"options",children:e.jsx("button",{className:"settings-button",onClick:O,children:e.jsx("i",{class:"fa-solid fa-gears"})})})]}),S&&e.jsx(Je,{}),D&&e.jsx("div",{className:"modal-overlay",children:e.jsx(He,{})})]})}export{Ye as default};
//# sourceMappingURL=Dashboard.js.map
