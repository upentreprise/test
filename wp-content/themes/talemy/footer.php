			<footer id="footer">
				<?php get_template_part( 'templates/footer/footer', 'top' ); ?>
				<?php get_template_part( 'templates/footer/footer', 'bottom' ); ?>
			</footer>
			<?php if ( talemy_get_option( 'scroll_top' ) ) : ?>
				<a id="scroll-top" class="scroll-top" href="javascript:void(0)"><i class="ticon-angle-up"></i></a>
			<?php endif; ?>
		</div><!-- site-main -->
	</div><!-- site -->
	<?php wp_footer(); ?>
</body>
</html>