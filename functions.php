<?php
include("includes/theme_options.php");
include("includes/shortcode.php");

//评论跳转   
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);   
add_filter('comment_text', 'add_redirect_comment_link', 99);   
function add_redirect_comment_link($text = ''){   
    $text=str_replace('href="', 'href="'.get_option('home').'/?r=', $text);   
    $text=str_replace("href='", "href='".get_option('home')."/?r=", $text);   
    return $text;   
}   
add_action('init', 'redirect_comment_link');   
function redirect_comment_link(){   
    $redirect = $_GET['r'];   
    if($redirect){   
        if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){   
            header("Location: $redirect");   
            exit;   
        }   
        else {    
header("Location: http://www.zhuweisheng.com.cn/");   
exit;   
}   
}   
}  

//自定义登录页面
function custom_login_logo() { echo '<link rel="stylesheet" id="wp-admin-css" href="'.get_bloginfo('template_directory').'/admstyle.css" type="text/css" />';}
add_action('login_head', 'custom_login_logo');
//防止冒充博主
function usecheck($incoming_comment) {
    $isSpam = 0;
    // 将 碎碎念 改成博主昵称
    if (trim($incoming_comment['comment_author']) == '碎碎念')
        $isSpam = 1;
    // 将 openzws@163.com 改成博主Email
    if (trim($incoming_comment['comment_author_email']) == 'openzws@163.com')
        $isSpam = 1;
    if(!$isSpam)
        return $incoming_comment;
    wp_die('请勿冒充博主发表评论');
}
if(!is_user_logged_in())
    add_filter( 'preprocess_comment', 'usecheck' );
//此段结束

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'name'			=> '小工具1',
        'before_widget'	=> '<div class="r_widget">',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '小工具2',
        'before_widget'	=> '<div class="r_widget">',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '小工具3',
        'before_widget'	=> '<div class="r_widget">',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '</div>',
    ));
}

/*淘宝商品信息*/
$new_meta_boxes =
array(
    "price" => array(
        "name" => "price",
        "std" => "",
        "title" => "原价:（直接输入价格即可，含小数点两位，例：28.00）"),

	"price2" => array(
        "name" => "price2",
        "std" => "",
        "title" => "特价:（直接输入价格即可，含小数点两位，例：28.00）"),

	"stoptime" => array(
        "name" => "stoptime",
		"std" => "年月日",
        "title" => "截止日期:（填入年月日）"),

    "taobaolink" => array(
        "name" => "taobao",
        "std" => "",
        "title" => "淘宝购买链接:（别忘记加http://：）")
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;
    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<h4>'.$meta_box['title'].'</h4>';
        echo '<textarea cols="60" rows="2" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }    
    echo '<input type="hidden" name="newmetaboxes_noncename" id="newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '输入产品相关信息', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $new_meta_boxes;    
    if ( !wp_verify_nonce( $_POST['newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;    
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;                    
    foreach($new_meta_boxes as $meta_box) {
        $data = $_POST[$meta_box['name'].'_value'];
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

/*导航菜单*/
if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array('primary' => '导航菜单'));
    register_nav_menus(array('footnav' => '顶部导航'));
}

/* 访问计数 */
function record_visitors()
{
if (is_singular())
{
global $post;
$post_ID = $post->ID;
if($post_ID)
{
$post_views = (int)get_post_meta($post_ID, 'views', true);
if(!update_post_meta($post_ID, 'views', ($post_views+1)))
{
add_post_meta($post_ID, 'views', 1, true);
}
}
}
}
add_action('wp_head', 'record_visitors');

/// 函数名称：post_views 

/// 函数作用：取得文章的阅读次数

function post_views($before = '(点击 ', $after = '次)', $echo = 1)

{

global $post;

$post_ID = $post->ID;

$views = (int)get_post_meta($post_ID,'views', true);

if ($echo) echo $before, number_format($views), $after;

else return $views;

}

// 获得热评文章
function simple_get_most_viewed($posts_num=10, $days=90){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
            FROM $wpdb->posts
           WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
		   AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >". mb_strimwidth($post->post_title,0,36)."</a></li>";
    }
    echo $output;
}
//标题文字截断
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '...';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str ;
}

//分页
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;							
$next = $paged + 1;	
$range = 5; //修改数字显示更多分页
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
	echo "<div class='pagination'>";
	echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='fir_las'>最前</a>":"";
	echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='page_previous'>上一页</a>":"";		
	for ($i=1; $i <= $pages; $i++){
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
	}
	}
	echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='page_next'>下一页</a>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='fir_las'>最后</a>":"";
	echo "</div>\n";
	}
}

// 垃圾评论拦截 
class anti_spam {
	function anti_spam() {
	    if ( !current_user_can('level_0') ) {
	      add_action('template_redirect', array($this, 'w_tb'), 1);
	      add_action('init', array($this, 'gate'), 1);
	      add_action('preprocess_comment', array($this, 'sink'), 1);
		}
	  }
	function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
      $IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
      $way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
      $spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
    }
  }
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      //方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
      die();
      //方法二: 标记为 spam, 留在资料库检查是否误判.
      //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      //$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed'];
    }
    return $comment;
	  }
	}
	$anti_spam = new anti_spam();
//屏蔽纯英文留言
function scp_comment_post( $incoming_comment ) {
$pattern = '/[一-龥]/u';
if(!preg_match($pattern, $incoming_comment['comment_content'])) {
wp_die( "请使用中文留言!" );
}
return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');

//日志归档
	class hacklog_archives
{
	function GetPosts() 
	{
		global  $wpdb;
		if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
			return $posts;
		$query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
		$rawposts =$wpdb->get_results( $query, OBJECT );
		foreach( $rawposts as $key => $post ) {
			$posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;
			$rawposts[$key] = null; 
		}
		$rawposts = null;
		wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;
		return $posts;
	}
	function PostList( $atts = array() ) 
	{
		global $wp_locale;
		global $hacklog_clean_archives_config;
		$atts = shortcode_atts(array(
			'usejs'        => $hacklog_clean_archives_config['usejs'],
			'monthorder'   => $hacklog_clean_archives_config['monthorder'],
			'postorder'    => $hacklog_clean_archives_config['postorder'],
			'postcount'    => '1',
			'commentcount' => '1',
		), $atts);
		$atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);
		$posts = $this->GetPosts();
		( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
		foreach( $posts as $key => $month ) {
			$sorter = array();
			foreach ( $month as $post )
				$sorter[] = $post->post_date_gmt;
			$sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
			array_multisort( $sorter, $sortorder, $month );
			$posts[$key] = $month;
			unset($month);
		}
		$html = '<div class="car-container';
		if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
		$html .= '">'. "\n";
		if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">展开所有月份'."</a>\n\n";
		$html .= '<ul class="car-list">' . "\n";
		$firstmonth = TRUE;
		foreach( $posts as $yearmonth => $posts ) {
			list( $year, $month ) = explode( '.', $yearmonth );
			$firstpost = TRUE;
			foreach( $posts as $post ) {
				if ( TRUE == $firstpost ) {
                    $spchar = $firstmonth ? '<span class="car-toggle-icon car-minus">-</span>' : '<span class="car-toggle-icon car-plus">+</span>';
					$html .= '	<li><span class="car-yearmonth" style="cursor:pointer;">'.$spchar.' ' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
					if ( '0' != $atts['postcount'] ) 
					{
						$html .= ' <span title="文章数量">(共' . count($posts) . '篇文章)</span>';
					}
                    if ($firstmonth == FALSE) {
					$html .= "</span>\n		<ul class='car-monthlisting' style='display:none;'>\n";
                    } else {
                    $html .= "</span>\n		<ul class='car-monthlisting'>\n";
                    }
					$firstpost = FALSE;
                     $firstmonth = FALSE;
				}
				$html .= '			<li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
				if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
					$html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
				$html .= "</li>\n";
			}
			$html .= "		</ul>\n	</li>\n";
		}
		$html .= "</ul>\n</div>\n";
		return $html;
	}
	function PostCount() 
	{
		$num_posts = wp_count_posts( 'post' );
		return number_format_i18n( $num_posts->publish );
	}
}
if(!empty($post->post_content))
{
	$all_config=explode(';',$post->post_content);
	foreach($all_config as $item)
	{
		$temp=explode('=',$item);
		$hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
	}
}
else
{
	$hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new');	
}
$hacklog_archives=new hacklog_archives();
	
//取消自动保存
function no_autosave() {
	wp_deregister_script('autosave');
	}
add_action( 'wp_print_scripts', 'no_autosave' );
//去除文章记录
remove_action('pre_post_update', 'wp_save_post_revision' );
add_action( 'wp_print_scripts', 'disable_autosave' );
function disable_autosave() {
wp_deregister_script('autosave');
}
//完整的编辑器
function enable_more_buttons($buttons) {
$buttons[] = 'hr';
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'sup';
$buttons[] = 'sub';
$buttons[] = 'del';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
 
return $buttons;
}
//add_filter("mce_buttons", "enable_more_buttons"); //默认将新添加的按钮追加在工具栏的第一行
//add_filter("mce_buttons_2", "enable_more_buttons");  //添加到工具栏的第二行
add_filter("mce_buttons_3", "enable_more_buttons");  //添加到工具栏的第三行

//添加编辑器快捷按钮
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    }

/* 去除 WordPress 後台升級提示 */
// 2.8 ~ 2.9:
add_filter('pre_transient_update_core',    create_function('$a', "return null;")); // don't update core
add_filter('pre_transient_update_plugins', create_function('$a', "return null;")); // don't update plugins
add_filter('pre_transient_update_themes',  create_function('$a', "return null;")); // don't update themes
 
// 3.0 ~ 3.1:
add_filter('pre_site_transient_update_core',    create_function('$a', "return null;")); // don't update core
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;")); // don't update plugins
add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;")); // don't update themes

//评论表情
function smilies_src ($img_src, $img, $siteurl){
return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
add_filter('smilies_src', 'smilies_src',1,20);
//系统表情指向主题表情(修改表情代码_代码1)
add_filter('smilies_src','custom_smilies_src',1,20);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
//表情代码转换图片(修改表情代码_代码2)
if ( !isset( $wpsmiliestrans ) ) {
        $wpsmiliestrans = array(
'[/疑问]' => 'icon_question.gif',
'[/调皮]' => 'icon_razz.gif',
'[/难过]' => 'icon_sad.gif',
'[/愤怒]' => 'icon_smile.gif',
'[/可爱]' => 'icon_redface.gif',
'[/坏笑]' => 'icon_biggrin.gif',
'[/惊讶]' => 'icon_surprised.gif',
'[/发呆]' => 'icon_eek.gif',
'[/撇嘴]' => 'icon_confused.gif',
'[/大兵]' => 'icon_cool.gif',
'[/偷笑]' => 'icon_lol.gif',
'[/得意]' => 'icon_mad.gif',
'[/白眼]' => 'icon_rolleyes.gif',
'[/鼓掌]' => 'icon_wink.gif',
'[/亲亲]' => 'icon_neutral.gif',
'[/流泪]' => 'icon_cry.gif',
'[/流汗]' => 'icon_arrow.gif',
'[/吓到]' => 'icon_exclaim.gif',
'[/抠鼻]' => 'icon_evil.gif',
'[/呲牙]' => 'icon_mrgreen.gif',

':?:' => 'icon_question.gif',
':razz:' => 'icon_razz.gif',
':sad:' => 'icon_sad.gif',
':evil:' => 'icon_smile.gif',
':!:' => 'icon_redface.gif',
':smile:' => 'icon_biggrin.gif',
':oops:' => 'icon_surprised.gif',
':grin:' => 'icon_eek.gif',
':eek:' => 'icon_confused.gif',
':shock:' => 'icon_cool.gif',
':???:' => 'icon_lol.gif',
':cool:' => 'icon_mad.gif',
':lol:' => 'icon_rolleyes.gif',
':mad:' => 'icon_wink.gif',
':twisted:' => 'icon_neutral.gif',
':roll:' => 'icon_cry.gif',
':wink:' => 'icon_arrow.gif',
':idea:' => 'icon_exclaim.gif',
':arrow:' => 'icon_evil.gif',
':neutral:' => 'icon_mrgreen.gif',
':cry:' => 'icon_eek.gif',
':mrgreen:' => 'icon_razz.gif',
        );
}


//密码保护提示
function password_hint( $c ){
global $post, $user_ID, $user_identity;
if ( empty($post->post_password) )
return $c;
if ( isset($_COOKIE['wp-postpass_'.COOKIEHASH]) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) == $post->post_password )
return $c;
if($hint = get_post_meta($post->ID, 'password_hint', true)){
$url = get_option('siteurl').'/wp-pass.php';
if($hint)
$hint = '密码提示：'.$hint;
else
$hint = "请输入您的密码";
if($user_ID)
$hint .= sprintf('欢迎进入，您的密码是：', $user_identity, $post->post_password);
$out = <<<END
<form method="post" action="$url">
<p>这篇文章是受保护的文章，请输入密码继续阅读：</p>
<div>
<label>$hint<br/>
<input type="password" name="post_password"/></label>
<input type="submit" value="输入密码" name="Submit"/>
</div>
</form>
END;
return $out;
}else{
return $c;
}
}
add_filter('the_content', 'password_hint');

//支持外链缩略图
if ( function_exists('add_theme_support') )
 add_theme_support('post-thumbnails');
 function catch_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){
		$random = mt_rand(1, 10);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/tb'.$random.'.jpg';
  }
  return $first_img;
 }

//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
$avatar_defaults[$myavatar] = '自定义头像';
return $avatar_defaults;};
//头像缓存到本地
function my_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.jpg';
  $t = 1209600; //設定14天, 單位:秒
  if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //當頭像不存在或文件超過14天才更新
    copy(htmlspecialchars_decode($g), $e);
  } else  $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));
  if (filesize($e) < 500) copy($w.'/avatar/default.jpg', $e);
  return $avatar;
}
// 评论回复/头像缓存
function lomo_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { //初始化楼层计数器
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);//获取主评论总数量
          $page = get_query_var('cpage');//获取当前评论列表页码
          $cpp=get_option('comments_per_page');//获取每页评论显示数量
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
		<div class="comment-author vcard"><?php if (get_option('swt_type') == 'Display') { ?>
			<?php
				$p = 'avatar/';
				$f = md5(strtolower($comment->comment_author_email));
				$a = $p . $f .'.jpg';
				$e = ABSPATH . $a;
				if (!is_file($e)){ //当头像不存在就更新
				$d = get_bloginfo('url'). '/avatar/default.jpg';
				$s = '40'; 
				$r = get_option('avatar_rating');
				$g = 'http://www.gravatar.com/avatar/'.$f.'.jpg?s='.$s.'&d='.$d.'&r='.$r;
                $avatarContent = file_get_contents($g);
                file_put_contents($e, $avatarContent);
				if ( filesize($e) == 0 ){ copy($d, $e); }
				};
			?>
			<img src='<?php bloginfo('wpurl'); ?>/<?php echo $a ?>' alt='' class='avatar' />
                <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/comment_gravatar.php'); } ?>
			<div class="floor">
			<?php
 if(!$parent_id = $comment->comment_parent){
   switch ($commentcount){
     case 2 :echo "沙发";--$commentcount;break;
     case 3 :echo "板凳";--$commentcount;break;
     case 4 :echo "地板";--$commentcount;break;
     default:printf('%1$s楼', --$commentcount);
   }
 }
 ?>
         </div><strong><?php comment_author_link() ?></strong>:<?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?></div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span style="color:#C00; font-style:inherit">您的评论正在排队...</span>
			<br />			
		<?php endif; ?>
		<?php comment_text() ?>
        
		<div class="clear"></div><span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span> <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
  </div>
<?php
}
function lomo_end_comment() {
		echo '</li>';
}

//登陆显示头像
function lomo_get_avatar($email, $size = 32){
return get_avatar($email, $size);
}
 
//彩色标签云
function colorCloud($text) {$text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);return $text;}
function colorCloudCallback($matches) {
	$text = $matches[1];
	$color = dechex(rand(0,16777215));
	$pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
	$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
	return "<a $text>";}
add_filter('wp_tag_cloud', 'colorCloud', 1);

//自动生成版权时间
function comicpress_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    ");
    $output = '';
    if($copyright_dates) {
    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
    $copyright .= '-' . $copyright_dates[0]->lastdate;
    }
    $output = $copyright;
    }
    return $output;
    }
/** RSS 中添加查看全文链接 */
function feed_read_more($content) {
    return $content . '<p><a rel="bookmark" href="'.get_permalink().'" target="_blank">查看全文</a></p>';
}
add_filter ('the_excerpt_rss', 'feed_read_more');
//评论邮件通知
function comment_mail_notify($comment_id) {
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email) && ($comment_author_email == $admin_email)) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
    $subject = '您在 [' . get_option("blogname") . '] 的评论有新的回复';
    $message = '
	<div>
	<p><strong>' . trim(get_comment($parent_id)->comment_author) . '， 您好</strong>！</p> 
	<p> 您发表在：《' . get_option('blogname') . '》的文章 “<strong>' . get_the_title($comment->comment_post_ID) . '</strong>” 的评论有新回复</p> 
	<strong><p>这里就是您的评论内容：</strong><br /> ' . trim(get_comment($parent_id)->comment_content) . '</p> 
	<strong><p>这里是新的回复：</strong><br /> ' . trim($comment->comment_content) . '</p> 
	<p><strong>回复者：' . trim($comment->comment_author) . '</strong></p> 
	<p><strong>你可以点击下面的链接来查看更多关于这文章的评论：</strong><br /> 
	<a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '</a></p> <br /> 
	<p><strong>感谢您的评论，欢迎再次光临。<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></strong> 
	</a></p> 
	<p style="color:#ff0000;">--------------- 碎碎念：www.zhuweisheng.com.cn ---------------</p>
    </div>';
	$message = convert_smilies($message);
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
//全部设置结束
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
?>