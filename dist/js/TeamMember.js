import{a2 as g,K as x,a5 as b,J as d,j as a,a1 as j}from"./index.js";import{E as v}from"./ErrorComponent.js";import{M as E,a as L,b as M}from"./MemberIntroductionComponent.js";import{u as R}from"./useDispatch.js";function P(){var s=g(),r=s.teammember,t=R();x.useEffect(function(){t(b(r))},[t,r]);var e=d(function(p){return p.team}),o=e.teamLoading,m=e.teamError,n=e.title,i=e.avatarURL,l=e.fullName,u=e.greeting,f=e.skills,c=e.teamResume;return o?a.jsx(j,{}):m?a.jsx(v,{error:m}):a.jsxs("section",{className:"team-member",children:[a.jsx(E,{resume:c}),a.jsx("main",{class:"founder",children:a.jsx(L,{title:n,avatarURL:i,fullName:l,greeting:u})}),a.jsx(M,{skills:f})]})}export{P as default};
//# sourceMappingURL=TeamMember.js.map
