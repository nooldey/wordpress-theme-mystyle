<?php
/*
Template Name: Tags
*/
?>
<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
<div class="main"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<div class="article">
<h2><?php the_title(); ?></h2>
        <div class="context"><?php wp_tag_cloud('smallest=14&largest=14&unit=px&number=0&orderby=count&order=RAND');?></div>
</div>
</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>