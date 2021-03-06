<?php

namespace WPOnion\Field;

use WPOnion\Field;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Field\Date_Picker' ) ) {
	/**
	 * Class Date_Picker
	 *
	 * @package WPOnion\Field
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Date_Picker extends Field {

		/**
		 * Generates Final HTML Output.
		 *
		 * @return mixed|void
		 */
		protected function output() {
			echo $this->before();
			if ( $this->has( 'range' ) && true === $this->data( 'range' ) ) {
				$date = $this->data( 'date' );

				if ( false === $date ) {
					$date = __( 'From Date', 'wponion' );
				}

				echo '<div class="date-range-container wpo-row">';
				echo $this->sub_field( $this->handle_args( 'title', $date, array(
					'id'         => 'from',
					'type'       => 'text',
					'title'      => __( 'From Date', 'wponion' ),
					'wrap_class' => 'wpo-col-xs-12 wpo-col-sm-12 wpo-col-md-2',
					'horizontal' => true,
					'attributes' => array(
						'data-wponion-datepicker-from-date' => true,
					),
				) ), $this->value( 'from' ), $this->name() );
				echo $this->sub_field( $this->handle_args( 'title', $this->data( 'to_date' ), array(
					'id'         => 'to',
					'type'       => 'text',
					'title'      => __( 'To Date', 'wponion' ),
					'wrap_class' => 'wpo-col-xs-12 wpo-col-sm-12 wpo-col-md-2',
					'horizontal' => true,
					'attributes' => array(
						'data-wponion-datepicker-to-date' => true,
					),
				) ), $this->value( 'to' ), $this->name() );
				echo '</div>';
			} else {
				echo $this->sub_field( $this->handle_args( 'placeholder', $this->data( 'date' ), array(
					'id'         => $this->field_id(),
					'type'       => 'text',
					'prefix'     => wpo_icon( 'wpoic-calendar' ),
					'only_field' => true,
				) ), $this->value(), $this->unique() );
			}

			echo $this->after();
		}

		/**
		 * Field's Custom Wrap Class.
		 *
		 * @return string
		 */
		protected function field_wrap_class() {
			return ( $this->has( 'range' ) && true === $this->data( 'range' ) ) ? ' wponion-datepicker-range ' : '';
		}

		/**
		 * Handles Fields Assets.
		 *
		 * @return mixed|void
		 */
		public function field_assets() {
			wponion_load_asset( 'wponion-datepicker' );
		}

		/**
		 * @return array|bool|mixed
		 */
		protected function js_field_args() {
			$js_args                      = array();
			$settings                     = ( $this->has( 'settings' ) ) ? $this->data( 'settings' ) : array();
			$js_args['settings']          = $settings;
			$js_args['settings']['theme'] = $this->data( 'theme' );
			$js_args['settings']['range'] = $this->data( 'range' );
			return $js_args;
		}

		/**
		 * Returns Field's Default Value.
		 *
		 * @return array|mixed
		 */
		protected function field_default() {
			return array(
				'range'    => false,
				'settings' => array(),
				'theme'    => 'default',
				'date'     => __( 'Date', 'wponion' ),
				'to_date'  => __( 'Till Date', 'wponion' ),
			);
		}
	}
}
