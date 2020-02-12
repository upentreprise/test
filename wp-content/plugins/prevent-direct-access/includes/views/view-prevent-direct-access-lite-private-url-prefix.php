<tr>
	<td class="feature-input"><span class="feature-input"></span></td>
	<td>
		<p>
			<label><?php echo esc_html__( 'Change Private Link Prefix', 'prevent-direct-access-lite' ) ?>
			</label>
		<div class="pda_error" id="pda_l_error"></div>
		<p class="description">
			<?php echo esc_html__( 'Your Private URL will be: ', 'prevent-direct-access-lite' ) ?><?php echo get_site_url() . '/' ?><span id="pda_prefix"><?php echo esc_html__( 'private', 'prevent-direct-access-lite' ) ?></span>/<?php _e( 'your-custom-filename', 'prevent-direct-access-lite' ) ?>
		</p>
		<input type="text" id="pda_prefix_url" name="pda_prefix_url" value="private" disabled="disabled"/>
		</p>
	</td>
</tr>
