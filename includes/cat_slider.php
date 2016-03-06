<?php
$cat_slider = explode(',', get_option('swt_cat_slider'));
$sliderx = get_option('swt_sliderx');
query_posts(array(
				'posts_per_page' =>$sliderx,
				'category__in' =>$cat_slider,
				'caller_get_posts' => 10,
				)
);
?>