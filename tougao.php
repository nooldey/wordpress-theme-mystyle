<?php
/*Template Name: TouGao
 * 作者：露兜
 * 博客：http://www.ludou.org/
 * 参考资料：http://www.ludou.org/wordpress-add-contribute-page.html/comment-page-2#comment-3817
 * 修正时间戳函数，使用wp函数current_time('timestamp')替代time()
 * 修改了wp_die函数调用，使用合适的页面title
 * 错误提示，增加点此返回链接
 */
    
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
    global $wpdb;
    $current_url = 'http://www.zhuweisheng.com.cn/postonline';   // 注意修改此处的链接地址
    $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'post' ORDER BY post_date DESC LIMIT 1");
    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( current_time('timestamp') - strtotime($last_post) < 120 ) {
        wp_die('您投稿也太勤快了吧，先歇会儿！<a href="'.$current_url.'">点此返回</a>');
    }        
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    $blog =  isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
    $content =  isset( $_POST['tougao_content'] ) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    // 表单项数据验证
    if ( empty($name) || mb_strlen($name) > 20 ) {
        wp_die('昵称必须填写，且长度不得超过20字。<a href="'.$current_url.'">点此返回</a>');
    }
    
    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        wp_die('Email必须填写，且长度不得超过60字，必须符合Email格式。<a href="'.$current_url.'">点此返回</a>');
    }
    
    if ( empty($title) || mb_strlen($title) > 100 ) {
        wp_die('标题必须填写，且长度不得超过100字。<a href="'.$current_url.'">点此返回</a>');
    }
    
    if ( empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 100) {
        wp_die('内容必须填写，且长度不得超过3000字，不得少于100字。<a href="'.$current_url.'">点此返回</a>');
    }
    
    $post_content = '昵称: '.$name.'<br />Email: '.$email.'<br />blog/link: '.$blog.'<br />内容:<br />'.$content;
  
    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content,
        'post_category' => array($category)
    );

/*将投稿者注册成你本站的订阅者
    require_once(ABSPATH . WPINC . '/registration.php');
	$user_id = username_exists( $name );
if($user_id == NULL) {
    if(mb_strlen($name,"utf-8") != strlen($name) || email_exists($email))
        wp_die('用户名含有非英文字符，或者Email已被注册！');

    $password = '123456'; // 默认的用户密码，自行更改
    $user_id = wp_create_user( $name, $password, $email );

    // 更新用户的网站和角色，角色默认为投稿者contributor，
    // 角色可改成订阅者：subscriber，作者：author
    wp_update_user( array ('ID' => $user_id, 'user_url' => $blog, 'role' => 'subscriber' ) ) ;
}

// 如果用户名已存在，则不添加用户，文章归到管理员名下

// 建立文章与作者关系
$tougao['post_author'] = $user_id;
 */

// 将文章插入数据库
$status = wp_insert_post( $tougao );
  
    if ($status != 0) { 
        // 投稿成功给博主发送邮件
        // somebody#example.com替换博主邮箱
        // My subject替换为邮件标题，content替换为邮件内容
        wp_mail("openzws@163.com","碎碎念投稿审核","碎碎念又有新成员啦~快去看看吧！A new archive was posted into your site , please check it ！");

        wp_die('投稿成功！感谢投稿！<a href="'.$current_url.'">点此返回</a>', '投稿成功');
    }
    else {
        wp_die('投稿失败！<a href="'.$current_url.'">点此返回</a>');
    }
}
?>
<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<div class="article">
<h2><?php the_title(); ?></h2>
<div class="context">
<?php the_content(); ?> 
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<div style="text-align: left; padding-top: 10px;">
<label>昵称:*</label>
</div>
<div>
<input type="text" size="40" value="" name="tougao_authorname" />
</div>
<div style="text-align: left; padding-top: 10px;">
<label>E-Mail:*</label>
</div>
<div>
<input type="text" size="40" value="" name="tougao_authoremail" />
</div>
<div style="text-align: left; padding-top: 10px;">
<label>您的博客/文章来源:</label>
</div>
<div>
<input type="text" size="40" value="" name="tougao_authorblog" />
</div>
<div style="text-align: left; padding-top: 10px;">
<label>文章标题:*</label>
</div>
<div>
<input type="text" size="40" value="" name="tougao_title" />
</div>
<div style="text-align: left; padding-top: 10px;">
<label>分类:*</label>
</div>
<div style="text-align: left;">
<?php wp_dropdown_categories('show_count=1&hierarchical=1'); ?>
</div>
<div style="text-align: left; padding-top: 10px;">
<label>文章内容:*</label>
</div>
<div>
<textarea rows="15" cols="55" name="tougao_content" style="width:665px;"></textarea>
</div>
<br clear="all">
<div style="text-align: center; padding-top: 10px;">
<input type="hidden" value="send" name="tougao_form" />
<input type="submit" value="提交" />
<input type="reset" value="重填" />
</div>
</form>
</div>
</div>
</div>
<?php endwhile; else: ?>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>