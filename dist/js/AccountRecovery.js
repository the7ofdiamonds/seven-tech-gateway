import{a as D,u as F,r as a,e as u,ad as P,o as h,j as e,ae as N,af as k}from"./index.js";import{u as I}from"./useDispatch.js";function Y(){var m=D(),S=m.emailEncoded,p=m.confirmationCode,i=S.replace(/%40/g,"@"),C=I(),c=F(function(d){return d.change});c.changeLoading,c.changeError;var f=c.changeSuccessMessage,l=c.changeErrorMessage,E=a.useState(""),g=u(E,2),s=g[0],_=g[1],y=a.useState(""),w=u(y,2),r=w[0],b=w[1],M=a.useState("Enter your preferred password twice."),x=u(M,2),j=x[0],n=x[1],R=a.useState(""),v=u(R,2),T=v[0],o=v[1];a.useEffect(function(){P(i)!=!0},[i]),a.useEffect(function(){s!=""&&r!=""&&s===r&&(n("You have entered your password twice."),o("success"))},[s,r]),a.useEffect(function(){s!=""&&h(s)==!1&&(n("Password is not valid."),o("error"))},[s]),a.useEffect(function(){s!=""&&r!=""&&!h(s)&&s!=r&&(n("Passwords do not match."),o("error"))},[s,r]),a.useEffect(function(){f&&(n(f),o("success"))},[f]),a.useEffect(function(){l&&(n(l),o("error"))},[l]);var V=function(t){t.target.name=="password"&&_(t.target.value)},q=function(t){t.target.name=="confirmPassword"&&b(t.target.value)},A=function(t){t.preventDefault(),P(i)&&N(p)&&h(s)&&s===r&&C(k({email:i,password:s,confirmPassword:r,confirmationCode:p}))};return e.jsx(e.Fragment,{children:e.jsx("section",{children:e.jsx("main",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:V,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",onChange:q,required:!0})})})]}),e.jsxs("tfoot",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:A,children:e.jsx("h3",{children:"CONFIRM"})})})}),e.jsx("tr",{children:e.jsx("td",{children:j!==""&&e.jsx("div",{className:"status-bar card ".concat(T),children:e.jsx("span",{children:j})})})})]})]})})})})})}export{Y as default};
//# sourceMappingURL=AccountRecovery.js.map
