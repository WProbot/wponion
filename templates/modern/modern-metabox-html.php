<?php
global $wponion_modern_theme;
$settings = $wponion_modern_theme->metabox();
$active   = $settings->active_page();
?>
<style>
	<?php
	echo '#' . $settings->metabox_id() . ' ul.wponion-metabox-parent-menu > li > a.active, #'. $settings->metabox_id() .' ul.wponion-metabox-parent-menu > li:hover > a{
			background: '.$settings->option('theme_color').';
		}';
	?>
</style>
<div class="<?php echo $settings->wrap_class( '', true ); ?>">
	<div class="wponion-metabox-inside-wrap">
		<div class="wponion-metabox-menu-wrap">
			<?php
			$menus  = $settings->metabox_menus();
			$return = '';
			if ( is_array( $menus ) ) {
				$return = '<ul class="meta-menu wponion-metabox-parent-menu">';
				foreach ( $menus as $slug => $menu ) {
					if ( isset( $menu['is_seperator'] ) && true === $menu['is_seperator'] ) {
						continue;
					}
					$return .= '<li>';

					if ( isset( $menu['submenu'] ) && false !== $menu['submenu'] ) {
						$ex_class                    = ( isset( $menu['attributes']['class'] ) ) ? $menu['attributes']['class'] : '';
						$menu['attributes']['class'] = $ex_class . ' ' . 'dropdown';
						$is_active                   = ( $active['parent_id'] === $menu['name'] ) ? 'style="display:block;"' : '';
						$return                      = $return . ' ' . $wponion_modern_theme->metabox_menu_html( $menu ) . '<ul class="meta-submenu" ' . $is_active . '>';
						foreach ( $menu['submenu'] as $_m ) {
							$return .= '<li>' . $wponion_modern_theme->metabox_menu_html( $_m, $menu['name'] ) . '</li>';
						}
						$return .= '</ul>';
					} else {
						$return .= $wponion_modern_theme->metabox_menu_html( $menu );
					}
					$return .= '</li>';
				}
				$return .= '</ul>';
			}
			echo $return;
			?>
			<div class="wponion-metabox-menu-bg-wrap"></div>
		</div>

		<div class="wponion-metabox-content-wrap">
			<?php
			foreach ( $settings->fields() as $option ) {
				if ( false === $settings->valid_option( $option ) ) {
					continue;
				}
				$slug       = $option['name'];
				$page_class = ( $slug === $active['parent_id'] ) ? '' : 'hidden';
				?>
				<div id="wponion-tab-<?php echo $slug; ?>" class="wponion-parent-wraps <?php echo $page_class; ?>">
					<?php
					if ( isset( $option['sections'] ) ) {
						foreach ( $option['sections'] as $section ) {
							if ( false === $settings->valid_option( $section ) ) {
								continue;
							}
							$child_slug  = $section['name'];
							$child_class = ( $child_slug === $active['section_id'] ) ? '' : 'hidden';
							echo '<div id="wponion-tab-' . $slug . '-' . $child_slug . '" class="wponion-section-wraps ' . $child_class . '" data-section-id="' . $child_slug . '">';
							foreach ( $section['fields'] as $field ) {
								echo $settings->render_field( $field, $option['name'], $section['name'] );
							}
							echo '</div>';
						}
					} elseif ( isset( $option['fields'] ) ) {
						foreach ( $option['fields'] as $field ) {
							echo $settings->render_field( $field, $option['name'] );
						}
					} elseif ( isset( $option['callback'] ) && false !== $option['callback'] ) {
						$with_wrap = ( isset( $option['with_wrap'] ) && true === $option['with_wrap'] || ! isset( $option['with_wrap'] ) ) ? true : false;
					}
					?>
				</div>
				<?php
			}
			?>
		</div>

	</div>
	<?php
	if ( false !== $settings->option( 'ajax' ) ) {
		?>
		<h2 class="ajax-container">

			<?php
			echo $settings->hidden_secure_data();
			echo $settings->save_button();
			?>
		</h2>
		<?php
	} ?>
</div>
