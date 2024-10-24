import{E as dr,L as jn,x as k,y as Yr,z as I,A as z,B as q,C as Rr,D as Cr,F as Or,G as Wn,H as Qr,I as Hn,J as zn,K as b,M as qn,N as Gn,S as le,c as p,d as c,O as ie,P as Bn,_ as V,Q as ce,R as Y,T as L,U as Kn,V as Jn,W as Zr,X as xr,Y as fr,Z as ue,$ as ee,a0 as re,a1 as Xn,a2 as Yn,a3 as Qn,u as Zn,r as $,a4 as xn,a5 as et,a6 as rt,a7 as nt,a as fe,b as pe,j as _,a8 as ve,v as tt,a9 as it}from"./index.js";import{u as at,S as st}from"./StatusBarComponent.js";function pr(a,r){var e={};for(var t in a)Object.prototype.hasOwnProperty.call(a,t)&&r.indexOf(t)<0&&(e[t]=a[t]);if(a!=null&&typeof Object.getOwnPropertySymbols=="function")for(var n=0,t=Object.getOwnPropertySymbols(a);n<t.length;n++)r.indexOf(t[n])<0&&Object.prototype.propertyIsEnumerable.call(a,t[n])&&(e[t[n]]=a[t[n]]);return e}var x;function en(){return k({},"dependent-sdk-initialized-before-auth","Another Firebase SDK was initialized and is trying to use Auth before Auth is initialized. Please be sure to call `initializeAuth` or `getAuth` before starting any other Firebase SDK.")}var ut=en,Me=new dr("auth","Firebase",en());/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var ne=new jn("@firebase/auth");function ot(a){if(ne.logLevel<=xr.WARN){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];ne.warn.apply(ne,["Auth (".concat(le,"): ").concat(a)].concat(e))}}function me(a){if(ne.logLevel<=xr.ERROR){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];ne.error.apply(ne,["Auth (".concat(le,"): ").concat(a)].concat(e))}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function H(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];throw vr.apply(void 0,[a].concat(e))}function j(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];return vr.apply(void 0,[a].concat(e))}function rn(a,r,e){var t=Object.assign(Object.assign({},ut()),k({},r,e)),n=new dr("auth","Firebase",t);return n.create(r,{appName:a.name})}function lt(a,r,e){var t=e;if(!(r instanceof t))throw t.name!==r.constructor.name&&H(a,"argument-error"),rn(a,"argument-error","Type of ".concat(r.constructor.name," does not match expected instance.")+"Did you pass a reference from a different Auth SDK?")}function vr(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];if(typeof a!="string"){var n,i=e[0],s=Y(e.slice(1));return s[0]&&(s[0].appName=a.name),(n=a._errorFactory).create.apply(n,[i].concat(Y(s)))}return Me.create.apply(Me,[a].concat(e))}function y(a,r){if(!a){for(var e=arguments.length,t=new Array(e>2?e-2:0),n=2;n<e;n++)t[n-2]=arguments[n];throw vr.apply(void 0,[r].concat(t))}}function G(a){var r="INTERNAL ASSERTION FAILED: "+a;throw me(r),new Error(r)}function K(a,r){a||G(r)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ue(){var a;return typeof self<"u"&&((a=self.location)===null||a===void 0?void 0:a.href)||""}function ct(){return Nr()==="http:"||Nr()==="https:"}function Nr(){var a;return typeof self<"u"&&((a=self.location)===null||a===void 0?void 0:a.protocol)||null}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ht(){return typeof navigator<"u"&&navigator&&"onLine"in navigator&&typeof navigator.onLine=="boolean"&&(ct()||zn()||"connection"in navigator)?navigator.onLine:!0}function dt(){if(typeof navigator>"u")return null;var a=navigator;return a.languages&&a.languages[0]||a.language||null}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var he=function(){function a(r,e){b(this,a),this.shortDelay=r,this.longDelay=e,K(e>r,"Short delay should be less than long delay!"),this.isMobile=qn()||Gn()}return I(a,[{key:"get",value:function(){return ht()?this.isMobile?this.longDelay:this.shortDelay:Math.min(5e3,this.shortDelay)}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function gr(a,r){K(a.emulator,"Emulator should always be set here");var e=a.emulator.url;return r?"".concat(e).concat(r.startsWith("/")?r.slice(1):r):e}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var nn=function(){function a(){b(this,a)}return I(a,null,[{key:"initialize",value:function(e,t,n){this.fetchImpl=e,t&&(this.headersImpl=t),n&&(this.responseImpl=n)}},{key:"fetch",value:function(r){function e(){return r.apply(this,arguments)}return e.toString=function(){return r.toString()},e}(function(){if(this.fetchImpl)return this.fetchImpl;if(typeof self<"u"&&"fetch"in self)return self.fetch;if(typeof globalThis<"u"&&globalThis.fetch)return globalThis.fetch;if(typeof fetch<"u")return fetch;G("Could not find fetch implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")})},{key:"headers",value:function(){if(this.headersImpl)return this.headersImpl;if(typeof self<"u"&&"Headers"in self)return self.Headers;if(typeof globalThis<"u"&&globalThis.Headers)return globalThis.Headers;if(typeof Headers<"u")return Headers;G("Could not find Headers implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")}},{key:"response",value:function(){if(this.responseImpl)return this.responseImpl;if(typeof self<"u"&&"Response"in self)return self.Response;if(typeof globalThis<"u"&&globalThis.Response)return globalThis.Response;if(typeof Response<"u")return Response;G("Could not find Response implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var ft=(x={},k(k(k(k(k(k(k(k(k(k(x,"CREDENTIAL_MISMATCH","custom-token-mismatch"),"MISSING_CUSTOM_TOKEN","internal-error"),"INVALID_IDENTIFIER","invalid-email"),"MISSING_CONTINUE_URI","internal-error"),"INVALID_PASSWORD","wrong-password"),"MISSING_PASSWORD","missing-password"),"INVALID_LOGIN_CREDENTIALS","invalid-credential"),"EMAIL_EXISTS","email-already-in-use"),"PASSWORD_LOGIN_DISABLED","operation-not-allowed"),"INVALID_IDP_RESPONSE","invalid-credential"),k(k(k(k(k(k(k(k(k(k(x,"INVALID_PENDING_TOKEN","invalid-credential"),"FEDERATED_USER_ID_ALREADY_LINKED","credential-already-in-use"),"MISSING_REQ_TYPE","internal-error"),"EMAIL_NOT_FOUND","user-not-found"),"RESET_PASSWORD_EXCEED_LIMIT","too-many-requests"),"EXPIRED_OOB_CODE","expired-action-code"),"INVALID_OOB_CODE","invalid-action-code"),"MISSING_OOB_CODE","internal-error"),"CREDENTIAL_TOO_OLD_LOGIN_AGAIN","requires-recent-login"),"INVALID_ID_TOKEN","invalid-user-token"),k(k(k(k(k(k(k(k(k(k(x,"TOKEN_EXPIRED","user-token-expired"),"USER_NOT_FOUND","user-token-expired"),"TOO_MANY_ATTEMPTS_TRY_LATER","too-many-requests"),"PASSWORD_DOES_NOT_MEET_REQUIREMENTS","password-does-not-meet-requirements"),"INVALID_CODE","invalid-verification-code"),"INVALID_SESSION_INFO","invalid-verification-id"),"INVALID_TEMPORARY_PROOF","invalid-credential"),"MISSING_SESSION_INFO","missing-verification-id"),"SESSION_EXPIRED","code-expired"),"MISSING_ANDROID_PACKAGE_NAME","missing-android-pkg-name"),k(k(k(k(k(k(k(k(k(k(x,"UNAUTHORIZED_DOMAIN","unauthorized-continue-uri"),"INVALID_OAUTH_CLIENT_ID","invalid-oauth-client-id"),"ADMIN_ONLY_OPERATION","admin-restricted-operation"),"INVALID_MFA_PENDING_CREDENTIAL","invalid-multi-factor-session"),"MFA_ENROLLMENT_NOT_FOUND","multi-factor-info-not-found"),"MISSING_MFA_ENROLLMENT_ID","missing-multi-factor-info"),"MISSING_MFA_PENDING_CREDENTIAL","missing-multi-factor-session"),"SECOND_FACTOR_EXISTS","second-factor-already-in-use"),"SECOND_FACTOR_LIMIT_EXCEEDED","maximum-second-factor-count-exceeded"),"BLOCKING_FUNCTION_ERROR_RESPONSE","internal-error"),k(k(k(k(k(k(k(k(x,"RECAPTCHA_NOT_ENABLED","recaptcha-not-enabled"),"MISSING_RECAPTCHA_TOKEN","missing-recaptcha-token"),"INVALID_RECAPTCHA_TOKEN","invalid-recaptcha-token"),"INVALID_RECAPTCHA_ACTION","invalid-recaptcha-action"),"MISSING_CLIENT_TYPE","missing-client-type"),"MISSING_RECAPTCHA_VERSION","missing-recaptcha-version"),"INVALID_RECAPTCHA_VERSION","invalid-recaptcha-version"),"INVALID_REQ_TYPE","invalid-req-type"));/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var pt=new he(3e4,6e4);function mr(a,r){return a.tenantId&&!r.tenantId?Object.assign(Object.assign({},r),{tenantId:a.tenantId}):r}function ae(a,r,e,t){return De.apply(this,arguments)}function De(){return De=p(c().mark(function a(r,e,t,n){var i,s=arguments;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return i=s.length>4&&s[4]!==void 0?s[4]:{},o.abrupt("return",tn(r,i,p(c().mark(function l(){var h,d,v,f;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:return h={},d={},n&&(e==="GET"?d=n:h={body:JSON.stringify(n)}),v=ce(Object.assign({key:r.config.apiKey},d)).slice(1),g.next=6,r._getAdditionalHeaders();case 6:return f=g.sent,f["Content-Type"]="application/json",r.languageCode&&(f["X-Firebase-Locale"]=r.languageCode),g.abrupt("return",nn.fetch()(an(r,r.config.apiHost,t,v),Object.assign({method:e,headers:f,referrerPolicy:"no-referrer"},h)));case 10:case"end":return g.stop()}},l)}))));case 2:case"end":return o.stop()}},a)})),De.apply(this,arguments)}function tn(a,r,e){return Fe.apply(this,arguments)}function Fe(){return Fe=p(c().mark(function a(r,e,t){var n,i,s,u,o,l,h,d,v,f;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:return r._canInitEmulator=!1,n=Object.assign(Object.assign({},ft),e),g.prev=2,i=new gt(r),g.next=6,Promise.race([t(),i.promise]);case 6:return s=g.sent,i.clearNetworkTimeout(),g.next=10,s.json();case 10:if(u=g.sent,!("needConfirmation"in u)){g.next=13;break}throw ge(r,"account-exists-with-different-credential",u);case 13:if(!(s.ok&&!("errorMessage"in u))){g.next=17;break}return g.abrupt("return",u);case 17:if(o=s.ok?u.errorMessage:u.error.message,l=o.split(" : "),h=V(l,2),d=h[0],v=h[1],d!=="FEDERATED_USER_ID_ALREADY_LINKED"){g.next=23;break}throw ge(r,"credential-already-in-use",u);case 23:if(d!=="EMAIL_EXISTS"){g.next=27;break}throw ge(r,"email-already-in-use",u);case 27:if(d!=="USER_DISABLED"){g.next=29;break}throw ge(r,"user-disabled",u);case 29:if(f=n[d]||d.toLowerCase().replace(/[_\s]+/g,"-"),!v){g.next=34;break}throw rn(r,f,v);case 34:H(r,f);case 35:g.next=42;break;case 37:if(g.prev=37,g.t0=g.catch(2),!(g.t0 instanceof fr)){g.next=41;break}throw g.t0;case 41:H(r,"network-request-failed",{message:String(g.t0)});case 42:case"end":return g.stop()}},a,null,[[2,37]])})),Fe.apply(this,arguments)}function vt(a,r,e,t){return $e.apply(this,arguments)}function $e(){return $e=p(c().mark(function a(r,e,t,n){var i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return i=u.length>4&&u[4]!==void 0?u[4]:{},l.next=3,ae(r,e,t,n,i);case 3:return s=l.sent,"mfaPendingCredential"in s&&H(r,"multi-factor-auth-required",{_serverResponse:s}),l.abrupt("return",s);case 6:case"end":return l.stop()}},a)})),$e.apply(this,arguments)}function an(a,r,e,t){var n="".concat(r).concat(e,"?").concat(t);return a.config.emulator?gr(a.config,n):"".concat(a.config.apiScheme,"://").concat(n)}var gt=function(){function a(r){var e=this;b(this,a),this.auth=r,this.timer=null,this.promise=new Promise(function(t,n){e.timer=setTimeout(function(){return n(j(e.auth,"network-request-failed"))},pt.get())})}return I(a,[{key:"clearNetworkTimeout",value:function(){clearTimeout(this.timer)}}]),a}();function ge(a,r,e){var t={appName:a.name};e.email&&(t.email=e.email),e.phoneNumber&&(t.phoneNumber=e.phoneNumber);var n=j(a,r,t);return n.customData._tokenResponse=e,n}function mt(a,r){return Ve.apply(this,arguments)}function Ve(){return Ve=p(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",ae(r,"POST","/v1/accounts:delete",e));case 1:case"end":return n.stop()}},a)})),Ve.apply(this,arguments)}function kt(a,r){return je.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function je(){return je=p(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",ae(r,"POST","/v1/accounts:lookup",e));case 1:case"end":return n.stop()}},a)})),je.apply(this,arguments)}function se(a){if(a)try{var r=new Date(Number(a));if(!isNaN(r.getTime()))return r.toUTCString()}catch{}}function wt(a){return We.apply(this,arguments)}function We(){return We=p(c().mark(function a(r){var e,t,n,i,s,u,o=arguments;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return e=o.length>1&&o[1]!==void 0?o[1]:!1,t=ie(r),h.next=4,t.getIdToken(e);case 4:return n=h.sent,i=kr(n),y(i&&i.exp&&i.auth_time&&i.iat,t.auth,"internal-error"),s=Xn(i.firebase)==="object"?i.firebase:void 0,u=s==null?void 0:s.sign_in_provider,h.abrupt("return",{claims:i,token:n,authTime:se(Ce(i.auth_time)),issuedAtTime:se(Ce(i.iat)),expirationTime:se(Ce(i.exp)),signInProvider:u||null,signInSecondFactor:(s==null?void 0:s.sign_in_second_factor)||null});case 10:case"end":return h.stop()}},a)})),We.apply(this,arguments)}function Ce(a){return Number(a)*1e3}function kr(a){var r=a.split("."),e=V(r,3),t=e[0],n=e[1],i=e[2];if(t===void 0||n===void 0||i===void 0)return me("JWT malformed, contained fewer than 3 sections"),null;try{var s=Yn(n);return s?JSON.parse(s):(me("Failed to decode base64 JWT payload"),null)}catch(u){return me("Caught error parsing JWT payload as JSON",u==null?void 0:u.toString()),null}}function yt(a){var r=kr(a);return y(r,"internal-error"),y(typeof r.exp<"u","internal-error"),y(typeof r.iat<"u","internal-error"),Number(r.exp)-Number(r.iat)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function oe(a,r){return He.apply(this,arguments)}function He(){return He=p(c().mark(function a(r,e){var t,n=arguments;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(t=n.length>2&&n[2]!==void 0?n[2]:!1,!t){s.next=3;break}return s.abrupt("return",e);case 3:return s.prev=3,s.next=6,e;case 6:return s.abrupt("return",s.sent);case 9:if(s.prev=9,s.t0=s.catch(3),!(s.t0 instanceof fr&&It(s.t0))){s.next=15;break}if(r.auth.currentUser!==r){s.next=15;break}return s.next=15,r.auth.signOut();case 15:throw s.t0;case 16:case"end":return s.stop()}},a,null,[[3,9]])})),He.apply(this,arguments)}function It(a){var r=a.code;return r==="auth/".concat("user-disabled")||r==="auth/".concat("user-token-expired")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var bt=function(){function a(r){b(this,a),this.user=r,this.isRunning=!1,this.timerId=null,this.errorBackoff=3e4}return I(a,[{key:"_start",value:function(){this.isRunning||(this.isRunning=!0,this.schedule())}},{key:"_stop",value:function(){this.isRunning&&(this.isRunning=!1,this.timerId!==null&&clearTimeout(this.timerId))}},{key:"getInterval",value:function(e){var t;if(e){var n=this.errorBackoff;return this.errorBackoff=Math.min(this.errorBackoff*2,96e4),n}else{this.errorBackoff=3e4;var i=(t=this.user.stsTokenManager.expirationTime)!==null&&t!==void 0?t:0,s=i-Date.now()-3e5;return Math.max(0,s)}}},{key:"schedule",value:function(){var e=this,t=arguments.length>0&&arguments[0]!==void 0?arguments[0]:!1;if(this.isRunning){var n=this.getInterval(t);this.timerId=setTimeout(p(c().mark(function i(){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,e.iteration();case 2:case"end":return u.stop()}},i)})),n)}}},{key:"iteration",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,this.user.getIdToken(!0);case 3:i.next=9;break;case 5:return i.prev=5,i.t0=i.catch(0),(i.t0===null||i.t0===void 0?void 0:i.t0.code)==="auth/".concat("network-request-failed")&&this.schedule(!0),i.abrupt("return");case 9:this.schedule();case 10:case"end":return i.stop()}},t,this,[[0,5]])}));function e(){return r.apply(this,arguments)}return e}()}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var sn=function(){function a(r,e){b(this,a),this.createdAt=r,this.lastLoginAt=e,this._initializeTime()}return I(a,[{key:"_initializeTime",value:function(){this.lastSignInTime=se(this.lastLoginAt),this.creationTime=se(this.createdAt)}},{key:"_copy",value:function(e){this.createdAt=e.createdAt,this.lastLoginAt=e.lastLoginAt,this._initializeTime()}},{key:"toJSON",value:function(){return{createdAt:this.createdAt,lastLoginAt:this.lastLoginAt}}}]),a}();/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ie(a){return ze.apply(this,arguments)}function ze(){return ze=p(c().mark(function a(r){var e,t,n,i,s,u,o,l,h,d,v;return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:return t=r.auth,m.next=3,r.getIdToken();case 3:return n=m.sent,m.next=6,oe(r,kt(t,{idToken:n}));case 6:i=m.sent,y(i==null?void 0:i.users.length,t,"internal-error"),s=i.users[0],r._notifyReloadListener(s),u=!((e=s.providerUserInfo)===null||e===void 0)&&e.length?St(s.providerUserInfo):[],o=_t(r.providerData,u),l=r.isAnonymous,h=!(r.email&&s.passwordHash)&&!(o!=null&&o.length),d=l?h:!1,v={uid:s.localId,displayName:s.displayName||null,photoURL:s.photoUrl||null,email:s.email||null,emailVerified:s.emailVerified||!1,phoneNumber:s.phoneNumber||null,tenantId:s.tenantId||null,providerData:o,metadata:new sn(s.createdAt,s.lastLoginAt),isAnonymous:d},Object.assign(r,v);case 17:case"end":return m.stop()}},a)})),ze.apply(this,arguments)}function Tt(a){return qe.apply(this,arguments)}function qe(){return qe=p(c().mark(function a(r){var e;return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return e=ie(r),n.next=3,Ie(e);case 3:return n.next=5,e.auth._persistUserIfCurrent(e);case 5:e.auth._notifyListenersIfCurrent(e);case 6:case"end":return n.stop()}},a)})),qe.apply(this,arguments)}function _t(a,r){var e=a.filter(function(t){return!r.some(function(n){return n.providerId===t.providerId})});return[].concat(Y(e),Y(r))}function St(a){return a.map(function(r){var e=r.providerId,t=pr(r,["providerId"]);return{providerId:e,uid:t.rawId||"",displayName:t.displayName||null,email:t.email||null,phoneNumber:t.phoneNumber||null,photoURL:t.photoUrl||null}})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Et(a,r){return Ge.apply(this,arguments)}function Ge(){return Ge=p(c().mark(function a(r,e){var t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,tn(r,{},p(c().mark(function s(){var u,o,l,h,d,v;return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:return u=ce({grant_type:"refresh_token",refresh_token:e}).slice(1),o=r.config,l=o.tokenApiHost,h=o.apiKey,d=an(r,l,"/v1/token","key=".concat(h)),m.next=5,r._getAdditionalHeaders();case 5:return v=m.sent,v["Content-Type"]="application/x-www-form-urlencoded",m.abrupt("return",nn.fetch()(d,{method:"POST",headers:v,body:u}));case 8:case"end":return m.stop()}},s)})));case 2:return t=i.sent,i.abrupt("return",{accessToken:t.access_token,expiresIn:t.expires_in,refreshToken:t.refresh_token});case 4:case"end":return i.stop()}},a)})),Ge.apply(this,arguments)}function Pt(a,r){return Be.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Be(){return Be=p(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",ae(r,"POST","/v2/accounts:revokeToken",mr(r,e)));case 1:case"end":return n.stop()}},a)})),Be.apply(this,arguments)}var Lr=function(){function a(){b(this,a),this.refreshToken=null,this.accessToken=null,this.expirationTime=null}return I(a,[{key:"isExpired",get:function(){return!this.expirationTime||Date.now()>this.expirationTime-3e4}},{key:"updateFromServerResponse",value:function(e){y(e.idToken,"internal-error"),y(typeof e.idToken<"u","internal-error"),y(typeof e.refreshToken<"u","internal-error");var t="expiresIn"in e&&typeof e.expiresIn<"u"?Number(e.expiresIn):yt(e.idToken);this.updateTokensAndExpiration(e.idToken,e.refreshToken,t)}},{key:"getToken",value:function(){var r=p(c().mark(function t(n){var i,s=arguments;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(i=s.length>1&&s[1]!==void 0?s[1]:!1,y(!this.accessToken||this.refreshToken,n,"user-token-expired"),!(!i&&this.accessToken&&!this.isExpired)){o.next=4;break}return o.abrupt("return",this.accessToken);case 4:if(!this.refreshToken){o.next=8;break}return o.next=7,this.refresh(n,this.refreshToken);case 7:return o.abrupt("return",this.accessToken);case 8:return o.abrupt("return",null);case 9:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"clearRefreshToken",value:function(){this.refreshToken=null}},{key:"refresh",value:function(){var r=p(c().mark(function t(n,i){var s,u,o,l;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return d.next=2,Et(n,i);case 2:s=d.sent,u=s.accessToken,o=s.refreshToken,l=s.expiresIn,this.updateTokensAndExpiration(u,o,Number(l));case 7:case"end":return d.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"updateTokensAndExpiration",value:function(e,t,n){this.refreshToken=t||null,this.accessToken=e||null,this.expirationTime=Date.now()+n*1e3}},{key:"toJSON",value:function(){return{refreshToken:this.refreshToken,accessToken:this.accessToken,expirationTime:this.expirationTime}}},{key:"_assign",value:function(e){this.accessToken=e.accessToken,this.refreshToken=e.refreshToken,this.expirationTime=e.expirationTime}},{key:"_clone",value:function(){return Object.assign(new a,this.toJSON())}},{key:"_performRefresh",value:function(){return G("not implemented")}}],[{key:"fromJSON",value:function(e,t){var n=t.refreshToken,i=t.accessToken,s=t.expirationTime,u=new a;return n&&(y(typeof n=="string","internal-error",{appName:e}),u.refreshToken=n),i&&(y(typeof i=="string","internal-error",{appName:e}),u.accessToken=i),s&&(y(typeof s=="number","internal-error",{appName:e}),u.expirationTime=s),u}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function X(a,r){y(typeof a=="string"||typeof a>"u","internal-error",{appName:r})}var Ke=function(){function a(r){b(this,a);var e=r.uid,t=r.auth,n=r.stsTokenManager,i=pr(r,["uid","auth","stsTokenManager"]);this.providerId="firebase",this.proactiveRefresh=new bt(this),this.reloadUserInfo=null,this.reloadListener=null,this.uid=e,this.auth=t,this.stsTokenManager=n,this.accessToken=n.accessToken,this.displayName=i.displayName||null,this.email=i.email||null,this.emailVerified=i.emailVerified||!1,this.phoneNumber=i.phoneNumber||null,this.photoURL=i.photoURL||null,this.isAnonymous=i.isAnonymous||!1,this.tenantId=i.tenantId||null,this.providerData=i.providerData?Y(i.providerData):[],this.metadata=new sn(i.createdAt||void 0,i.lastLoginAt||void 0)}return I(a,[{key:"getIdToken",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,oe(this,this.stsTokenManager.getToken(this.auth,n));case 2:if(i=u.sent,y(i,this.auth,"internal-error"),this.accessToken===i){u.next=9;break}return this.accessToken=i,u.next=8,this.auth._persistUserIfCurrent(this);case 8:this.auth._notifyListenersIfCurrent(this);case 9:return u.abrupt("return",i);case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"getIdTokenResult",value:function(e){return wt(this,e)}},{key:"reload",value:function(){return Tt(this)}},{key:"_assign",value:function(e){this!==e&&(y(this.uid===e.uid,this.auth,"internal-error"),this.displayName=e.displayName,this.photoURL=e.photoURL,this.email=e.email,this.emailVerified=e.emailVerified,this.phoneNumber=e.phoneNumber,this.isAnonymous=e.isAnonymous,this.tenantId=e.tenantId,this.providerData=e.providerData.map(function(t){return Object.assign({},t)}),this.metadata._copy(e.metadata),this.stsTokenManager._assign(e.stsTokenManager))}},{key:"_clone",value:function(e){var t=new a(Object.assign(Object.assign({},this),{auth:e,stsTokenManager:this.stsTokenManager._clone()}));return t.metadata._copy(this.metadata),t}},{key:"_onReload",value:function(e){y(!this.reloadListener,this.auth,"internal-error"),this.reloadListener=e,this.reloadUserInfo&&(this._notifyReloadListener(this.reloadUserInfo),this.reloadUserInfo=null)}},{key:"_notifyReloadListener",value:function(e){this.reloadListener?this.reloadListener(e):this.reloadUserInfo=e}},{key:"_startProactiveRefresh",value:function(){this.proactiveRefresh._start()}},{key:"_stopProactiveRefresh",value:function(){this.proactiveRefresh._stop()}},{key:"_updateTokensIfNecessary",value:function(){var r=p(c().mark(function t(n){var i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(i=u.length>1&&u[1]!==void 0?u[1]:!1,s=!1,n.idToken&&n.idToken!==this.stsTokenManager.accessToken&&(this.stsTokenManager.updateFromServerResponse(n),s=!0),!i){l.next=6;break}return l.next=6,Ie(this);case 6:return l.next=8,this.auth._persistUserIfCurrent(this);case 8:s&&this.auth._notifyListenersIfCurrent(this);case 9:case"end":return l.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"delete",value:function(){var r=p(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,this.getIdToken();case 2:return n=s.sent,s.next=5,oe(this,mt(this.auth,{idToken:n}));case 5:return this.stsTokenManager.clearRefreshToken(),s.abrupt("return",this.auth.signOut());case 7:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"toJSON",value:function(){return Object.assign(Object.assign({uid:this.uid,email:this.email||void 0,emailVerified:this.emailVerified,displayName:this.displayName||void 0,isAnonymous:this.isAnonymous,photoURL:this.photoURL||void 0,phoneNumber:this.phoneNumber||void 0,tenantId:this.tenantId||void 0,providerData:this.providerData.map(function(e){return Object.assign({},e)}),stsTokenManager:this.stsTokenManager.toJSON(),_redirectEventId:this._redirectEventId},this.metadata.toJSON()),{apiKey:this.auth.config.apiKey,appName:this.auth.name})}},{key:"refreshToken",get:function(){return this.stsTokenManager.refreshToken||""}}],[{key:"_fromJSON",value:function(e,t){var n,i,s,u,o,l,h,d,v=(n=t.displayName)!==null&&n!==void 0?n:void 0,f=(i=t.email)!==null&&i!==void 0?i:void 0,m=(s=t.phoneNumber)!==null&&s!==void 0?s:void 0,g=(u=t.photoURL)!==null&&u!==void 0?u:void 0,T=(o=t.tenantId)!==null&&o!==void 0?o:void 0,E=(l=t._redirectEventId)!==null&&l!==void 0?l:void 0,M=(h=t.createdAt)!==null&&h!==void 0?h:void 0,w=(d=t.lastLoginAt)!==null&&d!==void 0?d:void 0,P=t.uid,C=t.emailVerified,U=t.isAnonymous,J=t.providerData,S=t.stsTokenManager;y(P&&S,e,"internal-error");var Pe=Lr.fromJSON(this.name,S);y(typeof P=="string",e,"internal-error"),X(v,e.name),X(f,e.name),y(typeof C=="boolean",e,"internal-error"),y(typeof U=="boolean",e,"internal-error"),X(m,e.name),X(g,e.name),X(T,e.name),X(E,e.name),X(M,e.name),X(w,e.name);var Q=new a({uid:P,auth:e,email:f,emailVerified:C,displayName:v,isAnonymous:U,photoURL:g,phoneNumber:m,tenantId:T,stsTokenManager:Pe,createdAt:M,lastLoginAt:w});return J&&Array.isArray(J)&&(Q.providerData=J.map(function(Ae){return Object.assign({},Ae)})),E&&(Q._redirectEventId=E),Q}},{key:"_fromIdTokenResponse",value:function(){var r=p(c().mark(function t(n,i){var s,u,o,l=arguments;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return s=l.length>2&&l[2]!==void 0?l[2]:!1,u=new Lr,u.updateFromServerResponse(i),o=new a({uid:i.localId,auth:n,stsTokenManager:u,isAnonymous:s}),d.next=6,Ie(o);case 6:return d.abrupt("return",o);case 7:case"end":return d.stop()}},t)}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Mr=new Map;function B(a){K(a instanceof Function,"Expected a class definition");var r=Mr.get(a);return r?(K(r instanceof a,"Instance stored in cache mismatched with class"),r):(r=new a,Mr.set(a,r),r)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var un=function(){function a(){b(this,a),this.type="NONE",this.storage={}}return I(a,[{key:"_isAvailable",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",!0);case 1:case"end":return i.stop()}},t)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_set",value:function(){var r=p(c().mark(function t(n,i){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:this.storage[n]=i;case 1:case"end":return u.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"_get",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=this.storage[n],u.abrupt("return",i===void 0?null:i);case 2:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_remove",value:function(){var r=p(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:delete this.storage[n];case 1:case"end":return s.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_addListener",value:function(e,t){}},{key:"_removeListener",value:function(e,t){}}]),a}();un.type="NONE";var Ur=un;/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ke(a,r,e){return"firebase".concat(":",a,":").concat(r,":").concat(e)}var Dr=function(){function a(r,e,t){b(this,a),this.persistence=r,this.auth=e,this.userKey=t;var n=this.auth,i=n.config,s=n.name;this.fullUserKey=ke(this.userKey,i.apiKey,s),this.fullPersistenceKey=ke("persistence",i.apiKey,s),this.boundEventHandler=e._onStorageEvent.bind(e),this.persistence._addListener(this.fullUserKey,this.boundEventHandler)}return I(a,[{key:"setCurrentUser",value:function(e){return this.persistence._set(this.fullUserKey,e.toJSON())}},{key:"getCurrentUser",value:function(){var r=p(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,this.persistence._get(this.fullUserKey);case 2:return n=s.sent,s.abrupt("return",n?Ke._fromJSON(this.auth,n):null);case 4:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"removeCurrentUser",value:function(){return this.persistence._remove(this.fullUserKey)}},{key:"savePersistenceForRedirect",value:function(){return this.persistence._set(this.fullPersistenceKey,this.persistence.type)}},{key:"setPersistence",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this.persistence!==n){u.next=2;break}return u.abrupt("return");case 2:return u.next=4,this.getCurrentUser();case 4:return i=u.sent,u.next=7,this.removeCurrentUser();case 7:if(this.persistence=n,!i){u.next=10;break}return u.abrupt("return",this.setCurrentUser(i));case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"delete",value:function(){this.persistence._removeListener(this.fullUserKey,this.boundEventHandler)}}],[{key:"create",value:function(){var r=p(c().mark(function t(n,i){var s,u,o,l,h,d,v,f,m,g,T,E=arguments;return c().wrap(function(w){for(;;)switch(w.prev=w.next){case 0:if(s=E.length>2&&E[2]!==void 0?E[2]:"authUser",i.length){w.next=3;break}return w.abrupt("return",new a(B(Ur),n,s));case 3:return w.next=5,Promise.all(i.map(function(){var P=p(c().mark(function C(U){return c().wrap(function(S){for(;;)switch(S.prev=S.next){case 0:return S.next=2,U._isAvailable();case 2:if(!S.sent){S.next=4;break}return S.abrupt("return",U);case 4:return S.abrupt("return",void 0);case 5:case"end":return S.stop()}},C)}));return function(C){return P.apply(this,arguments)}}()));case 5:u=w.sent.filter(function(P){return P}),o=u[0]||B(Ur),l=ke(s,n.config.apiKey,n.name),h=null,d=ue(i),w.prev=10,d.s();case 12:if((v=d.n()).done){w.next=29;break}return f=v.value,w.prev=14,w.next=17,f._get(l);case 17:if(m=w.sent,!m){w.next=23;break}return g=Ke._fromJSON(n,m),f!==o&&(h=g),o=f,w.abrupt("break",29);case 23:w.next=27;break;case 25:w.prev=25,w.t0=w.catch(14);case 27:w.next=12;break;case 29:w.next=34;break;case 31:w.prev=31,w.t1=w.catch(10),d.e(w.t1);case 34:return w.prev=34,d.f(),w.finish(34);case 37:if(T=u.filter(function(P){return P._shouldAllowMigration}),!(!o._shouldAllowMigration||!T.length)){w.next=40;break}return w.abrupt("return",new a(o,n,s));case 40:if(o=T[0],!h){w.next=44;break}return w.next=44,o._set(l,h.toJSON());case 44:return w.next=46,Promise.all(i.map(function(){var P=p(c().mark(function C(U){return c().wrap(function(S){for(;;)switch(S.prev=S.next){case 0:if(U===o){S.next=8;break}return S.prev=1,S.next=4,U._remove(l);case 4:S.next=8;break;case 6:S.prev=6,S.t0=S.catch(1);case 8:case"end":return S.stop()}},C,null,[[1,6]])}));return function(C){return P.apply(this,arguments)}}()));case 46:return w.abrupt("return",new a(o,n,s));case 47:case"end":return w.stop()}},t,null,[[10,31,34,37],[14,25]])}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Fr(a){var r=a.toLowerCase();if(r.includes("opera/")||r.includes("opr/")||r.includes("opios/"))return"Opera";if(cn(r))return"IEMobile";if(r.includes("msie")||r.includes("trident/"))return"IE";if(r.includes("edge/"))return"Edge";if(on(r))return"Firefox";if(r.includes("silk/"))return"Silk";if(dn(r))return"Blackberry";if(fn(r))return"Webos";if(wr(r))return"Safari";if((r.includes("chrome/")||ln(r))&&!r.includes("edge/"))return"Chrome";if(hn(r))return"Android";var e=/([a-zA-Z\d\.]+)\/[a-zA-Z\d\.]*$/,t=a.match(e);return(t==null?void 0:t.length)===2?t[1]:"Other"}function on(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/firefox\//i.test(a)}function wr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L(),r=a.toLowerCase();return r.includes("safari/")&&!r.includes("chrome/")&&!r.includes("crios/")&&!r.includes("android")}function ln(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/crios\//i.test(a)}function cn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/iemobile/i.test(a)}function hn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/android/i.test(a)}function dn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/blackberry/i.test(a)}function fn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/webos/i.test(a)}function _e(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return/iphone|ipad|ipod/i.test(a)||/macintosh/i.test(a)&&/mobile/i.test(a)}function At(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L(),r;return _e(a)&&!!(!((r=window.navigator)===null||r===void 0)&&r.standalone)}function Rt(){return Kn()&&document.documentMode===10}function pn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:L();return _e(a)||hn(a)||fn(a)||dn(a)||/windows phone/i.test(a)||cn(a)}function Ct(){try{return!!(window&&window!==window.top)}catch{return!1}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function vn(a){var r=arguments.length>1&&arguments[1]!==void 0?arguments[1]:[],e;switch(a){case"Browser":e=Fr(L());break;case"Worker":e="".concat(Fr(L()),"-").concat(a);break;default:e=a}var t=r.length?r.join(","):"FirebaseCore-web";return"".concat(e,"/","JsCore","/").concat(le,"/").concat(t)}/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ot=function(){function a(r){b(this,a),this.auth=r,this.queue=[]}return I(a,[{key:"pushCallback",value:function(e,t){var n=this,i=function(o){return new Promise(function(l,h){try{var d=e(o);l(d)}catch(v){h(v)}})};i.onAbort=t,this.queue.push(i);var s=this.queue.length-1;return function(){n.queue[s]=function(){return Promise.resolve()}}}},{key:"runMiddleware",value:function(){var r=p(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:if(this.auth.currentUser!==n){f.next=2;break}return f.abrupt("return");case 2:i=[],f.prev=3,s=ue(this.queue),f.prev=5,s.s();case 7:if((u=s.n()).done){f.next=14;break}return o=u.value,f.next=11,o(n);case 11:o.onAbort&&i.push(o.onAbort);case 12:f.next=7;break;case 14:f.next=19;break;case 16:f.prev=16,f.t0=f.catch(5),s.e(f.t0);case 19:return f.prev=19,s.f(),f.finish(19);case 22:f.next=30;break;case 24:f.prev=24,f.t1=f.catch(3),i.reverse(),l=ue(i);try{for(l.s();!(h=l.n()).done;){d=h.value;try{d()}catch{}}}catch(m){l.e(m)}finally{l.f()}throw this.auth._errorFactory.create("login-blocked",{originalMessage:f.t1===null||f.t1===void 0?void 0:f.t1.message});case 30:case"end":return f.stop()}},t,this,[[3,24],[5,16,19,22]])}));function e(t){return r.apply(this,arguments)}return e}()}]),a}();/**
 * @license
 * Copyright 2023 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Nt(a){return Je.apply(this,arguments)}/**
 * @license
 * Copyright 2023 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Je(){return Je=p(c().mark(function a(r){var e,t=arguments;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=t.length>1&&t[1]!==void 0?t[1]:{},i.abrupt("return",ae(r,"GET","/v2/passwordPolicy",mr(r,e)));case 2:case"end":return i.stop()}},a)})),Je.apply(this,arguments)}var Lt=6,Mt=function(){function a(r){b(this,a);var e,t,n,i,s=r.customStrengthOptions;this.customStrengthOptions={},this.customStrengthOptions.minPasswordLength=(e=s.minPasswordLength)!==null&&e!==void 0?e:Lt,s.maxPasswordLength&&(this.customStrengthOptions.maxPasswordLength=s.maxPasswordLength),s.containsLowercaseCharacter!==void 0&&(this.customStrengthOptions.containsLowercaseLetter=s.containsLowercaseCharacter),s.containsUppercaseCharacter!==void 0&&(this.customStrengthOptions.containsUppercaseLetter=s.containsUppercaseCharacter),s.containsNumericCharacter!==void 0&&(this.customStrengthOptions.containsNumericCharacter=s.containsNumericCharacter),s.containsNonAlphanumericCharacter!==void 0&&(this.customStrengthOptions.containsNonAlphanumericCharacter=s.containsNonAlphanumericCharacter),this.enforcementState=r.enforcementState,this.enforcementState==="ENFORCEMENT_STATE_UNSPECIFIED"&&(this.enforcementState="OFF"),this.allowedNonAlphanumericCharacters=(n=(t=r.allowedNonAlphanumericCharacters)===null||t===void 0?void 0:t.join(""))!==null&&n!==void 0?n:"",this.forceUpgradeOnSignin=(i=r.forceUpgradeOnSignin)!==null&&i!==void 0?i:!1,this.schemaVersion=r.schemaVersion}return I(a,[{key:"validatePassword",value:function(e){var t,n,i,s,u,o,l={isValid:!0,passwordPolicy:this};return this.validatePasswordLengthOptions(e,l),this.validatePasswordCharacterOptions(e,l),l.isValid&&(l.isValid=(t=l.meetsMinPasswordLength)!==null&&t!==void 0?t:!0),l.isValid&&(l.isValid=(n=l.meetsMaxPasswordLength)!==null&&n!==void 0?n:!0),l.isValid&&(l.isValid=(i=l.containsLowercaseLetter)!==null&&i!==void 0?i:!0),l.isValid&&(l.isValid=(s=l.containsUppercaseLetter)!==null&&s!==void 0?s:!0),l.isValid&&(l.isValid=(u=l.containsNumericCharacter)!==null&&u!==void 0?u:!0),l.isValid&&(l.isValid=(o=l.containsNonAlphanumericCharacter)!==null&&o!==void 0?o:!0),l}},{key:"validatePasswordLengthOptions",value:function(e,t){var n=this.customStrengthOptions.minPasswordLength,i=this.customStrengthOptions.maxPasswordLength;n&&(t.meetsMinPasswordLength=e.length>=n),i&&(t.meetsMaxPasswordLength=e.length<=i)}},{key:"validatePasswordCharacterOptions",value:function(e,t){this.updatePasswordCharacterOptionsStatuses(t,!1,!1,!1,!1);for(var n,i=0;i<e.length;i++)n=e.charAt(i),this.updatePasswordCharacterOptionsStatuses(t,n>="a"&&n<="z",n>="A"&&n<="Z",n>="0"&&n<="9",this.allowedNonAlphanumericCharacters.includes(n))}},{key:"updatePasswordCharacterOptionsStatuses",value:function(e,t,n,i,s){this.customStrengthOptions.containsLowercaseLetter&&(e.containsLowercaseLetter||(e.containsLowercaseLetter=t)),this.customStrengthOptions.containsUppercaseLetter&&(e.containsUppercaseLetter||(e.containsUppercaseLetter=n)),this.customStrengthOptions.containsNumericCharacter&&(e.containsNumericCharacter||(e.containsNumericCharacter=i)),this.customStrengthOptions.containsNonAlphanumericCharacter&&(e.containsNonAlphanumericCharacter||(e.containsNonAlphanumericCharacter=s))}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ut=function(){function a(r,e,t,n){b(this,a),this.app=r,this.heartbeatServiceProvider=e,this.appCheckServiceProvider=t,this.config=n,this.currentUser=null,this.emulatorConfig=null,this.operations=Promise.resolve(),this.authStateSubscription=new $r(this),this.idTokenSubscription=new $r(this),this.beforeStateQueue=new Ot(this),this.redirectUser=null,this.isProactiveRefreshEnabled=!1,this.EXPECTED_PASSWORD_POLICY_SCHEMA_VERSION=1,this._canInitEmulator=!0,this._isInitialized=!1,this._deleted=!1,this._initializationPromise=null,this._popupRedirectResolver=null,this._errorFactory=Me,this._agentRecaptchaConfig=null,this._tenantRecaptchaConfigs={},this._projectPasswordPolicy=null,this._tenantPasswordPolicies={},this.lastNotifiedUid=void 0,this.languageCode=null,this.tenantId=null,this.settings={appVerificationDisabledForTesting:!1},this.frameworks=[],this.name=r.name,this.clientVersion=n.sdkClientVersion}return I(a,[{key:"_initializeWithPersistence",value:function(e,t){var n=this;return t&&(this._popupRedirectResolver=B(t)),this._initializationPromise=this.queue(p(c().mark(function i(){var s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(!n._deleted){l.next=2;break}return l.abrupt("return");case 2:return l.next=4,Dr.create(n,e);case 4:if(n.persistenceManager=l.sent,!n._deleted){l.next=7;break}return l.abrupt("return");case 7:if(!(!((s=n._popupRedirectResolver)===null||s===void 0)&&s._shouldInitProactively)){l.next=15;break}return l.prev=8,l.next=11,n._popupRedirectResolver._initialize(n);case 11:l.next=15;break;case 13:l.prev=13,l.t0=l.catch(8);case 15:return l.next=17,n.initializeCurrentUser(t);case 17:if(n.lastNotifiedUid=((u=n.currentUser)===null||u===void 0?void 0:u.uid)||null,!n._deleted){l.next=20;break}return l.abrupt("return");case 20:n._isInitialized=!0;case 21:case"end":return l.stop()}},i,null,[[8,13]])}))),this._initializationPromise}},{key:"_onStorageEvent",value:function(){var r=p(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(!this._deleted){s.next=2;break}return s.abrupt("return");case 2:return s.next=4,this.assertedPersistence.getCurrentUser();case 4:if(n=s.sent,!(!this.currentUser&&!n)){s.next=7;break}return s.abrupt("return");case 7:if(!(this.currentUser&&n&&this.currentUser.uid===n.uid)){s.next=12;break}return this._currentUser._assign(n),s.next=11,this.currentUser.getIdToken();case 11:return s.abrupt("return");case 12:return s.next=14,this._updateCurrentUser(n,!0);case 14:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeCurrentUser",value:function(){var r=p(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:return f.next=2,this.assertedPersistence.getCurrentUser();case 2:if(s=f.sent,u=s,o=!1,!(n&&this.config.authDomain)){f.next=14;break}return f.next=8,this.getOrInitRedirectPersistenceManager();case 8:return l=(i=this.redirectUser)===null||i===void 0?void 0:i._redirectEventId,h=u==null?void 0:u._redirectEventId,f.next=12,this.tryRedirectSignIn(n);case 12:d=f.sent,(!l||l===h)&&(d!=null&&d.user)&&(u=d.user,o=!0);case 14:if(u){f.next=16;break}return f.abrupt("return",this.directlySetCurrentUser(null));case 16:if(u._redirectEventId){f.next=32;break}if(!o){f.next=27;break}return f.prev=18,f.next=21,this.beforeStateQueue.runMiddleware(u);case 21:f.next=27;break;case 23:f.prev=23,f.t0=f.catch(18),u=s,this._popupRedirectResolver._overrideRedirectResult(this,function(){return Promise.reject(f.t0)});case 27:if(!u){f.next=31;break}return f.abrupt("return",this.reloadAndSetCurrentUserOrClear(u));case 31:return f.abrupt("return",this.directlySetCurrentUser(null));case 32:return y(this._popupRedirectResolver,this,"argument-error"),f.next=35,this.getOrInitRedirectPersistenceManager();case 35:if(!(this.redirectUser&&this.redirectUser._redirectEventId===u._redirectEventId)){f.next=37;break}return f.abrupt("return",this.directlySetCurrentUser(u));case 37:return f.abrupt("return",this.reloadAndSetCurrentUserOrClear(u));case 38:case"end":return f.stop()}},t,this,[[18,23]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"tryRedirectSignIn",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=null,u.prev=1,u.next=4,this._popupRedirectResolver._completeRedirectFn(this,n,!0);case 4:i=u.sent,u.next=11;break;case 7:return u.prev=7,u.t0=u.catch(1),u.next=11,this._setRedirectUser(null);case 11:return u.abrupt("return",i);case 12:case"end":return u.stop()}},t,this,[[1,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"reloadAndSetCurrentUserOrClear",value:function(){var r=p(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,Ie(n);case 3:s.next=9;break;case 5:if(s.prev=5,s.t0=s.catch(0),(s.t0===null||s.t0===void 0?void 0:s.t0.code)==="auth/".concat("network-request-failed")){s.next=9;break}return s.abrupt("return",this.directlySetCurrentUser(null));case 9:return s.abrupt("return",this.directlySetCurrentUser(n));case 10:case"end":return s.stop()}},t,this,[[0,5]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"useDeviceLanguage",value:function(){this.languageCode=dt()}},{key:"_delete",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:this._deleted=!0;case 1:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"updateCurrentUser",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=n?ie(n):null,i&&y(i.auth.config.apiKey===this.config.apiKey,this,"invalid-user-token"),u.abrupt("return",this._updateCurrentUser(i&&i._clone(this)));case 3:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_updateCurrentUser",value:function(){var r=p(c().mark(function t(n){var i=this,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(s=u.length>1&&u[1]!==void 0?u[1]:!1,!this._deleted){l.next=3;break}return l.abrupt("return");case 3:if(n&&y(this.tenantId===n.tenantId,this,"tenant-id-mismatch"),s){l.next=7;break}return l.next=7,this.beforeStateQueue.runMiddleware(n);case 7:return l.abrupt("return",this.queue(p(c().mark(function h(){return c().wrap(function(v){for(;;)switch(v.prev=v.next){case 0:return v.next=2,i.directlySetCurrentUser(n);case 2:i.notifyAuthListeners();case 3:case"end":return v.stop()}},h)}))));case 8:case"end":return l.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"signOut",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,this.beforeStateQueue.runMiddleware(null);case 2:if(!(this.redirectPersistenceManager||this._popupRedirectResolver)){i.next=5;break}return i.next=5,this._setRedirectUser(null);case 5:return i.abrupt("return",this._updateCurrentUser(null,!0));case 6:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"setPersistence",value:function(e){var t=this;return this.queue(p(c().mark(function n(){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,t.assertedPersistence.setPersistence(B(e));case 2:case"end":return s.stop()}},n)})))}},{key:"_getRecaptchaConfig",value:function(){return this.tenantId==null?this._agentRecaptchaConfig:this._tenantRecaptchaConfigs[this.tenantId]}},{key:"validatePassword",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this._getPasswordPolicyInternal()){u.next=3;break}return u.next=3,this._updatePasswordPolicy();case 3:if(i=this._getPasswordPolicyInternal(),i.schemaVersion===this.EXPECTED_PASSWORD_POLICY_SCHEMA_VERSION){u.next=6;break}return u.abrupt("return",Promise.reject(this._errorFactory.create("unsupported-password-policy-schema-version",{})));case 6:return u.abrupt("return",i.validatePassword(n));case 7:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_getPasswordPolicyInternal",value:function(){return this.tenantId===null?this._projectPasswordPolicy:this._tenantPasswordPolicies[this.tenantId]}},{key:"_updatePasswordPolicy",value:function(){var r=p(c().mark(function t(){var n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,Nt(this);case 2:n=u.sent,i=new Mt(n),this.tenantId===null?this._projectPasswordPolicy=i:this._tenantPasswordPolicies[this.tenantId]=i;case 5:case"end":return u.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_getPersistence",value:function(){return this.assertedPersistence.persistence.type}},{key:"_updateErrorMap",value:function(e){this._errorFactory=new dr("auth","Firebase",e())}},{key:"onAuthStateChanged",value:function(e,t,n){return this.registerStateListener(this.authStateSubscription,e,t,n)}},{key:"beforeAuthStateChanged",value:function(e,t){return this.beforeStateQueue.pushCallback(e,t)}},{key:"onIdTokenChanged",value:function(e,t,n){return this.registerStateListener(this.idTokenSubscription,e,t,n)}},{key:"authStateReady",value:function(){var e=this;return new Promise(function(t,n){if(e.currentUser)t();else var i=e.onAuthStateChanged(function(){i(),t()},n)})}},{key:"revokeAccessToken",value:function(){var r=p(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!this.currentUser){o.next=8;break}return o.next=3,this.currentUser.getIdToken();case 3:return i=o.sent,s={providerId:"apple.com",tokenType:"ACCESS_TOKEN",token:n,idToken:i},this.tenantId!=null&&(s.tenantId=this.tenantId),o.next=8,Pt(this,s);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"toJSON",value:function(){var e;return{apiKey:this.config.apiKey,authDomain:this.config.authDomain,appName:this.name,currentUser:(e=this._currentUser)===null||e===void 0?void 0:e.toJSON()}}},{key:"_setRedirectUser",value:function(){var r=p(c().mark(function t(n,i){var s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,this.getOrInitRedirectPersistenceManager(i);case 2:return s=o.sent,o.abrupt("return",n===null?s.removeCurrentUser():s.setCurrentUser(n));case 4:case"end":return o.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"getOrInitRedirectPersistenceManager",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this.redirectPersistenceManager){u.next=9;break}return i=n&&B(n)||this._popupRedirectResolver,y(i,this,"argument-error"),u.next=5,Dr.create(this,[B(i._redirectPersistence)],"redirectUser");case 5:return this.redirectPersistenceManager=u.sent,u.next=8,this.redirectPersistenceManager.getCurrentUser();case 8:this.redirectUser=u.sent;case 9:return u.abrupt("return",this.redirectPersistenceManager);case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_redirectUserForId",value:function(){var r=p(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!this._isInitialized){o.next=3;break}return o.next=3,this.queue(p(c().mark(function l(){return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:case"end":return d.stop()}},l)})));case 3:if(((i=this._currentUser)===null||i===void 0?void 0:i._redirectEventId)!==n){o.next=5;break}return o.abrupt("return",this._currentUser);case 5:if(((s=this.redirectUser)===null||s===void 0?void 0:s._redirectEventId)!==n){o.next=7;break}return o.abrupt("return",this.redirectUser);case 7:return o.abrupt("return",null);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_persistUserIfCurrent",value:function(){var r=p(c().mark(function t(n){var i=this;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(n!==this.currentUser){u.next=2;break}return u.abrupt("return",this.queue(p(c().mark(function o(){return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.abrupt("return",i.directlySetCurrentUser(n));case 1:case"end":return h.stop()}},o)}))));case 2:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_notifyListenersIfCurrent",value:function(e){e===this.currentUser&&this.notifyAuthListeners()}},{key:"_key",value:function(){return"".concat(this.config.authDomain,":").concat(this.config.apiKey,":").concat(this.name)}},{key:"_startProactiveRefresh",value:function(){this.isProactiveRefreshEnabled=!0,this.currentUser&&this._currentUser._startProactiveRefresh()}},{key:"_stopProactiveRefresh",value:function(){this.isProactiveRefreshEnabled=!1,this.currentUser&&this._currentUser._stopProactiveRefresh()}},{key:"_currentUser",get:function(){return this.currentUser}},{key:"notifyAuthListeners",value:function(){var e,t;if(this._isInitialized){this.idTokenSubscription.next(this.currentUser);var n=(t=(e=this.currentUser)===null||e===void 0?void 0:e.uid)!==null&&t!==void 0?t:null;this.lastNotifiedUid!==n&&(this.lastNotifiedUid=n,this.authStateSubscription.next(this.currentUser))}}},{key:"registerStateListener",value:function(e,t,n,i){var s=this;if(this._deleted)return function(){};var u=typeof t=="function"?t:t.next.bind(t),o=!1,l=this._isInitialized?Promise.resolve():this._initializationPromise;if(y(l,this,"internal-error"),l.then(function(){o||u(s.currentUser)}),typeof t=="function"){var h=e.addObserver(t,n,i);return function(){o=!0,h()}}else{var d=e.addObserver(t);return function(){o=!0,d()}}}},{key:"directlySetCurrentUser",value:function(){var r=p(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(this.currentUser&&this.currentUser!==n&&this._currentUser._stopProactiveRefresh(),n&&this.isProactiveRefreshEnabled&&n._startProactiveRefresh(),this.currentUser=n,!n){s.next=8;break}return s.next=6,this.assertedPersistence.setCurrentUser(n);case 6:s.next=10;break;case 8:return s.next=10,this.assertedPersistence.removeCurrentUser();case 10:case"end":return s.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"queue",value:function(e){return this.operations=this.operations.then(e,e),this.operations}},{key:"assertedPersistence",get:function(){return y(this.persistenceManager,this,"internal-error"),this.persistenceManager}},{key:"_logFramework",value:function(e){!e||this.frameworks.includes(e)||(this.frameworks.push(e),this.frameworks.sort(),this.clientVersion=vn(this.config.clientPlatform,this._getFrameworks()))}},{key:"_getFrameworks",value:function(){return this.frameworks}},{key:"_getAdditionalHeaders",value:function(){var r=p(c().mark(function t(){var n,i,s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return i=k({},"X-Client-Version",this.clientVersion),this.app.options.appId&&(i["X-Firebase-gmpid"]=this.app.options.appId),l.next=4,(n=this.heartbeatServiceProvider.getImmediate({optional:!0}))===null||n===void 0?void 0:n.getHeartbeatsHeader();case 4:return s=l.sent,s&&(i["X-Firebase-Client"]=s),l.next=8,this._getAppCheckToken();case 8:return u=l.sent,u&&(i["X-Firebase-AppCheck"]=u),l.abrupt("return",i);case 11:case"end":return l.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_getAppCheckToken",value:function(){var r=p(c().mark(function t(){var n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,(n=this.appCheckServiceProvider.getImmediate({optional:!0}))===null||n===void 0?void 0:n.getToken();case 2:return i=u.sent,i!=null&&i.error&&ot("Error while retrieving App Check token: ".concat(i.error)),u.abrupt("return",i==null?void 0:i.token);case 5:case"end":return u.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()}]),a}();function Se(a){return ie(a)}var $r=function(){function a(r){var e=this;b(this,a),this.auth=r,this.observer=null,this.addObserver=Jn(function(t){return e.observer=t})}return I(a,[{key:"next",get:function(){return y(this.observer,this.auth,"internal-error"),this.observer.next.bind(this.observer)}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Dt(){var a,r;return(r=(a=document.getElementsByTagName("head"))===null||a===void 0?void 0:a[0])!==null&&r!==void 0?r:document}function Ft(a){return new Promise(function(r,e){var t=document.createElement("script");t.setAttribute("src",a),t.onload=r,t.onerror=function(n){var i=j("internal-error");i.customData=n,e(i)},t.type="text/javascript",t.charset="UTF-8",Dt().appendChild(t)})}function $t(a){return"__".concat(a).concat(Math.floor(Math.random()*1e6))}function Vt(a,r){var e=Qr(a,"auth");if(e.isInitialized()){var t=e.getImmediate(),n=e.getOptions();if(Bn(n,r??{}))return t;H(t,"already-initialized")}var i=e.initialize({options:r});return i}function jt(a,r){var e=(r==null?void 0:r.persistence)||[],t=(Array.isArray(e)?e:[e]).map(B);r!=null&&r.errorMap&&a._updateErrorMap(r.errorMap),a._initializeWithPersistence(t,r==null?void 0:r.popupRedirectResolver)}function Wt(a,r,e){var t=Se(a);y(t._canInitEmulator,t,"emulator-config-failed"),y(/^https?:\/\//.test(r),t,"invalid-emulator-scheme");var n=!!(e!=null&&e.disableWarnings),i=gn(r),s=Ht(r),u=s.host,o=s.port,l=o===null?"":":".concat(o);t.config.emulator={url:"".concat(i,"//").concat(u).concat(l,"/")},t.settings.appVerificationDisabledForTesting=!0,t.emulatorConfig=Object.freeze({host:u,port:o,protocol:i.replace(":",""),options:Object.freeze({disableWarnings:n})}),n||zt()}function gn(a){var r=a.indexOf(":");return r<0?"":a.substr(0,r+1)}function Ht(a){var r=gn(a),e=/(\/\/)?([^?#/]+)/.exec(a.substr(r.length));if(!e)return{host:"",port:null};var t=e[2].split("@").pop()||"",n=/^(\[[^\]]+\])(:|$)/.exec(t);if(n){var i=n[1];return{host:i,port:Vr(t.substr(i.length+1))}}else{var s=t.split(":"),u=V(s,2),o=u[0],l=u[1];return{host:o,port:Vr(l)}}}function Vr(a){if(!a)return null;var r=Number(a);return isNaN(r)?null:r}function zt(){function a(){var r=document.createElement("p"),e=r.style;r.innerText="Running in emulator mode. Do not use with production credentials.",e.position="fixed",e.width="100%",e.backgroundColor="#ffffff",e.border=".1em solid #000000",e.color="#b50000",e.bottom="0px",e.left="0px",e.margin="0px",e.zIndex="10000",e.textAlign="center",r.classList.add("firebase-emulator-warning"),document.body.appendChild(r)}typeof console<"u"&&typeof console.info=="function"&&console.info("WARNING: You are using the Auth Emulator, which is intended for local testing only.  Do not use with production credentials."),typeof window<"u"&&typeof document<"u"&&(document.readyState==="loading"?window.addEventListener("DOMContentLoaded",a):a())}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var mn=function(){function a(r,e){b(this,a),this.providerId=r,this.signInMethod=e}return I(a,[{key:"toJSON",value:function(){return G("not implemented")}},{key:"_getIdTokenResponse",value:function(e){return G("not implemented")}},{key:"_linkToIdToken",value:function(e,t){return G("not implemented")}},{key:"_getReauthenticationResolver",value:function(e){return G("not implemented")}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function te(a,r){return Xe.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Xe(){return Xe=p(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",vt(r,"POST","/v1/accounts:signInWithIdp",mr(r,e)));case 1:case"end":return n.stop()}},a)})),Xe.apply(this,arguments)}var qt="http://localhost",Ye=function(a){z(e,a);var r=q(e);function e(){var t;return b(this,e),t=r.apply(this,arguments),t.pendingToken=null,t}return I(e,[{key:"toJSON",value:function(){return{idToken:this.idToken,accessToken:this.accessToken,secret:this.secret,nonce:this.nonce,pendingToken:this.pendingToken,providerId:this.providerId,signInMethod:this.signInMethod}}},{key:"_getIdTokenResponse",value:function(n){var i=this.buildRequest();return te(n,i)}},{key:"_linkToIdToken",value:function(n,i){var s=this.buildRequest();return s.idToken=i,te(n,s)}},{key:"_getReauthenticationResolver",value:function(n){var i=this.buildRequest();return i.autoCreate=!1,te(n,i)}},{key:"buildRequest",value:function(){var n={requestUri:qt,returnSecureToken:!0};if(this.pendingToken)n.pendingToken=this.pendingToken;else{var i={};this.idToken&&(i.id_token=this.idToken),this.accessToken&&(i.access_token=this.accessToken),this.secret&&(i.oauth_token_secret=this.secret),i.providerId=this.providerId,this.nonce&&!this.pendingToken&&(i.nonce=this.nonce),n.postBody=ce(i)}return n}}],[{key:"_fromParams",value:function(n){var i=new e(n.providerId,n.signInMethod);return n.idToken||n.accessToken?(n.idToken&&(i.idToken=n.idToken),n.accessToken&&(i.accessToken=n.accessToken),n.nonce&&!n.pendingToken&&(i.nonce=n.nonce),n.pendingToken&&(i.pendingToken=n.pendingToken)):n.oauthToken&&n.oauthTokenSecret?(i.accessToken=n.oauthToken,i.secret=n.oauthTokenSecret):H("argument-error"),i}},{key:"fromJSON",value:function(n){var i=typeof n=="string"?JSON.parse(n):n,s=i.providerId,u=i.signInMethod,o=pr(i,["providerId","signInMethod"]);if(!s||!u)return null;var l=new e(s,u);return l.idToken=o.idToken||void 0,l.accessToken=o.accessToken||void 0,l.secret=o.secret,l.nonce=o.nonce,l.pendingToken=o.pendingToken||null,l}}]),e}(mn);k({},"USER_NOT_FOUND","user-not-found");/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var yr=function(){function a(r){b(this,a),this.providerId=r,this.defaultLanguageCode=null,this.customParameters={}}return I(a,[{key:"setDefaultLanguage",value:function(e){this.defaultLanguageCode=e}},{key:"setCustomParameters",value:function(e){return this.customParameters=e,this}},{key:"getCustomParameters",value:function(){return this.customParameters}}]),a}();/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ir=function(a){z(e,a);var r=q(e);function e(){var t;return b(this,e),t=r.apply(this,arguments),t.scopes=[],t}return I(e,[{key:"addScope",value:function(n){return this.scopes.includes(n)||this.scopes.push(n),this}},{key:"getScopes",value:function(){return Y(this.scopes)}}]),e}(yr),kn=function(a){z(e,a);var r=q(e);function e(){return b(this,e),r.apply(this,arguments)}return I(e,[{key:"credential",value:function(n){return this._credential(Object.assign(Object.assign({},n),{nonce:n.rawNonce}))}},{key:"_credential",value:function(n){return y(n.idToken||n.accessToken,"argument-error"),Ye._fromParams(Object.assign(Object.assign({},n),{providerId:this.providerId,signInMethod:this.providerId}))}}],[{key:"credentialFromJSON",value:function(n){var i=typeof n=="string"?JSON.parse(n):n;return y("providerId"in i&&"signInMethod"in i,"argument-error"),Ye._fromParams(i)}},{key:"credentialFromResult",value:function(n){return e.oauthCredentialFromTaggedObject(n)}},{key:"credentialFromError",value:function(n){return e.oauthCredentialFromTaggedObject(n.customData||{})}},{key:"oauthCredentialFromTaggedObject",value:function(n){var i=n._tokenResponse;if(!i)return null;var s=i.oauthIdToken,u=i.oauthAccessToken,o=i.oauthTokenSecret,l=i.pendingToken,h=i.nonce,d=i.providerId;if(!u&&!o&&!s&&!l||!d)return null;try{return new e(d)._credential({idToken:s,accessToken:u,nonce:h,pendingToken:l})}catch{return null}}}]),e}(Ir);/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var br=function(a){z(e,a);var r=q(e);function e(){var t;return b(this,e),t=r.call(this,"google.com"),t.addScope("profile"),t}return I(e,null,[{key:"credential",value:function(n,i){return Ye._fromParams({providerId:e.PROVIDER_ID,signInMethod:e.GOOGLE_SIGN_IN_METHOD,idToken:n,accessToken:i})}},{key:"credentialFromResult",value:function(n){return e.credentialFromTaggedObject(n)}},{key:"credentialFromError",value:function(n){return e.credentialFromTaggedObject(n.customData||{})}},{key:"credentialFromTaggedObject",value:function(n){var i=n._tokenResponse;if(!i)return null;var s=i.oauthIdToken,u=i.oauthAccessToken;if(!s&&!u)return null;try{return e.credential(s,u)}catch{return null}}}]),e}(Ir);br.GOOGLE_SIGN_IN_METHOD="google.com";br.PROVIDER_ID="google.com";var Tr=function(){function a(r){b(this,a),this.user=r.user,this.providerId=r.providerId,this._tokenResponse=r._tokenResponse,this.operationType=r.operationType}return I(a,null,[{key:"_fromIdTokenResponse",value:function(){var r=p(c().mark(function t(n,i,s){var u,o,l,h,d=arguments;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:return u=d.length>3&&d[3]!==void 0?d[3]:!1,f.next=3,Ke._fromIdTokenResponse(n,s,u);case 3:return o=f.sent,l=jr(s),h=new a({user:o,providerId:l,_tokenResponse:s,operationType:i}),f.abrupt("return",h);case 7:case"end":return f.stop()}},t)}));function e(t,n,i){return r.apply(this,arguments)}return e}()},{key:"_forOperation",value:function(){var r=p(c().mark(function t(n,i,s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,n._updateTokensIfNecessary(s,!0);case 2:return u=jr(s),l.abrupt("return",new a({user:n,providerId:u,_tokenResponse:s,operationType:i}));case 4:case"end":return l.stop()}},t)}));function e(t,n,i){return r.apply(this,arguments)}return e}()}]),a}();function jr(a){return a.providerId?a.providerId:"phoneNumber"in a?"phone":null}var Gt=function(a){z(e,a);var r=q(e);function e(t,n,i,s){var u;b(this,e);var o;return u=r.call(this,n.code,n.message),u.operationType=i,u.user=s,Object.setPrototypeOf(Zr(u),e.prototype),u.customData={appName:t.name,tenantId:(o=t.tenantId)!==null&&o!==void 0?o:void 0,_serverResponse:n.customData._serverResponse,operationType:i},u}return I(e,null,[{key:"_fromErrorAndOperation",value:function(n,i,s,u){return new e(n,i,s,u)}}]),e}(fr);function wn(a,r,e,t){var n=r==="reauthenticate"?e._getReauthenticationResolver(a):e._getIdTokenResponse(a);return n.catch(function(i){throw i.code==="auth/".concat("multi-factor-auth-required")?Gt._fromErrorAndOperation(a,i,r,t):i})}function Bt(a,r){return Qe.apply(this,arguments)}function Qe(){return Qe=p(c().mark(function a(r,e){var t,n,i=arguments;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return t=i.length>2&&i[2]!==void 0?i[2]:!1,u.t0=oe,u.t1=r,u.t2=e,u.t3=r.auth,u.next=7,r.getIdToken();case 7:return u.t4=u.sent,u.t5=u.t2._linkToIdToken.call(u.t2,u.t3,u.t4),u.t6=t,u.next=12,(0,u.t0)(u.t1,u.t5,u.t6);case 12:return n=u.sent,u.abrupt("return",Tr._forOperation(r,"link",n));case 14:case"end":return u.stop()}},a)})),Qe.apply(this,arguments)}function Kt(a,r){return Ze.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ze(){return Ze=p(c().mark(function a(r,e){var t,n,i,s,u,o,l=arguments;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return t=l.length>2&&l[2]!==void 0?l[2]:!1,n=r.auth,i="reauthenticate",d.prev=3,d.next=6,oe(r,wn(n,i,e,r),t);case 6:return s=d.sent,y(s.idToken,n,"internal-error"),u=kr(s.idToken),y(u,n,"internal-error"),o=u.sub,y(r.uid===o,n,"user-mismatch"),d.abrupt("return",Tr._forOperation(r,i,s));case 15:throw d.prev=15,d.t0=d.catch(3),(d.t0===null||d.t0===void 0?void 0:d.t0.code)==="auth/".concat("user-not-found")&&H(n,"user-mismatch"),d.t0;case 19:case"end":return d.stop()}},a,null,[[3,15]])})),Ze.apply(this,arguments)}function Jt(a,r){return xe.apply(this,arguments)}function xe(){return xe=p(c().mark(function a(r,e){var t,n,i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return t=u.length>2&&u[2]!==void 0?u[2]:!1,n="signIn",l.next=4,wn(r,n,e);case 4:return i=l.sent,l.next=7,Tr._fromIdTokenResponse(r,n,i);case 7:if(s=l.sent,t){l.next=11;break}return l.next=11,r._updateCurrentUser(s.user);case 11:return l.abrupt("return",s);case 12:case"end":return l.stop()}},a)})),xe.apply(this,arguments)}function Xt(a,r,e,t){return ie(a).onIdTokenChanged(r,e,t)}function Yt(a,r,e){return ie(a).beforeAuthStateChanged(r,e)}var be="__sak";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var yn=function(){function a(r,e){b(this,a),this.storageRetriever=r,this.type=e}return I(a,[{key:"_isAvailable",value:function(){try{return this.storage?(this.storage.setItem(be,"1"),this.storage.removeItem(be),Promise.resolve(!0)):Promise.resolve(!1)}catch{return Promise.resolve(!1)}}},{key:"_set",value:function(e,t){return this.storage.setItem(e,JSON.stringify(t)),Promise.resolve()}},{key:"_get",value:function(e){var t=this.storage.getItem(e);return Promise.resolve(t?JSON.parse(t):null)}},{key:"_remove",value:function(e){return this.storage.removeItem(e),Promise.resolve()}},{key:"storage",get:function(){return this.storageRetriever()}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Qt(){var a=L();return wr(a)||_e(a)}var Zt=1e3,xt=10,In=function(a){z(e,a);var r=q(e);function e(){var t;return b(this,e),t=r.call(this,function(){return window.localStorage},"LOCAL"),t.boundEventHandler=function(n,i){return t.onStorageEvent(n,i)},t.listeners={},t.localCache={},t.pollTimer=null,t.safariLocalStorageNotSynced=Qt()&&Ct(),t.fallbackToPolling=pn(),t._shouldAllowMigration=!0,t}return I(e,[{key:"forAllChangedKeys",value:function(n){for(var i=0,s=Object.keys(this.listeners);i<s.length;i++){var u=s[i],o=this.storage.getItem(u),l=this.localCache[u];o!==l&&n(u,l,o)}}},{key:"onStorageEvent",value:function(n){var i=this,s=arguments.length>1&&arguments[1]!==void 0?arguments[1]:!1;if(!n.key){this.forAllChangedKeys(function(d,v,f){i.notifyListeners(d,f)});return}var u=n.key;if(s?this.detachListener():this.stopPolling(),this.safariLocalStorageNotSynced){var o=this.storage.getItem(u);if(n.newValue!==o)n.newValue!==null?this.storage.setItem(u,n.newValue):this.storage.removeItem(u);else if(this.localCache[u]===n.newValue&&!s)return}var l=function(){var v=i.storage.getItem(u);!s&&i.localCache[u]===v||i.notifyListeners(u,v)},h=this.storage.getItem(u);Rt()&&h!==n.newValue&&n.newValue!==n.oldValue?setTimeout(l,xt):l()}},{key:"notifyListeners",value:function(n,i){this.localCache[n]=i;var s=this.listeners[n];if(s)for(var u=0,o=Array.from(s);u<o.length;u++){var l=o[u];l(i&&JSON.parse(i))}}},{key:"startPolling",value:function(){var n=this;this.stopPolling(),this.pollTimer=setInterval(function(){n.forAllChangedKeys(function(i,s,u){n.onStorageEvent(new StorageEvent("storage",{key:i,oldValue:s,newValue:u}),!0)})},Zt)}},{key:"stopPolling",value:function(){this.pollTimer&&(clearInterval(this.pollTimer),this.pollTimer=null)}},{key:"attachListener",value:function(){window.addEventListener("storage",this.boundEventHandler)}},{key:"detachListener",value:function(){window.removeEventListener("storage",this.boundEventHandler)}},{key:"_addListener",value:function(n,i){Object.keys(this.listeners).length===0&&(this.fallbackToPolling?this.startPolling():this.attachListener()),this.listeners[n]||(this.listeners[n]=new Set,this.localCache[n]=this.storage.getItem(n)),this.listeners[n].add(i)}},{key:"_removeListener",value:function(n,i){this.listeners[n]&&(this.listeners[n].delete(i),this.listeners[n].size===0&&delete this.listeners[n]),Object.keys(this.listeners).length===0&&(this.detachListener(),this.stopPolling())}},{key:"_set",value:function(){var t=p(c().mark(function i(s,u){return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,ee(re(e.prototype),"_set",this).call(this,s,u);case 2:this.localCache[s]=JSON.stringify(u);case 3:case"end":return l.stop()}},i,this)}));function n(i,s){return t.apply(this,arguments)}return n}()},{key:"_get",value:function(){var t=p(c().mark(function i(s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,ee(re(e.prototype),"_get",this).call(this,s);case 2:return u=l.sent,this.localCache[s]=JSON.stringify(u),l.abrupt("return",u);case 5:case"end":return l.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()},{key:"_remove",value:function(){var t=p(c().mark(function i(s){return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,ee(re(e.prototype),"_remove",this).call(this,s);case 2:delete this.localCache[s];case 3:case"end":return o.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()}]),e}(yn);In.type="LOCAL";var ei=In;/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var bn=function(a){z(e,a);var r=q(e);function e(){return b(this,e),r.call(this,function(){return window.sessionStorage},"SESSION")}return I(e,[{key:"_addListener",value:function(n,i){}},{key:"_removeListener",value:function(n,i){}}]),e}(yn);bn.type="SESSION";var Tn=bn;/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ri(a){return Promise.all(a.map(function(){var r=p(c().mark(function e(t){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,t;case 3:return n=s.sent,s.abrupt("return",{fulfilled:!0,value:n});case 7:return s.prev=7,s.t0=s.catch(0),s.abrupt("return",{fulfilled:!1,reason:s.t0});case 10:case"end":return s.stop()}},e,null,[[0,7]])}));return function(e){return r.apply(this,arguments)}}()))}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var _n=function(){function a(r){b(this,a),this.eventTarget=r,this.handlersMap={},this.boundEventHandler=this.handleEvent.bind(this)}return I(a,[{key:"isListeningto",value:function(e){return this.eventTarget===e}},{key:"handleEvent",value:function(){var r=p(c().mark(function t(n){var i,s,u,o,l,h,d,v;return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:if(i=n,s=i.data,u=s.eventId,o=s.eventType,l=s.data,h=this.handlersMap[o],h!=null&&h.size){m.next=5;break}return m.abrupt("return");case 5:return i.ports[0].postMessage({status:"ack",eventId:u,eventType:o}),d=Array.from(h).map(function(){var g=p(c().mark(function T(E){return c().wrap(function(w){for(;;)switch(w.prev=w.next){case 0:return w.abrupt("return",E(i.origin,l));case 1:case"end":return w.stop()}},T)}));return function(T){return g.apply(this,arguments)}}()),m.next=9,ri(d);case 9:v=m.sent,i.ports[0].postMessage({status:"done",eventId:u,eventType:o,response:v});case 11:case"end":return m.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_subscribe",value:function(e,t){Object.keys(this.handlersMap).length===0&&this.eventTarget.addEventListener("message",this.boundEventHandler),this.handlersMap[e]||(this.handlersMap[e]=new Set),this.handlersMap[e].add(t)}},{key:"_unsubscribe",value:function(e,t){this.handlersMap[e]&&t&&this.handlersMap[e].delete(t),(!t||this.handlersMap[e].size===0)&&delete this.handlersMap[e],Object.keys(this.handlersMap).length===0&&this.eventTarget.removeEventListener("message",this.boundEventHandler)}}],[{key:"_getInstance",value:function(e){var t=this.receivers.find(function(i){return i.isListeningto(e)});if(t)return t;var n=new a(e);return this.receivers.push(n),n}}]),a}();_n.receivers=[];/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function _r(){for(var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:"",r=arguments.length>1&&arguments[1]!==void 0?arguments[1]:10,e="",t=0;t<r;t++)e+=Math.floor(Math.random()*10);return a+e}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var ni=function(){function a(r){b(this,a),this.target=r,this.handlers=new Set}return I(a,[{key:"removeMessageHandler",value:function(e){e.messageChannel&&(e.messageChannel.port1.removeEventListener("message",e.onMessage),e.messageChannel.port1.close()),this.handlers.delete(e)}},{key:"_send",value:function(){var r=p(c().mark(function t(n,i){var s=this,u,o,l,h,d=arguments;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:if(u=d.length>2&&d[2]!==void 0?d[2]:50,o=typeof MessageChannel<"u"?new MessageChannel:null,o){f.next=4;break}throw new Error("connection_unavailable");case 4:return f.abrupt("return",new Promise(function(m,g){var T=_r("",20);o.port1.start();var E=setTimeout(function(){g(new Error("unsupported_event"))},u);h={messageChannel:o,onMessage:function(w){var P=w;if(P.data.eventId===T)switch(P.data.status){case"ack":clearTimeout(E),l=setTimeout(function(){g(new Error("timeout"))},3e3);break;case"done":clearTimeout(l),m(P.data.response);break;default:clearTimeout(E),clearTimeout(l),g(new Error("invalid_response"));break}}},s.handlers.add(h),o.port1.addEventListener("message",h.onMessage),s.target.postMessage({eventType:n,eventId:T,data:i},[o.port2])}).finally(function(){h&&s.removeMessageHandler(h)}));case 5:case"end":return f.stop()}},t)}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function W(){return window}function ti(a){W().location.href=a}/**
 * @license
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Sn(){return typeof W().WorkerGlobalScope<"u"&&typeof W().importScripts=="function"}function ii(){return er.apply(this,arguments)}function er(){return er=p(c().mark(function a(){var r;return c().wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(navigator!=null&&navigator.serviceWorker){t.next=2;break}return t.abrupt("return",null);case 2:return t.prev=2,t.next=5,navigator.serviceWorker.ready;case 5:return r=t.sent,t.abrupt("return",r.active);case 9:return t.prev=9,t.t0=t.catch(2),t.abrupt("return",null);case 12:case"end":return t.stop()}},a,null,[[2,9]])})),er.apply(this,arguments)}function ai(){var a;return((a=navigator==null?void 0:navigator.serviceWorker)===null||a===void 0?void 0:a.controller)||null}function si(){return Sn()?self:null}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var En="firebaseLocalStorageDb",ui=1,Te="firebaseLocalStorage",Pn="fbase_key",de=function(){function a(r){b(this,a),this.request=r}return I(a,[{key:"toPromise",value:function(){var e=this;return new Promise(function(t,n){e.request.addEventListener("success",function(){t(e.request.result)}),e.request.addEventListener("error",function(){n(e.request.error)})})}}]),a}();function Ee(a,r){return a.transaction([Te],r?"readwrite":"readonly").objectStore(Te)}function oi(){var a=indexedDB.deleteDatabase(En);return new de(a).toPromise()}function rr(){var a=indexedDB.open(En,ui);return new Promise(function(r,e){a.addEventListener("error",function(){e(a.error)}),a.addEventListener("upgradeneeded",function(){var t=a.result;try{t.createObjectStore(Te,{keyPath:Pn})}catch(n){e(n)}}),a.addEventListener("success",p(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(n=a.result,n.objectStoreNames.contains(Te)){s.next=12;break}return n.close(),s.next=5,oi();case 5:return s.t0=r,s.next=8,rr();case 8:s.t1=s.sent,(0,s.t0)(s.t1),s.next=13;break;case 12:r(n);case 13:case"end":return s.stop()}},t)})))})}function Wr(a,r,e){return nr.apply(this,arguments)}function nr(){return nr=p(c().mark(function a(r,e,t){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return n=Ee(r,!0).put(k(k({},Pn,e),"value",t)),s.abrupt("return",new de(n).toPromise());case 2:case"end":return s.stop()}},a)})),nr.apply(this,arguments)}function li(a,r){return tr.apply(this,arguments)}function tr(){return tr=p(c().mark(function a(r,e){var t,n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return t=Ee(r,!1).get(e),s.next=3,new de(t).toPromise();case 3:return n=s.sent,s.abrupt("return",n===void 0?null:n.value);case 5:case"end":return s.stop()}},a)})),tr.apply(this,arguments)}function Hr(a,r){var e=Ee(a,!0).delete(r);return new de(e).toPromise()}var ci=800,hi=3,An=function(){function a(){b(this,a),this.type="LOCAL",this._shouldAllowMigration=!0,this.listeners={},this.localCache={},this.pollTimer=null,this.pendingWrites=0,this.receiver=null,this.sender=null,this.serviceWorkerReceiverAvailable=!1,this.activeServiceWorker=null,this._workerInitializationPromise=this.initializeServiceWorkerMessaging().then(function(){},function(){})}return I(a,[{key:"_openDb",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:if(!this.db){i.next=2;break}return i.abrupt("return",this.db);case 2:return i.next=4,rr();case 4:return this.db=i.sent,i.abrupt("return",this.db);case 6:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_withRetries",value:function(){var r=p(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:i=0;case 1:return o.prev=2,o.next=5,this._openDb();case 5:return s=o.sent,o.next=8,n(s);case 8:return o.abrupt("return",o.sent);case 11:if(o.prev=11,o.t0=o.catch(2),!(i++>hi)){o.next=15;break}throw o.t0;case 15:this.db&&(this.db.close(),this.db=void 0);case 16:o.next=1;break;case 18:case"end":return o.stop()}},t,this,[[2,11]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"initializeServiceWorkerMessaging",value:function(){var r=p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",Sn()?this.initializeReceiver():this.initializeSender());case 1:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeReceiver",value:function(){var r=p(c().mark(function t(){var n=this;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:this.receiver=_n._getInstance(si()),this.receiver._subscribe("keyChanged",function(){var u=p(c().mark(function o(l,h){var d;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:return f.next=2,n._poll();case 2:return d=f.sent,f.abrupt("return",{keyProcessed:d.includes(h.key)});case 4:case"end":return f.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}()),this.receiver._subscribe("ping",function(){var u=p(c().mark(function o(l,h){return c().wrap(function(v){for(;;)switch(v.prev=v.next){case 0:return v.abrupt("return",["keyChanged"]);case 1:case"end":return v.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}());case 3:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeSender",value:function(){var r=p(c().mark(function t(){var n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,ii();case 2:if(this.activeServiceWorker=o.sent,this.activeServiceWorker){o.next=5;break}return o.abrupt("return");case 5:return this.sender=new ni(this.activeServiceWorker),o.next=8,this.sender._send("ping",{},800);case 8:if(s=o.sent,s){o.next=11;break}return o.abrupt("return");case 11:!((n=s[0])===null||n===void 0)&&n.fulfilled&&(!((i=s[0])===null||i===void 0)&&i.value.includes("keyChanged"))&&(this.serviceWorkerReceiverAvailable=!0);case 12:case"end":return o.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"notifyServiceWorker",value:function(){var r=p(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(!(!this.sender||!this.activeServiceWorker||ai()!==this.activeServiceWorker)){s.next=2;break}return s.abrupt("return");case 2:return s.prev=2,s.next=5,this.sender._send("keyChanged",{key:n},this.serviceWorkerReceiverAvailable?800:50);case 5:s.next=9;break;case 7:s.prev=7,s.t0=s.catch(2);case 9:case"end":return s.stop()}},t,this,[[2,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_isAvailable",value:function(){var r=p(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(s.prev=0,indexedDB){s.next=3;break}return s.abrupt("return",!1);case 3:return s.next=5,rr();case 5:return n=s.sent,s.next=8,Wr(n,be,"1");case 8:return s.next=10,Hr(n,be);case 10:return s.abrupt("return",!0);case 13:s.prev=13,s.t0=s.catch(0);case 15:return s.abrupt("return",!1);case 16:case"end":return s.stop()}},t,null,[[0,13]])}));function e(){return r.apply(this,arguments)}return e}()},{key:"_withPendingWrite",value:function(){var r=p(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return this.pendingWrites++,s.prev=1,s.next=4,n();case 4:return s.prev=4,this.pendingWrites--,s.finish(4);case 7:case"end":return s.stop()}},t,this,[[1,,4,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_set",value:function(){var r=p(c().mark(function t(n,i){var s=this;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.abrupt("return",this._withPendingWrite(p(c().mark(function l(){return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return d.next=2,s._withRetries(function(v){return Wr(v,n,i)});case 2:return s.localCache[n]=i,d.abrupt("return",s.notifyServiceWorker(n));case 4:case"end":return d.stop()}},l)}))));case 1:case"end":return o.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"_get",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,this._withRetries(function(o){return li(o,n)});case 2:return i=u.sent,this.localCache[n]=i,u.abrupt("return",i);case 5:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_remove",value:function(){var r=p(c().mark(function t(n){var i=this;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.abrupt("return",this._withPendingWrite(p(c().mark(function o(){return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.next=2,i._withRetries(function(d){return Hr(d,n)});case 2:return delete i.localCache[n],h.abrupt("return",i.notifyServiceWorker(n));case 4:case"end":return h.stop()}},o)}))));case 1:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_poll",value:function(){var r=p(c().mark(function t(){var n,i,s,u,o,l,h,d,v,f,m;return c().wrap(function(T){for(;;)switch(T.prev=T.next){case 0:return T.next=2,this._withRetries(function(E){var M=Ee(E,!1).getAll();return new de(M).toPromise()});case 2:if(n=T.sent,n){T.next=5;break}return T.abrupt("return",[]);case 5:if(this.pendingWrites===0){T.next=7;break}return T.abrupt("return",[]);case 7:if(i=[],s=new Set,n.length!==0){u=ue(n);try{for(u.s();!(o=u.n()).done;)l=o.value,h=l.fbase_key,d=l.value,s.add(h),JSON.stringify(this.localCache[h])!==JSON.stringify(d)&&(this.notifyListeners(h,d),i.push(h))}catch(E){u.e(E)}finally{u.f()}}for(v=0,f=Object.keys(this.localCache);v<f.length;v++)m=f[v],this.localCache[m]&&!s.has(m)&&(this.notifyListeners(m,null),i.push(m));return T.abrupt("return",i);case 12:case"end":return T.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"notifyListeners",value:function(e,t){this.localCache[e]=t;var n=this.listeners[e];if(n)for(var i=0,s=Array.from(n);i<s.length;i++){var u=s[i];u(t)}}},{key:"startPolling",value:function(){var e=this;this.stopPolling(),this.pollTimer=setInterval(p(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",e._poll());case 1:case"end":return i.stop()}},t)})),ci)}},{key:"stopPolling",value:function(){this.pollTimer&&(clearInterval(this.pollTimer),this.pollTimer=null)}},{key:"_addListener",value:function(e,t){Object.keys(this.listeners).length===0&&this.startPolling(),this.listeners[e]||(this.listeners[e]=new Set,this._get(e)),this.listeners[e].add(t)}},{key:"_removeListener",value:function(e,t){this.listeners[e]&&(this.listeners[e].delete(t),this.listeners[e].size===0&&delete this.listeners[e]),Object.keys(this.listeners).length===0&&this.stopPolling()}}]),a}();An.type="LOCAL";var di=An;new he(3e4,6e4);/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Rn(a,r){return r?B(r):(y(a._popupRedirectResolver,a,"argument-error"),a._popupRedirectResolver)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Sr=function(a){z(e,a);var r=q(e);function e(t){var n;return b(this,e),n=r.call(this,"custom","custom"),n.params=t,n}return I(e,[{key:"_getIdTokenResponse",value:function(n){return te(n,this._buildIdpRequest())}},{key:"_linkToIdToken",value:function(n,i){return te(n,this._buildIdpRequest(i))}},{key:"_getReauthenticationResolver",value:function(n){return te(n,this._buildIdpRequest())}},{key:"_buildIdpRequest",value:function(n){var i={requestUri:this.params.requestUri,sessionId:this.params.sessionId,postBody:this.params.postBody,tenantId:this.params.tenantId,pendingToken:this.params.pendingToken,returnSecureToken:!0,returnIdpCredential:!0};return n&&(i.idToken=n),i}}]),e}(mn);function fi(a){return Jt(a.auth,new Sr(a),a.bypassAuthState)}function pi(a){var r=a.auth,e=a.user;return y(e,r,"internal-error"),Kt(e,new Sr(a),a.bypassAuthState)}function vi(a){return ir.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ir(){return ir=p(c().mark(function a(r){var e,t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=r.auth,t=r.user,y(t,e,"internal-error"),i.abrupt("return",Bt(t,new Sr(r),r.bypassAuthState));case 3:case"end":return i.stop()}},a)})),ir.apply(this,arguments)}var Cn=function(){function a(r,e,t,n){var i=arguments.length>4&&arguments[4]!==void 0?arguments[4]:!1;b(this,a),this.auth=r,this.resolver=t,this.user=n,this.bypassAuthState=i,this.pendingPromise=null,this.eventManager=null,this.filter=Array.isArray(e)?e:[e]}return I(a,[{key:"execute",value:function(){var e=this;return new Promise(function(){var t=p(c().mark(function n(i,s){return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return e.pendingPromise={resolve:i,reject:s},o.prev=1,o.next=4,e.resolver._initialize(e.auth);case 4:return e.eventManager=o.sent,o.next=7,e.onExecution();case 7:e.eventManager.registerConsumer(e),o.next=13;break;case 10:o.prev=10,o.t0=o.catch(1),e.reject(o.t0);case 13:case"end":return o.stop()}},n,null,[[1,10]])}));return function(n,i){return t.apply(this,arguments)}}())}},{key:"onAuthEvent",value:function(){var r=p(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(f){for(;;)switch(f.prev=f.next){case 0:if(i=n.urlResponse,s=n.sessionId,u=n.postBody,o=n.tenantId,l=n.error,h=n.type,!l){f.next=4;break}return this.reject(l),f.abrupt("return");case 4:return d={auth:this.auth,requestUri:i,sessionId:s,tenantId:o||void 0,postBody:u||void 0,user:this.user,bypassAuthState:this.bypassAuthState},f.prev=5,f.t0=this,f.next=9,this.getIdpTask(h)(d);case 9:f.t1=f.sent,f.t0.resolve.call(f.t0,f.t1),f.next=16;break;case 13:f.prev=13,f.t2=f.catch(5),this.reject(f.t2);case 16:case"end":return f.stop()}},t,this,[[5,13]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"onError",value:function(e){this.reject(e)}},{key:"getIdpTask",value:function(e){switch(e){case"signInViaPopup":case"signInViaRedirect":return fi;case"linkViaPopup":case"linkViaRedirect":return vi;case"reauthViaPopup":case"reauthViaRedirect":return pi;default:H(this.auth,"internal-error")}}},{key:"resolve",value:function(e){K(this.pendingPromise,"Pending promise was never set"),this.pendingPromise.resolve(e),this.unregisterAndCleanUp()}},{key:"reject",value:function(e){K(this.pendingPromise,"Pending promise was never set"),this.pendingPromise.reject(e),this.unregisterAndCleanUp()}},{key:"unregisterAndCleanUp",value:function(){this.eventManager&&this.eventManager.unregisterConsumer(this),this.pendingPromise=null,this.cleanUp()}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var gi=new he(2e3,1e4);function Oe(a,r,e){return ar.apply(this,arguments)}function ar(){return ar=p(c().mark(function a(r,e,t){var n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return n=Se(r),lt(r,e,yr),i=Rn(n,t),s=new On(n,"signInViaPopup",e,i),o.abrupt("return",s.executeNotNull());case 5:case"end":return o.stop()}},a)})),ar.apply(this,arguments)}var On=function(a){z(e,a);var r=q(e);function e(t,n,i,s,u){var o;return b(this,e),o=r.call(this,t,n,s,u),o.provider=i,o.authWindow=null,o.pollId=null,e.currentPopupAction&&e.currentPopupAction.cancel(),e.currentPopupAction=Zr(o),o}return I(e,[{key:"executeNotNull",value:function(){var t=p(c().mark(function i(){var s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,this.execute();case 2:return s=o.sent,y(s,this.auth,"internal-error"),o.abrupt("return",s);case 5:case"end":return o.stop()}},i,this)}));function n(){return t.apply(this,arguments)}return n}()},{key:"onExecution",value:function(){var t=p(c().mark(function i(){var s=this,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return K(this.filter.length===1,"Popup operations only handle one event"),u=_r(),l.next=4,this.resolver._openPopup(this.auth,this.provider,this.filter[0],u);case 4:this.authWindow=l.sent,this.authWindow.associatedEvent=u,this.resolver._originValidation(this.auth).catch(function(h){s.reject(h)}),this.resolver._isIframeWebStorageSupported(this.auth,function(h){h||s.reject(j(s.auth,"web-storage-unsupported"))}),this.pollUserCancellation();case 9:case"end":return l.stop()}},i,this)}));function n(){return t.apply(this,arguments)}return n}()},{key:"eventId",get:function(){var n;return((n=this.authWindow)===null||n===void 0?void 0:n.associatedEvent)||null}},{key:"cancel",value:function(){this.reject(j(this.auth,"cancelled-popup-request"))}},{key:"cleanUp",value:function(){this.authWindow&&this.authWindow.close(),this.pollId&&window.clearTimeout(this.pollId),this.authWindow=null,this.pollId=null,e.currentPopupAction=null}},{key:"pollUserCancellation",value:function(){var n=this,i=function s(){var u,o;if(!((o=(u=n.authWindow)===null||u===void 0?void 0:u.window)===null||o===void 0)&&o.closed){n.pollId=window.setTimeout(function(){n.pollId=null,n.reject(j(n.auth,"popup-closed-by-user"))},8e3);return}n.pollId=window.setTimeout(s,gi.get())};i()}}]),e}(Cn);On.currentPopupAction=null;/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var mi="pendingRedirect",we=new Map,ki=function(a){z(e,a);var r=q(e);function e(t,n){var i,s=arguments.length>2&&arguments[2]!==void 0?arguments[2]:!1;return b(this,e),i=r.call(this,t,["signInViaRedirect","linkViaRedirect","reauthViaRedirect","unknown"],n,void 0,s),i.eventId=null,i}return I(e,[{key:"execute",value:function(){var t=p(c().mark(function i(){var s,u,o;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:if(s=we.get(this.auth._key()),s){h.next=21;break}return h.prev=2,h.next=5,wi(this.resolver,this.auth);case 5:if(u=h.sent,!u){h.next=12;break}return h.next=9,ee(re(e.prototype),"execute",this).call(this);case 9:h.t0=h.sent,h.next=13;break;case 12:h.t0=null;case 13:o=h.t0,s=function(){return Promise.resolve(o)},h.next=20;break;case 17:h.prev=17,h.t1=h.catch(2),s=function(){return Promise.reject(h.t1)};case 20:we.set(this.auth._key(),s);case 21:return this.bypassAuthState||we.set(this.auth._key(),function(){return Promise.resolve(null)}),h.abrupt("return",s());case 23:case"end":return h.stop()}},i,this,[[2,17]])}));function n(){return t.apply(this,arguments)}return n}()},{key:"onAuthEvent",value:function(){var t=p(c().mark(function i(s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(s.type!=="signInViaRedirect"){l.next=4;break}return l.abrupt("return",ee(re(e.prototype),"onAuthEvent",this).call(this,s));case 4:if(s.type!=="unknown"){l.next=7;break}return this.resolve(null),l.abrupt("return");case 7:if(!s.eventId){l.next=17;break}return l.next=10,this.auth._redirectUserForId(s.eventId);case 10:if(u=l.sent,!u){l.next=16;break}return this.user=u,l.abrupt("return",ee(re(e.prototype),"onAuthEvent",this).call(this,s));case 16:this.resolve(null);case 17:case"end":return l.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()},{key:"onExecution",value:function(){var t=p(c().mark(function i(){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:case"end":return u.stop()}},i)}));function n(){return t.apply(this,arguments)}return n}()},{key:"cleanUp",value:function(){}}]),e}(Cn);function wi(a,r){return sr.apply(this,arguments)}function sr(){return sr=p(c().mark(function a(r,e){var t,n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return t=bi(e),n=Ii(r),u.next=4,n._isAvailable();case 4:if(u.sent){u.next=6;break}return u.abrupt("return",!1);case 6:return u.next=8,n._get(t);case 8:return u.t0=u.sent,i=u.t0==="true",u.next=12,n._remove(t);case 12:return u.abrupt("return",i);case 13:case"end":return u.stop()}},a)})),sr.apply(this,arguments)}function yi(a,r){we.set(a._key(),r)}function Ii(a){return B(a._redirectPersistence)}function bi(a){return ke(mi,a.config.apiKey,a.name)}function Ti(a,r){return ur.apply(this,arguments)}function ur(){return ur=p(c().mark(function a(r,e){var t,n,i,s,u,o=arguments;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return t=o.length>2&&o[2]!==void 0?o[2]:!1,n=Se(r),i=Rn(n,e),s=new ki(n,i,t),h.next=6,s.execute();case 6:if(u=h.sent,!(u&&!t)){h.next=13;break}return delete u.user._redirectEventId,h.next=11,n._persistUserIfCurrent(u.user);case 11:return h.next=13,n._setRedirectUser(null,e);case 13:return h.abrupt("return",u);case 14:case"end":return h.stop()}},a)})),ur.apply(this,arguments)}var _i=10*60*1e3,Si=function(){function a(r){b(this,a),this.auth=r,this.cachedEventUids=new Set,this.consumers=new Set,this.queuedRedirectEvent=null,this.hasHandledPotentialRedirect=!1,this.lastProcessedEventTime=Date.now()}return I(a,[{key:"registerConsumer",value:function(e){this.consumers.add(e),this.queuedRedirectEvent&&this.isEventForConsumer(this.queuedRedirectEvent,e)&&(this.sendToConsumer(this.queuedRedirectEvent,e),this.saveEventToCache(this.queuedRedirectEvent),this.queuedRedirectEvent=null)}},{key:"unregisterConsumer",value:function(e){this.consumers.delete(e)}},{key:"onEvent",value:function(e){var t=this;if(this.hasEventBeenHandled(e))return!1;var n=!1;return this.consumers.forEach(function(i){t.isEventForConsumer(e,i)&&(n=!0,t.sendToConsumer(e,i),t.saveEventToCache(e))}),this.hasHandledPotentialRedirect||!Ei(e)||(this.hasHandledPotentialRedirect=!0,n||(this.queuedRedirectEvent=e,n=!0)),n}},{key:"sendToConsumer",value:function(e,t){var n;if(e.error&&!Nn(e)){var i=((n=e.error.code)===null||n===void 0?void 0:n.split("auth/")[1])||"internal-error";t.onError(j(this.auth,i))}else t.onAuthEvent(e)}},{key:"isEventForConsumer",value:function(e,t){var n=t.eventId===null||!!e.eventId&&e.eventId===t.eventId;return t.filter.includes(e.type)&&n}},{key:"hasEventBeenHandled",value:function(e){return Date.now()-this.lastProcessedEventTime>=_i&&this.cachedEventUids.clear(),this.cachedEventUids.has(zr(e))}},{key:"saveEventToCache",value:function(e){this.cachedEventUids.add(zr(e)),this.lastProcessedEventTime=Date.now()}}]),a}();function zr(a){return[a.type,a.eventId,a.sessionId,a.tenantId].filter(function(r){return r}).join("-")}function Nn(a){var r=a.type,e=a.error;return r==="unknown"&&(e==null?void 0:e.code)==="auth/".concat("no-auth-event")}function Ei(a){switch(a.type){case"signInViaRedirect":case"linkViaRedirect":case"reauthViaRedirect":return!0;case"unknown":return Nn(a);default:return!1}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Pi(a){return or.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function or(){return or=p(c().mark(function a(r){var e,t=arguments;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=t.length>1&&t[1]!==void 0?t[1]:{},i.abrupt("return",ae(r,"GET","/v1/projects",e));case 2:case"end":return i.stop()}},a)})),or.apply(this,arguments)}var Ai=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/,Ri=/^https?/;function Ci(a){return lr.apply(this,arguments)}function lr(){return lr=p(c().mark(function a(r){var e,t,n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!r.config.emulator){o.next=2;break}return o.abrupt("return");case 2:return o.next=4,Pi(r);case 4:e=o.sent,t=e.authorizedDomains,n=ue(t),o.prev=7,n.s();case 9:if((i=n.n()).done){o.next=20;break}if(s=i.value,o.prev=11,!Oi(s)){o.next=14;break}return o.abrupt("return");case 14:o.next=18;break;case 16:o.prev=16,o.t0=o.catch(11);case 18:o.next=9;break;case 20:o.next=25;break;case 22:o.prev=22,o.t1=o.catch(7),n.e(o.t1);case 25:return o.prev=25,n.f(),o.finish(25);case 28:H(r,"unauthorized-domain");case 29:case"end":return o.stop()}},a,null,[[7,22,25,28],[11,16]])})),lr.apply(this,arguments)}function Oi(a){var r=Ue(),e=new URL(r),t=e.protocol,n=e.hostname;if(a.startsWith("chrome-extension://")){var i=new URL(a);return i.hostname===""&&n===""?t==="chrome-extension:"&&a.replace("chrome-extension://","")===r.replace("chrome-extension://",""):t==="chrome-extension:"&&i.hostname===n}if(!Ri.test(t))return!1;if(Ai.test(a))return n===a;var s=a.replace(/\./g,"\\."),u=new RegExp("^(.+\\."+s+"|"+s+")$","i");return u.test(n)}/**
 * @license
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ni=new he(3e4,6e4);function qr(){var a=W().___jsl;if(a!=null&&a.H)for(var r=0,e=Object.keys(a.H);r<e.length;r++){var t=e[r];if(a.H[t].r=a.H[t].r||[],a.H[t].L=a.H[t].L||[],a.H[t].r=Y(a.H[t].L),a.CP)for(var n=0;n<a.CP.length;n++)a.CP[n]=null}}function Li(a){return new Promise(function(r,e){var t,n,i;function s(){qr(),gapi.load("gapi.iframes",{callback:function(){r(gapi.iframes.getContext())},ontimeout:function(){qr(),e(j(a,"network-request-failed"))},timeout:Ni.get()})}if(!((n=(t=W().gapi)===null||t===void 0?void 0:t.iframes)===null||n===void 0)&&n.Iframe)r(gapi.iframes.getContext());else if(!((i=W().gapi)===null||i===void 0)&&i.load)s();else{var u=$t("iframefcb");return W()[u]=function(){gapi.load?s():e(j(a,"network-request-failed"))},Ft("https://apis.google.com/js/api.js?onload=".concat(u)).catch(function(o){return e(o)})}}).catch(function(r){throw ye=null,r})}var ye=null;function Mi(a){return ye=ye||Li(a),ye}/**
 * @license
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ui=new he(5e3,15e3),Di="__/auth/iframe",Fi="emulator/auth/iframe",$i={style:{position:"absolute",top:"-100px",width:"1px",height:"1px"},"aria-hidden":"true",tabindex:"-1"},Vi=new Map([["identitytoolkit.googleapis.com","p"],["staging-identitytoolkit.sandbox.googleapis.com","s"],["test-identitytoolkit.sandbox.googleapis.com","t"]]);function ji(a){var r=a.config;y(r.authDomain,a,"auth-domain-config-required");var e=r.emulator?gr(r,Fi):"https://".concat(a.config.authDomain,"/").concat(Di),t={apiKey:r.apiKey,appName:a.name,v:le},n=Vi.get(a.config.apiHost);n&&(t.eid=n);var i=a._getFrameworks();return i.length&&(t.fw=i.join(",")),"".concat(e,"?").concat(ce(t).slice(1))}function Wi(a){return cr.apply(this,arguments)}/**
 * @license
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function cr(){return cr=p(c().mark(function a(r){var e,t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,Mi(r);case 2:return e=i.sent,t=W().gapi,y(t,r,"internal-error"),i.abrupt("return",e.open({where:document.body,url:ji(r),messageHandlersFilter:t.iframes.CROSS_ORIGIN_IFRAMES_FILTER,attributes:$i,dontclear:!0},function(s){return new Promise(function(){var u=p(c().mark(function o(l,h){var d,v,f;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:return f=function(){W().clearTimeout(v),l(s)},g.next=3,s.restyle({setHideOnLeave:!1});case 3:d=j(r,"network-request-failed"),v=W().setTimeout(function(){h(d)},Ui.get()),s.ping(f).then(f,function(){h(d)});case 6:case"end":return g.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}())}));case 6:case"end":return i.stop()}},a)})),cr.apply(this,arguments)}var Hi={location:"yes",resizable:"yes",statusbar:"yes",toolbar:"no"},zi=500,qi=600,Gi="_blank",Bi="http://localhost",Gr=function(){function a(r){b(this,a),this.window=r,this.associatedEvent=null}return I(a,[{key:"close",value:function(){if(this.window)try{this.window.close()}catch{}}}]),a}();function Ki(a,r,e){var t=arguments.length>3&&arguments[3]!==void 0?arguments[3]:zi,n=arguments.length>4&&arguments[4]!==void 0?arguments[4]:qi,i=Math.max((window.screen.availHeight-n)/2,0).toString(),s=Math.max((window.screen.availWidth-t)/2,0).toString(),u="",o=Object.assign(Object.assign({},Hi),{width:t.toString(),height:n.toString(),top:i,left:s}),l=L().toLowerCase();e&&(u=ln(l)?Gi:e),on(l)&&(r=r||Bi,o.scrollbars="yes");var h=Object.entries(o).reduce(function(v,f){var m=V(f,2),g=m[0],T=m[1];return"".concat(v).concat(g,"=").concat(T,",")},"");if(At(l)&&u!=="_self")return Ji(r||"",u),new Gr(null);var d=window.open(r||"",u,h);y(d,a,"popup-blocked");try{d.focus()}catch{}return new Gr(d)}function Ji(a,r){var e=document.createElement("a");e.href=a,e.target=r;var t=document.createEvent("MouseEvent");t.initMouseEvent("click",!0,!0,window,1,0,0,0,0,!1,!1,!1,!1,1,null),e.dispatchEvent(t)}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Xi="__/auth/handler",Yi="emulator/auth/handler",Qi=encodeURIComponent("fac");function Br(a,r,e,t,n,i){return hr.apply(this,arguments)}function hr(){return hr=p(c().mark(function a(r,e,t,n,i,s){var u,o,l,h,d,v,f,m,g,T,E,M,w;return c().wrap(function(C){for(;;)switch(C.prev=C.next){case 0:if(y(r.config.authDomain,r,"auth-domain-config-required"),y(r.config.apiKey,r,"invalid-api-key"),u={apiKey:r.config.apiKey,appName:r.name,authType:t,redirectUrl:n,v:le,eventId:i},e instanceof yr)for(e.setDefaultLanguage(r.languageCode),u.providerId=e.providerId||"",Qn(e.getCustomParameters())||(u.customParameters=JSON.stringify(e.getCustomParameters())),o=0,l=Object.entries(s||{});o<l.length;o++)h=V(l[o],2),d=h[0],v=h[1],u[d]=v;for(e instanceof Ir&&(f=e.getScopes().filter(function(U){return U!==""}),f.length>0&&(u.scopes=f.join(","))),r.tenantId&&(u.tid=r.tenantId),m=u,g=0,T=Object.keys(m);g<T.length;g++)E=T[g],m[E]===void 0&&delete m[E];return C.next=10,r._getAppCheckToken();case 10:return M=C.sent,w=M?"#".concat(Qi,"=").concat(encodeURIComponent(M)):"",C.abrupt("return","".concat(Zi(r),"?").concat(ce(m).slice(1)).concat(w));case 13:case"end":return C.stop()}},a)})),hr.apply(this,arguments)}function Zi(a){var r=a.config;return r.emulator?gr(r,Yi):"https://".concat(r.authDomain,"/").concat(Xi)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var Ne="webStorageSupport",xi=function(){function a(){b(this,a),this.eventManagers={},this.iframes={},this.originValidationPromises={},this._redirectPersistence=Tn,this._completeRedirectFn=Ti,this._overrideRedirectResult=yi}return I(a,[{key:"_openPopup",value:function(){var r=p(c().mark(function t(n,i,s,u){var o,l;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return K((o=this.eventManagers[n._key()])===null||o===void 0?void 0:o.manager,"_initialize() not called before _openPopup()"),d.next=3,Br(n,i,s,Ue(),u);case 3:return l=d.sent,d.abrupt("return",Ki(n,l,_r()));case 5:case"end":return d.stop()}},t,this)}));function e(t,n,i,s){return r.apply(this,arguments)}return e}()},{key:"_openRedirect",value:function(){var r=p(c().mark(function t(n,i,s,u){var o;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.next=2,this._originValidation(n);case 2:return h.next=4,Br(n,i,s,Ue(),u);case 4:return o=h.sent,ti(o),h.abrupt("return",new Promise(function(){}));case 7:case"end":return h.stop()}},t,this)}));function e(t,n,i,s){return r.apply(this,arguments)}return e}()},{key:"_initialize",value:function(e){var t=this,n=e._key();if(this.eventManagers[n]){var i=this.eventManagers[n],s=i.manager,u=i.promise;return s?Promise.resolve(s):(K(u,"If manager is not set, promise should be"),u)}var o=this.initAndGetManager(e);return this.eventManagers[n]={promise:o},o.catch(function(){delete t.eventManagers[n]}),o}},{key:"initAndGetManager",value:function(){var r=p(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,Wi(n);case 2:return i=o.sent,s=new Si(n),i.register("authEvent",function(l){y(l==null?void 0:l.authEvent,n,"invalid-auth-event");var h=s.onEvent(l.authEvent);return{status:h?"ACK":"ERROR"}},gapi.iframes.CROSS_ORIGIN_IFRAMES_FILTER),this.eventManagers[n._key()]={manager:s},this.iframes[n._key()]=i,o.abrupt("return",s);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_isIframeWebStorageSupported",value:function(e,t){var n=this.iframes[e._key()];n.send(Ne,{type:Ne},function(i){var s,u=(s=i==null?void 0:i[0])===null||s===void 0?void 0:s[Ne];u!==void 0&&t(!!u),H(e,"internal-error")},gapi.iframes.CROSS_ORIGIN_IFRAMES_FILTER)}},{key:"_originValidation",value:function(e){var t=e._key();return this.originValidationPromises[t]||(this.originValidationPromises[t]=Ci(e)),this.originValidationPromises[t]}},{key:"_shouldInitProactively",get:function(){return pn()||wr()||_e()}}]),a}(),ea=xi,Kr="@firebase/auth",Jr="1.5.1";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var ra=function(){function a(r){b(this,a),this.auth=r,this.internalListeners=new Map}return I(a,[{key:"getUid",value:function(){var e;return this.assertAuthConfigured(),((e=this.auth.currentUser)===null||e===void 0?void 0:e.uid)||null}},{key:"getToken",value:function(){var r=p(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return this.assertAuthConfigured(),u.next=3,this.auth._initializationPromise;case 3:if(this.auth.currentUser){u.next=5;break}return u.abrupt("return",null);case 5:return u.next=7,this.auth.currentUser.getIdToken(n);case 7:return i=u.sent,u.abrupt("return",{accessToken:i});case 9:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"addAuthTokenListener",value:function(e){if(this.assertAuthConfigured(),!this.internalListeners.has(e)){var t=this.auth.onIdTokenChanged(function(n){e((n==null?void 0:n.stsTokenManager.accessToken)||null)});this.internalListeners.set(e,t),this.updateProactiveRefresh()}}},{key:"removeAuthTokenListener",value:function(e){this.assertAuthConfigured();var t=this.internalListeners.get(e);t&&(this.internalListeners.delete(e),t(),this.updateProactiveRefresh())}},{key:"assertAuthConfigured",value:function(){y(this.auth._initializationPromise,"dependent-sdk-initialized-before-auth")}},{key:"updateProactiveRefresh",value:function(){this.internalListeners.size>0?this.auth._startProactiveRefresh():this.auth._stopProactiveRefresh()}}]),a}();/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function na(a){switch(a){case"Node":return"node";case"ReactNative":return"rn";case"Worker":return"webworker";case"Cordova":return"cordova";default:return}}function ta(a){Rr(new Cr("auth",function(r,e){var t=e.options,n=r.getProvider("app").getImmediate(),i=r.getProvider("heartbeat"),s=r.getProvider("app-check-internal"),u=n.options,o=u.apiKey,l=u.authDomain;y(o&&!o.includes(":"),"invalid-api-key",{appName:n.name});var h={apiKey:o,authDomain:l,clientPlatform:a,apiHost:"identitytoolkit.googleapis.com",tokenApiHost:"securetoken.googleapis.com",apiScheme:"https",sdkClientVersion:vn(a)},d=new Ut(n,i,s,h);return jt(d,t),d},"PUBLIC").setInstantiationMode("EXPLICIT").setInstanceCreatedCallback(function(r,e,t){var n=r.getProvider("auth-internal");n.initialize()})),Rr(new Cr("auth-internal",function(r){var e=Se(r.getProvider("auth").getImmediate());return function(t){return new ra(t)}(e)},"PRIVATE").setInstantiationMode("EXPLICIT")),Or(Kr,Jr,na(a)),Or(Kr,Jr,"esm2017")}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var ia=5*60,aa=Yr("authIdTokenMaxAge")||ia,Xr=null,sa=function(r){return function(){var e=p(c().mark(function t(n){var i,s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(l.t0=n,!l.t0){l.next=5;break}return l.next=4,n.getIdTokenResult();case 4:l.t0=l.sent;case 5:if(i=l.t0,s=i&&(new Date().getTime()-Date.parse(i.issuedAtTime))/1e3,!(s&&s>aa)){l.next=9;break}return l.abrupt("return");case 9:if(u=i==null?void 0:i.token,Xr!==u){l.next=12;break}return l.abrupt("return");case 12:return Xr=u,l.next=15,fetch(r,{method:u?"POST":"DELETE",headers:u?{Authorization:"Bearer ".concat(u)}:{}});case 15:case"end":return l.stop()}},t)}));return function(t){return e.apply(this,arguments)}}()};function ua(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:Wn(),r=Qr(a,"auth");if(r.isInitialized())return r.getImmediate();var e=Vt(a,{popupRedirectResolver:ea,persistence:[di,ei,Tn]}),t=Yr("authTokenSyncURL");if(t){var n=sa(t);Yt(e,n,function(){return n(e.currentUser)}),Xt(e,function(s){return n(s)})}var i=Hn("auth");return i&&Wt(e,"http://".concat(i)),e}ta("Browser");function oa(){return new Promise(function(a,r){navigator.geolocation?navigator.geolocation.getCurrentPosition(function(e){var t=e.coords.latitude,n=e.coords.longitude;a({latitude:t,longitude:n})},function(e){la(e),r(e)}):(console.log("Geolocation is not supported by this browser."),r(new Error("Geolocation is not supported")))})}function la(a){switch(a.code){case a.PERMISSION_DENIED:console.log("User denied the request for Geolocation.");break;case a.POSITION_UNAVAILABLE:console.log("Location information is unavailable.");break;case a.TIMEOUT:console.log("The request to get user location timed out.");break;case a.UNKNOWN_ERROR:console.log("An unknown error occurred.");break}}var Le=ua(),ca=new br,ha=new kn("microsoft.com"),da=new kn("apple");function va(){var a=at(),r=Zn(function(N){return N.login}),e=r.loginSuccessMessage,t=r.loginErrorMessage,n=r.id,i=r.email,s=r.username,u=r.profileImage,o=r.accessToken,l=r.refreshToken,h=$.useState(""),d=V(h,2),v=d[0],f=d[1],m=$.useState(""),g=V(m,2),T=g[0],E=g[1],M=$.useState(""),w=V(M,2),P=w[0],C=w[1],U=$.useState(""),J=V(U,2);J[0];var S=J[1],Pe=$.useState(""),Q=V(Pe,2),Ae=Q[0],Er=Q[1],Ln=$.useState("Enter your email and password to log in."),Pr=V(Ln,2),Re=Pr[0],Ar=Pr[1];$.useEffect(function(){oa().then(function(N){C({longitude:N.longitude,latitude:N.latitude})})},[]),$.useEffect(function(){e&&(Ar(e),Er("success"))},[e]),$.useEffect(function(){n!=""&&i!=""&&s!=""&&u!=""&&o!=""&&l!=""&&(a(xn(n)),a(et(i)),a(rt(s)),a(nt(u)),a(fe(o)),a(pe(l)))},[a,n,i,s,u,o,l]),$.useEffect(function(){t&&(Ar(t),Er("error"))},[t]),$.useEffect(function(){Re!=""&&(S("modal-overlay"),setTimeout(function(){S("")},5e3))},[Re]);var Mn=function(){var N=p(c().mark(function O(D){return c().wrap(function(R){for(;;)switch(R.prev=R.next){case 0:f(D.target.value);case 1:case"end":return R.stop()}},O)}));return function(D){return N.apply(this,arguments)}}(),Un=function(){var N=p(c().mark(function O(D){return c().wrap(function(R){for(;;)switch(R.prev=R.next){case 0:E(D.target.value);case 1:case"end":return R.stop()}},O)}));return function(D){return N.apply(this,arguments)}}(),Dn=function(){var N=p(c().mark(function O(D){var A,R;return c().wrap(function(F){for(;;)switch(F.prev=F.next){case 0:if(D.preventDefault(),A=it(v),A){F.next=4;break}throw Error("Email entered is not valid.");case 4:if(R=tt(T),R){F.next=7;break}throw Error("Password entered is not valid.");case 7:a(ve({email:v,password:T,location:P}));case 8:case"end":return F.stop()}},O)}));return function(D){return N.apply(this,arguments)}}(),Fn=function(){var N=p(c().mark(function O(){return c().wrap(function(A){for(;;)switch(A.prev=A.next){case 0:return A.next=2,Oe(Le,ca).then(function(R){var Z=R._tokenResponse.idToken;a(fe(Z));var F=R._tokenResponse.refreshToken;a(pe(F)),a(ve({location:P}))});case 2:case"end":return A.stop()}},O)}));return function(){return N.apply(this,arguments)}}(),$n=function(){var N=p(c().mark(function O(){return c().wrap(function(A){for(;;)switch(A.prev=A.next){case 0:return A.next=2,Oe(Le,ha).then(function(R){var Z=R._tokenResponse.idToken;a(fe(Z));var F=R._tokenResponse.refreshToken;a(pe(F)),a(ve({location:P}))});case 2:case"end":return A.stop()}},O)}));return function(){return N.apply(this,arguments)}}(),Vn=function(){var N=p(c().mark(function O(){return c().wrap(function(A){for(;;)switch(A.prev=A.next){case 0:return A.next=2,Oe(Le,da).then(function(R){var Z=R._tokenResponse.idToken;a(fe(Z));var F=R._tokenResponse.refreshToken;a(pe(F)),a(ve({location:P}))});case 2:case"end":return A.stop()}},O)}));return function(){return N.apply(this,arguments)}}();return _.jsx(_.Fragment,{children:_.jsxs("div",{className:"flex-box",children:[_.jsxs("div",{className:"email-pass",children:[_.jsxs("form",{className:"login-card card",onSubmit:Dn,children:[_.jsx("input",{className:"input-email",type:"text",name:"email",placeholder:"Email",value:v,onChange:Mn,required:!0}),_.jsx("input",{className:"input-password",type:"password",name:"password",placeholder:"Password",value:T,onChange:Un,required:!0}),_.jsx("button",{id:"login_btn",type:"submit",children:_.jsx("h3",{children:"LOGIN"})})]}),_.jsx(st,{messageType:Ae,message:Re})]}),_.jsxs("div",{className:"actions",children:[_.jsxs("button",{className:"login-button google",onClick:Fn,children:[_.jsxs("svg",{xmlns:"http://www.w3.org/2000/svg",height:"24",viewBox:"0 0 24 24",width:"24",children:[_.jsx("path",{d:"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z",fill:"#4285F4"}),_.jsx("path",{d:"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z",fill:"#34A853"}),_.jsx("path",{d:"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z",fill:"#FBBC05"}),_.jsx("path",{d:"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z",fill:"#EA4335"}),_.jsx("path",{d:"M1 1h22v22H1z",fill:"none"})]}),_.jsx("h3",{children:"Login with Google"})]}),_.jsxs("button",{className:"login-button microsoft",onClick:$n,children:[_.jsxs("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 21 21",children:[_.jsx("path",{fill:"#f35325",d:"M0 0h10v10H0z"}),_.jsx("path",{fill:"#81bc06",d:"M11 0h10v10H11z"}),_.jsx("path",{fill:"#05a6f0",d:"M0 11h10v10H0z"}),_.jsx("path",{fill:"#ffba08",d:"M11 11h10v10H11z"})]}),_.jsx("h3",{children:"Login with Microsoft"})]}),_.jsxs("button",{className:"login-button apple",onClick:Vn,children:[_.jsx("svg",{xmlns:"http://www.w3.org/2000/svg",width:"170px",viewBox:"0 0 170 170",version:"1.1",height:"170px",children:_.jsx("path",{d:"m150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.197-2.12-9.973-3.17-14.34-3.17-4.58 0-9.492 1.05-14.746 3.17-5.262 2.13-9.501 3.24-12.742 3.35-4.929 0.21-9.842-1.96-14.746-6.52-3.13-2.73-7.045-7.41-11.735-14.04-5.032-7.08-9.169-15.29-12.41-24.65-3.471-10.11-5.211-19.9-5.211-29.378 0-10.857 2.346-20.221 7.045-28.068 3.693-6.303 8.606-11.275 14.755-14.925s12.793-5.51 19.948-5.629c3.915 0 9.049 1.211 15.429 3.591 6.362 2.388 10.447 3.599 12.238 3.599 1.339 0 5.877-1.416 13.57-4.239 7.275-2.618 13.415-3.702 18.445-3.275 13.63 1.1 23.87 6.473 30.68 16.153-12.19 7.386-18.22 17.731-18.1 31.002 0.11 10.337 3.86 18.939 11.23 25.769 3.34 3.17 7.07 5.62 11.22 7.36-0.9 2.61-1.85 5.11-2.86 7.51zm-31.26-123.01c0 8.1021-2.96 15.667-8.86 22.669-7.12 8.324-15.732 13.134-25.071 12.375-0.119-0.972-0.188-1.995-0.188-3.07 0-7.778 3.386-16.102 9.399-22.908 3.002-3.446 6.82-6.3113 11.45-8.597 4.62-2.2516 8.99-3.4968 13.1-3.71 0.12 1.0831 0.17 2.1663 0.17 3.2409z",fill:"#FFF"})}),_.jsx("h3",{children:"Login with Apple"})]})]})]})})}export{va as L};
//# sourceMappingURL=LoginComponent.js.map
