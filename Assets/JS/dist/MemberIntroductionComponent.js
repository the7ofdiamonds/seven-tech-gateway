import{j as t,r as c}from"./main.js";function f(l){const{resume:o}=l,s=document.getElementById("portfolio"),e=i=>{const r=document.getElementById(i);if(r){const a=r.getBoundingClientRect().top+window.scrollY,d=137.5,h=parseFloat(getComputedStyle(document.documentElement).fontSize),u=d/16*h,m=a-u;window.scrollTo({top:m,behavior:"smooth"})}},n=()=>{window.open("resume","_blank")};return t.jsxs("nav",{class:"author-nav",children:[s?t.jsxs(t.Fragment,{children:[t.jsx("button",{onClick:e("intro"),id:"founder_button",children:t.jsx("h3",{className:"title",children:"intro"})}),t.jsx("button",{onClick:e("7tech_portfolio"),id:"portfolio_button",children:t.jsx("h3",{className:"title",children:"PORTFOLIO"})})]}):"",o?t.jsx("button",{onClick:n,children:t.jsx("h3",{className:"title",children:"RÉSUMÉ"})}):""]})}function j(l){const{skills:o}=l,s=c.useRef(null);return c.useEffect(()=>{const e=s.current;if(e){const n=e.children.length;for(let i=0;i<n;i++)e.appendChild(e.children[i].cloneNode(!0));document.documentElement.style.setProperty("--total-skills",n)}},[o]),t.jsx(t.Fragment,{children:Array.isArray(o)&&o.length>0?t.jsx("div",{className:"author-skills",children:t.jsx("div",{className:"author-skills-slide",ref:s,children:o.map((e,n)=>t.jsx("i",{className:`fa-brands fa-${e.toLowerCase()}`},n))})}):null})}function g(l){const{title:o,avatarURL:s,fullName:e,greeting:n}=l;return t.jsxs("div",{class:"author-intro",children:[t.jsxs("div",{class:"author",children:[t.jsx("h2",{class:"title",children:o}),t.jsx("div",{class:"author-card card",children:t.jsx("div",{class:"author-pic",children:t.jsx("img",{src:s,alt:""})})}),t.jsx("h4",{class:"title",children:e})]}),t.jsx("div",{class:"author-card card",children:t.jsx("p",{class:"author-greeting",children:n})})]})}export{f as M,g as a,j as b};
//# sourceMappingURL=MemberIntroductionComponent.js.map
