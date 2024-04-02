import{a as F,u as N,r as a,e as i,a9 as E,j as e,ab as k,ac as I,ae as O}from"./index.js";import{S as z}from"./StatusBarComponent.js";import{u as G}from"./useDispatch.js";function L(){var f=F(),C=f.emailEncoded,h=f.confirmationCode,_=G(),l=N(function(d){return d.account}),m=l.accountSuccessMessage,u=l.accountErrorMessage;l.accountStatusCode;var w=a.useState(C.replace(/%40/g,"@")),p=i(w,2),s=p[0],y=p[1],b=a.useState(""),S=i(b,2),r=S[0],M=S[1],P=a.useState(""),x=i(P,2),T=x[0],v=x[1],D=a.useState(""),j=i(D,2),c=j[0],o=j[1],A=a.useState(""),g=i(A,2),R=g[0],n=g[1];a.useEffect(function(){(s==""||s==null)&&(n("error"),o("Email is not valid.")),E(s)!=!0&&(n("error"),o("Enter your email to remove your account."))},[s]),a.useEffect(function(){(r==""||r==null)&&(o("Enter your password to remove account."),n("error"))},[r]),a.useEffect(function(){m&&(o(m),n("success"))},[m]),a.useEffect(function(){u&&(console.log(u),o(u),n("error"))},[u]),a.useEffect(function(){c!=""&&(v("modal-overlay"),setTimeout(function(){v("")},5e3))},[c]);var V=function(t){t.preventDefault(),y(t.target.value)},q=function(t){t.preventDefault(),M(t.target.value)},B=function(t){t.preventDefault(),E(s)&&k(h)&&I(r)&&_(O({email:s,password:r,confirmationCode:h}))};return e.jsx(e.Fragment,{children:e.jsx("main",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"email",placeholder:"Email",onChange:V,value:s,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:q,required:!0})})})]}),e.jsxs("tfoot",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:B,children:e.jsx("h3",{children:"CONFIRM"})})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("span",{className:T,children:c!==""&&e.jsx(z,{messageType:R,message:c})})})})]})]})})})})}export{L as default};
//# sourceMappingURL=RemoveAccount.js.map
