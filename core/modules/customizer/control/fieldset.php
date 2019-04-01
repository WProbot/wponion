<?php
/**
 *
 * Initial version created 13-06-2018 / 04:12 PM
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @package
 * @link
 * @copyright 2018 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace WPOnion\Modules\Customizer\Control;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( '\WPOnion\Modules\Customizer\Control\Fieldset' ) ) {
	/**
	 * Class fieldset
	 *
	 * @package WPOnion\Modules\Customize_Control
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Fieldset extends \WPOnion\Modules\Customizer\Control\Cloneable {
		/**
		 * type
		 *
		 * @var string
		 */
		public $type = 'wponion_field_fieldset';

		/**
		 * @return array
		 */
		protected function field() {
			$field = parent::field(); // TODO: Change the autogenerated stub

			if ( isset( $field['attributes'] ) ) {
				unset( $field['attributes']['data-customize-setting-link'] );
			}
			return $field;
		}
	}
}
