<div class="clear1"></div>
<div class="roll">
<div class="roll-top"><span><a href="#top">返回顶部</a></span></div>
<div class="roll-fall"><span><a href="#foot">直达底部</a></span></div>
</div>
<div id="footer">
Copyright ©<?php echo gmdate(__('Y')); ?> <a href="<?php echo get_settings('home'); ?>" ><?php bloginfo('name'); ?></a> | 
<a href="tencent://message/?uin=<?php echo stripslashes(get_option('swt_qqhaoma')); ?>" target="_blank"><?php echo stripslashes(get_option('swt_qqming')); ?></a> | 
<a href="mailto:<?php echo stripslashes(get_option('swt_youxianghao')); ?>" target="_blank"><?php echo stripslashes(get_option('swt_youxiangming')); ?></a> | 
<a href="<?php echo get_settings('home'); ?>/sitemap.html" target="_blank">网站地图</a> | 
<?php $icp='Display';?> 
<?php if (get_option('swt_tj') == 'Display') { ?>
<?php echo stripslashes(get_option('swt_tjcode'));if($icp !='Display'){wp_protect();};?><?php } else{} ?>
<?php if (get_option('swt_beian') == 'Display') { ?>
<?php echo stripslashes(get_option('swt_beianhao')); if($icp !='Display'){wp_protect();}; ?><?php } else { } ?> 
 | Mystyle by <a href="http://www.zhuweisheng.com.cn" target="_blank">ZWS</a> | 
Powered by <a href="http://cn.wordpress.org/" title="cn.WordPress.org"> WordPress</a>
</div>
<?php if($icp !='Display')
{wp_protect();};?>
<?php wp_footer(); ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#w-loading div").animate({width:"100%"},800,function(){
setTimeout(function(){jQuery("#w-loading div").fadeOut(500);});});});
</script>
</body>
</html>