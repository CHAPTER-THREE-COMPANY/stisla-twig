/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@polymer/polymer@3.5.1/lib/utils/html-tag.js
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
window.JSCompiler_renameProperty=function(e,t){return e};
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
const e=window.trustedTypes&&trustedTypes.createPolicy("polymer-html-literal",{createHTML:e=>e});class t{constructor(e,t){o(e,t);const n=t.reduce(((t,n,o)=>t+r(n)+e[o+1]),e[0]);this.value=n.toString()}toString(){return this.value}}function r(e){if(e instanceof t)return e.value;throw new Error(`non-literal value passed to Polymer's htmlLiteral function: ${e}`)}const n=function(n,...l){o(n,l);const a=document.createElement("template");let i=l.reduce(((e,o,l)=>e+function(e){if(e instanceof HTMLTemplateElement)return e.innerHTML;if(e instanceof t)return r(e);throw new Error(`non-template value passed to Polymer's html function: ${e}`)}(o)+n[l+1]),n[0]);return e&&(i=e.createHTML(i)),a.innerHTML=i,a},o=(e,t)=>{if(!Array.isArray(e)||!Array.isArray(e.raw)||t.length!==e.length-1)throw new TypeError("Invalid call to the html template tag")},l=function(e,...r){return new t(e,r)};export{n as html,l as htmlLiteral};export default null;
