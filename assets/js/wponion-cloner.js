"use strict";!function(r){r.fn.WPOnionCloner=function(e){var n=r.extend({limit:!1,add_btn:!1,remove_btn:!1,clone_elem:!1,template:!1,sortable:!1,onLimitReached:!1,templateBeforeRender:!1,templateAfterRender:!1,onRemove:!1,onRemoveBefore:!1,onRemoveAfter:!1,show_animation:!1,hide_animation:!1},e);"string"==typeof n.add_btn&&(n.add_btn=this.find(n.add_btn)),"string"==typeof n.remove_btn&&(n.remove_btn_jquery=this.find(n.remove_btn));var o=r(this),t=n.add_btn,i=n.remove_btn_jquery,a=function(){if(!r(this).hasClass("removing")){r(this).addClass("removing");var e=parseInt(o.attr("data-wponion-clone-count"))-1;o.attr("data-wponion-clone-count",e),!1!==n.onRemoveBefore&&n.onRemoveBefore(r(this)),!1!==n.onRemove?n.onRemove(r(this)):!1!==n.hide_animation?r(this).parent().parent().animateCss(n.hide_animation,function(e){e.remove()}):r(this).parent().parent().remove(),!1!==n.onRemoveAfter&&n.onRemoveAfter(r(this))}};i.on("click",a),t.on("click",function(){var e=parseInt(o.attr("data-wponion-clone-count")),t=JSON.parse(JSON.stringify(n.template));if(0<n.limit&&(e===n.limit||e>=n.limit))return!1!==n.onLimitReached&&n.onLimitReached(),!1;e+=1,o.attr("data-wponion-clone-count",e),t=t.replace(/{wponionCloneID}/g,e),!1!==n.templateBeforeRender&&(t=n.templateBeforeRender(t,e,this)),t=r(t),!1!==n.show_animation&&t.animateCss(n.show_animation),o.append(t),!1!==n.templateAfterRender&&n.templateAfterRender(o,e,this),o.find(n.remove_btn).on("click",a)}),!1!==n.sortable&&o.sortable(r.extend({cursor:"move",axis:"y",scrollSensitivity:40,forcePlaceholderSize:!0,helper:"clone",opacity:.65},n.sortable))}}(jQuery);