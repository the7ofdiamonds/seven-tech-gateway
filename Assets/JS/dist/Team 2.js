import{u as n,r as i,t as u,j as r,L as c}from"./index.js";import{E as p}from"./ErrorComponent.js";import{G as f}from"./GroupMembers.js";import{u as x}from"./useDispatch.js";function g(){var e=n(function(m){return m.team}),s=e.teamLoading,t=e.teamError,o=e.team,a=x();return i.useEffect(function(){a(u())},[a]),s?r.jsx(c,{}):t?r.jsx(p,{error:t}):r.jsx(r.Fragment,{children:r.jsxs("section",{className:"team",children:[r.jsx("h4",{className:"title",children:"Team"}),r.jsx(f,{group:o})]})})}export{g as default};
//# sourceMappingURL=Team.js.map
