<?php
/**
 * Search template
 *
 * @package Talemy
 * @subpackage Templates
 */

get_header();

talemy_set_template_settings( 'search' );

do_action( 'talemy_content_start' );

do_action( 'talemy_content_banner' );

$post_type = !empty( $_GET['post_type'] ) ? $_GET['post_type'] : array();

?>
<div class="content-search">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="search-count">
					<?php printf( _n( 'About 1 Result', 'About %u Results', talemy_get_query()->found_posts, 'talemy' ), talemy_get_query()->found_posts ); ?>
				</div>
			</div>
			<div class="col-md-8">
			<?php if ( 'sfwd-courses' == $post_type || ( is_array( $post_type ) && in_array( 'sfwd-courses', $post_type ) ) ) {
					get_template_part( 'templates/learndash/search-form' );
				} else {
					get_search_form();
				}
			?>
			</div>
		</div>
	</div>
</div>

<div class="content-wrapper <?php echo esc_attr( talemy_get_setting( 'layout' ) ); ?>">

	<?php
		do_action( 'talemy_container_start' );

		do_action( 'talemy_before_main_content' );

	 	if ( have_posts() ) {

			get_template_part( 'templates/content', 'loop' );
		
		} else {

			get_template_part( 'templates/content', 'none' );
		}

		do_action( 'talemy_after_main_content' );

		do_action( 'talemy_sidebar' );

		do_action( 'talemy_container_end' );
		
	?>
</div>

<?php do_action( 'talemy_content_end' ); ?>

<?php get_footer(); ?>