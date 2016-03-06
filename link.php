<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
$(".lomolink a").each(function(e){
	$(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+" style=float:left;padding:5px;>");
}); 
});
</script>
<div class="left">
<div class="article"><h2><?php the_title(); ?></h2>
<div class="clear"></div>
<div class="lomolink"><ul>
<?php wp_list_bookmarks('orderby=id&category_orderby=id'); ?></ul>
</div>
<div class="clear"></div>
<div class="context">
<h3>友链须知：</h3><ul>
<li>1.先友后链，添加链接前先彼此了解对方网站，本站优先交换与wordpress及电气相关的独立博客网站的友链；</li>
<li>2.一链定型，我们会不定期检查贵站页面上本站的链接，如有更新，请在本页留言说明；</li>
<li>3.信任为先，对于擅自取消本站链接者，我们将强烈谴责并屏蔽此类不友好的链接，并不再与之交换链接；</li>
<li>4.共同成长，申请网站在百度、谷歌有收录，且收录状态良好，内容丰富有价值、定期更新的站优先，恶意SEO、采集站请绕行；</li>
<li>5.合法合规，本站拒绝添加游戏私服、成人用品、彩票赌博等涉嫌违法违规、商业盈利性质强、涉及版权纠纷的链接。</li></ul>
<h3>本站友链：</h3>
<p>【网站名称】碎碎念ZWS</p>
<p>【网站地址】http://www.zhuweisheng.com.cn/</p>
<p>【图像描述】专注于技术生活，关注wordpress与电气工程！</p><hr>
<?php the_content('Read more...'); ?></div>
</br>
</div>
</div>
<div class="articles">
<?php comments_template(); ?>
</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>