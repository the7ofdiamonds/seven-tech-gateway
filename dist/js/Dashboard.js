import{u as _,r as a,g as X,_ as r,j as e,f as ge,h as pe,i as Se,k as ve,m as xe,n as Ne,l as je,o as Ce}from"./index.js";import _e from"./Login.js";import{u as D,S as O}from"./StatusBarComponent.js";import"./NavigationLoginComponent.js";function ke(){var n=D(),s=_(function(L){return L.account}),h=s.accountLoading;s.accountError;var u=s.accountSuccessMessage,S=s.accountErrorMessage,i=s.accountStatusCode,f=s.email;a.useEffect(function(){n(X())},[n]),a.useEffect(function(){h&&c("")},[n,h]),a.useEffect(function(){u&&(l("success"),c(u))},[n,u]),a.useEffect(function(){S&&i!=403&&(l("error"),c(S))},[n,S]),a.useEffect(function(){i!=403&&g!=""&&(N("modal-overlay"),setTimeout(function(){N("")},3e3))},[n,i,g]),a.useEffect(function(){i==200&&setTimeout(function(){window.location.href="/"},5e3)},[i]);var v=a.useState(""),x=r(v,2),d=x[0],N=x[1],m=a.useState(""),k=r(m,2),C=k[0],l=k[1],j=a.useState(""),y=r(j,2),g=y[0],c=y[1],E=function(){f!=""||localStorage.getItem("email")!=""?n(ge(f||localStorage.getItem("email"))):(l("error"),c("An email is required to lock your account."))};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"account",children:[e.jsx("span",{className:"lock-account",children:e.jsx("button",{onClick:E,children:e.jsx("h3",{children:"LOCK ACCOUNT"})})}),e.jsx("span",{className:d,children:g!=""&&e.jsx(O,{messageType:C,message:g})})]})})}function ye(){var n=D(),s=_(function(p){return p.user}),h=s.userLoading;s.userError;var u=s.userSuccessMessage,S=s.userErrorMessage,i=s.userStatusCode,f=s.username,v=s.firstname,x=s.lastname,d=s.nickname,N=s.nicename,m=s.phone;a.useEffect(function(){n(X())},[n]),a.useEffect(function(){f&&j(f),v&&E(v),x&&M(x),d&&G(d),N&&K(N),m&&z(m)},[f,c,x,d,N,m]),a.useEffect(function(){h&&B("")},[n,h]),a.useEffect(function(){u&&(V("success"),B(u))},[n,u]),a.useEffect(function(){S&&i!=403&&(V("error"),B(S))},[n,S]),a.useEffect(function(){i!=403&&A!=""&&(J("modal-overlay"),setTimeout(function(){J("")},3e3))},[n,i,A]);var k=a.useState(f),C=r(k,2),l=C[0],j=C[1],y=a.useState(v),g=r(y,2),c=g[0],E=g[1],L=a.useState(x),w=r(L,2),T=w[0],M=w[1],b=a.useState(d),o=r(b,2),U=o[0],G=o[1],Y=a.useState(N),q=r(Y,2),F=q[0],K=q[1],Z=a.useState(m),R=r(Z,2),P=R[0],z=R[1],$=a.useState(""),H=r($,2),ee=H[0],J=H[1],ae=a.useState(""),Q=r(ae,2),te=Q[0],V=Q[1],ne=a.useState(""),W=r(ne,2),A=W[0],B=W[1],se=function(t){t.preventDefault(),t.target.name=="username"&&j(t.target.value)},ue=function(t){t.preventDefault(),l!=""&&n(pe(l))},ce=function(t){t.preventDefault(),t.target.name=="firstname"&&E(t.target.value)},re=function(t){t.preventDefault(),t.target.name=="lastname"&&M(t.target.value)},oe=function(t){t.preventDefault(),(c!==""||T!=="")&&n(Se({firstName:c,lastName:T})).then(function(I){I.payload.statusCode==201&&(n(updateAccountFirstName(I.payload.firstname)),n(updateAccountLastName(I.payload.lastname)))})},ie=function(t){t.preventDefault(),t.target.name=="nickname"&&G(t.target.value)},le=function(t){t.preventDefault(),U!=""&&n(ve(U))},me=function(t){t.preventDefault(),t.target.name=="nicename"&&K(t.target.value)},he=function(t){t.preventDefault(),F!=""&&n(xe(F))},fe=function(t){t.preventDefault(),t.target.name=="phone"&&z(t.target.value)},de=function(t){t.preventDefault(),P!=""&&n(Ne(P))};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"change",children:[e.jsxs("span",{className:"change-username",children:[e.jsx("input",{className:"input-username",type:"text",name:"username",placeholder:"Username",value:l,onChange:se}),e.jsx("div",{className:"action",children:e.jsx("button",{onClick:ue,children:e.jsx("h3",{children:"Change Username"})})})]}),e.jsxs("span",{className:"change-name",children:[e.jsx("input",{className:"input-name",type:"text",name:"firstname",placeholder:"First Name",value:c,onChange:ce}),e.jsx("input",{className:"input-name",type:"text",name:"lastname",placeholder:"Last Name",value:T,onChange:re}),e.jsx("div",{className:"action",children:e.jsx("button",{onClick:oe,children:e.jsx("h3",{children:"Change Name"})})})]}),e.jsxs("span",{className:"change-nickname",children:[e.jsx("input",{className:"input-name",type:"text",name:"nickname",placeholder:"Nickname",value:U,onChange:ie}),e.jsx("div",{className:"action",children:e.jsx("button",{onClick:le,children:e.jsx("h3",{children:"Change Nickname"})})})]}),e.jsxs("span",{className:"change-nicename",children:[e.jsx("input",{className:"input-name",type:"text",name:"nicename",placeholder:"Nicename",value:F,onChange:me}),e.jsx("div",{className:"action",children:e.jsx("button",{onClick:he,children:e.jsx("h3",{children:"Change Nicename"})})})]}),e.jsxs("span",{className:"change-phone",children:[e.jsx("input",{className:"input-phone",type:"text",name:"phone",placeholder:"Phone Number",value:P,onChange:fe}),e.jsx("div",{className:"action",children:e.jsx("button",{onClick:de,children:e.jsx("h3",{children:"Change Phone"})})})]}),e.jsx("span",{className:ee,children:A!=""&&e.jsx(O,{messageType:te,message:A})})]})})}function Ee(){var n=D(),s=_(function(c){return c.logout});s.logoutLoading,s.logoutError;var h=s.logoutSuccessMessage,u=s.logoutErrorMessage;a.useEffect(function(){h&&(m("success"),j(h))},[n,h]),a.useEffect(function(){u&&(m("error"),j(u))},[n,u]),a.useEffect(function(){u&&(m("error"),j(u))},[n,u]),a.useEffect(function(){l!=""&&(v("modal-overlay"),setTimeout(function(){v("")},3e3))},[n,l]);var S=a.useState(""),i=r(S,2),f=i[0],v=i[1],x=a.useState(""),d=r(x,2),N=d[0],m=d[1],k=a.useState(""),C=r(k,2),l=C[0],j=C[1],y=function(){n(je()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})},g=function(){logoutAllUrl!=null&&n(Ce()).then(function(){setTimeout(function(){window.location.href="/"},5e3)})};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"auth",children:[e.jsxs("span",{className:"logout",children:[e.jsx("button",{onClick:y,children:e.jsx("h3",{children:"LOG OUT"})}),e.jsx("button",{onClick:g,children:e.jsx("h3",{children:"LOG OUT ALL"})})]}),e.jsx("span",{className:f,children:l!=""&&e.jsx(O,{messageType:N,message:l})})]})})}function Ae(){var n=D(),s=_(function(o){return o.login}),h=s.profileImage,u=s.displayName,S=h||localStorage.getItem("profile_image"),i=u||localStorage.getItem("display_name"),f=_(function(o){return o.user}),v=f.changeStatusCode,x=_(function(o){return o.email}),d=x.emailStatusCode,N=_(function(o){return o.password}),m=N.passwordStatusCode,k=_(function(o){return o.login}),C=k.loginStatusCode,l=_(function(o){return o.account}),j=l.accountStatusCode,y=a.useState(""),g=r(y,2),c=g[0],E=g[1],L=a.useState(!1),w=r(L,2),T=w[0],M=w[1];a.useEffect(function(){C==200&&M(!1)},[C]),a.useEffect(function(){(v==403||d==403||m==403||j==403)&&M(!0)},[n,v,d,m,j]);var b=function(){c==!1&&E(!0),c==!0&&E(!1)};return e.jsxs(e.Fragment,{children:[e.jsx("h2",{className:"title",children:"Dashboard"}),e.jsxs("div",{className:"header",children:[e.jsx("div",{className:"profile-image",children:e.jsx("img",{src:"".concat(S),alt:""})}),e.jsx("h2",{className:"display-name",children:i}),e.jsx("div",{className:"action options",children:e.jsxs("button",{className:"settings-button",onClick:b,children:[e.jsx("i",{class:"fa-solid fa-gears"}),e.jsx("h3",{children:"Settings"})]})})]}),c&&e.jsx(ye,{}),e.jsx(Ee,{}),e.jsx(ke,{}),T&&e.jsx("div",{className:"modal-overlay",children:e.jsx("main",{className:"login",children:e.jsx(_e,{})})})]})}export{Ae as default};
//# sourceMappingURL=Dashboard.js.map
