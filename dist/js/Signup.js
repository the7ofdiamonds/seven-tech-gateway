import{c as X,a as Z,b as U,d as x,i as ee,e as L,f as ae,g as se,r as t,_ as i,j as e}from"./index.js";import{N as re}from"./NavigationLoginComponent.js";import{u as ne}from"./useDispatch.js";var te="http://localhost:8080/signup",ie={signupLoading:!1,signupError:"",signupSuccessMessage:"",signupErrorMessage:""},S=X("signup/signup",function(){var c=U(x().mark(function u(a){var n,m,d,h,g,f;return x().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(s.prev=0,isValidEmail(a.email)!=!1){s.next=3;break}throw new Error("A valid Email is required to signup.");case 3:if(se(a.username)!=!1){s.next=5;break}case 5:if(ae(a.password)!=!1){s.next=7;break}case 7:if(a.password==a.confirmPassword){s.next=9;break}throw new Error("Please enter your prefered password twice.");case 9:if(L(a.firstname)!=!1){s.next=11;break}throw new Error("Please provide a valid first name.");case 11:if(L(a.lastname)!=!1){s.next=13;break}throw new Error("Please provide a valid last name.");case 13:if(ee(a.phone)!=!1){s.next=15;break}case 15:return s.next=17,fetch(te,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({email:a.email,username:a.username,password:a.password,confirmPassword:a.confirmPassword,firstname:a.firstname,lastname:a.lastname,phone:a.phone,location:a.location})});case 17:if(n=s.sent,n.ok){s.next=24;break}return s.next=21,n.json();case 21:throw m=s.sent,d=m.message,new Error(d);case 24:return s.next=26,n.json();case 26:return h=s.sent,s.abrupt("return",h);case 30:return s.prev=30,s.t0=s.catch(0),g=s.t0.code,f=s.t0.message,s.abrupt("return","Error (".concat(g,"): ").concat(f));case 35:case"end":return s.stop()}},u,null,[[0,30]])}));return function(u){return c.apply(this,arguments)}}());Z({name:"signup",initialState:ie,reducers:{},extraReducers:function(u){u.addCase(S.fulfilled,function(a,n){a.signupLoading=!1,a.signupError="",a.signupSuccessMessage=n.payload.successMessage,a.signupErrorMessage=n.payload.errorMessage}).addMatcher(isAnyOf(S.pending),function(a){a.signupLoading=!0,a.signupError=null,a.signupSuccessMessage=null,a.signupErrorMessage=null}).addMatcher(isAnyOf(S.rejected),function(a,n){a.signupLoading=!1,a.signupError=n.error.stack,a.signupErrorMessage=n.error.message})}});function pe(){var c=t.useState(""),u=i(c,2),a=u[0],n=u[1],m=t.useState(""),d=i(m,2),h=d[0],g=d[1],f=t.useState(""),y=i(f,2),s=y[0],A=y[1],V=t.useState(""),b=i(V,2),p=b[0],_=b[1],D=t.useState(""),P=i(D,2),O=P[0],R=P[1],F=t.useState(""),C=i(F,2),G=C[0],Y=C[1],$=t.useState(""),M=i($,2),I=M[0],J=M[1],z=t.useState("Enter the username, email, and password of your choice to sign up."),k=i(z,2),N=k[0],w=k[1],B=t.useState(""),q=i(B,2),H=q[0],v=q[1],K=ne();t.useEffect(function(){if(s!==""&&p!==""&&s===p){var j="You have successfully entered your password twice.";w(j),v("success")}else if(s!==""&&s!==p){var r="You have not entered your password twice.";w(r),v("error")}},[s,p]);var Q={username:a,email:h,password:s,confirmPassword:p,firstname:O,lastname:G,phone:I,location:"here"},W=function(){var j=U(x().mark(function r(T){return x().wrap(function(E){for(;;)switch(E.prev=E.next){case 0:T.preventDefault(),K(S(Q)).then(function(l){console.log(l),w(l),v("success")}).then(function(){setTimeout(function(){window.location.href="/login"},5e3)}).catch(function(l){console.log(l.message),w(l.message),v(l.message)});case 2:case"end":return E.stop()}},r)}));return function(T){return j.apply(this,arguments)}}(),o=function(r){r.target.name==="user-name"?n(r.target.value):r.target.name==="email"?g(r.target.value):r.target.name==="password"?A(r.target.value):r.target.name==="confirm-password"?_(r.target.value):r.target.name==="firstname"?R(r.target.value):r.target.name==="lastname"?Y(r.target.value):r.target.name==="phone"&&J(r.target.value)};return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"signup",children:[e.jsx(re,{}),e.jsx("div",{className:"login card",children:e.jsx("form",{children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"user-name",placeholder:"User Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"email",name:"email",placeholder:"Email",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"confirm-password",placeholder:"Confirm Password",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"firstname",placeholder:"First Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"lastname",placeholder:"Last Name",onChange:o,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"phone",placeholder:"Phone",onChange:o,required:!0})})})]}),e.jsx("tfoot",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",onClick:W,children:e.jsx("h3",{children:"SIGN UP"})})})})]})})}),N!==""&&e.jsx("div",{className:"status-bar card ".concat(H),children:e.jsx("span",{children:N})})]})})}export{pe as default};
//# sourceMappingURL=Signup.js.map
