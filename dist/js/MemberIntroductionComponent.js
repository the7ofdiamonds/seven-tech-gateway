import{j as e,r as i}from"./index.js";function j(n){var r=n.resume,s=document.getElementById("portfolio");console.log(r);var t=function(c){var a=document.getElementById(c);if(a){var d=a.getBoundingClientRect().top+window.scrollY,u=137.5,h=parseFloat(getComputedStyle(document.documentElement).fontSize),m=u/16,v=m*h,f=d-v;window.scrollTo({top:f,behavior:"smooth"})}},l=function(){window.open("resume","_blank")};return e.jsxs("nav",{class:"author-nav",children:[s?e.jsxs(e.Fragment,{children:[e.jsx("button",{onClick:t("intro"),id:"founder_button",children:e.jsx("h3",{className:"title",children:"intro"})}),e.jsx("button",{onClick:t("7tech_portfolio"),id:"portfolio_button",children:e.jsx("h3",{className:"title",children:"PORTFOLIO"})})]}):"",r?e.jsx("button",{onClick:l,children:e.jsx("h3",{className:"title",children:"RÉSUMÉ"})}):""]})}function g(n){var r=n.skills,s=i.useRef(null);return i.useEffect(function(){var t=s.current;if(t){for(var l=t.children.length,o=0;o<l;o++)t.appendChild(t.children[o].cloneNode(!0));document.documentElement.style.setProperty("--total-skills",l)}},[r]),e.jsx(e.Fragment,{children:Array.isArray(r)&&r.length>0?e.jsx("div",{className:"author-skills",children:e.jsx("div",{className:"author-skills-slide",ref:s,children:r.map(function(t,l){return e.jsx("i",{className:"fa-brands fa-".concat(t.slug.toLowerCase())},l)})})}):null})}function p(n){var r=n.title,s=n.avatarURL,t=n.fullName,l=n.greeting;return e.jsxs("div",{class:"author-intro",children:[e.jsxs("div",{class:"author",children:[e.jsx("h2",{class:"title",children:r}),e.jsx("div",{class:"author-card card",children:e.jsx("div",{class:"author-pic",children:e.jsx("img",{src:s,alt:""})})}),e.jsx("h4",{class:"title",children:t})]}),e.jsx("div",{class:"author-card card",children:e.jsx("p",{class:"author-greeting",children:l})})]})}export{j as M,p as a,g as b};
//# sourceMappingURL=MemberIntroductionComponent.js.map