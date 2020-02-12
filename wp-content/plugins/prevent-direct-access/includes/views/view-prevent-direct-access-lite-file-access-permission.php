<tr>
    <td class="feature-input"><span class="feature-input"></span></td>
    <td>
	    <p>
		    <label><?php echo esc_html__( 'Set File Access Permission', 'prevent-direct-access-lite' ) ?>
			    <!--            <span>-->
			    <!--                --><?php //echo esc_html__( PDA_Lite_Constants::WARNING_PLAN, 'prevent-direct-access-lite' ) ?>
			    <!--            </span>-->
		    </label>
		    <?php echo esc_html__( 'Select user roles who can access protected files through their file URLs', 'prevent-direct-access-lite' ) ?>
	    </p>
        <select id="file_access_permission">
            <option value="admin_users" disabled="true"><?php echo esc_html__( 'Admin users', 'prevent-direct-access-gold' ) ?></option>
            <option value="author" disabled="true"><?php echo esc_html__( 'The file\'s author', 'prevent-direct-access-gold' ) ?></option>
            <option value="logged_users" disabled="true"><?php echo esc_html__( 'Logged-in users', 'prevent-direct-access-gold' ) ?></option>
            <option value="blank" selected><?php echo esc_html__( 'No user roles', 'prevent-direct-access-gold' ) ?></option>
            <option value="anyone" disabled="true"><?php echo esc_html__( 'Anyone', 'prevent-direct-access-gold' ) ?></option>
            <option value="custom_roles" disabled="true"><?php echo esc_html__( 'Choose custom roles', 'prevent-direct-access-gold' ) ?></option>
        </select>
    </td>
</tr>
