<div id="box">
 <div id="container">
		<?php if (get_option('swt_sliders') == '特定分类的文章') { ?>
		<?php include(TEMPLATEPATH . '/includes/cat_slider.php'); ?>
		<?php } else { include(TEMPLATEPATH . '/includes/sti_slider.php'); } ?>
		
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
        <div class="item">
			<div class="slititle"><h3><a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="猛戳畅读 《<?php the_title_attribute(); ?>》"><?php echo mb_strimwidth(get_the_title(), 0, 38, '...'); ?></a></h3></div>
        <div class="pic">
		<a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="<?php the_title(); ?>">
	    <?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { ?>
	    <img class="home-thumb" title="<?php the_title(); ?>" src="<?php echo catch_first_image() ?>" alt="<?php the_title(); ?>"/>
	    <?php } ?></a></div>
<div class="con_post"><?php echo mb_strimwidth(strip_tags(apply_filters('the_excerpt', $post->post_content)), 0, 400,"...");?></div>
</div>
<div class="clear"></div>
 <?php endwhile; ?>
<?php endif; ?>	

	</div> 
    <div id="control"></div>
</div>