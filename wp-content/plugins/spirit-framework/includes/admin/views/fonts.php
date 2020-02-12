<?php
$theme_fonts = SF_Fonts::get_fonts();
$custom_fonts = get_option( SF_Fonts::$custom_option_name );
?>
<div id="sf-fonts">
	<div id="sf-font-panel" class="sf-card-alt">
		<h3><?php _e( 'Theme Font List', 'spirit' ); ?></h3>
		<ul id="sf-font-preview">
		<?php if ( !empty( $theme_fonts ) ):
				foreach ( $theme_fonts as $font ):
					$font_style = '';
					if ( $font['source'] == 'Custom' ) {
						$font_style = '<style>' . SF_Fonts::get_custom_font_css( $font['family'] ) . '</style>';
					}
				?>
				<li>
					<?php echo $font_style; ?>
					<span class="sf-font-specimen" style="font-family:'<?php echo esc_attr( $font['family'] ); ?>'">Grumpy wizards make toxic brew for the evil Queen and Jack.</span>
					<span class="sf-font-family" data-source="<?php echo esc_attr( $font['source'] ); ?>"><?php echo esc_html( $font['family'] ); ?></span>
					<a href="javascript:void(0)" class="sf-remove-font" title="<?php esc_attr_e( 'Remove Font', 'spirit' ); ?>"><span class="screen-reader-text"><?php _e( 'Remove Font', 'spirit' ); ?></span>X</a>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>
		<ul id="sf-font-details">
		<?php if ( !empty( $theme_fonts ) ):
				foreach ( $theme_fonts as $font ):
					$variants = SF_Fonts::get_variants( $font['family'] );
					$font_family = !empty( $font['family'] ) ? $font['family'] : __( 'Unknown', 'spirit' );
					$font_variants = !empty( $font['variants'] ) ? $font['variants'] : '';
					$checked_variants = explode( ',', $font_variants );
					$variant_disabled = count( $variants ) > 1 ? '' : ' disabled';
				?>
				<li>
					<h2 class="sf-font-family"><?php echo esc_html( $font_family ); ?></h2>
					<div class="sf-font-source"><?php printf( __( 'Source: %s', 'spirit' ), esc_html( $font['source'] ) ); ?></div>
					<?php if ( $font['source'] == 'Google'): ?>
						<div class="sf-font-variant-subset">
							<div class="sf-font-variants">
								<h3><?php _e( 'Variants', 'spirit' ); ?>:</h3>
								<ul><?php foreach( $variants as $variant ):
									$attr = '';
									if ( ! empty( $checked_variants ) && in_array( $variant, $checked_variants ) || !empty( $variant_disabled ) ) {
										$attr = ' checked';
									} ?>
									<li>
										<label>
											<input type="checkbox" data-variant="<?php echo esc_attr( $variant ); ?>" class="sf-check-variant"<?php echo esc_attr( $attr . $variant_disabled ); ?>>
											<?php echo esc_html( $variant ); ?>
										</label>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
							<div class="clear"></div>
						</div>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>
		<div id="sf-save-fonts">
			<a class="sf-save-fonts button-primary" href="javascript:void(0)"><?php _e( 'Save Fonts', 'spirit' ); ?></a>
			<span class="sf-form-message"></span>
			<span class="spinner"></span>
		</div>
	</div>
	<div id="sf-font-library" class="sf-two-columns sf-sm-gutters">
		<div class="sf-column">
			<div id="sf-custom-fonts" class="sf-card-alt">
				<h3><?php _e( 'Custom Fonts', 'spirit' ); ?></h3>
				<ul class="sf-font-list">
				<?php if ( !empty( $custom_fonts ) ) : ?>
					<?php foreach ( $custom_fonts as $font ): ?>
						<li>
							<span class="sf-font-name"><?php echo esc_html( $font['family'] ); ?></span>
							<div class="sf-font-actions">
								<a href="javascript:void(0)" class="sf-add-font" title="<?php esc_attr_e( 'Add Font', 'spirit' ); ?>">+</a>
								<a href="javascript:void(0)" class="sf-remove-custom-font" title="<?php esc_attr_e( 'Remove Font', 'spirit' ); ?>">&ndash;</a>
							</div>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
				</ul>
			</div>
			<div id="sf-google-fonts" class="sf-card-alt">
				<h3><?php _e( 'Google Web Fonts', 'spirit' ); ?></h3>
				<div id="sf-font-filter">
				<?php $letters = range( 'A', 'Z' );
					foreach ( $letters as $letter ):
						if ( $letter !== 'X' ): ?>
						<a href="javascript:void(0)"><?php echo esc_html( $letter ); ?></a><?php
						endif;
					endforeach; ?>
				</div>
				<ul class="sf-font-list">
				<?php $google_web_fonts = SF_Fonts::get_google_fonts();
					if ( !empty( $google_web_fonts ) ) :
						foreach ( $google_web_fonts as $font ) :
							$font_family = $font['family'];
							$ff = preg_replace( '/\s/', '+', $font_family );
							$preview_link = 'https://www.google.com/fonts/specimen/' . $ff;
						?>
						<li class="sf-fi-<?php echo esc_attr( $font_family[0] ); ?>">
							<span class="sf-font-name"><?php echo esc_html( $font_family ); ?></span>
							<div class="sf-font-actions">
								<a href="<?php echo esc_url( $preview_link ); ?>" target="_blank" class="sf-preview-font"><?php _e( 'Preview', 'spirit' ) ?></a>
								<a href="javascript:void(0)" class="sf-add-font" title="<?php esc_attr_e( 'Add Font', 'spirit' ); ?>">+</a>
							</div>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="sf-column">
			<div class="sf-card-alt">
				<h3><?php _e( 'Add Custom Font', 'spirit' ); ?></h3>
				<p class="sf-form-message"></p>
				<form id="sf-form-custom-font" method="POST" action="<?php echo esc_url( admin_url( 'admin.php?page=sf_fonts', ( is_ssl() ? 'https' : 'http' ) ) ); ?>" enctype="multipart/form-data">
					<div>
						<label for="sf-file-woff"><?php _e( 'Custom Fonts', 'spirit' ); ?>.woff</label>
						<div class="sf-file-input">
							<span class="sf-file-name"></span>
							<div class="sf-upload-buttons">
								<input type="file" name="sf-ff-woff" id="sf-ff-woff" class="sf-ff">
								<input type="button" class="sf-upload-submit" value="<?php esc_attr_e( 'Upload', 'spirit' ); ?>">
								<input type="button" class="sf-upload-remove" value="X">
							</div>
						</div>
					</div>
					<div>
						<label for="sf-file-ttf"><?php _e( 'Custom Fonts', 'spirit' ); ?>.ttf</label>
						<div class="sf-file-input">
							<span class="sf-file-name"></span>
							<div class="sf-upload-buttons">
								<input type="file" id="sf-ff-ttf" class="sf-ff">
								<input type="button" class="sf-upload-submit" value="<?php esc_attr_e( 'Upload', 'spirit' ); ?>">
								<input type="button" class="sf-upload-remove" value="X">
							</div>
						</div>
					</div>
					<div>
						<label for="sf-file-eot"><?php _e( 'Custom Fonts', 'spirit' ); ?>.eot</label>
						<div class="sf-file-input">
							<span class="sf-file-name"></span>
							<div class="sf-upload-buttons">
								<input type="file" id="sf-ff-eot" class="sf-ff">
								<input type="button" class="sf-upload-submit" value="<?php esc_attr_e( 'Upload', 'spirit' ); ?>">
								<input type="button" class="sf-upload-remove" value="X">
							</div>
						</div>
					</div>
					<div>
						<label for="sf-file-svg"><?php _e( 'Custom Fonts', 'spirit' ); ?>.svg</label>
						<div class="sf-file-input">
							<span class="sf-file-name"></span>
							<div class="sf-upload-buttons">
								<input type="file" id="sf-ff-svg" class="sf-ff">
								<input type="button" class="sf-upload-submit" value="<?php esc_attr_e( 'Upload', 'spirit' ); ?>">
								<input type="button" class="sf-upload-remove" value="X">
							</div>
						</div>
					</div>
					<div>
						<label for="sf-file-woff2"><?php _e( 'Custom Fonts', 'spirit' ); ?>.woff2</label>
						<div class="sf-file-input">
							<span class="sf-file-name"></span>
							<div class="sf-upload-buttons">
								<input type="file" id="sf-ff-woff2" class="sf-ff">
								<input type="button" class="sf-upload-submit" value="<?php esc_attr_e( 'Upload', 'spirit' ); ?>">
								<input type="button" class="sf-upload-remove" value="X">
							</div>
						</div>
					</div>
					<div>
						<label for="sf-custom-font-name"><?php _e( 'Font Name', 'spirit' ); ?></label>
						<input type="text" id="sf-custom-font-name">
					</div>
					<div>
						<input type="submit" class="sf-add-custom-font button-primary" value="<?php esc_attr_e( 'Add Custom Font', 'spirit' ); ?>">
						<?php wp_nonce_field( 'save-cf-nonce', 'sf-save-cf-nonce' ); ?>
						<div class="spinner"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>