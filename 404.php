<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 未知页面</div>
<div class="left">
<div class="article">
<div align="center">
<h3 class="center">o(╯□╰)o没找到你要的东东...</h3>
<h3 class="center">您可以使用本站的搜索框搜索您想要的内容，如有不便深感抱歉！</h3>
<h3 class="center">你也可以看看右边栏目或者下面的文章归档，可能找到你喜欢的哦。</h3>
<iframe scrolling='no' frameborder='0' src='http://yibo.iyiyun.com/js/yibo404/key/'246 width='640' height='462' style='display:block;'></iframe>
<h3 class="center">请站长们支持公益广告，添加404公益广告位<a href="http://yibo.iyiyun.com/yibo404">益播公益传播平台</a></h3>
</div>
</div>
</div>

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
<div class="articles">
<div align="center"><h2><?php bloginfo('name'); ?> 共有文章： <?php echo $hacklog_archives->PostCount();?>篇，找找你感兴趣的吧！</h2></div>
<hr>
	<?php echo $hacklog_archives->PostList();?>
</div>
</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>