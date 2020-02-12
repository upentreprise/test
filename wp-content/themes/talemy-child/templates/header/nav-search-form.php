<form class="search-form" role="search" action="<?php echo esc_url( home_url() ); ?>" method="get">
    <div class="position-relative">
    <input type="search" name="s" class="sf-input" placeholder="<?php esc_html_e( 'what do you want to learn?', 'talemy' ); ?>" title="<?php echo esc_attr_e( 'Search', 'talemy' ); ?>" value="<?php echo get_search_query(); ?>">
        <?php if ( defined( 'LEARNDASH_VERSION' ) ) : ?>
            <input type="hidden" name="post_type" value="sfwd-courses">
        <?php endif; ?>
        <button class="sf-submit" type="submit">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>