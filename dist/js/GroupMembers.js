import{j as a,$ as c}from"./index.js";function n(i){var l=i.group;return a.jsx(a.Fragment,{children:(l==null?void 0:l.length)>0&&l.map(function(s){return a.jsx("div",{className:"group",children:s&&c(s)==="object"?a.jsxs("div",{className:"author-card card",children:[a.jsx("div",{className:"author-pic",children:a.jsx("a",{href:s.author_url,children:a.jsx("img",{src:s.avatar_url,alt:""})})}),a.jsx("div",{className:"author-name",children:a.jsxs("h4",{className:"title",children:[s.first_name," ",s.last_name]})}),a.jsx("div",{className:"author-role",children:a.jsx("h5",{children:s.role})}),a.jsx("div",{className:"author-contact",children:a.jsx("a",{href:"mailto:".concat(s.email),children:a.jsx("i",{className:"fa fa-envelope fa-fw"})})})]}):""},s.id)})})}export{n as G};
//# sourceMappingURL=GroupMembers.js.map
