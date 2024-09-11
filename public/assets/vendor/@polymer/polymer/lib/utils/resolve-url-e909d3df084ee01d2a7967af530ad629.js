/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@polymer/polymer@3.5.1/lib/utils/resolve-url.js
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
let e,t,n=/(url\()([^)]*)(\))/g,r=/(^\/[^\/])|(^#)|(^[\w-\d]*:)/;function a(n,a){if(n&&r.test(n))return n;if("//"===n)return n;if(void 0===e){e=!1;try{const t=new URL("b","http://a");t.pathname="c%20d",e="http://a/c%20d"===t.href}catch(e){}}if(a||(a=document.baseURI||window.location.href),e)try{return new URL(n,a).href}catch(e){return n}return t||(t=document.implementation.createHTMLDocument("temp"),t.base=t.createElement("base"),t.head.appendChild(t.base),t.anchor=t.createElement("a"),t.body.appendChild(t.anchor)),t.base.href=a,t.anchor.href=n,t.anchor.href||n}function c(e,t){return e.replace(n,(function(e,n,r,c){return n+"'"+a(r.replace(/["']/g,""),t)+"'"+c}))}function o(e){return e.substring(0,e.lastIndexOf("/")+1)}export{o as pathFromUrl,c as resolveCss,a as resolveUrl};export default null;
