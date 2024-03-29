import{a as N,u as R,r as a,e as u,ad as P,o as h,j as e,ae as k,af as A}from"./index.js";import{u as I}from"./useDispatch.js";function Y(){var m=N(),S=m.emailEncoded,p=m.confirmationCode,i=S.replace(/%40/g,"@"),C=I(),d=R(function(c){return c.change});d.changeLoading,d.changeError;var f=d.changeSuccessMessage,l=d.changeErrorMessage,E=a.useState(""),g=u(E,2),s=g[0],_=g[1],y=a.useState(""),w=u(y,2),r=w[0],b=w[1],M=a.useState("Enter your preferred password twice."),x=u(M,2),j=x[0],n=x[1],V=a.useState(""),v=u(V,2),T=v[0],o=v[1];a.useEffect(function(){P(i)!=!0},[i]),a.useEffect(function(){s!=""&&r!=""&&s===r&&(n("You have entered your password twice."),o("success"))},[s,r]),a.useEffect(function(){s!=""&&h(s)==!1&&(n("Password is not valid."),o("error"))},[s]),a.useEffect(function(){s!=""&&r!=""&&!h(s)&&s!=r&&(n("Passwords do not match."),o("error"))},[s,r]),a.useEffect(function(){f&&(n(f),o("success"))},[f]),a.useEffect(function(){l&&(n(l),o("error"))},[l]);var q=function(t){t.target.name=="password"&&_(t.target.value)},D=function(t){t.target.name=="confirmPassword"&&b(t.target.value)},F=function(t){t.preventDefault(),P(i)&&k(p)&&h(s)&&s===r&&C(A({email:i,password:s,confirmPassword:r,confirmationCode:p}))};return e.jsx(e.Fragment,{children:e.jsx("section",{children:e.jsx("main",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:q,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",onChange:D,required:!0})})})]}),e.jsxs("tfoot",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:F,children:e.jsx("h3",{children:"CONFIRM"})})})}),e.jsx("tr",{children:e.jsx("td",{children:j!==""&&e.jsx("div",{className:"status-bar card ".concat(T),children:e.jsx("span",{children:j})})})})]})]})})})})})}export{Y as default};
//# sourceMappingURL=VerifyEmail.js.map
