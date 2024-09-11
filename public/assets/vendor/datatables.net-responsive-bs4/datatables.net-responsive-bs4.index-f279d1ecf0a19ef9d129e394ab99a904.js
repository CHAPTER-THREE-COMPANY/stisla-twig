/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/datatables.net-responsive-bs4@2.2.3/js/responsive.bootstrap4.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
import a from"datatables.net-bs4";import d from"datatables.net-responsive";var e={exports:{}},o=e.exports=function(e,o){return e||(e=window),o&&o.fn.dataTable||(o=a(e,o).$),o.fn.dataTable.Responsive||d(e,o),function(a,d,e,o){var t=a.fn.dataTable,n=t.Responsive.display,s=n.modal,i=a('<div class="modal fade dtr-bs-modal" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"/></div></div></div>');return n.modal=function(d){return function(e,o,t){if(a.fn.modal){if(!o){if(d&&d.header){var n=i.find("div.modal-header"),l=n.find("button").detach();n.empty().append('<h4 class="modal-title">'+d.header(e)+"</h4>").append(l)}i.find("div.modal-body").empty().append(t()),i.appendTo("body").modal()}}else s(e,o,t)}},t.Responsive}(o,0,e.document)};
/*! Bootstrap 4 integration for DataTables' Responsive
 * ©2016 SpryMedia Ltd - datatables.net/license
 */export{o as default};
