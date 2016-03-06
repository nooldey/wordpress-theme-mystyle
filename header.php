<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />  
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/
<?php if (get_option('swt_timestyle') == 'Display') { 
$hourdiff = "8"; $timeadjust = ($hourdiff * 60 * 60);$melbdate = date("H",time() + $timeadjust);
    if($melbdate < 12)
	    if(get_option('swt_qianstyle')=='green.css')
           echo 'css/green.css';
		else
		   echo 'style.css';
    else
        if(get_option('swt_houstyle')=='green.css')
           echo 'css/green.css';
		else
		   echo 'style.css';
?>
   <?php { echo ''; } ?>
			<?php } else {
			if(get_option('swt_morenstyle')=='green.css')
           echo 'css/green.css';
		    else
		   echo 'style.css'; } ?>
" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/includes/highlight.css" />
<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/realgravatar.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/hoveraccordion.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lomo.js"></script>
<?php include('includes/lazyload.php'); ?>
</head>
<body oncopy="return true;" oncut="return true;">
<div id="w-loading"><div></div></div>
<script type="text/javascript">jQuery("#w-loading div").animate({width:"20%"});</script>
<div id="page">
<div id="header">
<div class="footnav"><div class="inner"><?php if(function_exists('wp_nav_menu')) { wp_nav_menu(array('theme_location'=>'footnav','menu_id'=>'nav','container'=>'ul'));}?>
<div id="rss"><ul>
<li class="rssfeed"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="icon1" title="欢迎订阅<?php bloginfo('name'); ?>"></a></li>
<?php if (get_option('swt_tqq') == 'Display') { ?><li class="tqq"><a href="<?php echo stripslashes(get_option('swt_tqqurl')); ?>" target="_blank" class="icon2" title="我的腾讯微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_tsina') == 'Display') { ?><li class="tsina"><a href="<?php echo stripslashes(get_option('swt_tsinaurl')); ?>" target="_blank" class="icon3" title="我的新浪微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_mailqq') == 'Display') { ?><li class="rssmail"><a href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url'); ?>" target="_blank" class="icon4" title="用QQ邮箱阅读空间订阅我的博客"></a></li><?php { echo ''; } ?><?php } else { } ?>
</ul></div>
<div class="search">
			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<input type="text" onfocus="if(this.value=='哔！语音搜索中...'){this.value='';}" onblur="if(this.value==''){this.value='哔！语音搜索中...';}" value="哔！语音搜索中..." name="s" id="s" x-webkit-speech="">
				<button type="submit"><?php _e("Search"); ?></button>
			</form>
		</div>
</div></div>
<div class="clear"></div>
<div id="top">
<div id="top_logo">
            <?php if (get_option('swt_logo') == 'Display') { ?>
    <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>"><div class="logo"></div></a>
    <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/logo.php'); } ?>
</div>
<div id="stime">			
			<embed src="http://www.niaome.com/upload/honehone_clock_tr.swf" quality="high" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="200" height="88">
		</div>
<div class="clear"></div>
</div>
<div class="topnav">
		<?php if(function_exists('wp_nav_menu')) { wp_nav_menu(array('theme_location'=>'primary','menu_id'=>'nav','container'=>'ul'));}?>		
</div>
</div>
<div class="clear1"></div>