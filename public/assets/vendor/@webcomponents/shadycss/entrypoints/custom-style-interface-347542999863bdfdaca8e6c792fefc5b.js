/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@webcomponents/shadycss@1.11.2/entrypoints/custom-style-interface.js
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
let e,t=null,o=window.HTMLImports&&window.HTMLImports.whenReady||null;function s(s){requestAnimationFrame((function(){o?o(s):(t||(t=new Promise((t=>{e=t})),"complete"===document.readyState?e():document.addEventListener("readystatechange",(()=>{"complete"===document.readyState&&e()}))),t.then((function(){s&&s()})))}))}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/const n="__seenByShadyCSS",S="__shadyCSSCachedStyle";let d=null,l=null;class i{constructor(){this.customStyles=[],this.enqueued=!1,s((()=>{window.ShadyCSS.flushCustomStyles&&window.ShadyCSS.flushCustomStyles()}))}enqueueDocumentValidation(){!this.enqueued&&l&&(this.enqueued=!0,s(l))}addCustomStyle(e){e[n]||(e[n]=!0,this.customStyles.push(e),this.enqueueDocumentValidation())}getStyleForCustomStyle(e){if(e[S])return e[S];let t;return t=e.getStyle?e.getStyle():e,t}processStyles(){const e=this.customStyles;for(let t=0;t<e.length;t++){const o=e[t];if(o[S])continue;const s=this.getStyleForCustomStyle(o);if(s){const e=s.__appliedElement||s;d&&d(e),o[S]=e}}return e}}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
function a(e,t){for(let o in t)null===o?e.style.removeProperty(o):e.style.setProperty(o,t[o])}i.prototype.addCustomStyle=i.prototype.addCustomStyle,i.prototype.getStyleForCustomStyle=i.prototype.getStyleForCustomStyle,i.prototype.processStyles=i.prototype.processStyles,Object.defineProperties(i.prototype,{transformCallback:{get:()=>d,set(e){d=e}},validateCallback:{get:()=>l,set(e){let t=!1;l||(t=!0),l=e,t&&this.enqueueDocumentValidation()}}});
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
const y=!(window.ShadyDOM&&window.ShadyDOM.inUse);let u,r;function w(e){u=(!e||!e.shimcssproperties)&&(y||Boolean(!navigator.userAgent.match(/AppleWebKit\/601|Edge\/15/)&&window.CSS&&CSS.supports&&CSS.supports("box-shadow","0 0 0 var(--foo)")))}window.ShadyCSS&&void 0!==window.ShadyCSS.cssBuild&&(r=window.ShadyCSS.cssBuild);const p=Boolean(window.ShadyCSS&&window.ShadyCSS.disableRuntime);window.ShadyCSS&&void 0!==window.ShadyCSS.nativeCss?u=window.ShadyCSS.nativeCss:window.ShadyCSS?(w(window.ShadyCSS),window.ShadyCSS=void 0):w(window.WebComponents&&window.WebComponents.flags);const c=u,m=new i;
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/window.ShadyCSS||(window.ShadyCSS={prepareTemplate(e,t,o){},prepareTemplateDom(e,t){},prepareTemplateStyles(e,t,o){},styleSubtree(e,t){m.processStyles(),a(e,t)},styleElement(e){m.processStyles()},styleDocument(e){m.processStyles(),a(document.body,e)},getComputedStyleValue:(e,t)=>function(e,t){const o=window.getComputedStyle(e).getPropertyValue(t);return o?o.trim():""}(e,t),flushCustomStyles(){},nativeCss:c,nativeShadow:y,cssBuild:r,disableRuntime:p}),window.ShadyCSS.CustomStyleInterface=m;
