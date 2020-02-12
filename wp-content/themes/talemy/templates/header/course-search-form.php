<?php if ( !defined( 'LEARNDASH_VERSION') ) : return; endif; ?>
<?php $category = ( get_query_var( 'ld_course_category' ) ) ? get_query_var( 'ld_course_category' ) : ''; ?>
<form class="course-search-form" role="search" action="<?php echo esc_url( home_url() ); ?>" method="get">
    <select name="ld_course_category" class="course-search-category">
        <option value="" selected><?php esc_html_e( 'All Categories', 'talemy' ); ?></option>
        <?php foreach ( talemy_get_ld_option_course_cats( 'slug' ) as $slug => $label ) : ?>
            <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $category, $slug ); ?>><?php echo esc_html( $label ); ?></option>
        <?php endforeach; ?>
    </select>
    <div class="position-relative">
        <input type="search" name="s" class="course-search-input" placeholder="<?php esc_html_e( 'Search for Courses', 'talemy' ); ?>" value="<?php echo get_search_query(); ?>">
        <input type="hidden" name="post_type" value="sfwd-courses">
        <button class="course-search-btn sf-submit" type="submit">
            <i class="ticon-search-alt" aria-hidden="true"></i>
        </button>
    </div>
</form>