<?php
$next = is_rtl() ? '<i class="fas fa-chevron-left"></i>' : '<i class="fas fa-chevron-right"></i>';
$prev = is_rtl() ? '<i class="fas fa-chevron-right"></i>' : '<i class="fas fa-chevron-left"></i>';
$total = talemy_get_query()->max_num_pages;
$max = 999999999;

if ( $total < 2 ) {
	return;
}

?>
<div class="pagination numeric">
	<div class="d-inline-block align-top"><?php
	 	echo paginate_links( array(
				'base'			=> str_replace( $max, '%#%', esc_url( get_pagenum_link( $max ) ) ),
				'format'		=> '&paged=%#%',
				'current'		=> max( 1, talemy_get_query()->get('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'plain',
				'prev_text'		=> $prev,
				'next_text'		=> $next
			));
 	?></div>
</div>