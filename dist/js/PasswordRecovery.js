import{a0 as D,u as F,r,_ as i,a4 as u,j as e,a5 as N}from"./index.js";import{u as k}from"./useDispatch.js";function L(){var f=D(),m=f.username,g=f.confirmationCode,S=k(),c=F(function(d){return d.change});c.changeLoading,c.changeError;var h=c.changeSuccessMessage,l=c.changeErrorMessage,P=r.useState(""),p=i(P,2),s=p[0],C=p[1],_=r.useState(""),x=i(_,2),a=x[0],E=x[1],y=r.useState("Enter your preferred password twice."),j=i(y,2),w=j[0],t=j[1],b=r.useState(""),v=i(b,2),M=v[0],n=v[1];console.log(u("1Test$22")),r.useEffect(function(){s!=""&&a!=""&&s===a&&(t("You have entered your password twice."),n("success"))},[s,a]),console.log(s),r.useEffect(function(){s!=""&&u(s)==!1&&(t("Password is not valid."),n("error"))},[s]),r.useEffect(function(){s!=""&&a!=""&&!u(s)&&s!=a&&(t("Passwords do not match."),n("error"))},[s,a]),r.useEffect(function(){h&&(t(h),n("success"))},[h]),r.useEffect(function(){l&&(t(l),n("error"))},[l]);var T=function(o){C(o.target.value)},R=function(o){E(o.target.value)},q=function(o){o.preventDefault(),m&&g&&u(s)&&s===a&&S(N({username:m,confirmationCode:g,password:s}))};return e.jsx(e.Fragment,{children:e.jsx("section",{children:e.jsx("main",{children:e.jsx("form",{action:"",children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:T,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirmPassword",placeholder:"Confirm Password",onChange:R,required:!0})})})]}),e.jsxs("tfoot",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:q,children:e.jsx("h3",{children:"CONFIRM"})})})}),e.jsx("tr",{children:e.jsx("td",{children:w!==""&&e.jsx("div",{className:"status-bar card ".concat(M),children:e.jsx("span",{children:w})})})})]})]})})})})})}export{L as default};
//# sourceMappingURL=PasswordRecovery.js.map
