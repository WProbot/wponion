<?php
/**
 *
 * Project : wponion
 * Date : 25-11-2018
 * Time : 03:46 PM
 * File : iframe.php
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @package wponion
 * @copyright 2018 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

namespace WPOnion\Field;

use WPOnion\Field;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Field\Iframe' ) ) {
	/**
	 * Class Iframe
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Iframe extends Field {

		/**
		 * Generates Final HTML Output.
		 *
		 * @return mixed|void
		 */
		protected function output() {
			echo $this->before();

			if ( false !== $this->data( 'heading' ) ) {
				printf( '<h3>%s</h3>', $this->data( 'heading' ) );
			}

			if ( false !== $this->data( 'url' ) ) {
				$attrs = $this->attributes( array(
					'height'      => $this->data( 'height' ),
					'width'       => $this->data( 'width' ),
					'src'         => $this->data( 'url' ),
					'frameborder' => '0',
				) );
				echo '<iframe ' . $attrs . '></iframe>';
			}

			echo $this->after();
		}

		/**
		 * Handles Fields Assets.
		 *
		 * @return mixed|void
		 */
		public function field_assets() {
		}

		/**
		 * Returns Field's Default Value.
		 *
		 * @return array|mixed
		 */
		protected function field_default() {
			return array(
				'heading' => false,
				'url'     => false,
				'height'  => '100%',
				'width'   => '100%',
			);
		}
	}
}
