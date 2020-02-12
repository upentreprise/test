<?php $show_footer_top = talemy_get_option( 'footer_top' );
if ( !$show_footer_top ) {
	return;
}

$footer_top_style = talemy_get_option( 'footer_top_style' );
$footer_loop_count = absint( $footer_top_style );
$footer_row_class = 'row';
$footer_column_class = '';
switch ( $footer_top_style ) {
	case '1':
		$footer_loop_count = 1;
		$footer_column_class = 'col footer-col footer-';
		break;
	case '2':
		$footer_loop_count = 2;
		$footer_column_class = 'col-md-6 footer-col footer-';
		$footer_row_class .= ' footer-2-cols';
		break;
	case '3':
		$footer_loop_count = 3;
		$footer_column_class = 'col-md-4 footer-col footer-';
		$footer_row_class .= ' footer-3-cols';
		break;
	case '4':
		$footer_loop_count = 4;
		$footer_column_class = 'col-md-6 col-lg-3 footer-col footer-';
		break;
	case '5':
		$footer_loop_count = 3;
		$footer_column_class = 'col-md-4 footer-col footer-';
		break;
	case '6':
		$footer_loop_count = 3;
		$footer_column_class = 'col-md-4 footer-col footer-';
		break;
}

?>
<?php if ( is_active_sidebar( 'footer-gallery' ) ) : ?>
	<div class="footer-gallery"><?php dynamic_sidebar( 'footer-gallery' ); ?></div>
<?php endif; ?>
<div class="footer-top">
	<div class="container">
		<?php if ( is_active_sidebar( 'footer-top' ) ) : ?>
		<div class="top-widget-area"><?php dynamic_sidebar( 'footer-top' ); ?></div>
		<?php endif; ?>
		<div class="<?php echo esc_attr( $footer_row_class ); ?>">
		<?php if ( '6' === $footer_top_style ) : ?>
			<div class="col-lg-8">
				<div class="row">
				<?php for ( $i = 1; $i < $footer_loop_count + 1; $i ++ ) : ?>
					<div class="<?php echo esc_attr( $footer_column_class . $i ); ?>">
					<?php if ( is_active_sidebar( 'footer-'. $i ) ) : dynamic_sidebar( 'footer-'. $i ); endif; ?>
					</div>
				<?php endfor; ?>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="footer-col footer-4">
					<?php if ( is_active_sidebar( 'footer-4' ) ) : dynamic_sidebar( 'footer-4' ); endif; ?>
				</div>
			</div>
		<?php elseif ( '5' === $footer_top_style ) : ?>
			<div class="col-xl-6">
				<div class="row">
				<?php for ( $i = 1; $i < $footer_loop_count + 1; $i ++ ) : ?>
					<div class="<?php echo esc_attr( $footer_column_class . $i ); ?>">
					<?php if ( is_active_sidebar( 'footer-'. $i ) ) : dynamic_sidebar( 'footer-'. $i ); endif; ?>
					</div>
				<?php endfor; ?>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="row">
					<div class="col-md-6 footer-col footer-4">
						<?php if ( is_active_sidebar( 'footer-4' ) ) : dynamic_sidebar( 'footer-4' ); endif; ?>
					</div>
					<div class="col-md-6 footer-col footer-5">
						<?php if ( is_active_sidebar( 'footer-5' ) ) : dynamic_sidebar( 'footer-5' ); endif; ?>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php for ( $i = 1; $i < $footer_loop_count + 1; $i ++ ) : ?>
				<?php if ( is_active_sidebar( 'footer-'. $i ) ) : ?>
				<div class="<?php echo esc_attr( $footer_column_class . $i ); ?>">
					<?php dynamic_sidebar( 'footer-'. $i ); ?>
				</div>
				<?php endif; ?>
			<?php endfor; ?>
		<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
			<div class="bottom-widget-area"><?php dynamic_sidebar( 'footer-bottom' ); ?></div>
		<?php endif; ?>
	</div>
</div>