import{a as _,u as h,r as a,e as l,a9 as y,aa as C,j as t}from"./index.js";import{S as M}from"./StatusBarComponent.js";import{u as j}from"./useDispatch.js";function P(){var i=_(),p=i.emailEncoded,s=i.confirmationCode,e=p.replace(/%40/g,"@"),S=j(),o=h(function(x){return x.account}),r=o.accountSuccessMessage,c=o.accountErrorMessage;o.accountStatusCode;var g=a.useState("Check your email for the confirmation code and link."),f=l(g,2),m=f[0],n=f[1],E=a.useState(""),d=l(E,2),v=d[0],u=d[1];return a.useEffect(function(){y(e)!=!0&&(u("error"),n("Email is not valid."))},[e]),a.useEffect(function(){r&&(n(r),u("success"))},[r]),a.useEffect(function(){c&&(n(c),u("error"))},[c]),a.useEffect(function(){(e!=""||e!=null)&&(s!=""||s!=null)&&S(C({email:e,confirmationCode:s}))},[e,s]),t.jsx(t.Fragment,{children:t.jsx("main",{children:m!==""&&t.jsx(M,{messageType:v,message:m})})})}export{P as default};
//# sourceMappingURL=AccountRecovery.js.map
