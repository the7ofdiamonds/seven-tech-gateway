import{u as B,r as u,_ as v,j as e,a as p,b as i,l as se,c as k,d as j,e as S,f as _,g as y,t as T}from"./index.js";import{N as re}from"./NavigationLogin.js";import{g as oe,G as ie,O as F,s as b}from"./index-dd468b12.js";import{u as le}from"./useDispatch.js";function ce(){return new Promise(function(c,a){navigator.geolocation?navigator.geolocation.getCurrentPosition(function(o){var f=o.coords.latitude,g=o.coords.longitude;c({latitude:f,longitude:g})},function(o){ue(o),a(o)}):(console.log("Geolocation is not supported by this browser."),a(new Error("Geolocation is not supported")))})}function ue(c){switch(c.code){case c.PERMISSION_DENIED:console.log("User denied the request for Geolocation.");break;case c.POSITION_UNAVAILABLE:console.log("Location information is unavailable.");break;case c.TIMEOUT:console.log("The request to get user location timed out.");break;case c.UNKNOWN_ERROR:console.log("An unknown error occurred.");break}}var M=oe(),he=new ie,de=new F("microsoft.com"),fe=new F("apple");function we(){var c="login",a=le(),o=B(function(t){return t.login}),f=o.loginSuccessMessage,g=o.loginErrorMessage;o.loginError;var E=o.accessToken,N=o.refreshToken;o.displayName,o.profileImage;var I=B(function(t){return t.token}),w=I.tokenSuccessMessage,x=I.tokenErrorMessage,$=u.useState(""),R=v($,2),C=R[0],D=R[1],q=u.useState(""),L=v(q,2),A=L[0],V=L[1],W=u.useState(""),P=v(W,2),m=P[0],K=P[1],J=u.useState(""),z=v(J,2),Q=z[0],G=z[1],X=u.useState("Enter your email and password to log in."),H=v(X,2),O=H[0],U=H[1];u.useEffect(function(){ce().then(function(t){K({longitude:t.longitude,latitude:t.latitude})})},[]),u.useEffect(function(){if(f||w){var t=f||w;U(t),G("success")}},[f,w]),u.useEffect(function(){if(g||x){var t=g||x;U(t),G("error")}},[g,x]),u.useEffect(function(){if(E&&N){var t=new URLSearchParams(window.location.search),s=t.get("redirectTo");setTimeout(function(){s==null?window.location.href="/dashboard":window.location.href=s},5e3)}},[E,N]);var Y=function(){var t=p(i().mark(function s(l){return i().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:D(l.target.value);case 1:case"end":return n.stop()}},s)}));return function(l){return t.apply(this,arguments)}}(),Z=function(){var t=p(i().mark(function s(l){return i().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:V(l.target.value);case 1:case"end":return n.stop()}},s)}));return function(l){return t.apply(this,arguments)}}(),ee=function(){var t=p(i().mark(function s(l){return i().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:l.preventDefault(),a(se({identity:C,password:A,location:m}));case 2:case"end":return n.stop()}},s)}));return function(l){return t.apply(this,arguments)}}(),ne=function(){var t=p(i().mark(function s(){return i().wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.next=2,b(M,he).then(function(n){a(k(n.user.displayName)),a(j(n.user.email)),a(S(n.user.photoURL));var h=n._tokenResponse.idToken;a(_(h));var d=n._tokenResponse.refreshToken;a(y(d)),a(T(h,d,m))});case 2:case"end":return r.stop()}},s)}));return function(){return t.apply(this,arguments)}}(),te=function(){var t=p(i().mark(function s(){return i().wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.next=2,b(M,de).then(function(n){a(k(n.user.displayName)),a(j(n.user.email)),a(S(n.user.photoURL));var h=n._tokenResponse.idToken;a(_(h));var d=n._tokenResponse.refreshToken;a(y(d)),a(T(h,d,m))});case 2:case"end":return r.stop()}},s)}));return function(){return t.apply(this,arguments)}}(),ae=function(){var t=p(i().mark(function s(){return i().wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return r.next=2,b(M,fe).then(function(n){a(k(n.user.displayName)),a(j(n.user.email)),a(S(n.user.photoURL));var h=n._tokenResponse.idToken;a(_(h));var d=n._tokenResponse.refreshToken;a(y(d)),a(T(h,d,m))});case 2:case"end":return r.stop()}},s)}));return function(){return t.apply(this,arguments)}}();return e.jsx(e.Fragment,{children:e.jsxs("main",{className:"login",children:[e.jsx(re,{page:c}),e.jsx("div",{className:"login card",children:e.jsx("form",{onSubmit:ee,children:e.jsxs("table",{children:[e.jsx("thead",{}),e.jsxs("tbody",{children:[e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"text",name:"identity",placeholder:"Username or Email",value:C,onChange:Y,required:!0})})}),e.jsx("tr",{children:e.jsx("td",{children:e.jsx("input",{type:"password",name:"password",placeholder:"Password",value:A,onChange:Z,required:!0})})})]}),e.jsx("tfoot",{children:e.jsx("tr",{children:e.jsx("td",{children:e.jsx("button",{type:"submit",children:e.jsx("h3",{children:"LOGIN"})})})})})]})})}),e.jsxs("div",{className:"actions",children:[e.jsxs("button",{className:"login-button google",onClick:ne,children:[e.jsxs("svg",{xmlns:"http://www.w3.org/2000/svg",height:"24",viewBox:"0 0 24 24",width:"24",children:[e.jsx("path",{d:"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z",fill:"#4285F4"}),e.jsx("path",{d:"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z",fill:"#34A853"}),e.jsx("path",{d:"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z",fill:"#FBBC05"}),e.jsx("path",{d:"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z",fill:"#EA4335"}),e.jsx("path",{d:"M1 1h22v22H1z",fill:"none"})]}),e.jsx("h3",{children:"Login with Google"})]}),e.jsxs("button",{className:"login-button microsoft",onClick:te,children:[e.jsxs("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 21 21",children:[e.jsx("path",{fill:"#f35325",d:"M0 0h10v10H0z"}),e.jsx("path",{fill:"#81bc06",d:"M11 0h10v10H11z"}),e.jsx("path",{fill:"#05a6f0",d:"M0 11h10v10H0z"}),e.jsx("path",{fill:"#ffba08",d:"M11 11h10v10H11z"})]}),e.jsx("h3",{children:"Login with Microsoft"})]}),e.jsxs("button",{className:"login-button apple",onClick:ae,children:[e.jsx("svg",{xmlns:"http://www.w3.org/2000/svg",width:"170px",viewBox:"0 0 170 170",version:"1.1",height:"170px",children:e.jsx("path",{d:"m150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.197-2.12-9.973-3.17-14.34-3.17-4.58 0-9.492 1.05-14.746 3.17-5.262 2.13-9.501 3.24-12.742 3.35-4.929 0.21-9.842-1.96-14.746-6.52-3.13-2.73-7.045-7.41-11.735-14.04-5.032-7.08-9.169-15.29-12.41-24.65-3.471-10.11-5.211-19.9-5.211-29.378 0-10.857 2.346-20.221 7.045-28.068 3.693-6.303 8.606-11.275 14.755-14.925s12.793-5.51 19.948-5.629c3.915 0 9.049 1.211 15.429 3.591 6.362 2.388 10.447 3.599 12.238 3.599 1.339 0 5.877-1.416 13.57-4.239 7.275-2.618 13.415-3.702 18.445-3.275 13.63 1.1 23.87 6.473 30.68 16.153-12.19 7.386-18.22 17.731-18.1 31.002 0.11 10.337 3.86 18.939 11.23 25.769 3.34 3.17 7.07 5.62 11.22 7.36-0.9 2.61-1.85 5.11-2.86 7.51zm-31.26-123.01c0 8.1021-2.96 15.667-8.86 22.669-7.12 8.324-15.732 13.134-25.071 12.375-0.119-0.972-0.188-1.995-0.188-3.07 0-7.778 3.386-16.102 9.399-22.908 3.002-3.446 6.82-6.3113 11.45-8.597 4.62-2.2516 8.99-3.4968 13.1-3.71 0.12 1.0831 0.17 2.1663 0.17 3.2409z",fill:"#FFF"})}),e.jsx("h3",{children:"Login with Apple"})]})]}),O!==""&&e.jsx("div",{className:"status-bar card ".concat(Q),children:e.jsx("span",{children:e.jsx("div",{dangerouslySetInnerHTML:{__html:O}})})})]})})}export{we as default};
//# sourceMappingURL=Login.js.map
