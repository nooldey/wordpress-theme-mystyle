<h3><span class="selected">博主寄语</span><span>网站概况</span><span>会员登录</span></h3>
	<div id="tab-content">
		<ul><?php if (get_option('swt_notice') == 'Display') { ?>
<div class="notice">
 <div class="notice_content"><?php echo stripslashes(get_option('swt_noticecode')); ?></div></div>
 <?php { echo ''; } ?><?php } else { } ?>
</ul>
		<ul class="hide"><li>日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
<li>评论总数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments where comment_author!='".(get_option('swt_user'))."'");?> 篇</li>
<li>标签数量：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
<li>链接总数：<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> 个</li>
<li>建站日期：<?php echo get_option('swt_builddate'); ?></li>
<li>运行天数：<?php echo floor((time()-strtotime(get_option('swt_builddate')))/86400); ?> 天</li>
<li>最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></li>
</ul>
		<ul class="hide">
		<!--会员登录模块--> 
<?php if (!(current_user_can('level_0'))){ ?> <form name="loginform2" id="loginform2" action="<?php echo get_option('siteurl'); ?>/wp-login.php" method="post"> <p class="login-username"> <label for="user_login">用户名</label> <input type="text" name="log" id="user_login" class="input" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20"> </p> <p class="login-password"> <label for="user_pass">密码</label> <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"> </p> <p class="login-remember"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="remenberme">记住我</label></p> <p class="login-submit"> <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" /> <input type="submit" name="submit" value="登陆" /></p></form><div><p>敢给我直接点登陆试试！</p></div><?php } else { ?> 
<!---username start--->
<?php if(is_user_logged_in()) {global $current_user; get_currentuserinfo(); echo('用户ID: ' . $current_user->ID . '<br/>');   echo('用户名: ' . $current_user->user_login . '<br/>'); echo('昵称: ' . $current_user->display_name . '<br/>'); echo('权限: ' . $current_user->user_level . '<br/>'); }?> </a><!-------------username end---------> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/">站点管理</a>| <a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="">退出</a><?php }?>
<!--会员登录模块结束-->
</ul>
					</div>