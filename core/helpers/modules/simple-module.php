<?php

if ( ! function_exists( 'wponion_plugin_links' ) ) {
	/**
	 * @param $plugin_file
	 *
	 * @return \WPOnion\Modules\Util\Plugin_Links
	 */
	function wponion_plugin_links( $plugin_file ) {
		return new \WPOnion\Modules\Util\Plugin_Links( $plugin_file );
	}
}
