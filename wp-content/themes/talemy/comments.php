<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() ) {
	/*
	 * If the current post is protected by a password and the visitor has not yet
	 * entered the password we will return early without loading the comments.
	 */
	return;
}
?>
<div id="comments" class="post-comments">

	<?php if ( have_comments() ) : ?>

		<h4 class="section-heading">
			<span class="title"><?php comments_number( esc_html__( 'Comments', 'talemy' ), esc_html__( '1 Comment', 'talemy' ), esc_html__( '% Comments', 'talemy' ) ); ?></span>
		</h4>
		<div class="comments-wrapper">
			<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'callback'    => 'talemy_comment'
				));
			?>
			</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav class="comments-nav"><?php paginate_comments_links(); ?></nav>
			<?php endif; ?>
		</div>
	
	<?php endif; ?>
	
	<?php if ( !comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
		<div class="comments-wrapper">
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'talemy' ); ?></p>
		</div>
	
	<?php endif; ?>
	<?php

	if ( comments_open() ) :
		$commenter = wp_get_current_commenter();
		$req_name_email = get_option( 'require_name_email' );
		$req_aria = $req_name_email ? " aria-required='true'" : '';
		$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$form_args = $fields_args = array();

		$fields_args['author'] = '<p class="comment-form-author"><input name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . esc_attr( $req_aria ) . ' placeholder="' . esc_attr__( 'Name', 'talemy' ) . ( esc_attr( $req_name_email ) ? '*' : '' ) . '" /></p>';
		$fields_args['email'] = '<p class="comment-form-email"><input name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . esc_attr( $req_aria ) . ' placeholder="' . esc_attr__( 'Email', 'talemy' ) . ( esc_attr( $req_name_email ) ? '*' : '' ) . '"/></p>';
		$fields_args['url'] = '<p class="comment-form-url"><input name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_attr__( 'Website', 'talemy' ) . '" /></p>';
		$fields_args['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /><label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'talemy' ) . '</label></p>';

		$form_args['title_reply'] = '<span>' . esc_html__( 'Leave a Reply', 'talemy' ) . '</span>';
		$form_args['title_reply_to'] = '<span>' . esc_html__( 'Leave a Reply to %s', 'talemy' ) . '</span>';
		$form_args['cancel_reply_link'] = esc_html__( 'Cancel Reply', 'talemy' );
		$form_args['label_submit'] = esc_html__( 'Post Comment', 'talemy' );
		$form_args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="' . esc_attr__( 'Write a comment', 'talemy' ) . '"></textarea></p>';
		$form_args['fields'] = apply_filters( 'comment_form_default_fields', $fields_args );
		$form_args['submit_field'] = '<p class="form-submit">%1$s %2$s</p>';
		$form_args['class_submit'] = 'btn btn-primary';

		comment_form( $form_args );

	endif;
?>
</div>