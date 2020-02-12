<tr>
    <td>
        <label class="pda_switch" for="enable_directory_listing">
            <input type="checkbox" id="enable_directory_listing"
                   name="enable_directory_listing" <?php echo $enable_directory_listing ?> />
            <span class="pda-slider round"></span>
        </label>
    </td>

    <td>
        <p>
            <label><?php echo esc_html__( 'Disable directory listing', 'prevent-direct-access-lite' ) ?></label>
            <?php echo esc_html__( 'Disable directory browsing of all folders and subdirectories.', 'prevent-direct-access-lite' ) ?>
        </p>
    </td>
</tr>

