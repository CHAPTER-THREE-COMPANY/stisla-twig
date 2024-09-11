/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@webcomponents/shadycss@1.11.2/entrypoints/apply-shim.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
const t=!(window.ShadyDOM&&window.ShadyDOM.inUse);let e,s;function n(s){e=(!s||!s.shimcssproperties)&&(t||Boolean(!navigator.userAgent.match(/AppleWebKit\/601|Edge\/15/)&&window.CSS&&CSS.supports&&CSS.supports("box-shadow","0 0 0 var(--foo)")))}window.ShadyCSS&&void 0!==window.ShadyCSS.cssBuild&&(s=window.ShadyCSS.cssBuild);const r=Boolean(window.ShadyCSS&&window.ShadyCSS.disableRuntime);window.ShadyCSS&&void 0!==window.ShadyCSS.nativeCss?e=window.ShadyCSS.nativeCss:window.ShadyCSS?(n(window.ShadyCSS),window.ShadyCSS=void 0):n(window.WebComponents&&window.WebComponents.flags);const o=e;
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/class l{constructor(){this.start=0,this.end=0,this.previous=null,this.parent=null,this.rules=null,this.parsedCssText="",this.cssText="",this.atRule=!1,this.type=0,this.keyframesName="",this.selector="",this.parsedSelector=""}}function i(t){return a(function(t){let e=new l;e.start=0,e.end=t.length;let s=e;for(let n=0,r=t.length;n<r;n++)if(t[n]===p){s.rules||(s.rules=[]);let t=s,e=t.rules[t.rules.length-1]||null;s=new l,s.start=n+1,s.parent=t,s.previous=e,t.rules.push(s)}else t[n]===m&&(s.end=n+1,s=s.parent||e);return e}(t=t.replace(d.comments,"").replace(d.port,"")),t)}function a(t,e){let s=e.substring(t.start,t.end-1);if(t.parsedCssText=t.cssText=s.trim(),t.parent){let n=t.previous?t.previous.end:t.parent.start;s=e.substring(n,t.start-1),s=function(t){return t.replace(/\\([0-9a-f]{1,6})\s/gi,(function(){let t=arguments[1],e=6-t.length;for(;e--;)t="0"+t;return"\\"+t}))}(s),s=s.replace(d.multipleSpaces," "),s=s.substring(s.lastIndexOf(";")+1);let r=t.parsedSelector=t.selector=s.trim();t.atRule=0===r.indexOf(S),t.atRule?0===r.indexOf(y)?t.type=c.MEDIA_RULE:r.match(d.keyframesRule)&&(t.type=c.KEYFRAMES_RULE,t.keyframesName=t.selector.split(d.multipleSpaces).pop()):0===r.indexOf(h)?t.type=c.MIXIN_RULE:t.type=c.STYLE_RULE}let n=t.rules;if(n)for(let t,s=0,r=n.length;s<r&&(t=n[s]);s++)a(t,e);return t}function u(t,e,s=""){let n="";if(t.cssText||t.rules){let s=t.rules;if(s&&!function(t){let e=t[0];return Boolean(e)&&Boolean(e.selector)&&0===e.selector.indexOf(h)}(s))for(let t,r=0,o=s.length;r<o&&(t=s[r]);r++)n=u(t,e,n);else n=e?t.cssText:function(t){return t=function(t){return t.replace(d.customProp,"").replace(d.mixinProp,"")}(t),function(t){return t.replace(d.mixinApply,"").replace(d.varApply,"")}(t)}(t.cssText),n=n.trim(),n&&(n="  "+n+"\n")}return n&&(t.selector&&(s+=t.selector+" "+p+"\n"),s+=n,t.selector&&(s+=m+"\n\n")),s}const c={STYLE_RULE:1,KEYFRAMES_RULE:7,MEDIA_RULE:4,MIXIN_RULE:1e3},p="{",m="}",d={comments:/\/\*[^*]*\*+([^/*][^*]*\*+)*\//gim,port:/@import[^;]*;/gim,customProp:/(?:^[^;\-\s}]+)?--[^;{}]*?:[^{};]*?(?:[;\n]|$)/gim,mixinProp:/(?:^[^;\-\s}]+)?--[^;{}]*?:[^{};]*?{[^}]*?}(?:[;\n]|$)?/gim,mixinApply:/@apply\s*\(?[^);]*\)?\s*(?:[;\n]|$)?/gim,varApply:/[^;:]*?:[^;]*?var\([^;]*\)(?:[;\n]|$)?/gim,keyframesRule:/^@[^\s]*keyframes/,multipleSpaces:/\s+/g},h="--",y="@media",S="@",f=/(?:^|[;\s{]\s*)(--[\w-]*?)\s*:\s*(?:((?:'(?:\\'|.)*?'|"(?:\\"|.)*?"|\([^)]*?\)|[^};{])+)|\{([^}]*)\}(?:(?=[;\s}])|$))/gi,C=/(?:^|\W+)@apply\s*\(?([^);\n]*)\)?/gi,_=/@media\s(.*)/,w=new Set,g="shady-unscoped";function x(t){const e=t.textContent;if(!w.has(e)){w.add(e);const t=document.createElement("style");t.setAttribute("shady-unscoped",""),t.textContent=e,document.head.appendChild(t)}}function E(t){return t.hasAttribute(g)}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/function b(t,e){return t?("string"==typeof t&&(t=i(t)),e&&v(t,e),u(t,o)):""}function R(t){return!t.__cssRules&&t.textContent&&(t.__cssRules=i(t.textContent)),t.__cssRules||null}function v(t,e,s,n){if(!t)return;let r=!1,o=t.type;if(n&&o===c.MEDIA_RULE){let e=t.selector.match(_);e&&(window.matchMedia(e[1]).matches||(r=!0))}o===c.STYLE_RULE?e(t):s&&o===c.KEYFRAMES_RULE?s(t):o===c.MIXIN_RULE&&(r=!0);let l=t.rules;if(l&&!r)for(let t,r=0,o=l.length;r<o&&(t=l[r]);r++)v(t,e,s,n)}function T(t,e){let s=t.indexOf("var(");if(-1===s)return e(t,"","","");let n=function(t,e){let s=0;for(let n=e,r=t.length;n<r;n++)if("("===t[n])s++;else if(")"===t[n]&&0==--s)return n;return-1}(t,s+3),r=t.substring(s+4,n),o=t.substring(0,s),l=T(t.substring(n+1),e),i=r.indexOf(",");return-1===i?e(o,r.trim(),"",l):e(o,r.substring(0,i).trim(),r.substring(i+1).trim(),l)}window.ShadyDOM&&window.ShadyDOM.wrap;const I="css-build";function A(t){if(void 0!==s)return s;if(void 0===t.__cssBuild){const e=t.getAttribute(I);if(e)t.__cssBuild=e;else{const e=function(t){const e="template"===t.localName?t.content.firstChild:t.firstChild;if(e instanceof Comment){const t=e.textContent.trim().split(":");if(t[0]===I)return t[1]}return""}(t);""!==e&&function(t){const e="template"===t.localName?t.content.firstChild:t.firstChild;e.parentNode.removeChild(e)}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/(t),t.__cssBuild=e}}return t.__cssBuild||""}function M(t){return""!==A(t)}const P=/;\s*/m,O=/^\s*(initial)|(inherit)\s*$/,L=/\s*!important/,$="_-_";class D{constructor(){this._map={}}set(t,e){t=t.trim(),this._map[t]={properties:e,dependants:{}}}get(t){return t=t.trim(),this._map[t]||null}}let F=null;class N{constructor(){this._currentElement=null,this._measureElement=null,this._map=new D}detectMixin(t){return function(t){const e=C.test(t)||f.test(t);return C.lastIndex=0,f.lastIndex=0,e}(t)}gatherStyles(e){const s=function(e){const s=[],n=e.querySelectorAll("style");for(let e=0;e<n.length;e++){const r=n[e];E(r)?t||(x(r),r.parentNode.removeChild(r)):(s.push(r.textContent),r.parentNode.removeChild(r))}return s.join("").trim()}(e.content);if(s){const t=document.createElement("style");return t.textContent=s,e.content.insertBefore(t,e.content.firstChild),t}return null}transformTemplate(t,e){void 0===t._gatheredStyle&&(t._gatheredStyle=this.gatherStyles(t));const s=t._gatheredStyle;return s?this.transformStyle(s,e):null}transformStyle(t,e=""){let s=R(t);return this.transformRules(s,e),t.textContent=b(s),s}transformCustomStyle(t){let e=R(t);return v(e,(t=>{":root"===t.selector&&(t.selector="html"),this.transformRule(t)})),t.textContent=b(e),e}transformRules(t,e){this._currentElement=e,v(t,(t=>{this.transformRule(t)})),this._currentElement=null}transformRule(t){t.cssText=this.transformCssText(t.parsedCssText,t),":root"===t.selector&&(t.selector=":host > *")}transformCssText(t,e){return t=t.replace(f,((t,s,n,r)=>this._produceCssProperties(t,s,n,r,e))),this._consumeCssProperties(t,e)}_getInitialValueForProperty(t){return this._measureElement||(this._measureElement=document.createElement("meta"),this._measureElement.setAttribute("apply-shim-measure",""),this._measureElement.style.all="initial",document.head.appendChild(this._measureElement)),window.getComputedStyle(this._measureElement).getPropertyValue(t)}_fallbacksFromPreviousRules(t){let e=t;for(;e.parent;)e=e.parent;const s={};let n=!1;return v(e,(e=>{n=n||e===t,n||e.selector===t.selector&&Object.assign(s,this._cssTextToMap(e.parsedCssText))})),s}_consumeCssProperties(t,e){let s=null;for(;s=C.exec(t);){let n=s[0],r=s[1],o=s.index,l=o+n.indexOf("@apply"),i=o+n.length,a=t.slice(0,l),u=t.slice(i),c=e?this._fallbacksFromPreviousRules(e):{};Object.assign(c,this._cssTextToMap(a));let p=this._atApplyToCssProperties(r,c);t=`${a}${p}${u}`,C.lastIndex=o+p.length}return t}_atApplyToCssProperties(t,e){t=t.replace(P,"");let s=[],n=this._map.get(t);if(n||(this._map.set(t,{}),n=this._map.get(t)),n){let r,o,l;this._currentElement&&(n.dependants[this._currentElement]=!0);const i=n.properties;for(r in i)l=e&&e[r],o=[r,": var(",t,$,r],l&&o.push(",",l.replace(L,"")),o.push(")"),L.test(i[r])&&o.push(" !important"),s.push(o.join(""))}return s.join("; ")}_replaceInitialOrInherit(t,e){let s=O.exec(e);return s&&(e=s[1]?this._getInitialValueForProperty(t):"apply-shim-inherit"),e}_cssTextToMap(t,e=!1){let s,n,r=t.split(";"),o={};for(let t,l,i=0;i<r.length;i++)t=r[i],t&&(l=t.split(":"),l.length>1&&(s=l[0].trim(),n=l.slice(1).join(":"),e&&(n=this._replaceInitialOrInherit(s,n)),o[s]=n));return o}_invalidateMixinEntry(t){if(F)for(let e in t.dependants)e!==this._currentElement&&F(e)}_produceCssProperties(t,e,s,n,r){if(s&&T(s,((t,e)=>{e&&this._map.get(e)&&(n=`@apply ${e};`)})),!n)return t;let o=this._consumeCssProperties(""+n,r),l=t.slice(0,t.indexOf("--")),i=this._cssTextToMap(o,!0),a=i,u=this._map.get(e),c=u&&u.properties;c?a=Object.assign(Object.create(c),i):this._map.set(e,a);let p,m,d=[],h=!1;for(p in a)m=i[p],void 0===m&&(m="initial"),c&&!(p in c)&&(h=!0),d.push(`${e}${$}${p}: ${m}`);return h&&this._invalidateMixinEntry(u),u&&(u.properties=a),s&&(l=`${t};${l}`),`${l}${d.join("; ")};`}}N.prototype.detectMixin=N.prototype.detectMixin,N.prototype.transformStyle=N.prototype.transformStyle,N.prototype.transformCustomStyle=N.prototype.transformCustomStyle,N.prototype.transformRules=N.prototype.transformRules,N.prototype.transformRule=N.prototype.transformRule,N.prototype.transformTemplate=N.prototype.transformTemplate,N.prototype._separator=$,Object.defineProperty(N.prototype,"invalidCallback",{get:()=>F,set(t){F=t}});
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
const k={},q="_applyShimCurrentVersion",B="_applyShimNextVersion",U="_applyShimValidatingVersion",V=Promise.resolve();
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/function j(t){let e=k[t];e&&function(t){t[q]=t[q]||0,t[U]=t[U]||0,t[B]=(t[B]||0)+1}(e)}function Y(t){return t[q]===t[B]}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
let K,W=null,X=window.HTMLImports&&window.HTMLImports.whenReady||null;function H(t){requestAnimationFrame((function(){X?X(t):(W||(W=new Promise((t=>{K=t})),"complete"===document.readyState?K():document.addEventListener("readystatechange",(()=>{"complete"===document.readyState&&K()}))),W.then((function(){t&&t()})))}))}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/const z="__seenByShadyCSS",G="__shadyCSSCachedStyle";let J=null,Q=null;class Z{constructor(){this.customStyles=[],this.enqueued=!1,H((()=>{window.ShadyCSS.flushCustomStyles&&window.ShadyCSS.flushCustomStyles()}))}enqueueDocumentValidation(){!this.enqueued&&Q&&(this.enqueued=!0,H(Q))}addCustomStyle(t){t[z]||(t[z]=!0,this.customStyles.push(t),this.enqueueDocumentValidation())}getStyleForCustomStyle(t){if(t[G])return t[G];let e;return e=t.getStyle?t.getStyle():t,e}processStyles(){const t=this.customStyles;for(let e=0;e<t.length;e++){const s=t[e];if(s[G])continue;const n=this.getStyleForCustomStyle(s);if(n){const t=n.__appliedElement||n;J&&J(t),s[G]=t}}return t}}Z.prototype.addCustomStyle=Z.prototype.addCustomStyle,Z.prototype.getStyleForCustomStyle=Z.prototype.getStyleForCustomStyle,Z.prototype.processStyles=Z.prototype.processStyles,Object.defineProperties(Z.prototype,{transformCallback:{get:()=>J,set(t){J=t}},validateCallback:{get:()=>Q,set(t){let e=!1;Q||(e=!0),Q=t,e&&this.enqueueDocumentValidation()}}});
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
const tt=new N;class et{constructor(){this.customStyleInterface=null,tt.invalidCallback=j}ensure(){this.customStyleInterface||window.ShadyCSS.CustomStyleInterface&&(this.customStyleInterface=window.ShadyCSS.CustomStyleInterface,this.customStyleInterface.transformCallback=t=>{tt.transformCustomStyle(t)},this.customStyleInterface.validateCallback=()=>{requestAnimationFrame((()=>{this.customStyleInterface.enqueued&&this.flushCustomStyles()}))})}prepareTemplate(t,e){if(this.ensure(),M(t))return;k[e]=t;let s=tt.transformTemplate(t,e);t._styleAst=s}flushCustomStyles(){if(this.ensure(),!this.customStyleInterface)return;let t=this.customStyleInterface.processStyles();if(this.customStyleInterface.enqueued){for(let e=0;e<t.length;e++){let s=t[e],n=this.customStyleInterface.getStyleForCustomStyle(s);n&&tt.transformCustomStyle(n)}this.customStyleInterface.enqueued=!1}}styleSubtree(t,e){if(this.ensure(),e&&function(t,e){for(let s in e)null===s?t.style.removeProperty(s):t.style.setProperty(s,e[s])}(t,e),t.shadowRoot){this.styleElement(t);let e=t.shadowRoot.children||t.shadowRoot.childNodes;for(let t=0;t<e.length;t++)this.styleSubtree(e[t])}else{let e=t.children||t.childNodes;for(let t=0;t<e.length;t++)this.styleSubtree(e[t])}}styleElement(t){this.ensure();let{is:e}=function(t){let e=t.localName,s="",n="";return e?e.indexOf("-")>-1?s=e:(n=e,s=t.getAttribute&&t.getAttribute("is")||""):(s=t.is,n=t.extends),{is:s,typeExtension:n}}(t),s=k[e];if((!s||!M(s))&&s&&!Y(s)){(function(t){return!Y(t)&&t[U]===t[B]})(s)||(this.prepareTemplate(s,e),function(t){t[U]=t[B],t._validating||(t._validating=!0,V.then((function(){t[q]=t[B],t._validating=!1})))}(s));let n=t.shadowRoot;if(n){let t=n.querySelector("style");t&&(t.__cssRules=s._styleAst,t.textContent=b(s._styleAst))}}}styleDocument(t){this.ensure(),this.styleSubtree(document.body,t)}}if(!window.ShadyCSS||!window.ShadyCSS.ScopingShim){const e=new et;let n=window.ShadyCSS&&window.ShadyCSS.CustomStyleInterface;window.ShadyCSS={prepareTemplate(t,s,n){e.flushCustomStyles(),e.prepareTemplate(t,s)},prepareTemplateStyles(t,e,s){window.ShadyCSS.prepareTemplate(t,e,s)},prepareTemplateDom(t,e){},styleSubtree(t,s){e.flushCustomStyles(),e.styleSubtree(t,s)},styleElement(t){e.flushCustomStyles(),e.styleElement(t)},styleDocument(t){e.flushCustomStyles(),e.styleDocument(t)},getComputedStyleValue:(t,e)=>function(t,e){const s=window.getComputedStyle(t).getPropertyValue(e);return s?s.trim():""}(t,e),flushCustomStyles(){e.flushCustomStyles()},nativeCss:o,nativeShadow:t,cssBuild:s,disableRuntime:r},n&&(window.ShadyCSS.CustomStyleInterface=n)}window.ShadyCSS.ApplyShim=tt;
