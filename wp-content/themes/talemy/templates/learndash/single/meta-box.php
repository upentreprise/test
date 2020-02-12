<?php $course_extra = get_post_meta( get_the_ID(), '_ld_custom_meta', true ); ?>
<div class="course-meta-box">
	<div class="row no-gutters">
		<div class="col-md-3">
			<div class="course-meta-box__label first"><?php esc_html_e( 'Category', 'talemy' ); ?></div>
			<div class="course-meta-box__content"><?php echo talemy_get_ld_course_categories(); ?></div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label"><?php esc_html_e( 'Level', 'talemy' ); ?></div>
			<div class="course-meta-box__content"><?php echo esc_html( $course_extra['level'] ); ?></div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label"><?php esc_html_e( 'Language', 'talemy' ); ?></div>
			<div class="course-meta-box__content"><?php echo esc_html( $course_extra['language'] ); ?></div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label last"><?php esc_html_e( 'Review', 'talemy' ); ?></div>
			<div class="course-meta-box__content"><?php do_action( 'ldcr_course_rating', get_the_ID(), true, true, true ); ?></div>
		</div>
	</div>
	<div class="row no-gutters">
		<div class="col-md-3">
			<div class="course-meta-box__label first"><?php echo LearnDash_Custom_Label::get_label( 'lessons' ); ?></div>
			<div class="course-meta-box__content">
			<?php if ( !empty( $course_extra['lessons'] ) ) : ?>
			<?php echo esc_html( $course_extra['lessons'] ); ?>
			<?php endif; ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label"><?php esc_html_e( 'Duration', 'talemy' ); ?></div>
			<div class="course-meta-box__content"><?php echo esc_html( $course_extra['duration'] ); ?></div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label"><?php esc_html_e( 'Students', 'talemy' ); ?></div>
			<div class="course-meta-box__content">

			</div>
		</div>
		<div class="col-md-3">
			<div class="course-meta-box__label last"></div>
			<div class="course-meta-box__content"></div>
		</div>
	</div>
</div>