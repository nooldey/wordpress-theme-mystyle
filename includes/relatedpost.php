<div class="Related_Posts">
<ul>
	<?php
	$post_num = 12; 
	global $post;
	$exists_related_ids = array();
	$tmp_post = $post;
	$tags = ''; $i = 0;
	$exists_related_ids[] = $post->ID;
	if ( get_the_tags( $post->ID ) ) {
	foreach ( get_the_tags( $post->ID ) as $tag ) $tags .= $tag->name . ',';
	$tags = strtr(rtrim($tags, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$post->ID);
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?><?php comments_number(' ','(1)','(%)'); ?></a></li>
	<?php
	$exists_related_ids[] = $post->ID;
	$i += 1;
	}
	}
	if ( $i < $post_num ) {
	$post = $tmp_post; setup_postdata($post);
	$cats = ''; 
	$post_num -= $i;
	foreach ( get_the_category( $post->ID ) as $cat ) $cats .= $cat->cat_ID . ',';
	$cats = strtr(rtrim($cats, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&orderby=rand&category='.$cats.'&exclude='. implode(",", $exists_related_ids));
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?><?php comments_number(' ','(1)','(%)'); ?></a></li>
	<?php
	}
	}
	$post = $tmp_post; setup_postdata($post);
	?></ul>
<div class="clear"></div>
</div>