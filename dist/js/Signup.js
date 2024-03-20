import{m as V,n as W,c as b,d as x,r as i,_ as u,j as e}from"./index.js";import{N as X}from"./NavigationLogin.js";import{u as Z}from"./useDispatch.js";var ee="http://localhost:8080/signup",se={signupLoading:!1,signupError:"",signupMessage:"",signupMessageType:""},ae=V("signup/signup",function(){var l=b(x().mark(function n(s){var t,h,c,g,f;return x().wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,fetch(ee,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({username:s.username,email:s.email,password:s.password,confirmPassword:s.confirmPassword,firstname:s.firstname,lastname:s.lastname,phone:s.phone,location:s.location})});case 3:if(response.ok){a.next=9;break}return a.next=6,response.json();case 6:throw t=a.sent,h=t.message,new Error(h);case 9:return a.next=11,response.json();case 11:return c=a.sent,a.abrupt("return",c);case 15:return a.prev=15,a.t0=a.catch(0),g=a.t0.code,f=a.t0.message,a.abrupt("return","Error (".concat(g,"): ").concat(f));case 20:case"end":return a.stop()}},n,null,[[0,15]])}));return function(n){return l.apply(this,arguments)}}());W({name:"signup",initialState:se,reducers:{updateAccessToken:function(n,s){n.accessToken=s.payload},updateRefreshToken:function(n,s){n.refreshToken=s.payload}},extraReducers:function(n){n.addCase(signIn.fulfilled,function(s,t){s.signupLoading=!1,s.signupError="",s.signupMessage=t.payload.message,s.signupMessageType=t.payload.message_type,s.customToken=t.payload.custom_token}).addMatcher(isAnyOf(signIn.pending),function(s){s.signupLoading=!0,s.signupError=null}).addMatcher(isAnyOf(signIn.rejected),function(s,t){s.signupLoading=!1,s.signupError=t.error.stack,s.signupMessageType="error",s.signupMessage=t.error.message})}});function ue(){var l=i.useState(""),n=u(l,2),s=n[0],t=n[1],h=i.useState(""),c=u(h,2),g=c[0],f=c[1],w=i.useState(""),a=u(w,2),d=a[0],q=a[1],L=i.useState(""),C=u(L,2),m=C[0],A=C[1],R=i.useState(""),T=u(R,2),U=T[0],D=T[1],I=i.useState(""),k=u(I,2),O=k[0],F=k[1],G=i.useState(""),_=u(G,2),Y=_[0],$=_[1],J=i.useState("Enter the username, email, and password of your choice to sign up."),E=u(J,2),P=E[0],j=E[1],z=i.useState(""),M=u(z,2),B=M[0],v=M[1],H=Z();i.useEffect(function(){if(d!==""&&m!==""&&d===m){var S="You have successfully entered your password twice.";j(S),v("success")}else if(d!==""&&d!==m){var r="You have not entered your password twice.";j(r),v("error")}},[d,m]);var K={username:s,email:g,password:d,confirmPassword:m,firstname:U,lastname:O,phone:Y,location:"here"},Q=function(){var S=b(x().mark(function r(N){return x().wrap(function(y){for(;;)switch(y.prev=y.next){case 0:N.preventDefault(),H(ae(K)).then(function(p){console.log(p),j(p),v("success")}).then(function(){setTimeout(function(){window.location.href="/login"},5e3)}).catch(function(p){console.log(p.message),j(p.message),v(p.message)});case 2:case"end":return y.stop()}},r)}));return function(N){return S.apply(this,arguments)}}(),o=function(r){r.target.name==="user-name"?t(r.target.value):r.target.name==="email"?f(r.target.value):r.target.name==="password"?q(r.target.value):r.target.name==="confirm-password"?A(r.target.value):r.target.name==="firstname"?D(r.target.value):r.target.name==="lastname"?F(r.target.value):r.target.name==="phone"&&$(r.target.value)};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"signup",children:[e.jsx(X,{}),e.jsx("div",{className:"login card",children:e.jsx("form",{children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"user-name",placeholder:"User Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"email",name:"email",placeholder:"Email",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirm-password",placeholder:"Confirm Password",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"firstname",placeholder:"First Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"lastname",placeholder:"Last Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"phone",placeholder:"Phone",onChange:o,required:!0})})})]}),e.jsx("tfoot",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:Q,children:e.jsx("h3",{children:"SIGN UP"})})})})]})})}),P!==""&&e.jsx("div",{className:"status-bar card ".concat(B),children:e.jsx("span",{children:P})})]})})}export{ue as default};
//# sourceMappingURL=Signup.js.map