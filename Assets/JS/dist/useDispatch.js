import{R as e,p as u,q as c}from"./main.js";function r(t=e){const o=t===e?u:c(t);return function(){const{store:s}=o();return s}}const a=r();function i(t=e){const o=t===e?a:r(t);return function(){return o().dispatch}}const x=i();export{x as u};
//# sourceMappingURL=useDispatch.js.map
