'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/**
 * Returns WPOnionElement Instance.
 * @returns {*}
 */
var wponion_elem = function wponion_elem() {
	return wponion.elem;
};

/**
 * WPOnion Core Functions.
 */
(function (window, document, $, wp, wponion, wphooks) {
	/**
  * WPOnion Core Element To Work With.
  * @type {*|HTMLElement}
  */
	wponion.elem = $('.wponion-framework');

	/**
  * Handles Framework ToolTip Functions.
  * @constructor
  */
	wponion.tooltip = function ($elem) {
		if ($elem.length >= 1) {
			return $elem.each(function () {
				/*$( this ).tooltip( {
    	container: $( this ).parent()
    } );*/

				tippy($(this)[0], wponion.field_js_args($(this), {
					arrow: true,
					arrowType: 'sharp'
				}));
			});
		}
	};

	/**
  * Handles BootStrap DropDown.
  * @type {function(*)}
  */
	wponion.dropdown = function ($elem) {
		if (1 >= $elem.length) {
			return $elem.each(function () {
				$(this).dropdown();
			});
		}
	};

	/**
  * Triggers A Hook To Reload All Fields.
  * @type {function()}
  */
	wponion.reload = function () {
		wponion.tooltip(wponion.elem.find(' .wponion-help'));
		//wponion.tooltip( wponion.elem.find( ' .wponion-field-tooltip ' ) );
		wponion.dropdown(wponion.elem.find('.dropdown-toggle'));
		wphooks.doAction("wponion_reload_fields");
		wponion.elem.trigger('reload');
	};

	/**
  * Checks for Document / Window for the elemnts JS settings. if exists it returns or default will be returned.
  * @type {function(*, *)}
  */
	wponion.field_js_args = function ($elem, $default) {
		var $js_id = $elem.attr("data-wponion-jsid");
		if ($js_id) {
			if (_typeof(window[$js_id]) === undefined || window[$js_id] === undefined) {
				return $default;
			}
			return window[$js_id];
		}

		return $default;
	};

	/**
  * Returns URL Query String as object
  * @example http://example.com?q1=22&q2=49 turns into {q1:22,q2:49}
  * @param str
  * @returns {any}
  */
	wponion.url_param = function (str) {
		return (str || document.location.search).replace(/(^\?)/, '').split("&").map(function (n) {
			return n = n.split("="), this[n[0]] = n[1], this;
		}.bind({}))[0];
	};

	/**
  * Below Code Runs On Document Ready
  */
	$(document).on("ready", function () {});

	/**
  * Below Code Runs On Window.load
  */
	$(window).on("load", function () {
		wponion.reload();
		wphooks.doAction('wponion_init');
	});

	/**
  * Hook Fired To Make sure all fields are using it.
  */
	wphooks.doAction("wponion_loaded");
})(window, document, jQuery, wp, wponion, wp.hooks);
//# sourceMappingURL=wponion-core.js.map