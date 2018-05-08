<?php
/**
 *
 * Initial version created 08-05-2018 / 06:15 AM
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @package
 * @link
 * @copyright 2018 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


if ( ! function_exists( 'wponion_get_registry' ) ) {
	/**
	 * Get the registry by type.
	 * Always return the same instance of the registry.
	 *
	 * @param string $type
	 *
	 * @return mixed
	 */
	function wponion_get_registry( $type = '' ) {
		static $data = array();

		if ( ! isset( $data[ $type ] ) ) {
			$data[ $type ] = new $type;
		}
		return $data[ $type ];
	}
}

if ( ! function_exists( 'wponion_registry' ) ) {
	/**
	 * Get the registry by type.
	 * Always return the same instance of the registry.
	 *
	 * @param string $type
	 *
	 * @return mixed
	 */
	function wponion_registry( $type = '' ) {
		$class = null;
		switch ( $type ) {
			case 'settings':
				$class = 'WPOnion_Registry';
				break;
			case 'core':
				$class = 'WPOnion_Core_Registry';
				break;
			default:
				$class = $type;
		}
		return wponion_get_registry( $class );
	}
}

if ( ! function_exists( 'wponion_get_registry_instance' ) ) {
	/**
	 * Adds An Instance To / Retrives An Instance.
	 *
	 * @param string $type
	 * @param        $instance
	 * @param string $registry_type
	 *
	 * @return bool
	 */
	function wponion_get_registry_instance( $type = 'settings', &$instance, $registry_type = 'core' ) {
		if ( $instance instanceof WPOnion_Abstract ) {
			$_registry = wponion_registry( $registry_type );
			$_registry->add( $type, $instance );
		} elseif ( is_string( $instance ) ) {
			return wponion_registry( $registry_type )->get( $type, $instance );
		}
		return true;
	}
}

if ( ! function_exists( 'wponion_settings_registry' ) ) {
	/**
	 * @param $instance
	 *
	 * @return bool
	 */
	function wponion_settings_registry( &$instance ) {
		return wponion_get_registry_instance( 'settings', $instance, 'settings' );
	}
}

if ( ! function_exists( 'wponion_core_registry' ) ) {
	/**
	 * @param $instance
	 *
	 * @return bool
	 */
	function wponion_core_registry( &$instance ) {
		return wponion_get_registry_instance( 'core', $instance );
	}
}

if ( ! function_exists( 'wponion_async' ) ) {
	/**
	 * @return \WPOnion_Async_Request
	 */
	function wponion_async() {
		static $instance = false;

		if ( false === $instance ) {
			$instance = new WPOnion_Async_Request();
		}
		return $instance;
	}
}
