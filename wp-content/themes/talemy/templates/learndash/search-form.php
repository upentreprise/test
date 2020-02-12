<?php
$category = ( get_query_var( 'ld_course_category' ) ) ? get_query_var( 'ld_course_category' ) : '';
$price = isset( $_GET['ld_course_price'] ) ?  $_GET['ld_course_price'] : '';
?>
<form class="course-search" role="search" action="<?php echo esc_url( home_url() ); ?>" method="get">
    <div class="row xs-gutters">
        <div class="col-sm-12 col-md-6">
            <div class="course-search__input-container">
                <input type="search" name="s" class="course-search__input" placeholder="<?php esc_html_e( 'Search..', 'talemy' ); ?>" value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="sfwd-courses">
                <button class="course-search__submit" type="submit">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <select name="ld_course_category" class="course-select__category">
                <option value="" selected><?php esc_html_e( 'All Categories', 'talemy' ); ?></option>
            <?php foreach ( talemy_get_ld_option_course_cats( 'slug' ) as $slug => $label ) : ?>
                <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $category, $slug ); ?>><?php echo esc_html( $label ); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            <select name="ld_course_price" class="course-select__price">
                <option value="all" <?php selected( $price, '' ); ?>><?php esc_html_e( 'All Price', 'talemy' ); ?></option>
                <option value="free" <?php selected( $price, 'free' ); ?>><?php esc_html_e( 'Free', 'talemy' ); ?></option>
                <option value="paid" <?php selected( $price, 'paid' ); ?>><?php esc_html_e( 'Paid', 'talemy' ); ?></option>
            </select>
        </div>
    </div>
</form>