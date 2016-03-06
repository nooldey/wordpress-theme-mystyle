<div id="sidebar">

<?php if (in_category(5) & is_single() ){include('includes/article_right.php');}else{ } //在指定分类下调用?><div id="rollstart"></div><!--滑动模块开始-->

<div class="widget"><div class="widgetr"><div id="tab-title"><?php include('includes/r_static.php'); ?></div></div></div>

<div class="widget"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具1') ) : ?>
	<?php endif; ?>
</div>

<div class="widget"><div class="widgetr"><div id="tab-title"><?php include('includes/r_tab.php'); ?></div></div></div>

<?php if (get_option('swt_ada') == 'Display') { ?>
<div class="widget"><div class="sponsor">
  <h3>Ad Time</h3>
  <?php echo stripslashes(get_option('swt_adacode')); ?></div></div><?php { echo ''; } ?><?php } else { } ?>

<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具2') ) : ?>
	<?php endif; ?>
</div>

<div class="widget"><?php include('includes/r_tags.php'); ?></div>

<div class="widgets"><div class="top_comment">
	<?php if (get_option('swt_wallreaders') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/top_comment.php'); } ?></div>
</div>

<div class="widget"><?php include('includes/r_comment.php'); ?></div>

<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具3') ) : ?>
	<?php endif; ?>
</div>

<?php wp_reset_query(); if ( is_home() ) { ?> 
<div class="widget">
<div class="widgetr">
<div class="r_links">
<h3>我的小伙伴们</h3>
<div class="v-links"><ul><?php wp_list_bookmarks('orderby=link_id&categorize=0&category=66&title_li='); ?></ul>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<script type="text/javascript">
jQuery("#w-loading div").animate({width:"60%"});
</script>