<?php 
$sliderx = get_option('swt_sliderx');
query_posts(array(
				'posts_per_page' =>$sliderx,
				'post__in'  => get_option('sticky_posts'),
				'caller_get_posts' => 10
				)
);
?>