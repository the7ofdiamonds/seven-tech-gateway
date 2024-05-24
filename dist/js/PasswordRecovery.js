import{a8 as N,u as k,r as s,_ as o,j as e,a9 as A,ab as I,ac as O,ad as Y}from"./index.js";import{u as z,S as G}from"./StatusBarComponent.js";function K(){var m=N(),v=m.emailEncoded,h=m.confirmationCode,p=v.replace(/%40/g,"@"),P=z(),u=k(function(c){return c.password}),l=u.passwordSuccessMessage,f=u.passwordErrorMessage;u.passwordStatusCode;var _=s.useState(""),w=o(_,2),a=w[0],E=w[1],y=s.useState(""),S=o(y,2),r=S[0],b=S[1],M=s.useState(!1),x=o(M,2),T=x[0],j=x[1],R=s.useState("Enter your preferred password twice."),g=o(R,2),n=g[0],d=g[1],V=s.useState(""),C=o(V,2),q=C[0],i=C[1];s.useEffect(function(){a!=""&&r!=""&&a===r&&(d("You have entered your password twice."),i("success"))},[a,r]),s.useEffect(function(){a!=""&&r!=""&&a!=r&&(d("Passwords do not match."),i("error"))},[a,r]),s.useEffect(function(){l&&(d(l),i("success"))},[l]),s.useEffect(function(){f&&(d(f),i("error"))},[f]),s.useEffect(function(){n!=""&&(j("modal-overlay"),setTimeout(function(){j("")},5e3))},[n]);var B=function(t){t.target.name=="password"&&E(t.target.value)},D=function(t){t.target.name=="confirmPassword"&&b(t.target.value)},F=function(t){t.preventDefault(),A(p)&&I(h)&&O(a)&&a===r&&P(Y({email:p,password:a,confirmPassword:r,confirmationCode:h}))};return e.jsx(e.Fragment,{children:e.jsx("section",{children:e.jsx("main",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:B,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",onChange:D,required:!0})})})]}),e.jsxs("tfoot",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:F,children:e.jsx("h3",{children:"CONFIRM"})})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("span",{className:T,children:n!=""&&e.jsx(G,{messageType:q,message:n})})})})]})]})})})})})}export{K as default};
//# sourceMappingURL=PasswordRecovery.js.map
