<?php

$themename = "Mystyle";
$shortname = "swt";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/css/';
$alt_stylesheets = array();
$alt_stylesheets[] = '';

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
	array(  "name" => $themename." Options",
      		"type" => "title"),


//首页布局设置开始
    array(  "type" => "close"),
    array( "name" => "首页布局风格设置",
           "type" => "section"),
    array( "type" => "open"),
	
	array(  "name" => "默认颜色风格",
            "id" => $shortname."_morenstyle",
			"std" => "Select a CSS skin:",
			"type" => "select",
			"options" => $alt_stylesheets,
			"default_option_value" => "style.css"),
			
	array(  "name" => "时间调节颜色风格",
			"desc" => "默认不开启",
            "id" => $shortname."_timestyle",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),
			
	array(	"name" => "12点前",
			"id" => $shortname."_qianstyle",
			"std" => "Select a CSS skin:",
			"type" => "select",
			"options" => $alt_stylesheets,
			"default_option_value" => "style.css"),
			
	array(	"name" => "12点后",
			"id" => $shortname."_houstyle",
			"std" => "Select a CSS skin:",
			"type" => "select",
			"options" => $alt_stylesheets,
			"default_option_value" => "style.css"),
			
	array(	"name" => "<span class='child'>显示</span>",
			"desc" => "篇文章",
			"id" => $shortname."_wzxs",
            "type" => "text",
            "std" => "4"),
		
//各功能模块控制
    array(  "type" => "close"),
    array(  "name" => "综合功能开关设置",
            "type" => "section"),
    array(  "type" => "open"),

	array(  "name" => "是否开启头像缓存",
			"desc" => "默认开启",
            "id" => $shortname."_type",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
	array(  "name" => "是否显示Logo图片",
			"desc" => "默认显示",
            "id" => $shortname."_logo",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
	array(  "name" => "是否显示缩略图",
			"desc" => "默认不显示",
            "id" => $shortname."_thumbnail",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示文章截图型缩略图",
			"desc" => "默认显示（开启前确认“是否显示缩略图”已开启）",
            "id" => $shortname."_articlepic",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
	array(  "name" => "是否显示侧边读者墙",
			"desc" => "默认显示",
            "id" => $shortname."_wallreaders",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
	array(  "name" => "是否显示相关文章功能",
			"desc" => "默认显示",
            "id" => $shortname."_xiangguan",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
//CMS分栏设置
    array(  "type" => "close"),
    array(  "name" => "CMS分栏、幻灯片开关设置",
            "type" => "section"),
    array(  "type" => "open"),
	
	array(  "name" => "是否显示CMS分栏",
			"desc" => "默认显示",
            "id" => $shortname."_cmsfl",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
			
	array(	"name" => "<span class='child'>首页CMS分栏ID设置</span>",
			"desc" => "<span class='child'>输入分类ID，多个分类请用英文逗号＂,＂隔开，默认最多可添加8个分类</span>",
            "id" => $shortname."_cat",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(	"name" => "<span class='child'>每个CMS分栏显示的文章数</span>",
			"id" => $shortname."_column_post",
			"std" => "5",
			"type" => "select",
			"options" => $number_entries),
	
	array(  "name" => "是否显示幻灯片",
		    "desc" => "默认显示",
		    "id" => $shortname."_slider",
		    "type" => "select",
		    "std" => "Hide",
		    "options" => array("Display", "Hide")),
		
	array(	"name" => "<span class='child'>显示多少篇文章</span>",
		    "id" => $shortname."_sliderx",
		    "type" => "text",
		    "std" => "5"),
		
	array(  "name" => "<span class='child'>选择幻灯片显示的内容</span>",
			"desc" => "<span class='child'>默认显示【置顶文章】，如果你选择【特定分类的文章】，请接着设置下面的选项</span>",
            "id" => $shortname."_sliders",
            "type" => "select",
            "std" => "置顶文章",
            "options" => array("置顶文章", "特定分类的文章")),

	array(	"name" => "<span class='child'>幻灯片显示的特定分类ID</span>",
			"desc" => "<span class='child'>输入分类ID，多个分类ID请用英文逗号＂,＂隔开</span>",
            "id" => $shortname."_cat_slider",
            "type" => "text",
            "std" => "1,2,3,4"),

//图文列表和瀑布流设置
    array(  "type" => "close"),
    array(  "name" => "图文列表、瀑布流设置",
            "type" => "section"),
    array(  "type" => "open"),

	array(  "name" => "<span class='child'>选择图文列表排版的分类ID</span>",
			"desc" => "<span class='child'>请输入一个分类ID</span>",
            "id" => $shortname."_cat_piclist",
            "type" => "text",
            "std" => "0"),
    	
	array(  "name" => "<span class='child'>选择图文列表排版的分类名称</span>",
			"desc" => "<span class='child'>请输入一个分类名称</span>",
            "id" => $shortname."_name_piclist",
            "type" => "text",
            "std" => "请设置"),
	
	array(	"name" => "<span class='child'>选择瀑布流排版的分类ID</span>",
			"desc" => "<span class='child'>请输入一个分类ID</span><br/><span>【碎碎念提示：请勿选择与图文列表相同的分类ID，以免出现冲突！】</span>",
            "id" => $shortname."_cat_flow",
            "type" => "text",
            "std" => "0"),
    
	array(  "name" => "<span class='child'>选择瀑布流排版的分类名称</span>",
			"desc" => "<span class='child'>请输入一个分类名称</span><br/><span>【碎碎念提示：请勿选择与图文列表相同的分类名，以免出现冲突！】</span>",
            "id" => $shortname."_name_flow",
            "type" => "text",
            "std" => "请设置"),


//SEO设置
    array(  "type" => "close"),
	array(  "name" => "网站SEO设置(必填)",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "输入你的网站关键字，一般不超过100个字符"),

//博客统计及链接设置
    array(  "type" => "close"),
	array(  "name" => "侧边栏博客统计、网站地图(必填)",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "<span class='child'>用户名</span>",
			"desc" => "",
			"id" => $shortname."_user",
            "type" => "text",
            "std" => ""),

	array(	"name" => "<span class='child'>建站日期</span>",
            "desc" => "",
            "id" => $shortname."_builddate",
            "type" => "text",
            "std" => "2012-8-8"),
			
	array(  "name" => "是否显示网站地图",
		    "desc" => "默认不显示，开启请安装百度地图插件",
		    "id" => $shortname."_sitemap",
		    "type" => "select",
		    "std" => "Hide",
		    "options" => array("Display", "Hide")),

//微博以及订阅设置
    array(  "type" => "close"),
	array(  "name" => "微博以及订阅设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示腾讯微博",
			"desc" => "默认不显示",
            "id" => $shortname."_tqq",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入腾讯微博地址",
            "desc" => "",
            "id" => $shortname."_tqqurl",
            "type" => "textarea",
            "std" => "http://t.qq.com/zws_hwy"),

	array(  "name" => "是否显示新浪微博",
			"desc" => "默认不显示",
            "id" => $shortname."_tsina",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入新浪微博地址",
            "desc" => "",
            "id" => $shortname."_tsinaurl",
            "type" => "textarea",
            "std" => "http://weibo.com/nooldey"),
	
	array(  "name" => "是否显示用QQ邮箱订阅博客",
			"desc" => "默认不显示",
            "id" => $shortname."_mailqq",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),
            
//网站统计、备案号
    array(  "type" => "close"),
	array(  "name" => "网站统计代码、备案号、联系方法设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示网站统计",
			"desc" => "默认不显示",
            "id" => $shortname."_tj",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

    array(  "name" => "输入你的网站统计代码",
            "desc" => "",
            "id" => $shortname."_tjcode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示备案号",
			"desc" => "默认不显示",
            "id" => $shortname."_beian",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "<span class='child'>输入您的备案号</span>",
			"desc" => "",
            "id" => $shortname."_beianhao",
            "type" => "text",
            "std" => "特免备案"),

	array(  "name" => "<span class='child'>邮箱显示昵称</span>",
			"desc" => "",
            "id" => $shortname."_youxiangming",
            "type" => "text",
            "std" => "站长邮箱"),
			
	array(  "name" => "<span class='child'>邮箱地址</span>",
			"desc" => "",
            "id" => $shortname."_youxianghao",
            "type" => "text",
            "std" => "openzws@163.com"),
	
	array(  "name" => "<span class='child'>QQ号码显示昵称</span>",
			"desc" => "",
            "id" => $shortname."_qqming",
            "type" => "text",
            "std" => "联系QQ"),
				
	array(  "name" => "<span class='child'>QQ号码</span>",
			"desc" => "",
            "id" => $shortname."_qqhaoma",
            "type" => "text",
            "std" => "306639269"),

//广告设置
    array(  "type" => "close"),
	array(  "name" => "博客广告设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示网站公告",
			"desc" => "默认不显示",
            "id" => $shortname."_notice",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入网站公告代码(支持HTML300*300)",
            "desc" => "",
            "id" => $shortname."_noticecode",
            "type" => "textarea",
            "std" => ""),
			
	array(  "name" => "是否显示幻灯片下面广告",
			"desc" => "默认不显示",
            "id" => $shortname."_adb",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入幻灯片下广告代码(最大宽度:720)",
            "desc" => "",
            "id" => $shortname."_adbcode",
            "type" => "textarea",
            "std" => ""),
            
	array(  "name" => "是否显示侧边栏广告",
			"desc" => "默认不显示",
            "id" => $shortname."_ada",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入侧边栏广告代码(300*300)",
            "desc" => "",
            "id" => $shortname."_adacode",
            "type" => "textarea",
            "std" => ""),
           
	array(  "name" => "是否显示文章底部广告",
			"desc" => "默认不显示",
            "id" => $shortname."_adc",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入文章底部广告代码(最大宽度:720)",
            "desc" => "",
            "id" => $shortname."_adccode",
            "type" => "textarea",
            "std" => ""),		
	array(	"type" => "close") 
);

function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "Mystyle主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/latest_version.js"></script>

<script type="text/javascript">
var _version = '<?php $theme_data = get_theme_data(dirname(__FILE__) . '/../style.css');echo $theme_data['Version'];?>';
jQuery(document).ready(function(){
	jQuery("span.version_number").text(Mystyle_latest_version);
	jQuery("a.downloand_add").attr("href",downloand_add);
	jQuery("a.author_add").attr("href",author_add);
	if(_version < Mystyle_latest_version ){
		jQuery(".version_tips").fadeIn(1000);
	}
	else {
		jQuery(".version_tips").hide();
	};
	jQuery(".close_version_tips").click(function(){
		jQuery(this).parent().fadeOut(1000);
	});
	jQuery(".fl_cbradio_op:checked").each(function() {
		jQuery(this).parent().parent().children().eq(3).show();
	});
	jQuery(".fl_cbradio_cl:checked").each(function() {
		jQuery(this).parent().parent().children().eq(3).hide();
	});
	jQuery(".fl_cbradio_cl").click(function(){
		jQuery(this).parent().parent().children().eq(3).slideUp();
	});
	jQuery(".fl_cbradio_op").click(function(){
		jQuery(this).parent().parent().children().eq(3).slideDown();
	});
   jQuery(".theme_options_content > div:not(:first)").hide();
   jQuery(".theme_options_tab li").each(function(index){
       jQuery(this).click(
	   	  function(){
			  jQuery(".theme_options_tab li.current").removeClass("current");
			  jQuery(this).addClass("current");
			  jQuery(".theme_options_content > div:visible").hide();
			  jQuery(".theme_options_content > div:eq(" + index + ")").show();
	  })
   })
})
</script>

<div class="wrap rm_wrap">
<h2>Mystyle主题设置</h2>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="恢复默认" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p>
</form>
<?php
function show_category() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = '<span>'.$category->name."(<em>".$category->term_id.'</em>)</span>';
		echo $output;
	}
}//栏目列表结束
?> 
<div id="all_cat">
<h4>站点所有分类ID:</h4>
<?php show_category(); ?> 
</div>
<div class="rm_opts">
<div class="rm_opts">
<form method="post"> 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
<?php break;
case "close":
?>
</div>
</div>
<br />
<?php break;
case "title":
?>
<?php break;
case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
		
		</option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":
$i++;
?>
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" />
</span><div class="clearfix"></div></div>
<div class="rm_options">
<?php break;
}
}
?>
<input type="hidden" name="action" value="save" />
</form>
 </div> 
 <div class="kg"></div>
 
<?php
}
?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('swt_alt_stylesheet');
	if($stylesheet != ''){?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/<?php echo $stylesheet; ?>" />
<?php }
} 
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>