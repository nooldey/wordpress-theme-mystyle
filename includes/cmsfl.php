<div id="art_main" class="fl"> 
<?php $display_categories = explode(',', get_option('swt_cat') ); $i = 1; foreach ($display_categories as $category) { ?>
<div class="con_box fl qd_aritle" id="cat-<?php echo $i; ?>"  >
		<?php query_posts("cat=$category")?>
<div class="widgetr">
		<h2><span><a href="<?php echo get_category_link($category);?>" target="_blank"><?php single_cat_title(); ?></a></span></h2>
		<ul class="index_resourse_list qd_list">
		<?php query_posts( array('showposts' => get_option('swt_column_post'),'cat' => $category,'offset' => 0,'post__not_in' => $do_not_duplicate));?>
		<?php while (have_posts()) : the_post(); ?>
		<li><span class="fr"><?php the_time('m-d'); ?></span>			
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,35); ?></a>
		</li>
		<?php endwhile; ?>
		</ul>
</div></div>
	<?php $i++; ?>
	<?php } ?>
</div>