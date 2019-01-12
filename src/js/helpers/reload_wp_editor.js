import WPOnion_Field from '../core/field';
import { rand_md5 } from 'vsp-js-helper/index';

/**
 * WP Editor Helper
 */
export default class extends WPOnion_Field {
	/**
	 * WP Editor Helper
	 */
	init() {
		if( this.element.length > 0 ) {
			let $mce_editor  = tinyMCEPreInit.mceInit[ this.option( 'wpeditor_id' ) ],
				$quick_tags  = tinyMCEPreInit.qtInit[ this.option( 'wpeditor_id' ) ],
				$NEW_ID      = 'wponion-wp-editor-' + rand_md5(),
				$textArea    = this.element.find( 'textarea' ).clone(),
				$actual_ID   = $textArea.attr( 'id' ),
				$actual_html = this.element.find( '.wponion-fieldset' ).html(),
				$regex       = new RegExp( $actual_ID, "g" );
			$actual_html     = $actual_html.replace( $regex, $NEW_ID );

			this.element.find( '.wponion-fieldset' ).html( $actual_html );
			this.element.find( 'textarea' ).parent().append( $textArea );
			this.element.find( 'textarea:not(#' + $actual_ID + ')' ).remove();
			this.element.find( 'textarea' ).attr( 'id', $NEW_ID );

			if( false === window.wponion._.isUndefined( $mce_editor ) ) {
				$mce_editor.selector = '#' + $NEW_ID;
				tinymce.init( $mce_editor );
				tinyMCE.execCommand( 'mceAddEditor', false, '#' + $NEW_ID );
			}

			if( false === window.wponion._.isUndefined( $quick_tags ) ) {
				$quick_tags.id = $NEW_ID;
				quicktags( $quick_tags );
			}
		}
	}
}
