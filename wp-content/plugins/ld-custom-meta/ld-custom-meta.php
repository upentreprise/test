<?php
/**
 * Plugin Name: LearnDash Custom Meta
 * Plugin URI: https://themespirit.com
 * Description: Add custom meta fields for LearnDash
 * Author: ThemeSpirit
 * Author URI: https://themespirit.com
 * Version: 1.0.1
 * Text Domain: ld-custom-meta
 * Domain Path: languages
 */

if ( !defined( 'LDCM_VERSION' ) ) define( 'LDCM_VERSION', '1.0.1' );
if ( !defined( 'LDCM_DIR' ) ) define( 'LDCM_DIR', plugin_dir_path( __FILE__ ) );

require_once( LDCM_DIR . 'includes/functions.php' );

add_action( 'plugins_loaded', 'ldcm_load_plugin_textdomain' );
add_action( 'add_meta_boxes', 'ldcm_add_metabox' );
add_action( 'save_post', 'ldcm_save_metabox', 20, 3 );

/**
 * Load textdomain
 */
function ldcm_load_plugin_textdomain() {
	load_plugin_textdomain( 'ld-custom-meta', false, LDCM_DIR . 'languages' );
}

/**
 * Register custom meta box
 */
function ldcm_add_metabox( $post_type = '' ) {
	if ( ( !empty( $post_type ) ) && ( in_array( $post_type, array( 'sfwd-courses', 'sfwd-lessons', 'sfwd-topic', 'sfwd-quiz' ) ) ) ) {
		add_meta_box( 'ld-custom-metabox', esc_html__( 'LearnDash Custom Meta', 'ld-custom-meta' ), 'ldcm_print_metabox', array( 'sfwd-courses', 'sfwd-lessons', 'sfwd-topic', 'sfwd-quiz' ), 'advanced', 'high', array() );
	}
}

/**
 * Prints custom meta box
 * 
 * @param  object $post Current post object
 */
function ldcm_print_metabox( $post ) {
	$settings = get_post_meta( $post->ID, '_ld_custom_meta', true );
	$headline = isset( $settings['headline'] ) ? $settings['headline'] : '';
	$short_desc = isset( $settings['short_desc'] ) ? $settings['short_desc'] : '';
	$duration = isset( $settings['duration'] ) ? $settings['duration'] : '';
	$lessons = isset( $settings['lessons'] ) ? $settings['lessons'] : '';
	$enrolled = isset( $settings['enrolled'] ) ? $settings['enrolled'] : '';
	$content_type = isset( $settings['content_type'] ) ? $settings['content_type'] : '';
    $content_types = apply_filters( 'ldcm_content_types', array(
        'far fa-file-alt'     => esc_html__( 'Text', 'ld-custom-meta' ),
        'fas fa-play-circle'  => esc_html__( 'Video', 'ld-custom-meta' ),
        'fas fa-headphones'   => esc_html__( 'Audio', 'ld-custom-meta' ),
        'far fa-image'        => esc_html__( 'Image', 'ld-custom-meta' ),
        'fas fa-tv'           => esc_html__( 'Presentation', 'ld-custom-meta' ),
        'fas fa-edit'         => esc_html__( 'Assignment', 'ld-custom-meta' )
    ));
    $embed_code = isset( $settings['embed_code'] ) ? $settings['embed_code'] : '';
    $video_html = '<video width="100%" controls><source src="video-file.webm" type="video/webm"></video>';

	wp_nonce_field( 'ld_custom_meta', 'ld_custom_meta_nonce' ); ?>
	<div class="sfwd sfwd_options">
		<?php if ( 'sfwd-courses' == get_post_type( $post->ID ) ) : ?>
		<div class="sfwd_input" id="ldcm_headline_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_headline_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Course Headline', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<textarea name="ldcm_headline" id="ldcm_headline"><?php echo wp_kses_post( $headline ); ?></textarea>
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_headline_help">
					<label class="sfwd_help_text"><?php esc_html_e( 'A short description of the course below the course title', 'ld-custom-meta' ); ?>
					</label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<div class="sfwd_input" id="ldcm_short_desc_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_short_desc_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Course Short Description', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<textarea name="ldcm_short_desc" id="ldcm_short_desc"><?php echo wp_kses_post( $short_desc ); ?></textarea>
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_short_desc_help">
					<label class="sfwd_help_text"><?php esc_html_e( 'A short description of the course to show on course list', 'ld-custom-meta' ); ?>
					</label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<?php endif; ?>
		<div class="sfwd_input" id="ldcm_duration_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_duration_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Estimated Duration', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<input name="ldcm_duration" id="ldcm_duration" type="text" value="<?php echo esc_attr( $duration ); ?>">
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_duration_help">
					<label class="sfwd_help_text"><?php esc_html_e( 'e.g. 5min, 1hour', 'ld-custom-meta' ); ?>
					</label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<?php if ( 'sfwd-courses' == get_post_type( $post->ID ) ) :
			$course_level = isset( $settings['level'] ) ? $settings['level'] : '';
            $course_levels = apply_filters( 'ldcm_course_levels', array(
            	esc_html__( 'All Levels', 'ld-custom-meta' ),
                esc_html__( 'Beginner', 'ld-custom-meta' ),
                esc_html__( 'Intermediate', 'ld-custom-meta' ),
                esc_html__( 'Advanced', 'ld-custom-meta' )
            ));
            $language = isset( $settings['language'] ) ? $settings['language'] : '';
			?>
			<div class="sfwd_input" id="ldcm_level_field">
				<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
					<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_level_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
					<label class="sfwd_label textinput"><?php esc_html_e( 'Course Level', 'ld-custom-meta' ); ?></label></a>
				</span>
				<span class="sfwd_option_input">
					<div class="sfwd_option_div">
						<select name="ldcm_level" id="ldcm_level">
							<option value="" <?php selected( '', $course_level ); ?>><?php esc_html_e( 'Select', 'ld-custom-meta' ); ?></option>
							<?php foreach ( $course_levels as $level ) : ?>
								<option value="<?php echo esc_attr( $level ); ?>" <?php selected( $level, $course_level ); ?>><?php echo esc_html( $level ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="sfwd_help_text_div" style="display:none" id="ldcm_level_help">
						<label class="sfwd_help_text"></label>
					</div>
				</span>
				<p style="clear:left"></p>
			</div>
			<div class="sfwd_input" id="ldcm_language_field">
				<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
					<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_language_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
					<label class="sfwd_label textinput"><?php esc_html_e( 'Course Language', 'ld-custom-meta' ); ?></label></a>
				</span>
				<span class="sfwd_option_input">
					<div class="sfwd_option_div">
						<input name="ldcm_language" id="ldcm_language" type="text" value="<?php echo esc_attr( $language ); ?>">
					</div>
					<div class="sfwd_help_text_div" style="display:none" id="ldcm_language_help">
						<label class="sfwd_help_text"></label>
					</div>
				</span>
				<p style="clear:left"></p>
			</div>
			<div class="sfwd_input" id="ldcm_lessons_field">
				<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
					<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_lessons_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
					<label class="sfwd_label textinput"><?php esc_html_e( 'Number of Lessons', 'ld-custom-meta' ); ?></label></a>
				</span>
				<span class="sfwd_option_input">
					<div class="sfwd_option_div">
						<input name="ldcm_lessons" id="ldcm_lessons" type="text" value="<?php echo esc_attr( $lessons ); ?>">
					</div>
					<div class="sfwd_help_text_div" style="display:none" id="ldcm_lessons_help">
						<label class="sfwd_help_text"></label>
					</div>
				</span>
				<p style="clear:left"></p>
			</div>
			<div class="sfwd_input" id="ldcm_enrolled_field">
				<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
					<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_enrolled_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
					<label class="sfwd_label textinput"><?php esc_html_e( 'Students Enrolled', 'ld-custom-meta' ); ?></label></a>
				</span>
				<span class="sfwd_option_input">
					<div class="sfwd_option_div">
						<input name="ldcm_enrolled" id="ldcm_enrolled" type="text" value="<?php echo esc_attr( $enrolled ); ?>">
					</div>
					<div class="sfwd_help_text_div" style="display:none" id="ldcm_enrolled_help">
						<label class="sfwd_help_text"><?php esc_html_e( 'Number of students enrolled to the course.', 'ld-custom-meta' ); ?>
						</label>
					</div>
				</span>
				<p style="clear:left"></p>
			</div>
		<?php endif; ?>
		<div class="sfwd_input" id="ldcm_content_type_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_content_type_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Content Type', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<select name="ldcm_content_type" id="ldcm_content_type">
						<option value="" <?php selected( '', $content_type ); ?>><?php esc_html_e( 'Select', 'ld-custom-meta' ); ?></option>
						<?php foreach ( $content_types as $icon => $label ) : ?>
							<option value="<?php echo esc_attr( $icon ); ?>" <?php selected( $icon, $content_type ); ?>><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_content_type_help">
					<label class="sfwd_help_text"></label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<div class="sfwd_input" id="ldcm_custom_icon_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_custom_icon_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Content Type Icon', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<input name="ldcm_custom_icon" id="ldcm_custom_icon" type="text" value="<?php echo esc_attr( $custom_icon ); ?>">
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_custom_icon_help">
					<label class="sfwd_help_text"><?php esc_html_e( 'e.g. fas fa-play-circle', 'ld-custom-meta' ); ?>
					</label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<div class="sfwd_input" id="ldcm_embed_code_field">
			<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
				<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_embed_code_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
				<label class="sfwd_label textinput"><?php esc_html_e( 'Media Embed', 'ld-custom-meta' ); ?></label></a>
			</span>
			<span class="sfwd_option_input">
				<div class="sfwd_option_div">
					<textarea name="ldcm_embed_code" id="ldcm_embed_code" type="text" value="<?php echo esc_attr( $custom_icon ); ?>" rows="2" cols="57"><?php echo esc_textarea( $embed_code ); ?></textarea>
				</div>
				<div class="sfwd_help_text_div" style="display:none" id="ldcm_embed_code_help">
					<label class="sfwd_help_text"><?php _e( 'Paste the direct video URL or video embed code. If you have a video file URL, then you can use the video tag to embed your video like this:', 'ld-custom-meta' ); ?><code><?php echo esc_html( $video_html ); ?></code>
					</label>
				</div>
			</span>
			<p style="clear:left"></p>
		</div>
		<?php if ( defined( 'LEARNDASH_WOOCOMMERCE_FILE' ) && 'sfwd-courses' == get_post_type( $post->ID ) ) : ?>
			<div class="sfwd_input" id="ldcm_related_product_field">
				<span class="sfwd_option_label" style="text-align:right;vertical-align:top;">
					<a class="sfwd_help_text_link" style="cursor:pointer;" title="Click for Help!" onclick="toggleVisibility( 'ldcm_related_product_help' );"><img src="<?php echo esc_url( LEARNDASH_LMS_PLUGIN_URL . 'assets/images/question.png' ); ?>">
					<label class="sfwd_label textinput"><?php esc_html_e( 'Related Product', 'ld-custom-meta' ); ?></label></a>
				</span>
				<span class="sfwd_option_input">
					<div class="sfwd_option_div">
						<?php $related_product = isset( $settings['related_product'] ) ? $settings['related_product'] : ''; ?>
						<select name="ldcm_related_product" id="ldcm_related_product">
							<option value="" <?php selected( '', $related_product ); ?>><?php esc_html_e( 'Select', 'ld-custom-meta' ); ?></option>
						<?php
							$products = get_posts( array(
								'post_type' => 'product',
								'post_status' => 'publish',
								'posts_per_page' => -1,
					        ) );
					        foreach ( $products as $product ) : ?>
					        	<option value="<?php echo esc_attr( $product->ID ); ?>" <?php selected( $product->ID, $related_product ); ?>><?php echo esc_html( $product->post_title ); ?></option>
					        <?php endforeach; ?>
						</select>
					</div>
					<div class="sfwd_help_text_div" style="display:none" id="ldcm_related_product_help">
						<label class="sfwd_help_text"></label>
					</div>
				</span>
				<p style="clear:left"></p>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Save custom meta box
 * 
 * @param int  $post_id  post ID
 */
function ldcm_save_metabox( $post_id ) {
	
	if ( !in_array( get_post_type(), array( 'sfwd-courses', 'sfwd-lessons', 'sfwd-topic', 'sfwd-quiz' ) ) ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( !isset( $_POST['ld_custom_meta_nonce'] ) || !wp_verify_nonce( $_POST['ld_custom_meta_nonce'], 'ld_custom_meta' ) ) {
		return;
	}

	global $wpdb;
	$meta_value = array();

	if ( !empty( $_POST['ldcm_duration'] ) ) {
		$meta_value['duration'] = sanitize_text_field( $_POST['ldcm_duration'] );
	}

	if ( !empty( $_POST['ldcm_content_type'] ) ) {
		$meta_value['content_type'] = sanitize_text_field( $_POST['ldcm_content_type'] );
	}

	if ( !empty( $_POST['ldcm_custom_icon'] ) ) {
		$meta_value['custom_icon'] = sanitize_text_field( $_POST['ldcm_custom_icon'] );
	}

	if ( !empty( $_POST['ldcm_embed_code'] ) ) {
		$meta_value['embed_code'] = wp_kses( $_POST['ldcm_embed_code'], ldcm_get_allowed_html_for_embed() );
	}

	if ( 'sfwd-courses' == get_post_type() ) {

		if ( !empty( $_POST['ldcm_headline'] ) ) {
			$meta_value['headline'] = wp_kses_post( $_POST['ldcm_headline'] );
		}

		if ( !empty( $_POST['ldcm_short_desc'] ) ) {
			$meta_value['short_desc'] = wp_kses_post( $_POST['ldcm_short_desc'] );
		}

		if ( !empty( $_POST['ldcm_level'] ) ) {
			$meta_value['level'] = sanitize_text_field( $_POST['ldcm_level'] );
		}

		if ( !empty( $_POST['ldcm_language'] ) ) {
			$meta_value['language'] = sanitize_text_field( $_POST['ldcm_language'] );
		}

		if ( !empty( $_POST['ldcm_enrolled'] ) ) {
			$meta_value['enrolled'] = absint( $_POST['ldcm_enrolled'] );
		}

		if ( !empty( $_POST['ldcm_lessons'] ) ) {
			$meta_value['lessons'] = absint( $_POST['ldcm_lessons'] );
		}

		if ( !empty( $_POST['ldcm_related_product'] ) ) {
			$meta_value['related_product'] = absint( $_POST['ldcm_related_product'] );
		}
	}

	update_post_meta( $post_id, '_ld_custom_meta', $meta_value );
}