import{j as r,q as x,r as p,t as j,u as k,L as h}from"./index.js";import{E as v}from"./ErrorComponent.js";import{M as _,a as L,b as N}from"./MemberIntroductionComponent.js";import{u as C}from"./useDispatch.js";function E(s){var n=s.social_networks;return console.log(n),r.jsx(r.Fragment,{children:Array.isArray(n)&&n.length>0?r.jsx("div",{className:"social-networks",children:n.map(function(o,e){return r.jsx("a",{href:"".concat(o.link),target:"_blank",children:r.jsx("i",{className:"fa-brands fa-".concat(o.icon.toLowerCase())},e)})})}):null})}function R(){var s=x(),n=s.founder,o=C();p.useEffect(function(){o(j(n))},[o,n]);var e=k(function(g){return g.founder}),t=e.founderLoading,a=e.founderError,i=e.title,l=e.avatarURL,u=e.fullName,m=e.greeting,c=e.skills,f=e.founder_resume,d=e.social_networks;return t?r.jsx(h,{}):a?r.jsx(v,{error:a}):r.jsx(r.Fragment,{children:r.jsxs("section",{className:"founder",children:[r.jsx(_,{resume:f}),r.jsx("main",{className:"founder",children:r.jsx(L,{title:i,avatarURL:l,fullName:u,greeting:m})}),r.jsx(N,{skills:c}),r.jsx(E,{social_networks:d})]})})}export{R as default};
//# sourceMappingURL=Founder.js.map
