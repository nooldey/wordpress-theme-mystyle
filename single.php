<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_category(', ') ?> &gt; <?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></div>
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<div class="left">
<div class="article">
<h2 style="text-align: center;"><?php the_title(); ?></h2>
<div class="article_info">作者：<?php the_author() ?> &nbsp;  &nbsp; 发布：<?php the_time('Y-m-d H:i') ?>&nbsp; &nbsp; 浏览：<?php post_views('', '次'); ?> &nbsp; &nbsp; 评论： <?php comments_popup_link ('抢沙发','1条吐槽','%条吐槽'); ?>  &nbsp; &nbsp; <?php edit_post_link('编辑', ' [ ', ' ] '); ?></div>
<div class="clear"></div>
        <div class="context">
        <?php the_content('Read more...'); ?><br/>
<div class="banquan">
<div class="postinfo">
<!-- Baidu Button BEGIN --><span class="fxd">分享到：</span>
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_tsina"></a>
<a class="bds_tsohu"></a>
<a class="bds_t163"></a>
<a class="bds_renren"></a>
<a class="bds_hi"></a>
<a class="bds_kaixin001"></a>
<a class="bds_ty"></a>
<span class="bds_more"></span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1&amp;uid=6429180" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
</div>
		<p>本文固定链接: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?></a><br/>
		<?php   $custom_fields = get_post_custom_keys($post_id);
if (!in_array ('zhuanzai', $custom_fields)) : ?>
栏目：<?php the_category(', ') ?><br/><?php the_tags('标签：', ', ', ''); ?><br/>
原创文章转载请注明：<a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?>  - <?php bloginfo('name');?></a><br/></p>
<?php else: ?>
<?php  $custom = get_post_custom($post_id);
$custom_value = $custom['zhuanzai']; ?>
本文由（<a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a>）整编自 <a target="_blank" rel="nofollow" href="<?php echo $custom_value[0] ?>" ><?php echo $custom_value[0] ?></a>
<br/></p>
<?php endif; ?>
</div>
<div class="con_pretext clearfix">
<ul>
<li class="first">上一篇：<?php if (get_previous_post()) { previous_post_link('%link','%title',true);} else { echo '已是最后文章';} ?></li>
<li class="last">下一篇：<?php if (get_next_post()) { next_post_link('%link','%title',true);} else { echo '已是最新文章';} ?></li>
</ul>
</div>
</div>
</div>
</div>

<?php if (get_option('swt_adc') == 'Display') { ?>
<div class="clear"></div>
<div class="adccode"><?php echo stripslashes(get_option('swt_adccode')); ?></div><?php { echo ''; } ?><?php } else { } ?>

<?php if (get_option('swt_xiangguan') == 'Display') { ?>
<div class="xiangguan">
<h3>猜你也喜欢:</h3>
<?php include('includes/relatedpost.php'); ?>
<div class="clear"></div>
</div>
<?php { echo ''; } ?><?php } else { } ?>


<div class="articles">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>
<!-- 将此代码放在适当的位置，建议在body结束前 -->
<script id="bdimgshare_shell"></script>
<script>
var bdShare_config_imgshare = {
	"type":"list"
	,"size":"small"
	,"pos":"top"
	,"color":"black"
	,"list":["qzone","tsina","tqq","renren","t163"]
	,"uid":"6429180"
};
document.getElementById("bdimgshare_shell").src="http://bdimg.share.baidu.com/static/js/imgshare_shell.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>