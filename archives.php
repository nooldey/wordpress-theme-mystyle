<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
	<script type="text/javascript">
		/* <![CDATA[ */
			jQuery(document).ready(function() {
                function setsplicon(c, d) {
                    if (c.html()=='+' || d=='+') {
                        c.html('-');
                        c.removeClass('car-plus');
                        c.addClass('car-minus');
                    } else if( !d || d=='-'){
                        c.html('+');
                        c.removeClass('car-minus');
                        c.addClass('car-plus');
                    }
                }
				jQuery('.car-collapse').find('.car-yearmonth').click(function() {
					jQuery(this).next('ul').slideToggle('fast');
                    setsplicon(jQuery(this).find('.car-toggle-icon'));
				});
				jQuery('.car-collapse').find('.car-toggler').click(function() {
					if ( '展开所有月份' == jQuery(this).text() ) {
						jQuery(this).parent('.car-container').find('.car-monthlisting').show();
						jQuery(this).text('折叠所有月份');
                       setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '+');
					}
					else {
						jQuery(this).parent('.car-container').find('.car-monthlisting').hide();
						jQuery(this).text('展开所有月份');
                        setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '-');
					}
					return false;
				});
			});
		/* ]]> */
	</script>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<div class="article">
<h2>文章归档</h2>
		<p class="articles_all"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a>目前共有文章：  <?php echo $hacklog_archives->PostCount();?>篇	</p>
	<?php echo $hacklog_archives->PostList();?>
</div>
</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>