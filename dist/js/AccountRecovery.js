import{a6 as x,u as h,r as s,_ as l,k as y,a7 as M,j as t}from"./index.js";import{u as j,S as C}from"./StatusBarComponent.js";function A(){var i=x(),g=i.emailEncoded,a=i.confirmationCode,e=g.replace(/%40/g,"@"),p=j(),u=h(function(_){return _.account}),o=u.accountSuccessMessage,r=u.accountErrorMessage,E=s.useState("Check your email for the confirmation code and link."),f=l(E,2),m=f[0],c=f[1],S=s.useState(""),d=l(S,2),v=d[0],n=d[1];return s.useEffect(function(){y(e)!=!0&&(n("error"),c("Email is not valid."))},[e]),s.useEffect(function(){o&&(c(o),n("success"))},[o]),s.useEffect(function(){r&&(c(r),n("error"))},[r]),s.useEffect(function(){(e!=""||e!=null)&&(a!=""||a!=null)&&p(M({email:e,confirmationCode:a}))},[e,a]),t.jsx(t.Fragment,{children:t.jsx("main",{children:m!==""&&t.jsx(C,{messageType:v,message:m})})})}export{A as default};
//# sourceMappingURL=AccountRecovery.js.map
