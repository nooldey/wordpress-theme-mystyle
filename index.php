<?php get_header(); ?>
<div id="content">
<div class="main">
<?php if (get_option('swt_slider') == 'Display') { ?>
<?php include(TEMPLATEPATH . '/includes/slider.php');  //幻灯片?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slider.js"></script>
<?php } else {echo ''; } ?>
<div class="clear"></div>

<?php
$args = array(
    'posts_per_page' => get_option('swt_wzxs'),
	'caller_get_posts' => 10,
	'post__not_in' =>$do_not_duplicate,
	'paged' => $paged
	);
query_posts($args);?>
	<?php while (have_posts()) : the_post(); ?>
	<?php if (is_home() && in_category('0') ) continue; //选择隐藏的分类ID?>
<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<li>
<div class="article">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?> </a>
<span class="new"><?php include('includes/new.php'); ?></span><span class="md"><?php the_time('m月d日') ?></span></h2>
<?php if (get_option('swt_thumbnail') == 'Display') { ?>
        <?php if (get_option('swt_articlepic') == 'Display') { ?>
<?php include('includes/articlepic.php'); ?>
    <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
<?php { echo ''; } ?><?php } else { } ?>
<div class="entry_post"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"..."); ?></div>
<div class="clear"></div>
<div class="info">分类：<?php the_category(', ') ?> &nbsp;  &nbsp; <?php the_tags('标签：', ', ', ''); ?> &nbsp;  &nbsp; 浏览：<?php post_views('', '次'); ?> &nbsp;  &nbsp; 评论：<?php comments_popup_link ('抢沙发','1条吐槽','%条吐槽'); ?></div>
</div></li></ul><div class="clear"></div>
		<?php endwhile; ?>
		<?php if (get_option('swt_cmsfl') == 'Display') { ?>
					<?php include(TEMPLATEPATH . '/includes/cmsfl.php');  //CMS分栏?>
					<?php } else {echo ''; } ?>

<div class="clear"></div>
<?php if (get_option('swt_adb') == 'Display') { ?>
<div class="adbcode"><?php echo stripslashes(get_option('swt_adbcode')); ?>
</div><?php { echo ''; } ?><?php } else { } ?>	
<div class="clear"></div>		

<div class="navigation"><?php pagination($query_string); ?></div>
</div>
<script type="text/javascript">
jQuery("#w-loading div").animate({width:"40%"});
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>