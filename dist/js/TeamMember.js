import{Z as g,r as x,a1 as b,u as d,j as r,Y as j}from"./index.js";import{E as v}from"./ErrorComponent.js";import{M as E,a as L,b as M}from"./MemberIntroductionComponent.js";import{u as R}from"./useDispatch.js";function P(){var s=g(),a=s.teammember,t=R();x.useEffect(function(){t(b(a))},[t,a]);var e=d(function(p){return p.team}),o=e.teamLoading,m=e.teamError,n=e.title,i=e.avatarURL,u=e.fullName,l=e.greeting,f=e.skills,c=e.teamResume;return o?r.jsx(j,{}):m?r.jsx(v,{error:m}):r.jsxs("section",{className:"team-member",children:[r.jsx(E,{resume:c}),r.jsx("main",{class:"founder",children:r.jsx(L,{title:n,avatarURL:i,fullName:u,greeting:l})}),r.jsx(M,{skills:f})]})}export{P as default};
//# sourceMappingURL=TeamMember.js.map
