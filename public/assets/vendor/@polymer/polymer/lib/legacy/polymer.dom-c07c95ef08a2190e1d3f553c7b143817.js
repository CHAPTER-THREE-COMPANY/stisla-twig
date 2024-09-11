/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@polymer/polymer@3.5.1/lib/legacy/polymer.dom.js
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
const e=window.ShadyDOM&&window.ShadyDOM.noPatch&&window.ShadyDOM.wrap?window.ShadyDOM.wrap:window.ShadyDOM?e=>ShadyDOM.patch(e):e=>e;
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/const t=!window.ShadyDOM||!window.ShadyDOM.inUse;var o;
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
function n(e,t,o){return{index:e,removed:t,addedCount:o}}Boolean(!window.ShadyCSS||window.ShadyCSS.nativeCss),t&&"adoptedStyleSheets"in Document.prototype&&"replaceSync"in CSSStyleSheet.prototype&&(()=>{try{const e=new CSSStyleSheet;e.replaceSync("");const t=document.createElement("div");return t.attachShadow({mode:"open"}),t.shadowRoot.adoptedStyleSheets=[e],t.shadowRoot.adoptedStyleSheets[0]===e}catch(e){return!1}})(),window.Polymer&&window.Polymer.rootPath||(o=document.baseURI||window.location.href).substring(0,o.lastIndexOf("/")+1),window.Polymer&&window.Polymer.sanitizeDOMValue,window.Polymer&&window.Polymer.setPassiveTouchGestures,window.Polymer&&window.Polymer.strictTemplatePolicy,window.Polymer&&window.Polymer.allowTemplateFromDomModule,window.Polymer&&window.Polymer.legacyOptimizations,window.Polymer&&window.Polymer.legacyWarnings,window.Polymer&&window.Polymer.syncInitialRender,window.Polymer&&window.Polymer.legacyUndefined,window.Polymer&&window.Polymer.orderedComputed,window.Polymer&&window.Polymer.removeNestedTemplates,window.Polymer&&window.Polymer.fastDomIf,window.Polymer&&window.Polymer.suppressTemplateNotifications,window.Polymer&&window.Polymer.legacyNoObservedAttributes,window.Polymer&&window.Polymer.useAdoptedStyleSheetsWithBuiltCSS;const r=0,i=1,s=2,d=3;function l(e,t,o,l,a,c){let u,p=0,w=0,y=Math.min(o-t,c-a);if(0==t&&0==a&&(p=function(e,t,o){for(let n=0;n<o;n++)if(!h(e[n],t[n]))return n;return o}(e,l,y)),o==e.length&&c==l.length&&(w=function(e,t,o){let n=e.length,r=t.length,i=0;for(;i<o&&h(e[--n],t[--r]);)i++;return i}(e,l,y-p)),a+=p,c-=w,(o-=w)-(t+=p)==0&&c-a==0)return[];if(t==o){for(u=n(t,[],0);a<c;)u.removed.push(l[a++]);return[u]}if(a==c)return[n(t,[],o-t)];let f=function(e){let t=e.length-1,o=e[0].length-1,n=e[t][o],l=[];for(;t>0||o>0;){if(0==t){l.push(s),o--;continue}if(0==o){l.push(d),t--;continue}let h,a=e[t-1][o-1],c=e[t-1][o],u=e[t][o-1];h=c<u?c<a?c:a:u<a?u:a,h==a?(a==n?l.push(r):(l.push(i),n=a),t--,o--):h==c?(l.push(d),t--,n=c):(l.push(s),o--,n=u)}return l.reverse(),l}(function(e,t,o,n,r,i){let s=i-r+1,d=o-t+1,l=new Array(s);for(let e=0;e<s;e++)l[e]=new Array(d),l[e][0]=e;for(let e=0;e<d;e++)l[0][e]=e;for(let o=1;o<s;o++)for(let i=1;i<d;i++)if(h(e[t+i-1],n[r+o-1]))l[o][i]=l[o-1][i-1];else{let e=l[o-1][i]+1,t=l[o][i-1]+1;l[o][i]=e<t?e:t}return l}(e,t,o,l,a,c));u=void 0;let m=[],S=t,g=a;for(let e=0;e<f.length;e++)switch(f[e]){case r:u&&(m.push(u),u=void 0),S++,g++;break;case i:u||(u=n(S,[],0)),u.addedCount++,S++,u.removed.push(l[g]),g++;break;case s:u||(u=n(S,[],0)),u.addedCount++,S++;break;case d:u||(u=n(S,[],0)),u.removed.push(l[g]),g++}return u&&m.push(u),m}function h(e,t){return e===t}
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/let a=0,c=0,u=[],p=0,w=!1,y=document.createTextNode("");new window.MutationObserver((function(){w=!1;const e=u.length;for(let t=0;t<e;t++){let e=u[t];if(e)try{e()}catch(e){setTimeout((()=>{throw e}))}}u.splice(0,e),c+=e})).observe(y,{characterData:!0});const f={run:e=>(w||(w=!0,y.textContent=p++),u.push(e),a++),cancel(e){const t=e-c;if(t>=0){if(!u[t])throw new Error("invalid async handle: "+e);u[t]=null}}};
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/function m(e){return"slot"===e.localName}let S=class{static getFlattenedNodes(t){const o=e(t);return m(t)?o.assignedNodes({flatten:!0}):Array.from(o.childNodes).map((t=>m(t)?e(t).assignedNodes({flatten:!0}):[t])).reduce(((e,t)=>e.concat(t)),[])}constructor(e,t){this._shadyChildrenObserver=null,this._nativeChildrenObserver=null,this._connected=!1,this._target=e,this.callback=t,this._effectiveNodes=[],this._observer=null,this._scheduled=!1,this._boundSchedule=()=>{this._schedule()},this.connect(),this._schedule()}connect(){m(this._target)?this._listenSlots([this._target]):e(this._target).children&&(this._listenSlots(e(this._target).children),window.ShadyDOM?this._shadyChildrenObserver=window.ShadyDOM.observeChildren(this._target,(e=>{this._processMutations(e)})):(this._nativeChildrenObserver=new MutationObserver((e=>{this._processMutations(e)})),this._nativeChildrenObserver.observe(this._target,{childList:!0}))),this._connected=!0}disconnect(){m(this._target)?this._unlistenSlots([this._target]):e(this._target).children&&(this._unlistenSlots(e(this._target).children),window.ShadyDOM&&this._shadyChildrenObserver?(window.ShadyDOM.unobserveChildren(this._shadyChildrenObserver),this._shadyChildrenObserver=null):this._nativeChildrenObserver&&(this._nativeChildrenObserver.disconnect(),this._nativeChildrenObserver=null)),this._connected=!1}_schedule(){this._scheduled||(this._scheduled=!0,f.run((()=>this.flush())))}_processMutations(e){this._processSlotMutations(e),this.flush()}_processSlotMutations(e){if(e)for(let t=0;t<e.length;t++){let o=e[t];o.addedNodes&&this._listenSlots(o.addedNodes),o.removedNodes&&this._unlistenSlots(o.removedNodes)}}flush(){if(!this._connected)return!1;window.ShadyDOM&&ShadyDOM.flush(),this._nativeChildrenObserver?this._processSlotMutations(this._nativeChildrenObserver.takeRecords()):this._shadyChildrenObserver&&this._processSlotMutations(this._shadyChildrenObserver.takeRecords()),this._scheduled=!1;let e={target:this._target,addedNodes:[],removedNodes:[]},t=this.constructor.getFlattenedNodes(this._target),o=(n=t,r=this._effectiveNodes,l(n,0,n.length,r,0,r.length));var n,r;for(let t,n=0;n<o.length&&(t=o[n]);n++)for(let o,n=0;n<t.removed.length&&(o=t.removed[n]);n++)e.removedNodes.push(o);for(let n,r=0;r<o.length&&(n=o[r]);r++)for(let o=n.index;o<n.index+n.addedCount;o++)e.addedNodes.push(t[o]);this._effectiveNodes=t;let i=!1;return(e.addedNodes.length||e.removedNodes.length)&&(i=!0,this.callback.call(this._target,e)),i}_listenSlots(e){for(let t=0;t<e.length;t++){let o=e[t];m(o)&&o.addEventListener("slotchange",this._boundSchedule)}}_unlistenSlots(e){for(let t=0;t<e.length;t++){let o=e[t];m(o)&&o.removeEventListener("slotchange",this._boundSchedule)}}},g=new Set;
/**
@license
Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/const v=function(e){g.add(e)},_=function(){const e=Boolean(g.size);return g.forEach((e=>{try{e.flush()}catch(e){setTimeout((()=>{throw e}))}})),e},b=function(){let e,t;do{e=window.ShadyDOM&&ShadyDOM.flush(),window.ShadyCSS&&window.ShadyCSS.ScopingShim&&window.ShadyCSS.ScopingShim.flush(),t=_()}while(e||t)},O=Element.prototype,C=O.matches||O.matchesSelector||O.mozMatchesSelector||O.msMatchesSelector||O.oMatchesSelector||O.webkitMatchesSelector,N=function(e,t){return C.call(e,t)};class M{constructor(e){window.ShadyDOM&&window.ShadyDOM.inUse&&window.ShadyDOM.patch(e),this.node=e}observeNodes(e){return new S(this.node,e)}unobserveNodes(e){e.disconnect()}notifyObserver(){}deepContains(t){if(e(this.node).contains(t))return!0;let o=t,n=t.ownerDocument;for(;o&&o!==n&&o!==this.node;)o=e(o).parentNode||e(o).host;return o===this.node}getOwnerRoot(){return e(this.node).getRootNode()}getDistributedNodes(){return"slot"===this.node.localName?e(this.node).assignedNodes({flatten:!0}):[]}getDestinationInsertionPoints(){let t=[],o=e(this.node).assignedSlot;for(;o;)t.push(o),o=e(o).assignedSlot;return t}importNode(t,o){let n=this.node instanceof Document?this.node:this.node.ownerDocument;return e(n).importNode(t,o)}getEffectiveChildNodes(){return S.getFlattenedNodes(this.node)}queryDistributedElements(e){let t=this.getEffectiveChildNodes(),o=[];for(let n,r=0,i=t.length;r<i&&(n=t[r]);r++)n.nodeType===Node.ELEMENT_NODE&&N(n,e)&&o.push(n);return o}get activeElement(){let e=this.node;return void 0!==e._activeElement?e._activeElement:e.activeElement}}function P(e,t){for(let o=0;o<t.length;o++){let n=t[o];Object.defineProperty(e,n,{get:function(){return this.node[n]},configurable:!0})}}class D{constructor(e){this.event=e}get rootTarget(){return this.path[0]}get localTarget(){return this.event.target}get path(){return this.event.composedPath()}}M.prototype.cloneNode,M.prototype.appendChild,M.prototype.insertBefore,M.prototype.removeChild,M.prototype.replaceChild,M.prototype.setAttribute,M.prototype.removeAttribute,M.prototype.querySelector,M.prototype.querySelectorAll,M.prototype.parentNode,M.prototype.firstChild,M.prototype.lastChild,M.prototype.nextSibling,M.prototype.previousSibling,M.prototype.firstElementChild,M.prototype.lastElementChild,M.prototype.nextElementSibling,M.prototype.previousElementSibling,M.prototype.childNodes,M.prototype.children,M.prototype.classList,M.prototype.textContent,M.prototype.innerHTML;let E=M;if(window.ShadyDOM&&window.ShadyDOM.inUse&&window.ShadyDOM.noPatch&&window.ShadyDOM.Wrapper){class e extends window.ShadyDOM.Wrapper{}Object.getOwnPropertyNames(M.prototype).forEach((t=>{"activeElement"!=t&&(e.prototype[t]=M.prototype[t])})),P(e.prototype,["classList"]),E=e,Object.defineProperties(D.prototype,{localTarget:{get(){const e=this.event.currentTarget,t=e&&x(e).getOwnerRoot(),o=this.path;for(let e=0;e<o.length;e++){const n=o[e];if(x(n).getOwnerRoot()===t)return n}},configurable:!0},path:{get(){return window.ShadyDOM.composedPath(this.event)},configurable:!0}})}else!function(e,t){for(let o=0;o<t.length;o++){let n=t[o];e[n]=function(){return this.node[n].apply(this.node,arguments)}}}(M.prototype,["cloneNode","appendChild","insertBefore","removeChild","replaceChild","setAttribute","removeAttribute","querySelector","querySelectorAll","attachShadow"]),P(M.prototype,["parentNode","firstChild","lastChild","nextSibling","previousSibling","firstElementChild","lastElementChild","nextElementSibling","previousElementSibling","childNodes","children","classList","shadowRoot"]),function(e,t){for(let o=0;o<t.length;o++){let n=t[o];Object.defineProperty(e,n,{get:function(){return this.node[n]},set:function(e){this.node[n]=e},configurable:!0})}}(M.prototype,["textContent","innerHTML","className"]);const T=E,x=function(e){if((e=e||document)instanceof E)return e;if(e instanceof D)return e;let t=e.__domApi;return t||(t=e instanceof Event?new D(e):new E(e),e.__domApi=t),t};export{T as DomApi,D as EventApi,v as addDebouncer,x as dom,b as flush,N as matchesSelector};export default null;
