<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 搜索结果</div>
<div class="main">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<li>
<div class="article">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》"><?php echo mb_strimwidth(get_the_title(), 0,40, '...'); ?> </a><span class="new"><?php include('includes/new.php'); ?></span></h2>
<?php if (get_option('swt_thumbnail') == 'Display') { ?>
        <?php if (get_option('swt_articlepic') == 'Display') { ?>
<?php include('includes/articlepic.php'); ?>
    <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
<?php { echo ''; } ?><?php } else { } ?>
<div class="entry_post"><span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"..."); ?></span></div>
<div class="clear"></div>
<div class="info">分类：<?php the_category(', ') ?> &nbsp;  &nbsp; <?php the_tags('标签：', ', ', ''); ?> &nbsp;  &nbsp; 浏览：<?php post_views('', '次'); ?> &nbsp;  &nbsp; 评论：<?php comments_popup_link ('抢沙发','1条吐槽','%条吐槽'); ?> <div class="comments_num"><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》">阅读全文</a></div></div>
</div></li></ul><div class="clear"></div>
		<?php endwhile; else: ?>
<div class="left">
<div class="article">
<div align="center">
<h3 class="center">非常抱歉，找不到你想要的文章，请换一个关键词搜索。</h3>
<h3 class="center">你可以看看右边栏目或者下面的文章归档，可能找到你喜欢的哦。</h3>

</div></div></div>
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
	
<div class="left">
<div class="article">
<div align="center"><h2><?php bloginfo('name'); ?> 共有文章： <?php echo $hacklog_archives->PostCount();?>篇，找找你喜欢的吧。</h2></div>
	<?php echo $hacklog_archives->PostList();?>
</div>
</div>
		<?php endif; ?> 
<div class="navigation"><?php pagination($query_string); ?></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>