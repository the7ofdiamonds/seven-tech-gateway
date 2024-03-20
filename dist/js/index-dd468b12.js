import{E as tr,L as Tn,b as k,o as $r,p as b,q as U,s as M,t as vr,C as gr,v as mr,w as _n,x as Vr,y as En,z as Rn,A as I,B as Pn,D as An,S as ee,c as f,d as c,F as Y,G as Sn,_ as re,H as ne,I as j,J as S,K as Wr,M as Cn,N as On,O as Hr,P as ir,Q as J,R as z,T as q,U as Nn,V as Ln,W as Un}from"./index.js";function ar(a,r){var e={};for(var t in a)Object.prototype.hasOwnProperty.call(a,t)&&r.indexOf(t)<0&&(e[t]=a[t]);if(a!=null&&typeof Object.getOwnPropertySymbols=="function")for(var n=0,t=Object.getOwnPropertySymbols(a);n<t.length;n++)r.indexOf(t[n])<0&&Object.prototype.propertyIsEnumerable.call(a,t[n])&&(e[t[n]]=a[t[n]]);return e}var K;function jr(){return k({},"dependent-sdk-initialized-before-auth","Another Firebase SDK was initialized and is trying to use Auth before Auth is initialized. Please be sure to call `initializeAuth` or `getAuth` before starting any other Firebase SDK.")}var Mn=jr,ye=new tr("auth","Firebase",jr());/**
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
 */var G=new Tn("@firebase/auth");function Dn(a){if(G.logLevel<=Hr.WARN){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];G.warn.apply(G,["Auth (".concat(ee,"): ").concat(a)].concat(e))}}function ue(a){if(G.logLevel<=Hr.ERROR){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];G.error.apply(G,["Auth (".concat(ee,"): ").concat(a)].concat(e))}}/**
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
 */function L(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];throw sr.apply(void 0,[a].concat(e))}function O(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];return sr.apply(void 0,[a].concat(e))}function Kr(a,r,e){var t=Object.assign(Object.assign({},Mn()),k({},r,e)),n=new tr("auth","Firebase",t);return n.create(r,{appName:a.name})}function Fn(a,r,e){var t=e;if(!(r instanceof t))throw t.name!==r.constructor.name&&L(a,"argument-error"),Kr(a,"argument-error","Type of ".concat(r.constructor.name," does not match expected instance.")+"Did you pass a reference from a different Auth SDK?")}function sr(a){for(var r=arguments.length,e=new Array(r>1?r-1:0),t=1;t<r;t++)e[t-1]=arguments[t];if(typeof a!="string"){var n,i=e[0],s=j(e.slice(1));return s[0]&&(s[0].appName=a.name),(n=a._errorFactory).create.apply(n,[i].concat(j(s)))}return ye.create.apply(ye,[a].concat(e))}function y(a,r){if(!a){for(var e=arguments.length,t=new Array(e>2?e-2:0),n=2;n<e;n++)t[n-2]=arguments[n];throw sr.apply(void 0,[r].concat(t))}}function F(a){var r="INTERNAL ASSERTION FAILED: "+a;throw ue(r),new Error(r)}function V(a,r){a||F(r)}/**
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
 */function we(){var a;return typeof self<"u"&&((a=self.location)===null||a===void 0?void 0:a.href)||""}function $n(){return kr()==="http:"||kr()==="https:"}function kr(){var a;return typeof self<"u"&&((a=self.location)===null||a===void 0?void 0:a.protocol)||null}/**
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
 */function Vn(){return typeof navigator<"u"&&navigator&&"onLine"in navigator&&typeof navigator.onLine=="boolean"&&($n()||Rn()||"connection"in navigator)?navigator.onLine:!0}function Wn(){if(typeof navigator>"u")return null;var a=navigator;return a.languages&&a.languages[0]||a.language||null}/**
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
 */var te=function(){function a(r,e){I(this,a),this.shortDelay=r,this.longDelay=e,V(e>r,"Short delay should be less than long delay!"),this.isMobile=Pn()||An()}return b(a,[{key:"get",value:function(){return Vn()?this.isMobile?this.longDelay:this.shortDelay:Math.min(5e3,this.shortDelay)}}]),a}();/**
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
 */function ur(a,r){V(a.emulator,"Emulator should always be set here");var e=a.emulator.url;return r?"".concat(e).concat(r.startsWith("/")?r.slice(1):r):e}/**
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
 */var zr=function(){function a(){I(this,a)}return b(a,null,[{key:"initialize",value:function(e,t,n){this.fetchImpl=e,t&&(this.headersImpl=t),n&&(this.responseImpl=n)}},{key:"fetch",value:function(r){function e(){return r.apply(this,arguments)}return e.toString=function(){return r.toString()},e}(function(){if(this.fetchImpl)return this.fetchImpl;if(typeof self<"u"&&"fetch"in self)return self.fetch;if(typeof globalThis<"u"&&globalThis.fetch)return globalThis.fetch;if(typeof fetch<"u")return fetch;F("Could not find fetch implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")})},{key:"headers",value:function(){if(this.headersImpl)return this.headersImpl;if(typeof self<"u"&&"Headers"in self)return self.Headers;if(typeof globalThis<"u"&&globalThis.Headers)return globalThis.Headers;if(typeof Headers<"u")return Headers;F("Could not find Headers implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")}},{key:"response",value:function(){if(this.responseImpl)return this.responseImpl;if(typeof self<"u"&&"Response"in self)return self.Response;if(typeof globalThis<"u"&&globalThis.Response)return globalThis.Response;if(typeof Response<"u")return Response;F("Could not find Response implementation, make sure you call FetchProvider.initialize() with an appropriate polyfill")}}]),a}();/**
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
 */var Hn=(K={},k(k(k(k(k(k(k(k(k(k(K,"CREDENTIAL_MISMATCH","custom-token-mismatch"),"MISSING_CUSTOM_TOKEN","internal-error"),"INVALID_IDENTIFIER","invalid-email"),"MISSING_CONTINUE_URI","internal-error"),"INVALID_PASSWORD","wrong-password"),"MISSING_PASSWORD","missing-password"),"INVALID_LOGIN_CREDENTIALS","invalid-credential"),"EMAIL_EXISTS","email-already-in-use"),"PASSWORD_LOGIN_DISABLED","operation-not-allowed"),"INVALID_IDP_RESPONSE","invalid-credential"),k(k(k(k(k(k(k(k(k(k(K,"INVALID_PENDING_TOKEN","invalid-credential"),"FEDERATED_USER_ID_ALREADY_LINKED","credential-already-in-use"),"MISSING_REQ_TYPE","internal-error"),"EMAIL_NOT_FOUND","user-not-found"),"RESET_PASSWORD_EXCEED_LIMIT","too-many-requests"),"EXPIRED_OOB_CODE","expired-action-code"),"INVALID_OOB_CODE","invalid-action-code"),"MISSING_OOB_CODE","internal-error"),"CREDENTIAL_TOO_OLD_LOGIN_AGAIN","requires-recent-login"),"INVALID_ID_TOKEN","invalid-user-token"),k(k(k(k(k(k(k(k(k(k(K,"TOKEN_EXPIRED","user-token-expired"),"USER_NOT_FOUND","user-token-expired"),"TOO_MANY_ATTEMPTS_TRY_LATER","too-many-requests"),"PASSWORD_DOES_NOT_MEET_REQUIREMENTS","password-does-not-meet-requirements"),"INVALID_CODE","invalid-verification-code"),"INVALID_SESSION_INFO","invalid-verification-id"),"INVALID_TEMPORARY_PROOF","invalid-credential"),"MISSING_SESSION_INFO","missing-verification-id"),"SESSION_EXPIRED","code-expired"),"MISSING_ANDROID_PACKAGE_NAME","missing-android-pkg-name"),k(k(k(k(k(k(k(k(k(k(K,"UNAUTHORIZED_DOMAIN","unauthorized-continue-uri"),"INVALID_OAUTH_CLIENT_ID","invalid-oauth-client-id"),"ADMIN_ONLY_OPERATION","admin-restricted-operation"),"INVALID_MFA_PENDING_CREDENTIAL","invalid-multi-factor-session"),"MFA_ENROLLMENT_NOT_FOUND","multi-factor-info-not-found"),"MISSING_MFA_ENROLLMENT_ID","missing-multi-factor-info"),"MISSING_MFA_PENDING_CREDENTIAL","missing-multi-factor-session"),"SECOND_FACTOR_EXISTS","second-factor-already-in-use"),"SECOND_FACTOR_LIMIT_EXCEEDED","maximum-second-factor-count-exceeded"),"BLOCKING_FUNCTION_ERROR_RESPONSE","internal-error"),k(k(k(k(k(k(k(k(K,"RECAPTCHA_NOT_ENABLED","recaptcha-not-enabled"),"MISSING_RECAPTCHA_TOKEN","missing-recaptcha-token"),"INVALID_RECAPTCHA_TOKEN","invalid-recaptcha-token"),"INVALID_RECAPTCHA_ACTION","invalid-recaptcha-action"),"MISSING_CLIENT_TYPE","missing-client-type"),"MISSING_RECAPTCHA_VERSION","missing-recaptcha-version"),"INVALID_RECAPTCHA_VERSION","invalid-recaptcha-version"),"INVALID_REQ_TYPE","invalid-req-type"));/**
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
 */var jn=new te(3e4,6e4);function ie(a,r){return a.tenantId&&!r.tenantId?Object.assign(Object.assign({},r),{tenantId:a.tenantId}):r}function H(a,r,e,t){return be.apply(this,arguments)}function be(){return be=f(c().mark(function a(r,e,t,n){var i,s=arguments;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return i=s.length>4&&s[4]!==void 0?s[4]:{},o.abrupt("return",qr(r,i,f(c().mark(function l(){var h,d,m,p;return c().wrap(function(v){for(;;)switch(v.prev=v.next){case 0:return h={},d={},n&&(e==="GET"?d=n:h={body:JSON.stringify(n)}),m=ne(Object.assign({key:r.config.apiKey},d)).slice(1),v.next=6,r._getAdditionalHeaders();case 6:return p=v.sent,p["Content-Type"]="application/json",r.languageCode&&(p["X-Firebase-Locale"]=r.languageCode),v.abrupt("return",zr.fetch()(Gr(r,r.config.apiHost,t,m),Object.assign({method:e,headers:p,referrerPolicy:"no-referrer"},h)));case 10:case"end":return v.stop()}},l)}))));case 2:case"end":return o.stop()}},a)})),be.apply(this,arguments)}function qr(a,r,e){return Ie.apply(this,arguments)}function Ie(){return Ie=f(c().mark(function a(r,e,t){var n,i,s,u,o,l,h,d,m,p;return c().wrap(function(v){for(;;)switch(v.prev=v.next){case 0:return r._canInitEmulator=!1,n=Object.assign(Object.assign({},Hn),e),v.prev=2,i=new qn(r),v.next=6,Promise.race([t(),i.promise]);case 6:return s=v.sent,i.clearNetworkTimeout(),v.next=10,s.json();case 10:if(u=v.sent,!("needConfirmation"in u)){v.next=13;break}throw se(r,"account-exists-with-different-credential",u);case 13:if(!(s.ok&&!("errorMessage"in u))){v.next=17;break}return v.abrupt("return",u);case 17:if(o=s.ok?u.errorMessage:u.error.message,l=o.split(" : "),h=re(l,2),d=h[0],m=h[1],d!=="FEDERATED_USER_ID_ALREADY_LINKED"){v.next=23;break}throw se(r,"credential-already-in-use",u);case 23:if(d!=="EMAIL_EXISTS"){v.next=27;break}throw se(r,"email-already-in-use",u);case 27:if(d!=="USER_DISABLED"){v.next=29;break}throw se(r,"user-disabled",u);case 29:if(p=n[d]||d.toLowerCase().replace(/[_\s]+/g,"-"),!m){v.next=34;break}throw Kr(r,p,m);case 34:L(r,p);case 35:v.next=42;break;case 37:if(v.prev=37,v.t0=v.catch(2),!(v.t0 instanceof ir)){v.next=41;break}throw v.t0;case 41:L(r,"network-request-failed",{message:String(v.t0)});case 42:case"end":return v.stop()}},a,null,[[2,37]])})),Ie.apply(this,arguments)}function Kn(a,r,e,t){return Te.apply(this,arguments)}function Te(){return Te=f(c().mark(function a(r,e,t,n){var i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return i=u.length>4&&u[4]!==void 0?u[4]:{},l.next=3,H(r,e,t,n,i);case 3:return s=l.sent,"mfaPendingCredential"in s&&L(r,"multi-factor-auth-required",{_serverResponse:s}),l.abrupt("return",s);case 6:case"end":return l.stop()}},a)})),Te.apply(this,arguments)}function Gr(a,r,e,t){var n="".concat(r).concat(e,"?").concat(t);return a.config.emulator?ur(a.config,n):"".concat(a.config.apiScheme,"://").concat(n)}function zn(a){switch(a){case"ENFORCE":return"ENFORCE";case"AUDIT":return"AUDIT";case"OFF":return"OFF";default:return"ENFORCEMENT_STATE_UNSPECIFIED"}}var qn=function(){function a(r){var e=this;I(this,a),this.auth=r,this.timer=null,this.promise=new Promise(function(t,n){e.timer=setTimeout(function(){return n(O(e.auth,"network-request-failed"))},jn.get())})}return b(a,[{key:"clearNetworkTimeout",value:function(){clearTimeout(this.timer)}}]),a}();function se(a,r,e){var t={appName:a.name};e.email&&(t.email=e.email),e.phoneNumber&&(t.phoneNumber=e.phoneNumber);var n=O(a,r,t);return n.customData._tokenResponse=e,n}function yr(a){return a!==void 0&&a.enterprise!==void 0}var Gn=function(){function a(r){if(I(this,a),this.siteKey="",this.recaptchaEnforcementState=[],r.recaptchaKey===void 0)throw new Error("recaptchaKey undefined");this.siteKey=r.recaptchaKey.split("/")[3],this.recaptchaEnforcementState=r.recaptchaEnforcementState}return b(a,[{key:"getProviderEnforcementState",value:function(e){if(!this.recaptchaEnforcementState||this.recaptchaEnforcementState.length===0)return null;var t=J(this.recaptchaEnforcementState),n;try{for(t.s();!(n=t.n()).done;){var i=n.value;if(i.provider&&i.provider===e)return zn(i.enforcementState)}}catch(s){t.e(s)}finally{t.f()}return null}},{key:"isProviderEnabled",value:function(e){return this.getProviderEnforcementState(e)==="ENFORCE"||this.getProviderEnforcementState(e)==="AUDIT"}}]),a}();function Bn(a,r){return _e.apply(this,arguments)}/**
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
 */function _e(){return _e=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",H(r,"GET","/v2/recaptchaConfig",ie(r,e)));case 1:case"end":return n.stop()}},a)})),_e.apply(this,arguments)}function Jn(a,r){return Ee.apply(this,arguments)}function Ee(){return Ee=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",H(r,"POST","/v1/accounts:delete",e));case 1:case"end":return n.stop()}},a)})),Ee.apply(this,arguments)}function Yn(a,r){return Re.apply(this,arguments)}/**
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
 */function Re(){return Re=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",H(r,"POST","/v1/accounts:lookup",e));case 1:case"end":return n.stop()}},a)})),Re.apply(this,arguments)}function Z(a){if(a)try{var r=new Date(Number(a));if(!isNaN(r.getTime()))return r.toUTCString()}catch{}}function Xn(a){return Pe.apply(this,arguments)}function Pe(){return Pe=f(c().mark(function a(r){var e,t,n,i,s,u,o=arguments;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return e=o.length>1&&o[1]!==void 0?o[1]:!1,t=Y(r),h.next=4,t.getIdToken(e);case 4:return n=h.sent,i=or(n),y(i&&i.exp&&i.auth_time&&i.iat,t.auth,"internal-error"),s=Nn(i.firebase)==="object"?i.firebase:void 0,u=s==null?void 0:s.sign_in_provider,h.abrupt("return",{claims:i,token:n,authTime:Z(me(i.auth_time)),issuedAtTime:Z(me(i.iat)),expirationTime:Z(me(i.exp)),signInProvider:u||null,signInSecondFactor:(s==null?void 0:s.sign_in_second_factor)||null});case 10:case"end":return h.stop()}},a)})),Pe.apply(this,arguments)}function me(a){return Number(a)*1e3}function or(a){var r=a.split("."),e=re(r,3),t=e[0],n=e[1],i=e[2];if(t===void 0||n===void 0||i===void 0)return ue("JWT malformed, contained fewer than 3 sections"),null;try{var s=Ln(n);return s?JSON.parse(s):(ue("Failed to decode base64 JWT payload"),null)}catch(u){return ue("Caught error parsing JWT payload as JSON",u==null?void 0:u.toString()),null}}function Qn(a){var r=or(a);return y(r,"internal-error"),y(typeof r.exp<"u","internal-error"),y(typeof r.iat<"u","internal-error"),Number(r.exp)-Number(r.iat)}/**
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
 */function x(a,r){return Ae.apply(this,arguments)}function Ae(){return Ae=f(c().mark(function a(r,e){var t,n=arguments;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(t=n.length>2&&n[2]!==void 0?n[2]:!1,!t){s.next=3;break}return s.abrupt("return",e);case 3:return s.prev=3,s.next=6,e;case 6:return s.abrupt("return",s.sent);case 9:if(s.prev=9,s.t0=s.catch(3),!(s.t0 instanceof ir&&Zn(s.t0))){s.next=15;break}if(r.auth.currentUser!==r){s.next=15;break}return s.next=15,r.auth.signOut();case 15:throw s.t0;case 16:case"end":return s.stop()}},a,null,[[3,9]])})),Ae.apply(this,arguments)}function Zn(a){var r=a.code;return r==="auth/".concat("user-disabled")||r==="auth/".concat("user-token-expired")}/**
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
 */var xn=function(){function a(r){I(this,a),this.user=r,this.isRunning=!1,this.timerId=null,this.errorBackoff=3e4}return b(a,[{key:"_start",value:function(){this.isRunning||(this.isRunning=!0,this.schedule())}},{key:"_stop",value:function(){this.isRunning&&(this.isRunning=!1,this.timerId!==null&&clearTimeout(this.timerId))}},{key:"getInterval",value:function(e){var t;if(e){var n=this.errorBackoff;return this.errorBackoff=Math.min(this.errorBackoff*2,96e4),n}else{this.errorBackoff=3e4;var i=(t=this.user.stsTokenManager.expirationTime)!==null&&t!==void 0?t:0,s=i-Date.now()-3e5;return Math.max(0,s)}}},{key:"schedule",value:function(){var e=this,t=arguments.length>0&&arguments[0]!==void 0?arguments[0]:!1;if(this.isRunning){var n=this.getInterval(t);this.timerId=setTimeout(f(c().mark(function i(){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,e.iteration();case 2:case"end":return u.stop()}},i)})),n)}}},{key:"iteration",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,this.user.getIdToken(!0);case 3:i.next=9;break;case 5:return i.prev=5,i.t0=i.catch(0),(i.t0===null||i.t0===void 0?void 0:i.t0.code)==="auth/".concat("network-request-failed")&&this.schedule(!0),i.abrupt("return");case 9:this.schedule();case 10:case"end":return i.stop()}},t,this,[[0,5]])}));function e(){return r.apply(this,arguments)}return e}()}]),a}();/**
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
 */var Br=function(){function a(r,e){I(this,a),this.createdAt=r,this.lastLoginAt=e,this._initializeTime()}return b(a,[{key:"_initializeTime",value:function(){this.lastSignInTime=Z(this.lastLoginAt),this.creationTime=Z(this.createdAt)}},{key:"_copy",value:function(e){this.createdAt=e.createdAt,this.lastLoginAt=e.lastLoginAt,this._initializeTime()}},{key:"toJSON",value:function(){return{createdAt:this.createdAt,lastLoginAt:this.lastLoginAt}}}]),a}();/**
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
 */function he(a){return Se.apply(this,arguments)}function Se(){return Se=f(c().mark(function a(r){var e,t,n,i,s,u,o,l,h,d,m;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:return t=r.auth,g.next=3,r.getIdToken();case 3:return n=g.sent,g.next=6,x(r,Yn(t,{idToken:n}));case 6:i=g.sent,y(i==null?void 0:i.users.length,t,"internal-error"),s=i.users[0],r._notifyReloadListener(s),u=!((e=s.providerUserInfo)===null||e===void 0)&&e.length?nt(s.providerUserInfo):[],o=rt(r.providerData,u),l=r.isAnonymous,h=!(r.email&&s.passwordHash)&&!(o!=null&&o.length),d=l?h:!1,m={uid:s.localId,displayName:s.displayName||null,photoURL:s.photoUrl||null,email:s.email||null,emailVerified:s.emailVerified||!1,phoneNumber:s.phoneNumber||null,tenantId:s.tenantId||null,providerData:o,metadata:new Br(s.createdAt,s.lastLoginAt),isAnonymous:d},Object.assign(r,m);case 17:case"end":return g.stop()}},a)})),Se.apply(this,arguments)}function et(a){return Ce.apply(this,arguments)}function Ce(){return Ce=f(c().mark(function a(r){var e;return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return e=Y(r),n.next=3,he(e);case 3:return n.next=5,e.auth._persistUserIfCurrent(e);case 5:e.auth._notifyListenersIfCurrent(e);case 6:case"end":return n.stop()}},a)})),Ce.apply(this,arguments)}function rt(a,r){var e=a.filter(function(t){return!r.some(function(n){return n.providerId===t.providerId})});return[].concat(j(e),j(r))}function nt(a){return a.map(function(r){var e=r.providerId,t=ar(r,["providerId"]);return{providerId:e,uid:t.rawId||"",displayName:t.displayName||null,email:t.email||null,phoneNumber:t.phoneNumber||null,photoURL:t.photoUrl||null}})}/**
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
 */function tt(a,r){return Oe.apply(this,arguments)}function Oe(){return Oe=f(c().mark(function a(r,e){var t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,qr(r,{},f(c().mark(function s(){var u,o,l,h,d,m;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:return u=ne({grant_type:"refresh_token",refresh_token:e}).slice(1),o=r.config,l=o.tokenApiHost,h=o.apiKey,d=Gr(r,l,"/v1/token","key=".concat(h)),g.next=5,r._getAdditionalHeaders();case 5:return m=g.sent,m["Content-Type"]="application/x-www-form-urlencoded",g.abrupt("return",zr.fetch()(d,{method:"POST",headers:m,body:u}));case 8:case"end":return g.stop()}},s)})));case 2:return t=i.sent,i.abrupt("return",{accessToken:t.access_token,expiresIn:t.expires_in,refreshToken:t.refresh_token});case 4:case"end":return i.stop()}},a)})),Oe.apply(this,arguments)}function it(a,r){return Ne.apply(this,arguments)}/**
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
 */function Ne(){return Ne=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",H(r,"POST","/v2/accounts:revokeToken",ie(r,e)));case 1:case"end":return n.stop()}},a)})),Ne.apply(this,arguments)}var wr=function(){function a(){I(this,a),this.refreshToken=null,this.accessToken=null,this.expirationTime=null}return b(a,[{key:"isExpired",get:function(){return!this.expirationTime||Date.now()>this.expirationTime-3e4}},{key:"updateFromServerResponse",value:function(e){y(e.idToken,"internal-error"),y(typeof e.idToken<"u","internal-error"),y(typeof e.refreshToken<"u","internal-error");var t="expiresIn"in e&&typeof e.expiresIn<"u"?Number(e.expiresIn):Qn(e.idToken);this.updateTokensAndExpiration(e.idToken,e.refreshToken,t)}},{key:"getToken",value:function(){var r=f(c().mark(function t(n){var i,s=arguments;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(i=s.length>1&&s[1]!==void 0?s[1]:!1,y(!this.accessToken||this.refreshToken,n,"user-token-expired"),!(!i&&this.accessToken&&!this.isExpired)){o.next=4;break}return o.abrupt("return",this.accessToken);case 4:if(!this.refreshToken){o.next=8;break}return o.next=7,this.refresh(n,this.refreshToken);case 7:return o.abrupt("return",this.accessToken);case 8:return o.abrupt("return",null);case 9:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"clearRefreshToken",value:function(){this.refreshToken=null}},{key:"refresh",value:function(){var r=f(c().mark(function t(n,i){var s,u,o,l;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return d.next=2,tt(n,i);case 2:s=d.sent,u=s.accessToken,o=s.refreshToken,l=s.expiresIn,this.updateTokensAndExpiration(u,o,Number(l));case 7:case"end":return d.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"updateTokensAndExpiration",value:function(e,t,n){this.refreshToken=t||null,this.accessToken=e||null,this.expirationTime=Date.now()+n*1e3}},{key:"toJSON",value:function(){return{refreshToken:this.refreshToken,accessToken:this.accessToken,expirationTime:this.expirationTime}}},{key:"_assign",value:function(e){this.accessToken=e.accessToken,this.refreshToken=e.refreshToken,this.expirationTime=e.expirationTime}},{key:"_clone",value:function(){return Object.assign(new a,this.toJSON())}},{key:"_performRefresh",value:function(){return F("not implemented")}}],[{key:"fromJSON",value:function(e,t){var n=t.refreshToken,i=t.accessToken,s=t.expirationTime,u=new a;return n&&(y(typeof n=="string","internal-error",{appName:e}),u.refreshToken=n),i&&(y(typeof i=="string","internal-error",{appName:e}),u.accessToken=i),s&&(y(typeof s=="number","internal-error",{appName:e}),u.expirationTime=s),u}}]),a}();/**
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
 */function W(a,r){y(typeof a=="string"||typeof a>"u","internal-error",{appName:r})}var Le=function(){function a(r){I(this,a);var e=r.uid,t=r.auth,n=r.stsTokenManager,i=ar(r,["uid","auth","stsTokenManager"]);this.providerId="firebase",this.proactiveRefresh=new xn(this),this.reloadUserInfo=null,this.reloadListener=null,this.uid=e,this.auth=t,this.stsTokenManager=n,this.accessToken=n.accessToken,this.displayName=i.displayName||null,this.email=i.email||null,this.emailVerified=i.emailVerified||!1,this.phoneNumber=i.phoneNumber||null,this.photoURL=i.photoURL||null,this.isAnonymous=i.isAnonymous||!1,this.tenantId=i.tenantId||null,this.providerData=i.providerData?j(i.providerData):[],this.metadata=new Br(i.createdAt||void 0,i.lastLoginAt||void 0)}return b(a,[{key:"getIdToken",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,x(this,this.stsTokenManager.getToken(this.auth,n));case 2:if(i=u.sent,y(i,this.auth,"internal-error"),this.accessToken===i){u.next=9;break}return this.accessToken=i,u.next=8,this.auth._persistUserIfCurrent(this);case 8:this.auth._notifyListenersIfCurrent(this);case 9:return u.abrupt("return",i);case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"getIdTokenResult",value:function(e){return Xn(this,e)}},{key:"reload",value:function(){return et(this)}},{key:"_assign",value:function(e){this!==e&&(y(this.uid===e.uid,this.auth,"internal-error"),this.displayName=e.displayName,this.photoURL=e.photoURL,this.email=e.email,this.emailVerified=e.emailVerified,this.phoneNumber=e.phoneNumber,this.isAnonymous=e.isAnonymous,this.tenantId=e.tenantId,this.providerData=e.providerData.map(function(t){return Object.assign({},t)}),this.metadata._copy(e.metadata),this.stsTokenManager._assign(e.stsTokenManager))}},{key:"_clone",value:function(e){var t=new a(Object.assign(Object.assign({},this),{auth:e,stsTokenManager:this.stsTokenManager._clone()}));return t.metadata._copy(this.metadata),t}},{key:"_onReload",value:function(e){y(!this.reloadListener,this.auth,"internal-error"),this.reloadListener=e,this.reloadUserInfo&&(this._notifyReloadListener(this.reloadUserInfo),this.reloadUserInfo=null)}},{key:"_notifyReloadListener",value:function(e){this.reloadListener?this.reloadListener(e):this.reloadUserInfo=e}},{key:"_startProactiveRefresh",value:function(){this.proactiveRefresh._start()}},{key:"_stopProactiveRefresh",value:function(){this.proactiveRefresh._stop()}},{key:"_updateTokensIfNecessary",value:function(){var r=f(c().mark(function t(n){var i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(i=u.length>1&&u[1]!==void 0?u[1]:!1,s=!1,n.idToken&&n.idToken!==this.stsTokenManager.accessToken&&(this.stsTokenManager.updateFromServerResponse(n),s=!0),!i){l.next=6;break}return l.next=6,he(this);case 6:return l.next=8,this.auth._persistUserIfCurrent(this);case 8:s&&this.auth._notifyListenersIfCurrent(this);case 9:case"end":return l.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"delete",value:function(){var r=f(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,this.getIdToken();case 2:return n=s.sent,s.next=5,x(this,Jn(this.auth,{idToken:n}));case 5:return this.stsTokenManager.clearRefreshToken(),s.abrupt("return",this.auth.signOut());case 7:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"toJSON",value:function(){return Object.assign(Object.assign({uid:this.uid,email:this.email||void 0,emailVerified:this.emailVerified,displayName:this.displayName||void 0,isAnonymous:this.isAnonymous,photoURL:this.photoURL||void 0,phoneNumber:this.phoneNumber||void 0,tenantId:this.tenantId||void 0,providerData:this.providerData.map(function(e){return Object.assign({},e)}),stsTokenManager:this.stsTokenManager.toJSON(),_redirectEventId:this._redirectEventId},this.metadata.toJSON()),{apiKey:this.auth.config.apiKey,appName:this.auth.name})}},{key:"refreshToken",get:function(){return this.stsTokenManager.refreshToken||""}}],[{key:"_fromJSON",value:function(e,t){var n,i,s,u,o,l,h,d,m=(n=t.displayName)!==null&&n!==void 0?n:void 0,p=(i=t.email)!==null&&i!==void 0?i:void 0,g=(s=t.phoneNumber)!==null&&s!==void 0?s:void 0,v=(u=t.photoURL)!==null&&u!==void 0?u:void 0,T=(o=t.tenantId)!==null&&o!==void 0?o:void 0,_=(l=t._redirectEventId)!==null&&l!==void 0?l:void 0,A=(h=t.createdAt)!==null&&h!==void 0?h:void 0,w=(d=t.lastLoginAt)!==null&&d!==void 0?d:void 0,R=t.uid,P=t.emailVerified,C=t.isAnonymous,D=t.providerData,E=t.stsTokenManager;y(R&&E,e,"internal-error");var Q=wr.fromJSON(this.name,E);y(typeof R=="string",e,"internal-error"),W(m,e.name),W(p,e.name),y(typeof P=="boolean",e,"internal-error"),y(typeof C=="boolean",e,"internal-error"),W(g,e.name),W(v,e.name),W(T,e.name),W(_,e.name),W(A,e.name),W(w,e.name);var ge=new a({uid:R,auth:e,email:p,emailVerified:P,displayName:m,isAnonymous:C,photoURL:v,phoneNumber:g,tenantId:T,stsTokenManager:Q,createdAt:A,lastLoginAt:w});return D&&Array.isArray(D)&&(ge.providerData=D.map(function(In){return Object.assign({},In)})),_&&(ge._redirectEventId=_),ge}},{key:"_fromIdTokenResponse",value:function(){var r=f(c().mark(function t(n,i){var s,u,o,l=arguments;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return s=l.length>2&&l[2]!==void 0?l[2]:!1,u=new wr,u.updateFromServerResponse(i),o=new a({uid:i.localId,auth:n,stsTokenManager:u,isAnonymous:s}),d.next=6,he(o);case 6:return d.abrupt("return",o);case 7:case"end":return d.stop()}},t)}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
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
 */var br=new Map;function $(a){V(a instanceof Function,"Expected a class definition");var r=br.get(a);return r?(V(r instanceof a,"Instance stored in cache mismatched with class"),r):(r=new a,br.set(a,r),r)}/**
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
 */var Jr=function(){function a(){I(this,a),this.type="NONE",this.storage={}}return b(a,[{key:"_isAvailable",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",!0);case 1:case"end":return i.stop()}},t)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_set",value:function(){var r=f(c().mark(function t(n,i){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:this.storage[n]=i;case 1:case"end":return u.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"_get",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=this.storage[n],u.abrupt("return",i===void 0?null:i);case 2:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_remove",value:function(){var r=f(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:delete this.storage[n];case 1:case"end":return s.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_addListener",value:function(e,t){}},{key:"_removeListener",value:function(e,t){}}]),a}();Jr.type="NONE";var Ir=Jr;/**
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
 */function oe(a,r,e){return"firebase".concat(":",a,":").concat(r,":").concat(e)}var Tr=function(){function a(r,e,t){I(this,a),this.persistence=r,this.auth=e,this.userKey=t;var n=this.auth,i=n.config,s=n.name;this.fullUserKey=oe(this.userKey,i.apiKey,s),this.fullPersistenceKey=oe("persistence",i.apiKey,s),this.boundEventHandler=e._onStorageEvent.bind(e),this.persistence._addListener(this.fullUserKey,this.boundEventHandler)}return b(a,[{key:"setCurrentUser",value:function(e){return this.persistence._set(this.fullUserKey,e.toJSON())}},{key:"getCurrentUser",value:function(){var r=f(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,this.persistence._get(this.fullUserKey);case 2:return n=s.sent,s.abrupt("return",n?Le._fromJSON(this.auth,n):null);case 4:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"removeCurrentUser",value:function(){return this.persistence._remove(this.fullUserKey)}},{key:"savePersistenceForRedirect",value:function(){return this.persistence._set(this.fullPersistenceKey,this.persistence.type)}},{key:"setPersistence",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this.persistence!==n){u.next=2;break}return u.abrupt("return");case 2:return u.next=4,this.getCurrentUser();case 4:return i=u.sent,u.next=7,this.removeCurrentUser();case 7:if(this.persistence=n,!i){u.next=10;break}return u.abrupt("return",this.setCurrentUser(i));case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"delete",value:function(){this.persistence._removeListener(this.fullUserKey,this.boundEventHandler)}}],[{key:"create",value:function(){var r=f(c().mark(function t(n,i){var s,u,o,l,h,d,m,p,g,v,T,_=arguments;return c().wrap(function(w){for(;;)switch(w.prev=w.next){case 0:if(s=_.length>2&&_[2]!==void 0?_[2]:"authUser",i.length){w.next=3;break}return w.abrupt("return",new a($(Ir),n,s));case 3:return w.next=5,Promise.all(i.map(function(){var R=f(c().mark(function P(C){return c().wrap(function(E){for(;;)switch(E.prev=E.next){case 0:return E.next=2,C._isAvailable();case 2:if(!E.sent){E.next=4;break}return E.abrupt("return",C);case 4:return E.abrupt("return",void 0);case 5:case"end":return E.stop()}},P)}));return function(P){return R.apply(this,arguments)}}()));case 5:u=w.sent.filter(function(R){return R}),o=u[0]||$(Ir),l=oe(s,n.config.apiKey,n.name),h=null,d=J(i),w.prev=10,d.s();case 12:if((m=d.n()).done){w.next=29;break}return p=m.value,w.prev=14,w.next=17,p._get(l);case 17:if(g=w.sent,!g){w.next=23;break}return v=Le._fromJSON(n,g),p!==o&&(h=v),o=p,w.abrupt("break",29);case 23:w.next=27;break;case 25:w.prev=25,w.t0=w.catch(14);case 27:w.next=12;break;case 29:w.next=34;break;case 31:w.prev=31,w.t1=w.catch(10),d.e(w.t1);case 34:return w.prev=34,d.f(),w.finish(34);case 37:if(T=u.filter(function(R){return R._shouldAllowMigration}),!(!o._shouldAllowMigration||!T.length)){w.next=40;break}return w.abrupt("return",new a(o,n,s));case 40:if(o=T[0],!h){w.next=44;break}return w.next=44,o._set(l,h.toJSON());case 44:return w.next=46,Promise.all(i.map(function(){var R=f(c().mark(function P(C){return c().wrap(function(E){for(;;)switch(E.prev=E.next){case 0:if(C===o){E.next=8;break}return E.prev=1,E.next=4,C._remove(l);case 4:E.next=8;break;case 6:E.prev=6,E.t0=E.catch(1);case 8:case"end":return E.stop()}},P,null,[[1,6]])}));return function(P){return R.apply(this,arguments)}}()));case 46:return w.abrupt("return",new a(o,n,s));case 47:case"end":return w.stop()}},t,null,[[10,31,34,37],[14,25]])}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
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
 */function _r(a){var r=a.toLowerCase();if(r.includes("opera/")||r.includes("opr/")||r.includes("opios/"))return"Opera";if(Qr(r))return"IEMobile";if(r.includes("msie")||r.includes("trident/"))return"IE";if(r.includes("edge/"))return"Edge";if(Yr(r))return"Firefox";if(r.includes("silk/"))return"Silk";if(xr(r))return"Blackberry";if(en(r))return"Webos";if(lr(r))return"Safari";if((r.includes("chrome/")||Xr(r))&&!r.includes("edge/"))return"Chrome";if(Zr(r))return"Android";var e=/([a-zA-Z\d\.]+)\/[a-zA-Z\d\.]*$/,t=a.match(e);return(t==null?void 0:t.length)===2?t[1]:"Other"}function Yr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/firefox\//i.test(a)}function lr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S(),r=a.toLowerCase();return r.includes("safari/")&&!r.includes("chrome/")&&!r.includes("crios/")&&!r.includes("android")}function Xr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/crios\//i.test(a)}function Qr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/iemobile/i.test(a)}function Zr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/android/i.test(a)}function xr(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/blackberry/i.test(a)}function en(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/webos/i.test(a)}function fe(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return/iphone|ipad|ipod/i.test(a)||/macintosh/i.test(a)&&/mobile/i.test(a)}function at(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S(),r;return fe(a)&&!!(!((r=window.navigator)===null||r===void 0)&&r.standalone)}function st(){return Cn()&&document.documentMode===10}function rn(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:S();return fe(a)||Zr(a)||en(a)||xr(a)||/windows phone/i.test(a)||Qr(a)}function ut(){try{return!!(window&&window!==window.top)}catch{return!1}}/**
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
 */function nn(a){var r=arguments.length>1&&arguments[1]!==void 0?arguments[1]:[],e;switch(a){case"Browser":e=_r(S());break;case"Worker":e="".concat(_r(S()),"-").concat(a);break;default:e=a}var t=r.length?r.join(","):"FirebaseCore-web";return"".concat(e,"/","JsCore","/").concat(ee,"/").concat(t)}/**
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
 */var ot=function(){function a(r){I(this,a),this.auth=r,this.queue=[]}return b(a,[{key:"pushCallback",value:function(e,t){var n=this,i=function(o){return new Promise(function(l,h){try{var d=e(o);l(d)}catch(m){h(m)}})};i.onAbort=t,this.queue.push(i);var s=this.queue.length-1;return function(){n.queue[s]=function(){return Promise.resolve()}}}},{key:"runMiddleware",value:function(){var r=f(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:if(this.auth.currentUser!==n){p.next=2;break}return p.abrupt("return");case 2:i=[],p.prev=3,s=J(this.queue),p.prev=5,s.s();case 7:if((u=s.n()).done){p.next=14;break}return o=u.value,p.next=11,o(n);case 11:o.onAbort&&i.push(o.onAbort);case 12:p.next=7;break;case 14:p.next=19;break;case 16:p.prev=16,p.t0=p.catch(5),s.e(p.t0);case 19:return p.prev=19,s.f(),p.finish(19);case 22:p.next=30;break;case 24:p.prev=24,p.t1=p.catch(3),i.reverse(),l=J(i);try{for(l.s();!(h=l.n()).done;){d=h.value;try{d()}catch{}}}catch(g){l.e(g)}finally{l.f()}throw this.auth._errorFactory.create("login-blocked",{originalMessage:p.t1===null||p.t1===void 0?void 0:p.t1.message});case 30:case"end":return p.stop()}},t,this,[[3,24],[5,16,19,22]])}));function e(t){return r.apply(this,arguments)}return e}()}]),a}();/**
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
 */function lt(a){return Ue.apply(this,arguments)}/**
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
 */function Ue(){return Ue=f(c().mark(function a(r){var e,t=arguments;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=t.length>1&&t[1]!==void 0?t[1]:{},i.abrupt("return",H(r,"GET","/v2/passwordPolicy",ie(r,e)));case 2:case"end":return i.stop()}},a)})),Ue.apply(this,arguments)}var ct=6,ht=function(){function a(r){I(this,a);var e,t,n,i,s=r.customStrengthOptions;this.customStrengthOptions={},this.customStrengthOptions.minPasswordLength=(e=s.minPasswordLength)!==null&&e!==void 0?e:ct,s.maxPasswordLength&&(this.customStrengthOptions.maxPasswordLength=s.maxPasswordLength),s.containsLowercaseCharacter!==void 0&&(this.customStrengthOptions.containsLowercaseLetter=s.containsLowercaseCharacter),s.containsUppercaseCharacter!==void 0&&(this.customStrengthOptions.containsUppercaseLetter=s.containsUppercaseCharacter),s.containsNumericCharacter!==void 0&&(this.customStrengthOptions.containsNumericCharacter=s.containsNumericCharacter),s.containsNonAlphanumericCharacter!==void 0&&(this.customStrengthOptions.containsNonAlphanumericCharacter=s.containsNonAlphanumericCharacter),this.enforcementState=r.enforcementState,this.enforcementState==="ENFORCEMENT_STATE_UNSPECIFIED"&&(this.enforcementState="OFF"),this.allowedNonAlphanumericCharacters=(n=(t=r.allowedNonAlphanumericCharacters)===null||t===void 0?void 0:t.join(""))!==null&&n!==void 0?n:"",this.forceUpgradeOnSignin=(i=r.forceUpgradeOnSignin)!==null&&i!==void 0?i:!1,this.schemaVersion=r.schemaVersion}return b(a,[{key:"validatePassword",value:function(e){var t,n,i,s,u,o,l={isValid:!0,passwordPolicy:this};return this.validatePasswordLengthOptions(e,l),this.validatePasswordCharacterOptions(e,l),l.isValid&&(l.isValid=(t=l.meetsMinPasswordLength)!==null&&t!==void 0?t:!0),l.isValid&&(l.isValid=(n=l.meetsMaxPasswordLength)!==null&&n!==void 0?n:!0),l.isValid&&(l.isValid=(i=l.containsLowercaseLetter)!==null&&i!==void 0?i:!0),l.isValid&&(l.isValid=(s=l.containsUppercaseLetter)!==null&&s!==void 0?s:!0),l.isValid&&(l.isValid=(u=l.containsNumericCharacter)!==null&&u!==void 0?u:!0),l.isValid&&(l.isValid=(o=l.containsNonAlphanumericCharacter)!==null&&o!==void 0?o:!0),l}},{key:"validatePasswordLengthOptions",value:function(e,t){var n=this.customStrengthOptions.minPasswordLength,i=this.customStrengthOptions.maxPasswordLength;n&&(t.meetsMinPasswordLength=e.length>=n),i&&(t.meetsMaxPasswordLength=e.length<=i)}},{key:"validatePasswordCharacterOptions",value:function(e,t){this.updatePasswordCharacterOptionsStatuses(t,!1,!1,!1,!1);for(var n,i=0;i<e.length;i++)n=e.charAt(i),this.updatePasswordCharacterOptionsStatuses(t,n>="a"&&n<="z",n>="A"&&n<="Z",n>="0"&&n<="9",this.allowedNonAlphanumericCharacters.includes(n))}},{key:"updatePasswordCharacterOptionsStatuses",value:function(e,t,n,i,s){this.customStrengthOptions.containsLowercaseLetter&&(e.containsLowercaseLetter||(e.containsLowercaseLetter=t)),this.customStrengthOptions.containsUppercaseLetter&&(e.containsUppercaseLetter||(e.containsUppercaseLetter=n)),this.customStrengthOptions.containsNumericCharacter&&(e.containsNumericCharacter||(e.containsNumericCharacter=i)),this.customStrengthOptions.containsNonAlphanumericCharacter&&(e.containsNonAlphanumericCharacter||(e.containsNonAlphanumericCharacter=s))}}]),a}();/**
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
 */var dt=function(){function a(r,e,t,n){I(this,a),this.app=r,this.heartbeatServiceProvider=e,this.appCheckServiceProvider=t,this.config=n,this.currentUser=null,this.emulatorConfig=null,this.operations=Promise.resolve(),this.authStateSubscription=new Er(this),this.idTokenSubscription=new Er(this),this.beforeStateQueue=new ot(this),this.redirectUser=null,this.isProactiveRefreshEnabled=!1,this.EXPECTED_PASSWORD_POLICY_SCHEMA_VERSION=1,this._canInitEmulator=!0,this._isInitialized=!1,this._deleted=!1,this._initializationPromise=null,this._popupRedirectResolver=null,this._errorFactory=ye,this._agentRecaptchaConfig=null,this._tenantRecaptchaConfigs={},this._projectPasswordPolicy=null,this._tenantPasswordPolicies={},this.lastNotifiedUid=void 0,this.languageCode=null,this.tenantId=null,this.settings={appVerificationDisabledForTesting:!1},this.frameworks=[],this.name=r.name,this.clientVersion=n.sdkClientVersion}return b(a,[{key:"_initializeWithPersistence",value:function(e,t){var n=this;return t&&(this._popupRedirectResolver=$(t)),this._initializationPromise=this.queue(f(c().mark(function i(){var s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(!n._deleted){l.next=2;break}return l.abrupt("return");case 2:return l.next=4,Tr.create(n,e);case 4:if(n.persistenceManager=l.sent,!n._deleted){l.next=7;break}return l.abrupt("return");case 7:if(!(!((s=n._popupRedirectResolver)===null||s===void 0)&&s._shouldInitProactively)){l.next=15;break}return l.prev=8,l.next=11,n._popupRedirectResolver._initialize(n);case 11:l.next=15;break;case 13:l.prev=13,l.t0=l.catch(8);case 15:return l.next=17,n.initializeCurrentUser(t);case 17:if(n.lastNotifiedUid=((u=n.currentUser)===null||u===void 0?void 0:u.uid)||null,!n._deleted){l.next=20;break}return l.abrupt("return");case 20:n._isInitialized=!0;case 21:case"end":return l.stop()}},i,null,[[8,13]])}))),this._initializationPromise}},{key:"_onStorageEvent",value:function(){var r=f(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(!this._deleted){s.next=2;break}return s.abrupt("return");case 2:return s.next=4,this.assertedPersistence.getCurrentUser();case 4:if(n=s.sent,!(!this.currentUser&&!n)){s.next=7;break}return s.abrupt("return");case 7:if(!(this.currentUser&&n&&this.currentUser.uid===n.uid)){s.next=12;break}return this._currentUser._assign(n),s.next=11,this.currentUser.getIdToken();case 11:return s.abrupt("return");case 12:return s.next=14,this._updateCurrentUser(n,!0);case 14:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeCurrentUser",value:function(){var r=f(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:return p.next=2,this.assertedPersistence.getCurrentUser();case 2:if(s=p.sent,u=s,o=!1,!(n&&this.config.authDomain)){p.next=14;break}return p.next=8,this.getOrInitRedirectPersistenceManager();case 8:return l=(i=this.redirectUser)===null||i===void 0?void 0:i._redirectEventId,h=u==null?void 0:u._redirectEventId,p.next=12,this.tryRedirectSignIn(n);case 12:d=p.sent,(!l||l===h)&&(d!=null&&d.user)&&(u=d.user,o=!0);case 14:if(u){p.next=16;break}return p.abrupt("return",this.directlySetCurrentUser(null));case 16:if(u._redirectEventId){p.next=32;break}if(!o){p.next=27;break}return p.prev=18,p.next=21,this.beforeStateQueue.runMiddleware(u);case 21:p.next=27;break;case 23:p.prev=23,p.t0=p.catch(18),u=s,this._popupRedirectResolver._overrideRedirectResult(this,function(){return Promise.reject(p.t0)});case 27:if(!u){p.next=31;break}return p.abrupt("return",this.reloadAndSetCurrentUserOrClear(u));case 31:return p.abrupt("return",this.directlySetCurrentUser(null));case 32:return y(this._popupRedirectResolver,this,"argument-error"),p.next=35,this.getOrInitRedirectPersistenceManager();case 35:if(!(this.redirectUser&&this.redirectUser._redirectEventId===u._redirectEventId)){p.next=37;break}return p.abrupt("return",this.directlySetCurrentUser(u));case 37:return p.abrupt("return",this.reloadAndSetCurrentUserOrClear(u));case 38:case"end":return p.stop()}},t,this,[[18,23]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"tryRedirectSignIn",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=null,u.prev=1,u.next=4,this._popupRedirectResolver._completeRedirectFn(this,n,!0);case 4:i=u.sent,u.next=11;break;case 7:return u.prev=7,u.t0=u.catch(1),u.next=11,this._setRedirectUser(null);case 11:return u.abrupt("return",i);case 12:case"end":return u.stop()}},t,this,[[1,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"reloadAndSetCurrentUserOrClear",value:function(){var r=f(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,he(n);case 3:s.next=9;break;case 5:if(s.prev=5,s.t0=s.catch(0),(s.t0===null||s.t0===void 0?void 0:s.t0.code)==="auth/".concat("network-request-failed")){s.next=9;break}return s.abrupt("return",this.directlySetCurrentUser(null));case 9:return s.abrupt("return",this.directlySetCurrentUser(n));case 10:case"end":return s.stop()}},t,this,[[0,5]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"useDeviceLanguage",value:function(){this.languageCode=Wn()}},{key:"_delete",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:this._deleted=!0;case 1:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"updateCurrentUser",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return i=n?Y(n):null,i&&y(i.auth.config.apiKey===this.config.apiKey,this,"invalid-user-token"),u.abrupt("return",this._updateCurrentUser(i&&i._clone(this)));case 3:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_updateCurrentUser",value:function(){var r=f(c().mark(function t(n){var i=this,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(s=u.length>1&&u[1]!==void 0?u[1]:!1,!this._deleted){l.next=3;break}return l.abrupt("return");case 3:if(n&&y(this.tenantId===n.tenantId,this,"tenant-id-mismatch"),s){l.next=7;break}return l.next=7,this.beforeStateQueue.runMiddleware(n);case 7:return l.abrupt("return",this.queue(f(c().mark(function h(){return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:return m.next=2,i.directlySetCurrentUser(n);case 2:i.notifyAuthListeners();case 3:case"end":return m.stop()}},h)}))));case 8:case"end":return l.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"signOut",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,this.beforeStateQueue.runMiddleware(null);case 2:if(!(this.redirectPersistenceManager||this._popupRedirectResolver)){i.next=5;break}return i.next=5,this._setRedirectUser(null);case 5:return i.abrupt("return",this._updateCurrentUser(null,!0));case 6:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"setPersistence",value:function(e){var t=this;return this.queue(f(c().mark(function n(){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,t.assertedPersistence.setPersistence($(e));case 2:case"end":return s.stop()}},n)})))}},{key:"_getRecaptchaConfig",value:function(){return this.tenantId==null?this._agentRecaptchaConfig:this._tenantRecaptchaConfigs[this.tenantId]}},{key:"validatePassword",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this._getPasswordPolicyInternal()){u.next=3;break}return u.next=3,this._updatePasswordPolicy();case 3:if(i=this._getPasswordPolicyInternal(),i.schemaVersion===this.EXPECTED_PASSWORD_POLICY_SCHEMA_VERSION){u.next=6;break}return u.abrupt("return",Promise.reject(this._errorFactory.create("unsupported-password-policy-schema-version",{})));case 6:return u.abrupt("return",i.validatePassword(n));case 7:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_getPasswordPolicyInternal",value:function(){return this.tenantId===null?this._projectPasswordPolicy:this._tenantPasswordPolicies[this.tenantId]}},{key:"_updatePasswordPolicy",value:function(){var r=f(c().mark(function t(){var n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,lt(this);case 2:n=u.sent,i=new ht(n),this.tenantId===null?this._projectPasswordPolicy=i:this._tenantPasswordPolicies[this.tenantId]=i;case 5:case"end":return u.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_getPersistence",value:function(){return this.assertedPersistence.persistence.type}},{key:"_updateErrorMap",value:function(e){this._errorFactory=new tr("auth","Firebase",e())}},{key:"onAuthStateChanged",value:function(e,t,n){return this.registerStateListener(this.authStateSubscription,e,t,n)}},{key:"beforeAuthStateChanged",value:function(e,t){return this.beforeStateQueue.pushCallback(e,t)}},{key:"onIdTokenChanged",value:function(e,t,n){return this.registerStateListener(this.idTokenSubscription,e,t,n)}},{key:"authStateReady",value:function(){var e=this;return new Promise(function(t,n){if(e.currentUser)t();else var i=e.onAuthStateChanged(function(){i(),t()},n)})}},{key:"revokeAccessToken",value:function(){var r=f(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!this.currentUser){o.next=8;break}return o.next=3,this.currentUser.getIdToken();case 3:return i=o.sent,s={providerId:"apple.com",tokenType:"ACCESS_TOKEN",token:n,idToken:i},this.tenantId!=null&&(s.tenantId=this.tenantId),o.next=8,it(this,s);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"toJSON",value:function(){var e;return{apiKey:this.config.apiKey,authDomain:this.config.authDomain,appName:this.name,currentUser:(e=this._currentUser)===null||e===void 0?void 0:e.toJSON()}}},{key:"_setRedirectUser",value:function(){var r=f(c().mark(function t(n,i){var s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,this.getOrInitRedirectPersistenceManager(i);case 2:return s=o.sent,o.abrupt("return",n===null?s.removeCurrentUser():s.setCurrentUser(n));case 4:case"end":return o.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"getOrInitRedirectPersistenceManager",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(this.redirectPersistenceManager){u.next=9;break}return i=n&&$(n)||this._popupRedirectResolver,y(i,this,"argument-error"),u.next=5,Tr.create(this,[$(i._redirectPersistence)],"redirectUser");case 5:return this.redirectPersistenceManager=u.sent,u.next=8,this.redirectPersistenceManager.getCurrentUser();case 8:this.redirectUser=u.sent;case 9:return u.abrupt("return",this.redirectPersistenceManager);case 10:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_redirectUserForId",value:function(){var r=f(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!this._isInitialized){o.next=3;break}return o.next=3,this.queue(f(c().mark(function l(){return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:case"end":return d.stop()}},l)})));case 3:if(((i=this._currentUser)===null||i===void 0?void 0:i._redirectEventId)!==n){o.next=5;break}return o.abrupt("return",this._currentUser);case 5:if(((s=this.redirectUser)===null||s===void 0?void 0:s._redirectEventId)!==n){o.next=7;break}return o.abrupt("return",this.redirectUser);case 7:return o.abrupt("return",null);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_persistUserIfCurrent",value:function(){var r=f(c().mark(function t(n){var i=this;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:if(n!==this.currentUser){u.next=2;break}return u.abrupt("return",this.queue(f(c().mark(function o(){return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.abrupt("return",i.directlySetCurrentUser(n));case 1:case"end":return h.stop()}},o)}))));case 2:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_notifyListenersIfCurrent",value:function(e){e===this.currentUser&&this.notifyAuthListeners()}},{key:"_key",value:function(){return"".concat(this.config.authDomain,":").concat(this.config.apiKey,":").concat(this.name)}},{key:"_startProactiveRefresh",value:function(){this.isProactiveRefreshEnabled=!0,this.currentUser&&this._currentUser._startProactiveRefresh()}},{key:"_stopProactiveRefresh",value:function(){this.isProactiveRefreshEnabled=!1,this.currentUser&&this._currentUser._stopProactiveRefresh()}},{key:"_currentUser",get:function(){return this.currentUser}},{key:"notifyAuthListeners",value:function(){var e,t;if(this._isInitialized){this.idTokenSubscription.next(this.currentUser);var n=(t=(e=this.currentUser)===null||e===void 0?void 0:e.uid)!==null&&t!==void 0?t:null;this.lastNotifiedUid!==n&&(this.lastNotifiedUid=n,this.authStateSubscription.next(this.currentUser))}}},{key:"registerStateListener",value:function(e,t,n,i){var s=this;if(this._deleted)return function(){};var u=typeof t=="function"?t:t.next.bind(t),o=!1,l=this._isInitialized?Promise.resolve():this._initializationPromise;if(y(l,this,"internal-error"),l.then(function(){o||u(s.currentUser)}),typeof t=="function"){var h=e.addObserver(t,n,i);return function(){o=!0,h()}}else{var d=e.addObserver(t);return function(){o=!0,d()}}}},{key:"directlySetCurrentUser",value:function(){var r=f(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(this.currentUser&&this.currentUser!==n&&this._currentUser._stopProactiveRefresh(),n&&this.isProactiveRefreshEnabled&&n._startProactiveRefresh(),this.currentUser=n,!n){s.next=8;break}return s.next=6,this.assertedPersistence.setCurrentUser(n);case 6:s.next=10;break;case 8:return s.next=10,this.assertedPersistence.removeCurrentUser();case 10:case"end":return s.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"queue",value:function(e){return this.operations=this.operations.then(e,e),this.operations}},{key:"assertedPersistence",get:function(){return y(this.persistenceManager,this,"internal-error"),this.persistenceManager}},{key:"_logFramework",value:function(e){!e||this.frameworks.includes(e)||(this.frameworks.push(e),this.frameworks.sort(),this.clientVersion=nn(this.config.clientPlatform,this._getFrameworks()))}},{key:"_getFrameworks",value:function(){return this.frameworks}},{key:"_getAdditionalHeaders",value:function(){var r=f(c().mark(function t(){var n,i,s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return i=k({},"X-Client-Version",this.clientVersion),this.app.options.appId&&(i["X-Firebase-gmpid"]=this.app.options.appId),l.next=4,(n=this.heartbeatServiceProvider.getImmediate({optional:!0}))===null||n===void 0?void 0:n.getHeartbeatsHeader();case 4:return s=l.sent,s&&(i["X-Firebase-Client"]=s),l.next=8,this._getAppCheckToken();case 8:return u=l.sent,u&&(i["X-Firebase-AppCheck"]=u),l.abrupt("return",i);case 11:case"end":return l.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_getAppCheckToken",value:function(){var r=f(c().mark(function t(){var n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,(n=this.appCheckServiceProvider.getImmediate({optional:!0}))===null||n===void 0?void 0:n.getToken();case 2:return i=u.sent,i!=null&&i.error&&Dn("Error while retrieving App Check token: ".concat(i.error)),u.abrupt("return",i==null?void 0:i.token);case 5:case"end":return u.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()}]),a}();function X(a){return Y(a)}var Er=function(){function a(r){var e=this;I(this,a),this.auth=r,this.observer=null,this.addObserver=On(function(t){return e.observer=t})}return b(a,[{key:"next",get:function(){return y(this.observer,this.auth,"internal-error"),this.observer.next.bind(this.observer)}}]),a}();/**
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
 */function pt(){var a,r;return(r=(a=document.getElementsByTagName("head"))===null||a===void 0?void 0:a[0])!==null&&r!==void 0?r:document}function tn(a){return new Promise(function(r,e){var t=document.createElement("script");t.setAttribute("src",a),t.onload=r,t.onerror=function(n){var i=O("internal-error");i.customData=n,e(i)},t.type="text/javascript",t.charset="UTF-8",pt().appendChild(t)})}function ft(a){return"__".concat(a).concat(Math.floor(Math.random()*1e6))}var vt="https://www.google.com/recaptcha/enterprise.js?render=",gt="recaptcha-enterprise",mt="NO_RECAPTCHA",kt=function(){function a(r){I(this,a),this.type=gt,this.auth=X(r)}return b(a,[{key:"verify",value:function(){var r=f(c().mark(function t(){var n=this,i,s,u,o,l,h=arguments;return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:return l=function(g,v,T){var _=window.grecaptcha;yr(_)?_.enterprise.ready(function(){_.enterprise.execute(g,{action:i}).then(function(A){v(A)}).catch(function(){v(mt)})}):T(Error("No reCAPTCHA enterprise script loaded."))},o=function(){return o=f(c().mark(function g(v){return c().wrap(function(_){for(;;)switch(_.prev=_.next){case 0:if(s){_.next=5;break}if(!(v.tenantId==null&&v._agentRecaptchaConfig!=null)){_.next=3;break}return _.abrupt("return",v._agentRecaptchaConfig.siteKey);case 3:if(!(v.tenantId!=null&&v._tenantRecaptchaConfigs[v.tenantId]!==void 0)){_.next=5;break}return _.abrupt("return",v._tenantRecaptchaConfigs[v.tenantId].siteKey);case 5:return _.abrupt("return",new Promise(function(){var A=f(c().mark(function w(R,P){return c().wrap(function(D){for(;;)switch(D.prev=D.next){case 0:Bn(v,{clientType:"CLIENT_TYPE_WEB",version:"RECAPTCHA_ENTERPRISE"}).then(function(E){if(E.recaptchaKey===void 0)P(new Error("recaptcha Enterprise site key undefined"));else{var Q=new Gn(E);return v.tenantId==null?v._agentRecaptchaConfig=Q:v._tenantRecaptchaConfigs[v.tenantId]=Q,R(Q.siteKey)}}).catch(function(E){P(E)});case 1:case"end":return D.stop()}},w)}));return function(w,R){return A.apply(this,arguments)}}()));case 6:case"end":return _.stop()}},g)})),o.apply(this,arguments)},u=function(g){return o.apply(this,arguments)},i=h.length>0&&h[0]!==void 0?h[0]:"verify",s=h.length>1&&h[1]!==void 0?h[1]:!1,m.abrupt("return",new Promise(function(p,g){u(n.auth).then(function(v){if(!s&&yr(window.grecaptcha))l(v,p,g);else{if(typeof window>"u"){g(new Error("RecaptchaVerifier is only supported in browser"));return}tn(vt+v).then(function(){l(v,p,g)}).catch(function(T){g(T)})}}).catch(function(v){g(v)})}));case 6:case"end":return m.stop()}},t)}));function e(){return r.apply(this,arguments)}return e}()}]),a}();function Rr(a,r,e){return Me.apply(this,arguments)}function Me(){return Me=f(c().mark(function a(r,e,t){var n,i,s,u,o=arguments;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return n=o.length>3&&o[3]!==void 0?o[3]:!1,i=new kt(r),h.prev=2,h.next=5,i.verify(t);case 5:s=h.sent,h.next=13;break;case 8:return h.prev=8,h.t0=h.catch(2),h.next=12,i.verify(t,!0);case 12:s=h.sent;case 13:return u=Object.assign({},e),n?Object.assign(u,{captchaResp:s}):Object.assign(u,{captchaResponse:s}),Object.assign(u,{clientType:"CLIENT_TYPE_WEB"}),Object.assign(u,{recaptchaVersion:"RECAPTCHA_ENTERPRISE"}),h.abrupt("return",u);case 18:case"end":return h.stop()}},a,null,[[2,8]])})),Me.apply(this,arguments)}function yt(a,r,e,t){return De.apply(this,arguments)}function De(){return De=f(c().mark(function a(r,e,t,n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!(!((i=r._getRecaptchaConfig())===null||i===void 0)&&i.isProviderEnabled("EMAIL_PASSWORD_PROVIDER"))){o.next=7;break}return o.next=3,Rr(r,e,t,t==="getOobCode");case 3:return s=o.sent,o.abrupt("return",n(r,s));case 7:return o.abrupt("return",n(r,e).catch(function(){var l=f(c().mark(function h(d){var m;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:if(d.code!=="auth/".concat("missing-recaptcha-token")){g.next=8;break}return console.log("".concat(t," is protected by reCAPTCHA Enterprise for this project. Automatically triggering the reCAPTCHA flow and restarting the flow.")),g.next=4,Rr(r,e,t,t==="getOobCode");case 4:return m=g.sent,g.abrupt("return",n(r,m));case 8:return g.abrupt("return",Promise.reject(d));case 9:case"end":return g.stop()}},h)}));return function(h){return l.apply(this,arguments)}}()));case 8:case"end":return o.stop()}},a)})),De.apply(this,arguments)}function wt(a,r){var e=Vr(a,"auth");if(e.isInitialized()){var t=e.getImmediate(),n=e.getOptions();if(Sn(n,r??{}))return t;L(t,"already-initialized")}var i=e.initialize({options:r});return i}function bt(a,r){var e=(r==null?void 0:r.persistence)||[],t=(Array.isArray(e)?e:[e]).map($);r!=null&&r.errorMap&&a._updateErrorMap(r.errorMap),a._initializeWithPersistence(t,r==null?void 0:r.popupRedirectResolver)}function It(a,r,e){var t=X(a);y(t._canInitEmulator,t,"emulator-config-failed"),y(/^https?:\/\//.test(r),t,"invalid-emulator-scheme");var n=!!(e!=null&&e.disableWarnings),i=an(r),s=Tt(r),u=s.host,o=s.port,l=o===null?"":":".concat(o);t.config.emulator={url:"".concat(i,"//").concat(u).concat(l,"/")},t.settings.appVerificationDisabledForTesting=!0,t.emulatorConfig=Object.freeze({host:u,port:o,protocol:i.replace(":",""),options:Object.freeze({disableWarnings:n})}),n||_t()}function an(a){var r=a.indexOf(":");return r<0?"":a.substr(0,r+1)}function Tt(a){var r=an(a),e=/(\/\/)?([^?#/]+)/.exec(a.substr(r.length));if(!e)return{host:"",port:null};var t=e[2].split("@").pop()||"",n=/^(\[[^\]]+\])(:|$)/.exec(t);if(n){var i=n[1];return{host:i,port:Pr(t.substr(i.length+1))}}else{var s=t.split(":"),u=re(s,2),o=u[0],l=u[1];return{host:o,port:Pr(l)}}}function Pr(a){if(!a)return null;var r=Number(a);return isNaN(r)?null:r}function _t(){function a(){var r=document.createElement("p"),e=r.style;r.innerText="Running in emulator mode. Do not use with production credentials.",e.position="fixed",e.width="100%",e.backgroundColor="#ffffff",e.border=".1em solid #000000",e.color="#b50000",e.bottom="0px",e.left="0px",e.margin="0px",e.zIndex="10000",e.textAlign="center",r.classList.add("firebase-emulator-warning"),document.body.appendChild(r)}typeof console<"u"&&typeof console.info=="function"&&console.info("WARNING: You are using the Auth Emulator, which is intended for local testing only.  Do not use with production credentials."),typeof window<"u"&&typeof document<"u"&&(document.readyState==="loading"?window.addEventListener("DOMContentLoaded",a):a())}/**
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
 */var sn=function(){function a(r,e){I(this,a),this.providerId=r,this.signInMethod=e}return b(a,[{key:"toJSON",value:function(){return F("not implemented")}},{key:"_getIdTokenResponse",value:function(e){return F("not implemented")}},{key:"_linkToIdToken",value:function(e,t){return F("not implemented")}},{key:"_getReauthenticationResolver",value:function(e){return F("not implemented")}}]),a}();function Et(a,r){return Fe.apply(this,arguments)}function Fe(){return Fe=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",H(r,"POST","/v1/accounts:sendOobCode",ie(r,e)));case 1:case"end":return n.stop()}},a)})),Fe.apply(this,arguments)}function Rt(a,r){return $e.apply(this,arguments)}function $e(){return $e=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",Et(r,e));case 1:case"end":return n.stop()}},a)})),$e.apply(this,arguments)}/**
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
 */function B(a,r){return Ve.apply(this,arguments)}/**
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
 */function Ve(){return Ve=f(c().mark(function a(r,e){return c().wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",Kn(r,"POST","/v1/accounts:signInWithIdp",ie(r,e)));case 1:case"end":return n.stop()}},a)})),Ve.apply(this,arguments)}var Pt="http://localhost",We=function(a){U(e,a);var r=M(e);function e(){var t;return I(this,e),t=r.apply(this,arguments),t.pendingToken=null,t}return b(e,[{key:"toJSON",value:function(){return{idToken:this.idToken,accessToken:this.accessToken,secret:this.secret,nonce:this.nonce,pendingToken:this.pendingToken,providerId:this.providerId,signInMethod:this.signInMethod}}},{key:"_getIdTokenResponse",value:function(n){var i=this.buildRequest();return B(n,i)}},{key:"_linkToIdToken",value:function(n,i){var s=this.buildRequest();return s.idToken=i,B(n,s)}},{key:"_getReauthenticationResolver",value:function(n){var i=this.buildRequest();return i.autoCreate=!1,B(n,i)}},{key:"buildRequest",value:function(){var n={requestUri:Pt,returnSecureToken:!0};if(this.pendingToken)n.pendingToken=this.pendingToken;else{var i={};this.idToken&&(i.id_token=this.idToken),this.accessToken&&(i.access_token=this.accessToken),this.secret&&(i.oauth_token_secret=this.secret),i.providerId=this.providerId,this.nonce&&!this.pendingToken&&(i.nonce=this.nonce),n.postBody=ne(i)}return n}}],[{key:"_fromParams",value:function(n){var i=new e(n.providerId,n.signInMethod);return n.idToken||n.accessToken?(n.idToken&&(i.idToken=n.idToken),n.accessToken&&(i.accessToken=n.accessToken),n.nonce&&!n.pendingToken&&(i.nonce=n.nonce),n.pendingToken&&(i.pendingToken=n.pendingToken)):n.oauthToken&&n.oauthTokenSecret?(i.accessToken=n.oauthToken,i.secret=n.oauthTokenSecret):L("argument-error"),i}},{key:"fromJSON",value:function(n){var i=typeof n=="string"?JSON.parse(n):n,s=i.providerId,u=i.signInMethod,o=ar(i,["providerId","signInMethod"]);if(!s||!u)return null;var l=new e(s,u);return l.idToken=o.idToken||void 0,l.accessToken=o.accessToken||void 0,l.secret=o.secret,l.nonce=o.nonce,l.pendingToken=o.pendingToken||null,l}}]),e}(sn);k({},"USER_NOT_FOUND","user-not-found");/**
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
 */var cr=function(){function a(r){I(this,a),this.providerId=r,this.defaultLanguageCode=null,this.customParameters={}}return b(a,[{key:"setDefaultLanguage",value:function(e){this.defaultLanguageCode=e}},{key:"setCustomParameters",value:function(e){return this.customParameters=e,this}},{key:"getCustomParameters",value:function(){return this.customParameters}}]),a}();/**
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
 */var hr=function(a){U(e,a);var r=M(e);function e(){var t;return I(this,e),t=r.apply(this,arguments),t.scopes=[],t}return b(e,[{key:"addScope",value:function(n){return this.scopes.includes(n)||this.scopes.push(n),this}},{key:"getScopes",value:function(){return j(this.scopes)}}]),e}(cr),Gi=function(a){U(e,a);var r=M(e);function e(){return I(this,e),r.apply(this,arguments)}return b(e,[{key:"credential",value:function(n){return this._credential(Object.assign(Object.assign({},n),{nonce:n.rawNonce}))}},{key:"_credential",value:function(n){return y(n.idToken||n.accessToken,"argument-error"),We._fromParams(Object.assign(Object.assign({},n),{providerId:this.providerId,signInMethod:this.providerId}))}}],[{key:"credentialFromJSON",value:function(n){var i=typeof n=="string"?JSON.parse(n):n;return y("providerId"in i&&"signInMethod"in i,"argument-error"),We._fromParams(i)}},{key:"credentialFromResult",value:function(n){return e.oauthCredentialFromTaggedObject(n)}},{key:"credentialFromError",value:function(n){return e.oauthCredentialFromTaggedObject(n.customData||{})}},{key:"oauthCredentialFromTaggedObject",value:function(n){var i=n._tokenResponse;if(!i)return null;var s=i.oauthIdToken,u=i.oauthAccessToken,o=i.oauthTokenSecret,l=i.pendingToken,h=i.nonce,d=i.providerId;if(!u&&!o&&!s&&!l||!d)return null;try{return new e(d)._credential({idToken:s,accessToken:u,nonce:h,pendingToken:l})}catch{return null}}}]),e}(hr);/**
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
 */var un=function(a){U(e,a);var r=M(e);function e(){var t;return I(this,e),t=r.call(this,"google.com"),t.addScope("profile"),t}return b(e,null,[{key:"credential",value:function(n,i){return We._fromParams({providerId:e.PROVIDER_ID,signInMethod:e.GOOGLE_SIGN_IN_METHOD,idToken:n,accessToken:i})}},{key:"credentialFromResult",value:function(n){return e.credentialFromTaggedObject(n)}},{key:"credentialFromError",value:function(n){return e.credentialFromTaggedObject(n.customData||{})}},{key:"credentialFromTaggedObject",value:function(n){var i=n._tokenResponse;if(!i)return null;var s=i.oauthIdToken,u=i.oauthAccessToken;if(!s&&!u)return null;try{return e.credential(s,u)}catch{return null}}}]),e}(hr);un.GOOGLE_SIGN_IN_METHOD="google.com";un.PROVIDER_ID="google.com";var dr=function(){function a(r){I(this,a),this.user=r.user,this.providerId=r.providerId,this._tokenResponse=r._tokenResponse,this.operationType=r.operationType}return b(a,null,[{key:"_fromIdTokenResponse",value:function(){var r=f(c().mark(function t(n,i,s){var u,o,l,h,d=arguments;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:return u=d.length>3&&d[3]!==void 0?d[3]:!1,p.next=3,Le._fromIdTokenResponse(n,s,u);case 3:return o=p.sent,l=Ar(s),h=new a({user:o,providerId:l,_tokenResponse:s,operationType:i}),p.abrupt("return",h);case 7:case"end":return p.stop()}},t)}));function e(t,n,i){return r.apply(this,arguments)}return e}()},{key:"_forOperation",value:function(){var r=f(c().mark(function t(n,i,s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,n._updateTokensIfNecessary(s,!0);case 2:return u=Ar(s),l.abrupt("return",new a({user:n,providerId:u,_tokenResponse:s,operationType:i}));case 4:case"end":return l.stop()}},t)}));function e(t,n,i){return r.apply(this,arguments)}return e}()}]),a}();function Ar(a){return a.providerId?a.providerId:"phoneNumber"in a?"phone":null}var At=function(a){U(e,a);var r=M(e);function e(t,n,i,s){var u;I(this,e);var o;return u=r.call(this,n.code,n.message),u.operationType=i,u.user=s,Object.setPrototypeOf(Wr(u),e.prototype),u.customData={appName:t.name,tenantId:(o=t.tenantId)!==null&&o!==void 0?o:void 0,_serverResponse:n.customData._serverResponse,operationType:i},u}return b(e,null,[{key:"_fromErrorAndOperation",value:function(n,i,s,u){return new e(n,i,s,u)}}]),e}(ir);function on(a,r,e,t){var n=r==="reauthenticate"?e._getReauthenticationResolver(a):e._getIdTokenResponse(a);return n.catch(function(i){throw i.code==="auth/".concat("multi-factor-auth-required")?At._fromErrorAndOperation(a,i,r,t):i})}function St(a,r){return He.apply(this,arguments)}function He(){return He=f(c().mark(function a(r,e){var t,n,i=arguments;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return t=i.length>2&&i[2]!==void 0?i[2]:!1,u.t0=x,u.t1=r,u.t2=e,u.t3=r.auth,u.next=7,r.getIdToken();case 7:return u.t4=u.sent,u.t5=u.t2._linkToIdToken.call(u.t2,u.t3,u.t4),u.t6=t,u.next=12,(0,u.t0)(u.t1,u.t5,u.t6);case 12:return n=u.sent,u.abrupt("return",dr._forOperation(r,"link",n));case 14:case"end":return u.stop()}},a)})),He.apply(this,arguments)}function Ct(a,r){return je.apply(this,arguments)}/**
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
 */function je(){return je=f(c().mark(function a(r,e){var t,n,i,s,u,o,l=arguments;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return t=l.length>2&&l[2]!==void 0?l[2]:!1,n=r.auth,i="reauthenticate",d.prev=3,d.next=6,x(r,on(n,i,e,r),t);case 6:return s=d.sent,y(s.idToken,n,"internal-error"),u=or(s.idToken),y(u,n,"internal-error"),o=u.sub,y(r.uid===o,n,"user-mismatch"),d.abrupt("return",dr._forOperation(r,i,s));case 15:throw d.prev=15,d.t0=d.catch(3),(d.t0===null||d.t0===void 0?void 0:d.t0.code)==="auth/".concat("user-not-found")&&L(n,"user-mismatch"),d.t0;case 19:case"end":return d.stop()}},a,null,[[3,15]])})),je.apply(this,arguments)}function Ot(a,r){return Ke.apply(this,arguments)}function Ke(){return Ke=f(c().mark(function a(r,e){var t,n,i,s,u=arguments;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return t=u.length>2&&u[2]!==void 0?u[2]:!1,n="signIn",l.next=4,on(r,n,e);case 4:return i=l.sent,l.next=7,dr._fromIdTokenResponse(r,n,i);case 7:if(s=l.sent,t){l.next=11;break}return l.next=11,r._updateCurrentUser(s.user);case 11:return l.abrupt("return",s);case 12:case"end":return l.stop()}},a)})),Ke.apply(this,arguments)}/**
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
 */function Nt(a,r,e){var t;y(((t=e.url)===null||t===void 0?void 0:t.length)>0,a,"invalid-continue-uri"),y(typeof e.dynamicLinkDomain>"u"||e.dynamicLinkDomain.length>0,a,"invalid-dynamic-link-domain"),r.continueUrl=e.url,r.dynamicLinkDomain=e.dynamicLinkDomain,r.canHandleCodeInApp=e.handleCodeInApp,e.iOS&&(y(e.iOS.bundleId.length>0,a,"missing-ios-bundle-id"),r.iOSBundleId=e.iOS.bundleId),e.android&&(y(e.android.packageName.length>0,a,"missing-android-pkg-name"),r.androidInstallApp=e.android.installApp,r.androidMinimumVersionCode=e.android.minimumVersion,r.androidPackageName=e.android.packageName)}function Bi(a,r,e){return ze.apply(this,arguments)}function ze(){return ze=f(c().mark(function a(r,e,t){var n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return n=X(r),i={requestType:"PASSWORD_RESET",email:e,clientType:"CLIENT_TYPE_WEB"},t&&Nt(n,i,t),u.next=5,yt(n,i,"getOobCode",Rt);case 5:case"end":return u.stop()}},a)})),ze.apply(this,arguments)}function Lt(a,r,e,t){return Y(a).onIdTokenChanged(r,e,t)}function Ut(a,r,e){return Y(a).beforeAuthStateChanged(r,e)}var de="__sak";/**
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
 */var ln=function(){function a(r,e){I(this,a),this.storageRetriever=r,this.type=e}return b(a,[{key:"_isAvailable",value:function(){try{return this.storage?(this.storage.setItem(de,"1"),this.storage.removeItem(de),Promise.resolve(!0)):Promise.resolve(!1)}catch{return Promise.resolve(!1)}}},{key:"_set",value:function(e,t){return this.storage.setItem(e,JSON.stringify(t)),Promise.resolve()}},{key:"_get",value:function(e){var t=this.storage.getItem(e);return Promise.resolve(t?JSON.parse(t):null)}},{key:"_remove",value:function(e){return this.storage.removeItem(e),Promise.resolve()}},{key:"storage",get:function(){return this.storageRetriever()}}]),a}();/**
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
 */function Mt(){var a=S();return lr(a)||fe(a)}var Dt=1e3,Ft=10,cn=function(a){U(e,a);var r=M(e);function e(){var t;return I(this,e),t=r.call(this,function(){return window.localStorage},"LOCAL"),t.boundEventHandler=function(n,i){return t.onStorageEvent(n,i)},t.listeners={},t.localCache={},t.pollTimer=null,t.safariLocalStorageNotSynced=Mt()&&ut(),t.fallbackToPolling=rn(),t._shouldAllowMigration=!0,t}return b(e,[{key:"forAllChangedKeys",value:function(n){for(var i=0,s=Object.keys(this.listeners);i<s.length;i++){var u=s[i],o=this.storage.getItem(u),l=this.localCache[u];o!==l&&n(u,l,o)}}},{key:"onStorageEvent",value:function(n){var i=this,s=arguments.length>1&&arguments[1]!==void 0?arguments[1]:!1;if(!n.key){this.forAllChangedKeys(function(d,m,p){i.notifyListeners(d,p)});return}var u=n.key;if(s?this.detachListener():this.stopPolling(),this.safariLocalStorageNotSynced){var o=this.storage.getItem(u);if(n.newValue!==o)n.newValue!==null?this.storage.setItem(u,n.newValue):this.storage.removeItem(u);else if(this.localCache[u]===n.newValue&&!s)return}var l=function(){var m=i.storage.getItem(u);!s&&i.localCache[u]===m||i.notifyListeners(u,m)},h=this.storage.getItem(u);st()&&h!==n.newValue&&n.newValue!==n.oldValue?setTimeout(l,Ft):l()}},{key:"notifyListeners",value:function(n,i){this.localCache[n]=i;var s=this.listeners[n];if(s)for(var u=0,o=Array.from(s);u<o.length;u++){var l=o[u];l(i&&JSON.parse(i))}}},{key:"startPolling",value:function(){var n=this;this.stopPolling(),this.pollTimer=setInterval(function(){n.forAllChangedKeys(function(i,s,u){n.onStorageEvent(new StorageEvent("storage",{key:i,oldValue:s,newValue:u}),!0)})},Dt)}},{key:"stopPolling",value:function(){this.pollTimer&&(clearInterval(this.pollTimer),this.pollTimer=null)}},{key:"attachListener",value:function(){window.addEventListener("storage",this.boundEventHandler)}},{key:"detachListener",value:function(){window.removeEventListener("storage",this.boundEventHandler)}},{key:"_addListener",value:function(n,i){Object.keys(this.listeners).length===0&&(this.fallbackToPolling?this.startPolling():this.attachListener()),this.listeners[n]||(this.listeners[n]=new Set,this.localCache[n]=this.storage.getItem(n)),this.listeners[n].add(i)}},{key:"_removeListener",value:function(n,i){this.listeners[n]&&(this.listeners[n].delete(i),this.listeners[n].size===0&&delete this.listeners[n]),Object.keys(this.listeners).length===0&&(this.detachListener(),this.stopPolling())}},{key:"_set",value:function(){var t=f(c().mark(function i(s,u){return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,z(q(e.prototype),"_set",this).call(this,s,u);case 2:this.localCache[s]=JSON.stringify(u);case 3:case"end":return l.stop()}},i,this)}));function n(i,s){return t.apply(this,arguments)}return n}()},{key:"_get",value:function(){var t=f(c().mark(function i(s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return l.next=2,z(q(e.prototype),"_get",this).call(this,s);case 2:return u=l.sent,this.localCache[s]=JSON.stringify(u),l.abrupt("return",u);case 5:case"end":return l.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()},{key:"_remove",value:function(){var t=f(c().mark(function i(s){return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,z(q(e.prototype),"_remove",this).call(this,s);case 2:delete this.localCache[s];case 3:case"end":return o.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()}]),e}(ln);cn.type="LOCAL";var $t=cn;/**
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
 */var hn=function(a){U(e,a);var r=M(e);function e(){return I(this,e),r.call(this,function(){return window.sessionStorage},"SESSION")}return b(e,[{key:"_addListener",value:function(n,i){}},{key:"_removeListener",value:function(n,i){}}]),e}(ln);hn.type="SESSION";var dn=hn;/**
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
 */function Vt(a){return Promise.all(a.map(function(){var r=f(c().mark(function e(t){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,t;case 3:return n=s.sent,s.abrupt("return",{fulfilled:!0,value:n});case 7:return s.prev=7,s.t0=s.catch(0),s.abrupt("return",{fulfilled:!1,reason:s.t0});case 10:case"end":return s.stop()}},e,null,[[0,7]])}));return function(e){return r.apply(this,arguments)}}()))}/**
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
 */var pn=function(){function a(r){I(this,a),this.eventTarget=r,this.handlersMap={},this.boundEventHandler=this.handleEvent.bind(this)}return b(a,[{key:"isListeningto",value:function(e){return this.eventTarget===e}},{key:"handleEvent",value:function(){var r=f(c().mark(function t(n){var i,s,u,o,l,h,d,m;return c().wrap(function(g){for(;;)switch(g.prev=g.next){case 0:if(i=n,s=i.data,u=s.eventId,o=s.eventType,l=s.data,h=this.handlersMap[o],h!=null&&h.size){g.next=5;break}return g.abrupt("return");case 5:return i.ports[0].postMessage({status:"ack",eventId:u,eventType:o}),d=Array.from(h).map(function(){var v=f(c().mark(function T(_){return c().wrap(function(w){for(;;)switch(w.prev=w.next){case 0:return w.abrupt("return",_(i.origin,l));case 1:case"end":return w.stop()}},T)}));return function(T){return v.apply(this,arguments)}}()),g.next=9,Vt(d);case 9:m=g.sent,i.ports[0].postMessage({status:"done",eventId:u,eventType:o,response:m});case 11:case"end":return g.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_subscribe",value:function(e,t){Object.keys(this.handlersMap).length===0&&this.eventTarget.addEventListener("message",this.boundEventHandler),this.handlersMap[e]||(this.handlersMap[e]=new Set),this.handlersMap[e].add(t)}},{key:"_unsubscribe",value:function(e,t){this.handlersMap[e]&&t&&this.handlersMap[e].delete(t),(!t||this.handlersMap[e].size===0)&&delete this.handlersMap[e],Object.keys(this.handlersMap).length===0&&this.eventTarget.removeEventListener("message",this.boundEventHandler)}}],[{key:"_getInstance",value:function(e){var t=this.receivers.find(function(i){return i.isListeningto(e)});if(t)return t;var n=new a(e);return this.receivers.push(n),n}}]),a}();pn.receivers=[];/**
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
 */function pr(){for(var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:"",r=arguments.length>1&&arguments[1]!==void 0?arguments[1]:10,e="",t=0;t<r;t++)e+=Math.floor(Math.random()*10);return a+e}/**
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
 */var Wt=function(){function a(r){I(this,a),this.target=r,this.handlers=new Set}return b(a,[{key:"removeMessageHandler",value:function(e){e.messageChannel&&(e.messageChannel.port1.removeEventListener("message",e.onMessage),e.messageChannel.port1.close()),this.handlers.delete(e)}},{key:"_send",value:function(){var r=f(c().mark(function t(n,i){var s=this,u,o,l,h,d=arguments;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:if(u=d.length>2&&d[2]!==void 0?d[2]:50,o=typeof MessageChannel<"u"?new MessageChannel:null,o){p.next=4;break}throw new Error("connection_unavailable");case 4:return p.abrupt("return",new Promise(function(g,v){var T=pr("",20);o.port1.start();var _=setTimeout(function(){v(new Error("unsupported_event"))},u);h={messageChannel:o,onMessage:function(w){var R=w;if(R.data.eventId===T)switch(R.data.status){case"ack":clearTimeout(_),l=setTimeout(function(){v(new Error("timeout"))},3e3);break;case"done":clearTimeout(l),g(R.data.response);break;default:clearTimeout(_),clearTimeout(l),v(new Error("invalid_response"));break}}},s.handlers.add(h),o.port1.addEventListener("message",h.onMessage),s.target.postMessage({eventType:n,eventId:T,data:i},[o.port2])}).finally(function(){h&&s.removeMessageHandler(h)}));case 5:case"end":return p.stop()}},t)}));function e(t,n){return r.apply(this,arguments)}return e}()}]),a}();/**
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
 */function N(){return window}function Ht(a){N().location.href=a}/**
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
 */function fn(){return typeof N().WorkerGlobalScope<"u"&&typeof N().importScripts=="function"}function jt(){return qe.apply(this,arguments)}function qe(){return qe=f(c().mark(function a(){var r;return c().wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(navigator!=null&&navigator.serviceWorker){t.next=2;break}return t.abrupt("return",null);case 2:return t.prev=2,t.next=5,navigator.serviceWorker.ready;case 5:return r=t.sent,t.abrupt("return",r.active);case 9:return t.prev=9,t.t0=t.catch(2),t.abrupt("return",null);case 12:case"end":return t.stop()}},a,null,[[2,9]])})),qe.apply(this,arguments)}function Kt(){var a;return((a=navigator==null?void 0:navigator.serviceWorker)===null||a===void 0?void 0:a.controller)||null}function zt(){return fn()?self:null}/**
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
 */var vn="firebaseLocalStorageDb",qt=1,pe="firebaseLocalStorage",gn="fbase_key",ae=function(){function a(r){I(this,a),this.request=r}return b(a,[{key:"toPromise",value:function(){var e=this;return new Promise(function(t,n){e.request.addEventListener("success",function(){t(e.request.result)}),e.request.addEventListener("error",function(){n(e.request.error)})})}}]),a}();function ve(a,r){return a.transaction([pe],r?"readwrite":"readonly").objectStore(pe)}function Gt(){var a=indexedDB.deleteDatabase(vn);return new ae(a).toPromise()}function Ge(){var a=indexedDB.open(vn,qt);return new Promise(function(r,e){a.addEventListener("error",function(){e(a.error)}),a.addEventListener("upgradeneeded",function(){var t=a.result;try{t.createObjectStore(pe,{keyPath:gn})}catch(n){e(n)}}),a.addEventListener("success",f(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(n=a.result,n.objectStoreNames.contains(pe)){s.next=12;break}return n.close(),s.next=5,Gt();case 5:return s.t0=r,s.next=8,Ge();case 8:s.t1=s.sent,(0,s.t0)(s.t1),s.next=13;break;case 12:r(n);case 13:case"end":return s.stop()}},t)})))})}function Sr(a,r,e){return Be.apply(this,arguments)}function Be(){return Be=f(c().mark(function a(r,e,t){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return n=ve(r,!0).put(k(k({},gn,e),"value",t)),s.abrupt("return",new ae(n).toPromise());case 2:case"end":return s.stop()}},a)})),Be.apply(this,arguments)}function Bt(a,r){return Je.apply(this,arguments)}function Je(){return Je=f(c().mark(function a(r,e){var t,n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return t=ve(r,!1).get(e),s.next=3,new ae(t).toPromise();case 3:return n=s.sent,s.abrupt("return",n===void 0?null:n.value);case 5:case"end":return s.stop()}},a)})),Je.apply(this,arguments)}function Cr(a,r){var e=ve(a,!0).delete(r);return new ae(e).toPromise()}var Jt=800,Yt=3,mn=function(){function a(){I(this,a),this.type="LOCAL",this._shouldAllowMigration=!0,this.listeners={},this.localCache={},this.pollTimer=null,this.pendingWrites=0,this.receiver=null,this.sender=null,this.serviceWorkerReceiverAvailable=!1,this.activeServiceWorker=null,this._workerInitializationPromise=this.initializeServiceWorkerMessaging().then(function(){},function(){})}return b(a,[{key:"_openDb",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:if(!this.db){i.next=2;break}return i.abrupt("return",this.db);case 2:return i.next=4,Ge();case 4:return this.db=i.sent,i.abrupt("return",this.db);case 6:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"_withRetries",value:function(){var r=f(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:i=0;case 1:return o.prev=2,o.next=5,this._openDb();case 5:return s=o.sent,o.next=8,n(s);case 8:return o.abrupt("return",o.sent);case 11:if(o.prev=11,o.t0=o.catch(2),!(i++>Yt)){o.next=15;break}throw o.t0;case 15:this.db&&(this.db.close(),this.db=void 0);case 16:o.next=1;break;case 18:case"end":return o.stop()}},t,this,[[2,11]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"initializeServiceWorkerMessaging",value:function(){var r=f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",fn()?this.initializeReceiver():this.initializeSender());case 1:case"end":return i.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeReceiver",value:function(){var r=f(c().mark(function t(){var n=this;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:this.receiver=pn._getInstance(zt()),this.receiver._subscribe("keyChanged",function(){var u=f(c().mark(function o(l,h){var d;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:return p.next=2,n._poll();case 2:return d=p.sent,p.abrupt("return",{keyProcessed:d.includes(h.key)});case 4:case"end":return p.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}()),this.receiver._subscribe("ping",function(){var u=f(c().mark(function o(l,h){return c().wrap(function(m){for(;;)switch(m.prev=m.next){case 0:return m.abrupt("return",["keyChanged"]);case 1:case"end":return m.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}());case 3:case"end":return s.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"initializeSender",value:function(){var r=f(c().mark(function t(){var n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,jt();case 2:if(this.activeServiceWorker=o.sent,this.activeServiceWorker){o.next=5;break}return o.abrupt("return");case 5:return this.sender=new Wt(this.activeServiceWorker),o.next=8,this.sender._send("ping",{},800);case 8:if(s=o.sent,s){o.next=11;break}return o.abrupt("return");case 11:!((n=s[0])===null||n===void 0)&&n.fulfilled&&(!((i=s[0])===null||i===void 0)&&i.value.includes("keyChanged"))&&(this.serviceWorkerReceiverAvailable=!0);case 12:case"end":return o.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"notifyServiceWorker",value:function(){var r=f(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(!(!this.sender||!this.activeServiceWorker||Kt()!==this.activeServiceWorker)){s.next=2;break}return s.abrupt("return");case 2:return s.prev=2,s.next=5,this.sender._send("keyChanged",{key:n},this.serviceWorkerReceiverAvailable?800:50);case 5:s.next=9;break;case 7:s.prev=7,s.t0=s.catch(2);case 9:case"end":return s.stop()}},t,this,[[2,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_isAvailable",value:function(){var r=f(c().mark(function t(){var n;return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(s.prev=0,indexedDB){s.next=3;break}return s.abrupt("return",!1);case 3:return s.next=5,Ge();case 5:return n=s.sent,s.next=8,Sr(n,de,"1");case 8:return s.next=10,Cr(n,de);case 10:return s.abrupt("return",!0);case 13:s.prev=13,s.t0=s.catch(0);case 15:return s.abrupt("return",!1);case 16:case"end":return s.stop()}},t,null,[[0,13]])}));function e(){return r.apply(this,arguments)}return e}()},{key:"_withPendingWrite",value:function(){var r=f(c().mark(function t(n){return c().wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return this.pendingWrites++,s.prev=1,s.next=4,n();case 4:return s.prev=4,this.pendingWrites--,s.finish(4);case 7:case"end":return s.stop()}},t,this,[[1,,4,7]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_set",value:function(){var r=f(c().mark(function t(n,i){var s=this;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.abrupt("return",this._withPendingWrite(f(c().mark(function l(){return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return d.next=2,s._withRetries(function(m){return Sr(m,n,i)});case 2:return s.localCache[n]=i,d.abrupt("return",s.notifyServiceWorker(n));case 4:case"end":return d.stop()}},l)}))));case 1:case"end":return o.stop()}},t,this)}));function e(t,n){return r.apply(this,arguments)}return e}()},{key:"_get",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.next=2,this._withRetries(function(o){return Bt(o,n)});case 2:return i=u.sent,this.localCache[n]=i,u.abrupt("return",i);case 5:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_remove",value:function(){var r=f(c().mark(function t(n){var i=this;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return u.abrupt("return",this._withPendingWrite(f(c().mark(function o(){return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.next=2,i._withRetries(function(d){return Cr(d,n)});case 2:return delete i.localCache[n],h.abrupt("return",i.notifyServiceWorker(n));case 4:case"end":return h.stop()}},o)}))));case 1:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_poll",value:function(){var r=f(c().mark(function t(){var n,i,s,u,o,l,h,d,m,p,g;return c().wrap(function(T){for(;;)switch(T.prev=T.next){case 0:return T.next=2,this._withRetries(function(_){var A=ve(_,!1).getAll();return new ae(A).toPromise()});case 2:if(n=T.sent,n){T.next=5;break}return T.abrupt("return",[]);case 5:if(this.pendingWrites===0){T.next=7;break}return T.abrupt("return",[]);case 7:if(i=[],s=new Set,n.length!==0){u=J(n);try{for(u.s();!(o=u.n()).done;)l=o.value,h=l.fbase_key,d=l.value,s.add(h),JSON.stringify(this.localCache[h])!==JSON.stringify(d)&&(this.notifyListeners(h,d),i.push(h))}catch(_){u.e(_)}finally{u.f()}}for(m=0,p=Object.keys(this.localCache);m<p.length;m++)g=p[m],this.localCache[g]&&!s.has(g)&&(this.notifyListeners(g,null),i.push(g));return T.abrupt("return",i);case 12:case"end":return T.stop()}},t,this)}));function e(){return r.apply(this,arguments)}return e}()},{key:"notifyListeners",value:function(e,t){this.localCache[e]=t;var n=this.listeners[e];if(n)for(var i=0,s=Array.from(n);i<s.length;i++){var u=s[i];u(t)}}},{key:"startPolling",value:function(){var e=this;this.stopPolling(),this.pollTimer=setInterval(f(c().mark(function t(){return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.abrupt("return",e._poll());case 1:case"end":return i.stop()}},t)})),Jt)}},{key:"stopPolling",value:function(){this.pollTimer&&(clearInterval(this.pollTimer),this.pollTimer=null)}},{key:"_addListener",value:function(e,t){Object.keys(this.listeners).length===0&&this.startPolling(),this.listeners[e]||(this.listeners[e]=new Set,this._get(e)),this.listeners[e].add(t)}},{key:"_removeListener",value:function(e,t){this.listeners[e]&&(this.listeners[e].delete(t),this.listeners[e].size===0&&delete this.listeners[e]),Object.keys(this.listeners).length===0&&this.stopPolling()}}]),a}();mn.type="LOCAL";var Xt=mn;new te(3e4,6e4);/**
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
 */function kn(a,r){return r?$(r):(y(a._popupRedirectResolver,a,"argument-error"),a._popupRedirectResolver)}/**
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
 */var fr=function(a){U(e,a);var r=M(e);function e(t){var n;return I(this,e),n=r.call(this,"custom","custom"),n.params=t,n}return b(e,[{key:"_getIdTokenResponse",value:function(n){return B(n,this._buildIdpRequest())}},{key:"_linkToIdToken",value:function(n,i){return B(n,this._buildIdpRequest(i))}},{key:"_getReauthenticationResolver",value:function(n){return B(n,this._buildIdpRequest())}},{key:"_buildIdpRequest",value:function(n){var i={requestUri:this.params.requestUri,sessionId:this.params.sessionId,postBody:this.params.postBody,tenantId:this.params.tenantId,pendingToken:this.params.pendingToken,returnSecureToken:!0,returnIdpCredential:!0};return n&&(i.idToken=n),i}}]),e}(sn);function Qt(a){return Ot(a.auth,new fr(a),a.bypassAuthState)}function Zt(a){var r=a.auth,e=a.user;return y(e,r,"internal-error"),Ct(e,new fr(a),a.bypassAuthState)}function xt(a){return Ye.apply(this,arguments)}/**
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
 */function Ye(){return Ye=f(c().mark(function a(r){var e,t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=r.auth,t=r.user,y(t,e,"internal-error"),i.abrupt("return",St(t,new fr(r),r.bypassAuthState));case 3:case"end":return i.stop()}},a)})),Ye.apply(this,arguments)}var yn=function(){function a(r,e,t,n){var i=arguments.length>4&&arguments[4]!==void 0?arguments[4]:!1;I(this,a),this.auth=r,this.resolver=t,this.user=n,this.bypassAuthState=i,this.pendingPromise=null,this.eventManager=null,this.filter=Array.isArray(e)?e:[e]}return b(a,[{key:"execute",value:function(){var e=this;return new Promise(function(){var t=f(c().mark(function n(i,s){return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return e.pendingPromise={resolve:i,reject:s},o.prev=1,o.next=4,e.resolver._initialize(e.auth);case 4:return e.eventManager=o.sent,o.next=7,e.onExecution();case 7:e.eventManager.registerConsumer(e),o.next=13;break;case 10:o.prev=10,o.t0=o.catch(1),e.reject(o.t0);case 13:case"end":return o.stop()}},n,null,[[1,10]])}));return function(n,i){return t.apply(this,arguments)}}())}},{key:"onAuthEvent",value:function(){var r=f(c().mark(function t(n){var i,s,u,o,l,h,d;return c().wrap(function(p){for(;;)switch(p.prev=p.next){case 0:if(i=n.urlResponse,s=n.sessionId,u=n.postBody,o=n.tenantId,l=n.error,h=n.type,!l){p.next=4;break}return this.reject(l),p.abrupt("return");case 4:return d={auth:this.auth,requestUri:i,sessionId:s,tenantId:o||void 0,postBody:u||void 0,user:this.user,bypassAuthState:this.bypassAuthState},p.prev=5,p.t0=this,p.next=9,this.getIdpTask(h)(d);case 9:p.t1=p.sent,p.t0.resolve.call(p.t0,p.t1),p.next=16;break;case 13:p.prev=13,p.t2=p.catch(5),this.reject(p.t2);case 16:case"end":return p.stop()}},t,this,[[5,13]])}));function e(t){return r.apply(this,arguments)}return e}()},{key:"onError",value:function(e){this.reject(e)}},{key:"getIdpTask",value:function(e){switch(e){case"signInViaPopup":case"signInViaRedirect":return Qt;case"linkViaPopup":case"linkViaRedirect":return xt;case"reauthViaPopup":case"reauthViaRedirect":return Zt;default:L(this.auth,"internal-error")}}},{key:"resolve",value:function(e){V(this.pendingPromise,"Pending promise was never set"),this.pendingPromise.resolve(e),this.unregisterAndCleanUp()}},{key:"reject",value:function(e){V(this.pendingPromise,"Pending promise was never set"),this.pendingPromise.reject(e),this.unregisterAndCleanUp()}},{key:"unregisterAndCleanUp",value:function(){this.eventManager&&this.eventManager.unregisterConsumer(this),this.pendingPromise=null,this.cleanUp()}}]),a}();/**
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
 */var ei=new te(2e3,1e4);function Ji(a,r,e){return Xe.apply(this,arguments)}function Xe(){return Xe=f(c().mark(function a(r,e,t){var n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return n=X(r),Fn(r,e,cr),i=kn(n,t),s=new wn(n,"signInViaPopup",e,i),o.abrupt("return",s.executeNotNull());case 5:case"end":return o.stop()}},a)})),Xe.apply(this,arguments)}var wn=function(a){U(e,a);var r=M(e);function e(t,n,i,s,u){var o;return I(this,e),o=r.call(this,t,n,s,u),o.provider=i,o.authWindow=null,o.pollId=null,e.currentPopupAction&&e.currentPopupAction.cancel(),e.currentPopupAction=Wr(o),o}return b(e,[{key:"executeNotNull",value:function(){var t=f(c().mark(function i(){var s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,this.execute();case 2:return s=o.sent,y(s,this.auth,"internal-error"),o.abrupt("return",s);case 5:case"end":return o.stop()}},i,this)}));function n(){return t.apply(this,arguments)}return n}()},{key:"onExecution",value:function(){var t=f(c().mark(function i(){var s=this,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:return V(this.filter.length===1,"Popup operations only handle one event"),u=pr(),l.next=4,this.resolver._openPopup(this.auth,this.provider,this.filter[0],u);case 4:this.authWindow=l.sent,this.authWindow.associatedEvent=u,this.resolver._originValidation(this.auth).catch(function(h){s.reject(h)}),this.resolver._isIframeWebStorageSupported(this.auth,function(h){h||s.reject(O(s.auth,"web-storage-unsupported"))}),this.pollUserCancellation();case 9:case"end":return l.stop()}},i,this)}));function n(){return t.apply(this,arguments)}return n}()},{key:"eventId",get:function(){var n;return((n=this.authWindow)===null||n===void 0?void 0:n.associatedEvent)||null}},{key:"cancel",value:function(){this.reject(O(this.auth,"cancelled-popup-request"))}},{key:"cleanUp",value:function(){this.authWindow&&this.authWindow.close(),this.pollId&&window.clearTimeout(this.pollId),this.authWindow=null,this.pollId=null,e.currentPopupAction=null}},{key:"pollUserCancellation",value:function(){var n=this,i=function s(){var u,o;if(!((o=(u=n.authWindow)===null||u===void 0?void 0:u.window)===null||o===void 0)&&o.closed){n.pollId=window.setTimeout(function(){n.pollId=null,n.reject(O(n.auth,"popup-closed-by-user"))},8e3);return}n.pollId=window.setTimeout(s,ei.get())};i()}}]),e}(yn);wn.currentPopupAction=null;/**
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
 */var ri="pendingRedirect",le=new Map,ni=function(a){U(e,a);var r=M(e);function e(t,n){var i,s=arguments.length>2&&arguments[2]!==void 0?arguments[2]:!1;return I(this,e),i=r.call(this,t,["signInViaRedirect","linkViaRedirect","reauthViaRedirect","unknown"],n,void 0,s),i.eventId=null,i}return b(e,[{key:"execute",value:function(){var t=f(c().mark(function i(){var s,u,o;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:if(s=le.get(this.auth._key()),s){h.next=21;break}return h.prev=2,h.next=5,ti(this.resolver,this.auth);case 5:if(u=h.sent,!u){h.next=12;break}return h.next=9,z(q(e.prototype),"execute",this).call(this);case 9:h.t0=h.sent,h.next=13;break;case 12:h.t0=null;case 13:o=h.t0,s=function(){return Promise.resolve(o)},h.next=20;break;case 17:h.prev=17,h.t1=h.catch(2),s=function(){return Promise.reject(h.t1)};case 20:le.set(this.auth._key(),s);case 21:return this.bypassAuthState||le.set(this.auth._key(),function(){return Promise.resolve(null)}),h.abrupt("return",s());case 23:case"end":return h.stop()}},i,this,[[2,17]])}));function n(){return t.apply(this,arguments)}return n}()},{key:"onAuthEvent",value:function(){var t=f(c().mark(function i(s){var u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(s.type!=="signInViaRedirect"){l.next=4;break}return l.abrupt("return",z(q(e.prototype),"onAuthEvent",this).call(this,s));case 4:if(s.type!=="unknown"){l.next=7;break}return this.resolve(null),l.abrupt("return");case 7:if(!s.eventId){l.next=17;break}return l.next=10,this.auth._redirectUserForId(s.eventId);case 10:if(u=l.sent,!u){l.next=16;break}return this.user=u,l.abrupt("return",z(q(e.prototype),"onAuthEvent",this).call(this,s));case 16:this.resolve(null);case 17:case"end":return l.stop()}},i,this)}));function n(i){return t.apply(this,arguments)}return n}()},{key:"onExecution",value:function(){var t=f(c().mark(function i(){return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:case"end":return u.stop()}},i)}));function n(){return t.apply(this,arguments)}return n}()},{key:"cleanUp",value:function(){}}]),e}(yn);function ti(a,r){return Qe.apply(this,arguments)}function Qe(){return Qe=f(c().mark(function a(r,e){var t,n,i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return t=si(e),n=ai(r),u.next=4,n._isAvailable();case 4:if(u.sent){u.next=6;break}return u.abrupt("return",!1);case 6:return u.next=8,n._get(t);case 8:return u.t0=u.sent,i=u.t0==="true",u.next=12,n._remove(t);case 12:return u.abrupt("return",i);case 13:case"end":return u.stop()}},a)})),Qe.apply(this,arguments)}function ii(a,r){le.set(a._key(),r)}function ai(a){return $(a._redirectPersistence)}function si(a){return oe(ri,a.config.apiKey,a.name)}function ui(a,r){return Ze.apply(this,arguments)}function Ze(){return Ze=f(c().mark(function a(r,e){var t,n,i,s,u,o=arguments;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return t=o.length>2&&o[2]!==void 0?o[2]:!1,n=X(r),i=kn(n,e),s=new ni(n,i,t),h.next=6,s.execute();case 6:if(u=h.sent,!(u&&!t)){h.next=13;break}return delete u.user._redirectEventId,h.next=11,n._persistUserIfCurrent(u.user);case 11:return h.next=13,n._setRedirectUser(null,e);case 13:return h.abrupt("return",u);case 14:case"end":return h.stop()}},a)})),Ze.apply(this,arguments)}var oi=10*60*1e3,li=function(){function a(r){I(this,a),this.auth=r,this.cachedEventUids=new Set,this.consumers=new Set,this.queuedRedirectEvent=null,this.hasHandledPotentialRedirect=!1,this.lastProcessedEventTime=Date.now()}return b(a,[{key:"registerConsumer",value:function(e){this.consumers.add(e),this.queuedRedirectEvent&&this.isEventForConsumer(this.queuedRedirectEvent,e)&&(this.sendToConsumer(this.queuedRedirectEvent,e),this.saveEventToCache(this.queuedRedirectEvent),this.queuedRedirectEvent=null)}},{key:"unregisterConsumer",value:function(e){this.consumers.delete(e)}},{key:"onEvent",value:function(e){var t=this;if(this.hasEventBeenHandled(e))return!1;var n=!1;return this.consumers.forEach(function(i){t.isEventForConsumer(e,i)&&(n=!0,t.sendToConsumer(e,i),t.saveEventToCache(e))}),this.hasHandledPotentialRedirect||!ci(e)||(this.hasHandledPotentialRedirect=!0,n||(this.queuedRedirectEvent=e,n=!0)),n}},{key:"sendToConsumer",value:function(e,t){var n;if(e.error&&!bn(e)){var i=((n=e.error.code)===null||n===void 0?void 0:n.split("auth/")[1])||"internal-error";t.onError(O(this.auth,i))}else t.onAuthEvent(e)}},{key:"isEventForConsumer",value:function(e,t){var n=t.eventId===null||!!e.eventId&&e.eventId===t.eventId;return t.filter.includes(e.type)&&n}},{key:"hasEventBeenHandled",value:function(e){return Date.now()-this.lastProcessedEventTime>=oi&&this.cachedEventUids.clear(),this.cachedEventUids.has(Or(e))}},{key:"saveEventToCache",value:function(e){this.cachedEventUids.add(Or(e)),this.lastProcessedEventTime=Date.now()}}]),a}();function Or(a){return[a.type,a.eventId,a.sessionId,a.tenantId].filter(function(r){return r}).join("-")}function bn(a){var r=a.type,e=a.error;return r==="unknown"&&(e==null?void 0:e.code)==="auth/".concat("no-auth-event")}function ci(a){switch(a.type){case"signInViaRedirect":case"linkViaRedirect":case"reauthViaRedirect":return!0;case"unknown":return bn(a);default:return!1}}/**
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
 */function hi(a){return xe.apply(this,arguments)}/**
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
 */function xe(){return xe=f(c().mark(function a(r){var e,t=arguments;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return e=t.length>1&&t[1]!==void 0?t[1]:{},i.abrupt("return",H(r,"GET","/v1/projects",e));case 2:case"end":return i.stop()}},a)})),xe.apply(this,arguments)}var di=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/,pi=/^https?/;function fi(a){return er.apply(this,arguments)}function er(){return er=f(c().mark(function a(r){var e,t,n,i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:if(!r.config.emulator){o.next=2;break}return o.abrupt("return");case 2:return o.next=4,hi(r);case 4:e=o.sent,t=e.authorizedDomains,n=J(t),o.prev=7,n.s();case 9:if((i=n.n()).done){o.next=20;break}if(s=i.value,o.prev=11,!vi(s)){o.next=14;break}return o.abrupt("return");case 14:o.next=18;break;case 16:o.prev=16,o.t0=o.catch(11);case 18:o.next=9;break;case 20:o.next=25;break;case 22:o.prev=22,o.t1=o.catch(7),n.e(o.t1);case 25:return o.prev=25,n.f(),o.finish(25);case 28:L(r,"unauthorized-domain");case 29:case"end":return o.stop()}},a,null,[[7,22,25,28],[11,16]])})),er.apply(this,arguments)}function vi(a){var r=we(),e=new URL(r),t=e.protocol,n=e.hostname;if(a.startsWith("chrome-extension://")){var i=new URL(a);return i.hostname===""&&n===""?t==="chrome-extension:"&&a.replace("chrome-extension://","")===r.replace("chrome-extension://",""):t==="chrome-extension:"&&i.hostname===n}if(!pi.test(t))return!1;if(di.test(a))return n===a;var s=a.replace(/\./g,"\\."),u=new RegExp("^(.+\\."+s+"|"+s+")$","i");return u.test(n)}/**
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
 */var gi=new te(3e4,6e4);function Nr(){var a=N().___jsl;if(a!=null&&a.H)for(var r=0,e=Object.keys(a.H);r<e.length;r++){var t=e[r];if(a.H[t].r=a.H[t].r||[],a.H[t].L=a.H[t].L||[],a.H[t].r=j(a.H[t].L),a.CP)for(var n=0;n<a.CP.length;n++)a.CP[n]=null}}function mi(a){return new Promise(function(r,e){var t,n,i;function s(){Nr(),gapi.load("gapi.iframes",{callback:function(){r(gapi.iframes.getContext())},ontimeout:function(){Nr(),e(O(a,"network-request-failed"))},timeout:gi.get()})}if(!((n=(t=N().gapi)===null||t===void 0?void 0:t.iframes)===null||n===void 0)&&n.Iframe)r(gapi.iframes.getContext());else if(!((i=N().gapi)===null||i===void 0)&&i.load)s();else{var u=ft("iframefcb");return N()[u]=function(){gapi.load?s():e(O(a,"network-request-failed"))},tn("https://apis.google.com/js/api.js?onload=".concat(u)).catch(function(o){return e(o)})}}).catch(function(r){throw ce=null,r})}var ce=null;function ki(a){return ce=ce||mi(a),ce}/**
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
 */var yi=new te(5e3,15e3),wi="__/auth/iframe",bi="emulator/auth/iframe",Ii={style:{position:"absolute",top:"-100px",width:"1px",height:"1px"},"aria-hidden":"true",tabindex:"-1"},Ti=new Map([["identitytoolkit.googleapis.com","p"],["staging-identitytoolkit.sandbox.googleapis.com","s"],["test-identitytoolkit.sandbox.googleapis.com","t"]]);function _i(a){var r=a.config;y(r.authDomain,a,"auth-domain-config-required");var e=r.emulator?ur(r,bi):"https://".concat(a.config.authDomain,"/").concat(wi),t={apiKey:r.apiKey,appName:a.name,v:ee},n=Ti.get(a.config.apiHost);n&&(t.eid=n);var i=a._getFrameworks();return i.length&&(t.fw=i.join(",")),"".concat(e,"?").concat(ne(t).slice(1))}function Ei(a){return rr.apply(this,arguments)}/**
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
 */function rr(){return rr=f(c().mark(function a(r){var e,t;return c().wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.next=2,ki(r);case 2:return e=i.sent,t=N().gapi,y(t,r,"internal-error"),i.abrupt("return",e.open({where:document.body,url:_i(r),messageHandlersFilter:t.iframes.CROSS_ORIGIN_IFRAMES_FILTER,attributes:Ii,dontclear:!0},function(s){return new Promise(function(){var u=f(c().mark(function o(l,h){var d,m,p;return c().wrap(function(v){for(;;)switch(v.prev=v.next){case 0:return p=function(){N().clearTimeout(m),l(s)},v.next=3,s.restyle({setHideOnLeave:!1});case 3:d=O(r,"network-request-failed"),m=N().setTimeout(function(){h(d)},yi.get()),s.ping(p).then(p,function(){h(d)});case 6:case"end":return v.stop()}},o)}));return function(o,l){return u.apply(this,arguments)}}())}));case 6:case"end":return i.stop()}},a)})),rr.apply(this,arguments)}var Ri={location:"yes",resizable:"yes",statusbar:"yes",toolbar:"no"},Pi=500,Ai=600,Si="_blank",Ci="http://localhost",Lr=function(){function a(r){I(this,a),this.window=r,this.associatedEvent=null}return b(a,[{key:"close",value:function(){if(this.window)try{this.window.close()}catch{}}}]),a}();function Oi(a,r,e){var t=arguments.length>3&&arguments[3]!==void 0?arguments[3]:Pi,n=arguments.length>4&&arguments[4]!==void 0?arguments[4]:Ai,i=Math.max((window.screen.availHeight-n)/2,0).toString(),s=Math.max((window.screen.availWidth-t)/2,0).toString(),u="",o=Object.assign(Object.assign({},Ri),{width:t.toString(),height:n.toString(),top:i,left:s}),l=S().toLowerCase();e&&(u=Xr(l)?Si:e),Yr(l)&&(r=r||Ci,o.scrollbars="yes");var h=Object.entries(o).reduce(function(m,p){var g=re(p,2),v=g[0],T=g[1];return"".concat(m).concat(v,"=").concat(T,",")},"");if(at(l)&&u!=="_self")return Ni(r||"",u),new Lr(null);var d=window.open(r||"",u,h);y(d,a,"popup-blocked");try{d.focus()}catch{}return new Lr(d)}function Ni(a,r){var e=document.createElement("a");e.href=a,e.target=r;var t=document.createEvent("MouseEvent");t.initMouseEvent("click",!0,!0,window,1,0,0,0,0,!1,!1,!1,!1,1,null),e.dispatchEvent(t)}/**
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
 */var Li="__/auth/handler",Ui="emulator/auth/handler",Mi=encodeURIComponent("fac");function Ur(a,r,e,t,n,i){return nr.apply(this,arguments)}function nr(){return nr=f(c().mark(function a(r,e,t,n,i,s){var u,o,l,h,d,m,p,g,v,T,_,A,w;return c().wrap(function(P){for(;;)switch(P.prev=P.next){case 0:if(y(r.config.authDomain,r,"auth-domain-config-required"),y(r.config.apiKey,r,"invalid-api-key"),u={apiKey:r.config.apiKey,appName:r.name,authType:t,redirectUrl:n,v:ee,eventId:i},e instanceof cr)for(e.setDefaultLanguage(r.languageCode),u.providerId=e.providerId||"",Un(e.getCustomParameters())||(u.customParameters=JSON.stringify(e.getCustomParameters())),o=0,l=Object.entries(s||{});o<l.length;o++)h=re(l[o],2),d=h[0],m=h[1],u[d]=m;for(e instanceof hr&&(p=e.getScopes().filter(function(C){return C!==""}),p.length>0&&(u.scopes=p.join(","))),r.tenantId&&(u.tid=r.tenantId),g=u,v=0,T=Object.keys(g);v<T.length;v++)_=T[v],g[_]===void 0&&delete g[_];return P.next=10,r._getAppCheckToken();case 10:return A=P.sent,w=A?"#".concat(Mi,"=").concat(encodeURIComponent(A)):"",P.abrupt("return","".concat(Di(r),"?").concat(ne(g).slice(1)).concat(w));case 13:case"end":return P.stop()}},a)})),nr.apply(this,arguments)}function Di(a){var r=a.config;return r.emulator?ur(r,Ui):"https://".concat(r.authDomain,"/").concat(Li)}/**
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
 */var ke="webStorageSupport",Fi=function(){function a(){I(this,a),this.eventManagers={},this.iframes={},this.originValidationPromises={},this._redirectPersistence=dn,this._completeRedirectFn=ui,this._overrideRedirectResult=ii}return b(a,[{key:"_openPopup",value:function(){var r=f(c().mark(function t(n,i,s,u){var o,l;return c().wrap(function(d){for(;;)switch(d.prev=d.next){case 0:return V((o=this.eventManagers[n._key()])===null||o===void 0?void 0:o.manager,"_initialize() not called before _openPopup()"),d.next=3,Ur(n,i,s,we(),u);case 3:return l=d.sent,d.abrupt("return",Oi(n,l,pr()));case 5:case"end":return d.stop()}},t,this)}));function e(t,n,i,s){return r.apply(this,arguments)}return e}()},{key:"_openRedirect",value:function(){var r=f(c().mark(function t(n,i,s,u){var o;return c().wrap(function(h){for(;;)switch(h.prev=h.next){case 0:return h.next=2,this._originValidation(n);case 2:return h.next=4,Ur(n,i,s,we(),u);case 4:return o=h.sent,Ht(o),h.abrupt("return",new Promise(function(){}));case 7:case"end":return h.stop()}},t,this)}));function e(t,n,i,s){return r.apply(this,arguments)}return e}()},{key:"_initialize",value:function(e){var t=this,n=e._key();if(this.eventManagers[n]){var i=this.eventManagers[n],s=i.manager,u=i.promise;return s?Promise.resolve(s):(V(u,"If manager is not set, promise should be"),u)}var o=this.initAndGetManager(e);return this.eventManagers[n]={promise:o},o.catch(function(){delete t.eventManagers[n]}),o}},{key:"initAndGetManager",value:function(){var r=f(c().mark(function t(n){var i,s;return c().wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.next=2,Ei(n);case 2:return i=o.sent,s=new li(n),i.register("authEvent",function(l){y(l==null?void 0:l.authEvent,n,"invalid-auth-event");var h=s.onEvent(l.authEvent);return{status:h?"ACK":"ERROR"}},gapi.iframes.CROSS_ORIGIN_IFRAMES_FILTER),this.eventManagers[n._key()]={manager:s},this.iframes[n._key()]=i,o.abrupt("return",s);case 8:case"end":return o.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"_isIframeWebStorageSupported",value:function(e,t){var n=this.iframes[e._key()];n.send(ke,{type:ke},function(i){var s,u=(s=i==null?void 0:i[0])===null||s===void 0?void 0:s[ke];u!==void 0&&t(!!u),L(e,"internal-error")},gapi.iframes.CROSS_ORIGIN_IFRAMES_FILTER)}},{key:"_originValidation",value:function(e){var t=e._key();return this.originValidationPromises[t]||(this.originValidationPromises[t]=fi(e)),this.originValidationPromises[t]}},{key:"_shouldInitProactively",get:function(){return rn()||lr()||fe()}}]),a}(),$i=Fi,Mr="@firebase/auth",Dr="1.5.1";/**
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
 */var Vi=function(){function a(r){I(this,a),this.auth=r,this.internalListeners=new Map}return b(a,[{key:"getUid",value:function(){var e;return this.assertAuthConfigured(),((e=this.auth.currentUser)===null||e===void 0?void 0:e.uid)||null}},{key:"getToken",value:function(){var r=f(c().mark(function t(n){var i;return c().wrap(function(u){for(;;)switch(u.prev=u.next){case 0:return this.assertAuthConfigured(),u.next=3,this.auth._initializationPromise;case 3:if(this.auth.currentUser){u.next=5;break}return u.abrupt("return",null);case 5:return u.next=7,this.auth.currentUser.getIdToken(n);case 7:return i=u.sent,u.abrupt("return",{accessToken:i});case 9:case"end":return u.stop()}},t,this)}));function e(t){return r.apply(this,arguments)}return e}()},{key:"addAuthTokenListener",value:function(e){if(this.assertAuthConfigured(),!this.internalListeners.has(e)){var t=this.auth.onIdTokenChanged(function(n){e((n==null?void 0:n.stsTokenManager.accessToken)||null)});this.internalListeners.set(e,t),this.updateProactiveRefresh()}}},{key:"removeAuthTokenListener",value:function(e){this.assertAuthConfigured();var t=this.internalListeners.get(e);t&&(this.internalListeners.delete(e),t(),this.updateProactiveRefresh())}},{key:"assertAuthConfigured",value:function(){y(this.auth._initializationPromise,"dependent-sdk-initialized-before-auth")}},{key:"updateProactiveRefresh",value:function(){this.internalListeners.size>0?this.auth._startProactiveRefresh():this.auth._stopProactiveRefresh()}}]),a}();/**
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
 */function Wi(a){switch(a){case"Node":return"node";case"ReactNative":return"rn";case"Worker":return"webworker";case"Cordova":return"cordova";default:return}}function Hi(a){vr(new gr("auth",function(r,e){var t=e.options,n=r.getProvider("app").getImmediate(),i=r.getProvider("heartbeat"),s=r.getProvider("app-check-internal"),u=n.options,o=u.apiKey,l=u.authDomain;y(o&&!o.includes(":"),"invalid-api-key",{appName:n.name});var h={apiKey:o,authDomain:l,clientPlatform:a,apiHost:"identitytoolkit.googleapis.com",tokenApiHost:"securetoken.googleapis.com",apiScheme:"https",sdkClientVersion:nn(a)},d=new dt(n,i,s,h);return bt(d,t),d},"PUBLIC").setInstantiationMode("EXPLICIT").setInstanceCreatedCallback(function(r,e,t){var n=r.getProvider("auth-internal");n.initialize()})),vr(new gr("auth-internal",function(r){var e=X(r.getProvider("auth").getImmediate());return function(t){return new Vi(t)}(e)},"PRIVATE").setInstantiationMode("EXPLICIT")),mr(Mr,Dr,Wi(a)),mr(Mr,Dr,"esm2017")}/**
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
 */var ji=5*60,Ki=$r("authIdTokenMaxAge")||ji,Fr=null,zi=function(r){return function(){var e=f(c().mark(function t(n){var i,s,u;return c().wrap(function(l){for(;;)switch(l.prev=l.next){case 0:if(l.t0=n,!l.t0){l.next=5;break}return l.next=4,n.getIdTokenResult();case 4:l.t0=l.sent;case 5:if(i=l.t0,s=i&&(new Date().getTime()-Date.parse(i.issuedAtTime))/1e3,!(s&&s>Ki)){l.next=9;break}return l.abrupt("return");case 9:if(u=i==null?void 0:i.token,Fr!==u){l.next=12;break}return l.abrupt("return");case 12:return Fr=u,l.next=15,fetch(r,{method:u?"POST":"DELETE",headers:u?{Authorization:"Bearer ".concat(u)}:{}});case 15:case"end":return l.stop()}},t)}));return function(t){return e.apply(this,arguments)}}()};function Yi(){var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:_n(),r=Vr(a,"auth");if(r.isInitialized())return r.getImmediate();var e=wt(a,{popupRedirectResolver:$i,persistence:[Xt,$t,dn]}),t=$r("authTokenSyncURL");if(t){var n=zi(t);Ut(e,n,function(){return n(e.currentUser)}),Lt(e,function(s){return n(s)})}var i=En("auth");return i&&It(e,"http://".concat(i)),e}Hi("Browser");export{un as G,Gi as O,Bi as a,Yi as g,Ji as s};
//# sourceMappingURL=index-dd468b12.js.map
