<tr>
	<td>
        <label class="pda_switch" for="remove_license_and_all_data">
            <input type="checkbox" id="remove_license_and_all_data" name="remove_license_and_all_data" disabled/>
            <span class="pda-slider round"></span>
        </label>
		<div class="pda_error" id="pda_l_error"></div>
	</td>
    <td>
        <p>
            <label><?php echo esc_html__( 'Remove Data Upon Uninstall', 'prevent-direct-access-lite' ) ?>
            <span>
                <?php echo esc_html__( PDA_Lite_Constants::WARNING_PLAN, 'prevent-direct-access-lite' ) ?>
            </span>
            </label>
            <?php echo esc_html__( 'Remove your license and ALL related data upon uninstall. Your license may not be used on this website again or elsewhere anymore.', 'prevent-direct-access-lite' ) ?>
        </p>
    </td>
</tr>
