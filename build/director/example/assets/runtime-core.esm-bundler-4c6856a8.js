function C(t){if(a(t)){const n={};for(let e=0;e<t.length;e++){const i=t[e],s=f(i)?E(i):C(i);if(s)for(const c in s)n[c]=s[c]}return n}else{if(f(t))return t;if(g(t))return t}}const A=/;(?![^(]*\))/g,T=/:([^]+)/,V=/\/\*.*?\*\//gs;function E(t){const n={};return t.replace(V,"").split(A).forEach(e=>{if(e){const i=e.split(T);i.length>1&&(n[i[0].trim()]=i[1].trim())}}),n}function b(t){let n="";if(f(t))n=t;else if(a(t))for(let e=0;e<t.length;e++){const i=b(t[e]);i&&(n+=i+" ")}else if(g(t))for(const e in t)t[e]&&(n+=e+" ");return n.trim()}const lt=t=>f(t)?t:t==null?"":a(t)||g(t)&&(t.toString===O||!m(t.toString))?JSON.stringify(t,d,2):String(t),d=(t,n)=>n&&n.__v_isRef?d(t,n.value):W(n)?{[`Map(${n.size})`]:[...n.entries()].reduce((e,[i,s])=>(e[`${i} =>`]=s,e),{})}:$(n)?{[`Set(${n.size})`]:[...n.values()]}:g(n)&&!a(n)&&!H(n)?String(n):n,w=[],B=()=>!1,D=/^on[^a-z]/,P=t=>D.test(t),h=Object.assign,a=Array.isArray,W=t=>k(t)==="[object Map]",$=t=>k(t)==="[object Set]",m=t=>typeof t=="function",f=t=>typeof t=="string",g=t=>t!==null&&typeof t=="object",O=Object.prototype.toString,k=t=>O.call(t),H=t=>k(t)==="[object Object]";function R(t){return N(t)?R(t.__v_raw):!!(t&&t.__v_isReactive)}function N(t){return!!(t&&t.__v_isReadonly)}function j(t){return R(t)||N(t)}function K(t){return!!(t&&t.__v_isRef===!0)}let _=null,L=null;const Y=t=>t.__isSuspense;function ot(t){return m(t)?{setup:t,name:t.name}:t}const J=Symbol();function U(){return{app:null,config:{isNativeTag:B,performance:!1,globalProperties:{},optionMergeStrategies:{},errorHandler:void 0,warnHandler:void 0,compilerOptions:{}},mixins:[],components:{},directives:{},provides:Object.create(null),optionsCache:new WeakMap,propsCache:new WeakMap,emitsCache:new WeakMap}}const q=t=>t.__isTeleport,z=Symbol(void 0),G=Symbol(void 0),Q=Symbol(void 0),p=[];let u=null;function rt(t=!1){p.push(u=t?null:[])}function X(){p.pop(),u=p[p.length-1]||null}function Z(t){return t.dynamicChildren=u||w,X(),u&&u.push(t),t}function ut(t,n,e,i,s,c){return Z(x(t,n,e,i,s,c,!0))}function v(t){return t?t.__v_isVNode===!0:!1}const I="__vInternal",M=({key:t})=>t??null,S=({ref:t,ref_key:n,ref_for:e})=>t!=null?f(t)||K(t)||m(t)?{i:_,r:t,k:n,f:!!e}:t:null;function x(t,n=null,e=null,i=0,s=null,c=t===z?0:1,r=!1,l=!1){const o={__v_isVNode:!0,__v_skip:!0,type:t,props:n,key:n&&M(n),ref:n&&S(n),scopeId:L,slotScopeIds:null,children:e,component:null,suspense:null,ssContent:null,ssFallback:null,dirs:null,transition:null,el:null,anchor:null,target:null,targetAnchor:null,staticCount:0,shapeFlag:c,patchFlag:i,dynamicProps:s,dynamicChildren:null,appContext:null,ctx:_};return l?(F(o,e),c&128&&t.normalize(o)):e&&(o.shapeFlag|=f(e)?8:16),!r&&u&&(o.patchFlag>0||c&6)&&o.patchFlag!==32&&u.push(o),o}const tt=nt;function nt(t,n=null,e=null,i=0,s=null,c=!1){if((!t||t===J)&&(t=Q),v(t)){const l=y(t,n,!0);return e&&F(l,e),!c&&u&&(l.shapeFlag&6?u[u.indexOf(t)]=l:u.push(l)),l.patchFlag|=-2,l}if(ct(t)&&(t=t.__vccOpts),n){n=et(n);let{class:l,style:o}=n;l&&!f(l)&&(n.class=b(l)),g(o)&&(j(o)&&!a(o)&&(o=h({},o)),n.style=C(o))}const r=f(t)?1:Y(t)?128:q(t)?64:g(t)?4:m(t)?2:0;return x(t,n,e,i,s,r,c,!0)}function et(t){return t?j(t)||I in t?h({},t):t:null}function y(t,n,e=!1){const{props:i,ref:s,patchFlag:c,children:r}=t,l=n?it(i||{},n):i;return{__v_isVNode:!0,__v_skip:!0,type:t.type,props:l,key:l&&M(l),ref:n&&n.ref?e&&s?a(s)?s.concat(S(n)):[s,S(n)]:S(n):s,scopeId:t.scopeId,slotScopeIds:t.slotScopeIds,children:r,target:t.target,targetAnchor:t.targetAnchor,staticCount:t.staticCount,shapeFlag:t.shapeFlag,patchFlag:n&&t.type!==z?c===-1?16:c|16:c,dynamicProps:t.dynamicProps,dynamicChildren:t.dynamicChildren,appContext:t.appContext,dirs:t.dirs,transition:t.transition,component:t.component,suspense:t.suspense,ssContent:t.ssContent&&y(t.ssContent),ssFallback:t.ssFallback&&y(t.ssFallback),el:t.el,anchor:t.anchor,ctx:t.ctx,ce:t.ce}}function st(t=" ",n=0){return tt(G,null,t,n)}function F(t,n){let e=0;const{shapeFlag:i}=t;if(n==null)n=null;else if(a(n))e=16;else if(typeof n=="object")if(i&65){const s=n.default;s&&(s._c&&(s._d=!1),F(t,s()),s._c&&(s._d=!0));return}else{e=32;const s=n._;!s&&!(I in n)?n._ctx=_:s===3&&_&&(_.slots._===1?n._=1:(n._=2,t.patchFlag|=1024))}else m(n)?(n={default:n,_ctx:_},e=32):(n=String(n),i&64?(e=16,n=[st(n)]):e=8);t.children=n,t.shapeFlag|=e}function it(...t){const n={};for(let e=0;e<t.length;e++){const i=t[e];for(const s in i)if(s==="class")n.class!==i.class&&(n.class=b([n.class,i.class]));else if(s==="style")n.style=C([n.style,i.style]);else if(P(s)){const c=n[s],r=i[s];r&&c!==r&&!(a(c)&&c.includes(r))&&(n[s]=c?[].concat(c,r):r)}else s!==""&&(n[s]=i[s])}return n}U();function ct(t){return m(t)&&"__vccOpts"in t}export{st as a,x as b,ut as c,ot as d,rt as o,lt as t};
