<tr>
    <td>
        <label class="pda_switch" for="pda_auto_protect_new_files">
            <input type="checkbox" id="pda_auto_protect_new_files"
                   name="pda_auto_protect_new_files" disabled="disabled"/>
            <span class="pda-slider round"></span>
        </label>
    </td>

	<td>
		<p>
			<label>
				<?php echo esc_html__( 'Auto-protect New File Uploads', 'prevent-direct-access-lite' ); ?>
			</label>
			<span>
		        <?php echo esc_html__( 'Automatically protect all new file uploads', 'prevent-direct-access-lite' );
		        echo esc_html__( PDA_Lite_Constants::WARNING_PLAN, 'prevent-direct-access-lite' ); ?>
            </span>
		</p>
	</td>
</tr>
