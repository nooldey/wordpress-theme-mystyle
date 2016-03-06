<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt;
			<?php if (have_posts()) : ?> 
			<?php $post = $posts[0]; ?>
			<?php if (is_category()) { ?><?php single_cat_title(); ?>
			<?php } elseif( is_tag() ) { ?><?php single_tag_title(); ?>
			<?php } elseif (is_day()) { ?><?php the_time('Y年n月j日'); ?>发布的所有日志
			<?php } elseif (is_month()) { ?><?php the_time('Y年n月'); ?>发布的所有日志
			<?php } elseif (is_year()) { ?><?php the_time('Y年'); ?>发布的所有日志
			<?php } elseif (is_author()) { ?><?php wp_title( '');?>发布的所有日志
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1>Blog Archives</h1>
			<?php } ?><?php endif; ?></div>
<div class="main">
<!--图片文章列表-->
	<?php $cat_piclist = get_option('swt_cat_piclist') ; 
		  $name_piclist = get_option('swt_name_piclist') ; 
	      $cat_flow = get_option('swt_cat_flow'); 
		  $name_flow = get_option('swt_name_flow') ;
	if($cat == ($cat_piclist) || $cat == get_cat_id($name_piclist) ){ ?><!--分类ID--> 
<?php $posts = query_posts($query_string . '&orderby=date&showposts=16'); ?><!--显示文章数目-->
<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" class="art-pic-list">
					<div class="article">
						<?php if (get_option('swt_thumbnail') == 'Display') { ?>
						<?php if (get_option('swt_articlepic') == 'Display') { ?>
						<?php include('includes/articlepic.php'); ?>
						    <?php { echo ''; } ?>
									<?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
						<?php { echo ''; } ?>
						<?php } else { } ?>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》"><?php echo mb_strimwidth(get_the_title(), 0, 20,"..."); ?></a><span class="new"><?php include('includes/new.php'); ?></span></h2>
						<ul class="info">
							<li>发现宝藏：<?php the_time(Y年n月d日) ?></li>
							<li>已有<?php post_views('', '人'); ?>感兴趣</li>
							<li style="color:#08b;">活动截止：<?php echo get_post_meta($post->ID,"stoptime_value",true);?></li>
							<li><del>原价：￥<?php echo get_post_meta($post->ID,"price_value",true);?></del></li>
							<li style="color:red;font-weight:700;font-size:15px;">特价：￥<?php echo get_post_meta($post->ID,"price2_value",true);?></li>
						
						</ul>
						<div class="inner">
						<div class="taobao_num"><a href="<?php echo get_post_meta($post->ID,"taobao_value",true);?>" rel="bookmark" title="淘宝购买<?php the_title_attribute(); ?>" target="_blank">立即购买</a></div>
						<div class="comments_num"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">查看详细</a></div></div>
					</div>
				</div>
				<?php endwhile; ?>
				<div class="clear"></div>
			<?php endif; ?> 
<!-- 瀑布流 -->
		<?php } elseif($cat == ($cat_flow) || $cat == get_cat_id($name_flow) ){ ?><!--分类ID--> 
		<?php $posts = query_posts($query_string . '&orderby=date&showposts=60'); ?><!--显示文章数目-->
			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/flow.min.js"></script>
			<script type="text/javascript">
			jQuery(function(){
				jQuery(window).load( function() {
					jQuery('.flow-wrapper').BlocksIt({
						numOfCol: 3,
						offsetX: 2,
						offsetY: 2
					});
				});
			});
			</script>
			<?php if (have_posts()) : ?>
				<div class="flow-wrapper">
					<?php while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" class="art-flow">
							<?php if (get_option('swt_thumbnail') == 'Display') { ?>
							<?php if (get_option('swt_articlepic') == 'Display') { ?>
							<?php include('includes/articlepic.php'); ?>
							    <?php { echo ''; } ?>
										<?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
							<?php { echo ''; } ?><?php } else { } ?>
							<div class="entry_post"><span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 94,"..."); ?></span></div>
							<ul class="info">
								<li>点击：<?php post_views('', '次'); ?></li>
								<li>评论：<?php comments_popup_link ('抢沙发','1条吐槽','%条吐槽'); ?></li>
							</ul>		
					</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?> 
		<?php }else{ ?>
<!-- 普通文章列表 -->
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<li>
					<div class="article">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?> </a><span class="new"><?php include('includes/new.php'); ?></span><span class="md"><?php the_time('m月d日') ?></span></h2>
					<?php if (get_option('swt_thumbnail') == 'Display') { ?>
					<?php if (get_option('swt_articlepic') == 'Display') { ?>
					<?php include('includes/articlepic.php'); ?>
					    <?php { echo ''; } ?>
								<?php } else { include(TEMPLATEPATH . '/includes/thumbnail.php'); } ?>
					<?php { echo ''; } ?><?php } else { } ?>
					<div class="entry_post"><span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"..."); ?></span></div>
					<div class="clear"></div>
					<div class="info">分类：<?php the_category(', ') ?> &nbsp;  &nbsp; <?php the_tags('标签：', ', ', ''); ?> &nbsp;  &nbsp; 浏览：<?php post_views('', '次'); ?> &nbsp;  &nbsp; 评论：<?php comments_popup_link ('抢沙发','1条吐槽','%条吐槽'); ?> <div class="comments_num"><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 《<?php the_title_attribute(); ?>》">阅读全文</a></div></div>
										</div>
				</li>
			</ul>
			<div class="clear"></div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php } ?>
		<div class="clear"></div>
		<div class="navigation"><?php pagination($query_string); ?></div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>