<tr>
    <td class="feature-input"><span class="feature-input"></span></td>
    <td>
        <p>
            <label><?php echo esc_html__( 'Customize "No Access" Page', 'prevent-direct-access-lite' ) ?></label>
            <?php if ( isset( $title ) && ! empty( $title ) && $title != null && ! empty( $title['title'] ) ) { ?>
        <div class='no-access-selected-page'>
            <b class="no-access-selected-page-label"><?php echo esc_html__( 'Selected page: ', 'prevent-direct-access-lite' ) ?></b>
            <span class="no-access-selected-page-title"><?php echo esc_html__( $title['title'], 'prevent-direct-access-lite' ) ?></span>
            <span class="dashicons dashicons-no remove-no-access-page"></span>
        </div>
        <?php } else { ?>
            <div class='no-access-default-page no-access-selected-page'>
                <b class='selected_page'><?php echo esc_html__( 'Default page:', 'prevent-direct-access-lite') ?></b> <span class='value_page'><?php echo esc_html__( '404 Not Found Page', 'prevent-direct-access-lite') ?></span>
                <span style="display: none" id="remove_page" class="dashicons dashicons-no remove-no-access-page"></span>
            </div>
        <?php } ?>
        <div>
            <?php wp_nonce_field( 'internal-linking', '_ajax_linking_nonce', false );?>
            <input type="search" id="search" placeholder="Type to search" class="valid" autocomplete="off" aria-invalid="false"/>
        </div>
        <div class="no-access-search-container">
            <ul id="pda_search_result"></ul>
            <div class="title_page_404">
                <input id="title_page_404_input" type="hidden" value="<?php echo $title_page; ?>">
                <input id="search_page_404_input" type="hidden" name="search_result_page_404" value="<?php _e($data_page); ?>"/>
            </div>
        </div>
        </p>
    </td>
</tr>