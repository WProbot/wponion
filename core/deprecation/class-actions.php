<?php

namespace WPOnion\Deprecation;

use WPOnion\Bridge\Deprecated_Hooks;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Deprecation\Actions' ) ) {
	/**
	 * Handles deprecation notices and triggering of legacy action hooks.
	 */
	class Actions extends Deprecated_Hooks {
		/**
		 * Array of deprecated hooks we need to handle.
		 * Format of 'new' => 'old'.
		 *
		 * @var array
		 */
		protected $deprecated_hooks = array(
			'wponion/core/loaded'                => 'wponion_core_loaded',
			'wponion/addon/before/load'          => 'wponion_before_addons_load',
			'wponion/addon/after/loaded'         => 'wponion_after_addons_load',
			'wponion/loaded'                     => 'wponion_loaded',
			'wponion/integrations/before/load'   => 'wponion_integrations_before_loaded',
			'wponion/integrations/after/loaded'  => 'wponion_integrations_loaded',
			'wponion/init'                       => 'wponion_init',
			'wponion/core/fields/registered'     => 'wponion_core_fields_registered',
			'wponion/ajax/shutdown'              => 'wponion_ajax_shutdown',
			'wponion/ajax/shutdown/error'        => 'wponion_ajax_shutdown_error',
			'wponion/ajax/shutdown/success'      => 'wponion_ajax_shutdown_success',
			'wponion/assets/register/before'     => 'wponion_register_assets_before',
			'wponion/assets/register/after'      => 'wponion_register_assets_after',
			'wponion/ajax/metabox/render/before' => 'wponion_metabox_ajax_before_render',
			'wponion/ajax/metabox/render/after'  => 'wponion_metabox_ajax_render',
			'wponion/icons/setup/before'         => 'wponion_before_icons_setup',
			'wponion/icons/setup/after'          => 'wponion_after_icons_setup',
			'wponion/field_class/load'           => 'wponion_load_field_class',
			'wponion/ajax/enqueue_assets'        => 'wponion_ajax_enqueue_scripts',
			'wponion/settings/page/assets'       => 'wponion_settings_page_assets',
		);

		/**
		 * Array of versions on each hook has been deprecated.
		 *
		 * @var array
		 */
		protected $deprecated_version = array(
			'wponion_core_loaded' => '1.4.6.1',
		);

		/**
		 * Fire off a legacy hook with it's args.
		 *
		 * @param string $old_hook Old hook name.
		 * @param array  $new_callback_args New callback args.
		 *
		 * @return mixed
		 */
		protected function trigger_hook( $old_hook, $new_callback_args ) {
			do_action_ref_array( $old_hook, $new_callback_args );
		}
	}

}
