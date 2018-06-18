'use strict';

/**
 * @param window = Window Object
 * @param document = Document Object
 * @param $ = jQuery Object
 * @param wpo = $wponion object
 * @param wp = $wponion.theme object.
 */
(function (window, document, $, wpo, wp) {
	var wphooks = wp.hooks;

	/**
  * Customizer Functions.
  * @type {{link_customize_settings: function(*), cloneable_update: function(*), cloneable: function(*=)}}
  */
	var $wponion_customizer = {
		/**
   * Adds data-customize-settings-link attribute.
   */
		link_customize_settings: function link_customize_settings($elem) {
			$elem.find('input , textarea').each(function () {
				$(this).attr("data-customize-setting-link", true);
			});
		},

		/**
   * Links WIth KeyValue to auto get and save data.
   */
		cloneable_update: function cloneable_update($control) {
			var $values = $control.container.find(':input').inputToArray({ key: 'name', value: true });
			var $input = $control.container.find('input.wponion_cloneable_value');

			$.each($values, function ($k, $vs) {
				$.each($vs, function ($e, $ep) {
					$values = $ep;
				});
			});

			$input.val(JSON.stringify($values));
			$input.trigger('change');
		},

		/**
   * Links WIth KeyValue to auto get and save data.
   */
		get_keyval_data: function get_keyval_data($control) {
			var $values = $control.container.find(':input').inputToArray({ key: 'name', value: true });
			$.each($values, function ($k, $vs) {
				$.each($vs, function ($e, $ep) {
					$values = $ep;
				});
			});

			return $values;
		},

		/**
   * Enables Cloneable fields.
   */
		cloneable: function cloneable($control) {
			$control.container.on('change', ':input', function () {
				if (!$(this).hasClass('wponion_cloneable_value')) {
					$wponion_customizer.cloneable_update($control);
				}
			});
		}
	};

	var $wpc = wp.customize.controlConstructor;

	/**
  * Handles Key Value field in customizer.
  */
	$wpc.wponion_field_key_value = wp.customize.Control.extend({
		ready: function ready() {
			var control = this;
			wphooks.addAction('wponion_key_value_updated', function ($elem) {
				var $val = $wponion_customizer.get_keyval_data(control);
				control.setting.set($val);
			}, 11);

			control.container.on('change', 'input[type=text]', function () {
				var $val = $wponion_customizer.get_keyval_data(control);
				control.setting.set($val);
			});
		}
	});

	$wpc.wponion_field_checkbox = wp.customize.Control.extend({
		ready: function ready() {
			var control = this;
			control.container.on('change', ':input', function () {
				var $val = $wponion_customizer.get_keyval_data(control);
				control.setting.set($val);
			});
		}
	});

	/**
  * Handles Fieldset And Checkbox Field.
  */
	$wpc.wponion_field_fieldset = wp.customize.Control.extend({
		ready: function ready() {
			$wponion_customizer.cloneable(this);
		}
	});

	/**
  * Handles Image Picker.
  */
	$wpc.wponion_field_image = $wpc.wponion_field_gallery = wp.customize.Control.extend({
		initialize: function initialize(id, options) {
			var $html = $('<div>' + options.params.content + '</div>');
			var $input = $html.find('input#image_id');
			$input.attr('data-customize-setting-link', $html.find('input#image_id').attr('name'));
			options.params.content = $html.html();
			wp.customize.Control.prototype.initialize.call(this, id, options);
		}
	});

	/**
  * Inits Customizer Instance.
  */
	wphooks.addAction('wponion_init', function () {
		$(".wponion-module-customizer-framework.wponion-framework").each(function () {
			$wponion_customizer.link_customize_settings($(this));
		});
	});
})(window, document, jQuery, $wponion, wp);
//# sourceMappingURL=wponion-customizer.js.map