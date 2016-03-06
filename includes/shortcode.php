<?php
//回复内容可见				
function ATheme_reply_to_read($atts, $content=null) {
        extract(shortcode_atts(array("notice" => '<p class="yincang-tag shortcodestyle"><strong style="color:#f00;">碎碎念提示:</strong> 此处内容需要您<a href="#respond" title="评论本文">评论本文</a>后才能查看!</p>'), $atts));  
        $email = null;   
        $user_ID = (int) wp_get_current_user()->ID;   
        if ($user_ID > 0) {   
            $email = get_userdata($user_ID)->user_email;   
            //对博主直接显示内容   
            $admin_email = get_bloginfo ('admin_email');  
			
            if ($email == $admin_email) {   
                return $content;   
            }   
        } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {   
            $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);   
        } else {   
            return $notice;   
        }   
        if (empty($email)) {   
            return $notice;   
        }   
        global $wpdb;   
        $post_id = get_the_ID();   
        $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";   
        if ($wpdb->get_results($query)) {   
            return do_shortcode($content);   
        } else {   
            return $notice;   
        }   
    }   
	
add_shortcode('reply', 'ATheme_reply_to_read');
//警示
function warningbox($atts, $content=null, $code="") {
	$return = '<div class="warning shortcodestyle">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('warning' , 'warningbox' );
//禁止
function nowaybox($atts, $content=null, $code="") {
	$return = '<div class="noway shortcodestyle">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('noway' , 'nowaybox' );
//购买
function buybox($atts, $content=null, $code="") {
	$return = '<div class="buy shortcodestyle">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('buy' , 'buybox' );
//项目版
function taskbox($atts, $content=null, $code="") {
	$return = '<div class="task shortcodestyle">';
	$return .= $content;
	$return .= '</div>';
	return $return;
}
add_shortcode('task' , 'taskbox' );
//音乐播放器
function doubanplayer($atts, $content=null){
	extract(shortcode_atts(array("auto"=>'0'),$atts));
	return '<embed src="'.get_bloginfo("template_url").'/images/shortcode/doubanplayer.swf?url='.$content.'&amp;autoplay='.$auto.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="400" height="30">';
	}
add_shortcode('music','doubanplayer');

//下载链接
function downlink($atts,$content=null){
	extract(shortcode_atts(array("href"=>'http://'),$atts));
	return '<div class="but_down"><a href="'.$href.'" title="'.$content.'" alt="'.$content.'" target="_blank"><span>'.$content.'</span></a><div class="clear"></div></div>';
	}
	add_shortcode('Downlink','downlink');
	
//flv播放器
function flvlink($atts,$content=null){
	extract(shortcode_atts(array("auto"=>'0'),$atts));
	return'<embed src="'.get_bloginfo("template_url").'/images/shortcode/flvideo.swf?auto='.$auto.'&flv='.$content.'" menu="false" quality="high" wmode="transparent" bgcolor="#ffffff" width="560" height="315" name="flvideo" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_cn" />';
	}
add_shortcode('flv','flvlink');
//mp3专用播放器
function mp3link($atts, $content=null){
	extract(shortcode_atts(array("auto"=>'0',"replay"=>'0',),$atts));	
	return '<embed src="'.get_bloginfo("template_url").'/images/shortcode/dewplayer.swf?mp3='.$content.'&amp;autostart='.$auto.'&amp;autoreplay='.$replay.'" wmode="transparent" height="20" width="240" type="application/x-shockwave-flash" />';
	}
add_shortcode('mp3','mp3link');	
				
//在线视频
/* 20120616 修复WP 3.4 官方中文版 的问题
function wp_embed_handler_youku( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youku', '<embed src="http://player.youku.com/player.php/sid/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'youku', '#http://v.youku.com/v_show/id_(.*?).html#i', 'wp_embed_handler_youku' );
				
function wp_embed_handler_tudou( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_tudou', '<embed src="http://www.tudou.com/v/' . esc_attr($matches[1]) . '/v.swf"  quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr );}
wp_embed_register_handler( 'tudou', '#http://www.tudou.com/programs/view/(.*?)/#i', 'wp_embed_handler_tudou' );

*/

function wp_embed_handler_ku6( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_ku6', '<embed src="http://player.ku6.com/refer/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'ku6', '#http://v.ku6.com/show/(.*?).html#i', 'wp_embed_handler_ku6' );
				
function wp_embed_handler_youtube( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youtube', '<embed src="http://www.youtube.com/v/' . esc_attr($matches[1]) . '?&amp;hl=zh_CN&amp;rel=0" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'youtube', '#http://youtu.be/(.*?)/#i', 'wp_embed_handler_youtube' );
			
function wp_embed_handler_56 ($matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_56', '<embed src="http://player.56.com/v_' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( '56', '#http://player.56.com/v_(.*?).swf#i', 'wp_embed_handler_56' );
			
function wp_embed_handler_sohu( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sohu', '<embed src="http://share.vrs.sohu.com/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'sohu', '#http://share.vrs.sohu.com/(.*?)/v.swf#i', 'wp_embed_handler_sohu' );

function wp_embed_handler_6cn( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_6cn', '<embed src="http://6.cn/p/' . esc_attr($matches[1]) . '.swf" quality="high" width="480" height="385" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( '6cn', '#http://6.cn/p/(.*?).swf#i', 'wp_embed_handler_6cn' );
				
function wp_embed_handler_letv( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_letv', '<embed src="http://www.letv.com/player/' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'letv', '#http://www.letv.com/player/(.*?).swf#i', 'wp_embed_handler_letv' );
				
function wp_embed_handler_sina( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sina', '<embed src="http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=' . esc_attr($matches[1]) . '/s.swf" quality="high" width="620" height="405" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
wp_embed_register_handler( 'sina', '#http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=(.*?)/s.swf#i', 'wp_embed_handler_sina' );
				
/////////////////////////////////////////////////////////////

function mystyle_Shortpage(){?>
<style type="text/css">
.wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
.devetable td{vertical-align:top;text-align: left; }
.top td{vertical-align: middle;text-align: left; }
pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
strong{ color:#666}
.none{display:none;}
fieldset{ border:1px solid #ddd;margin:5px 0 10px;padding:10px 10px 20px 10px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}
fieldset:hover{border-color:#bbb;}
fieldset legend{padding:0 5px;color:#777;font-size:14px;font-weight:700;cursor:pointer}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){  
$(".toggle").click(function(){$(this).next().slideToggle('slow')});
});
</script>
<div class="wrap">
<div id="icon-themes" class="icon32"><br></div>
<h2>主题短代码</h2>
    <div style="padding-left:20px;">
	<p>写文章时如果需要可以加入下列短代码（在“可视化”与“HTML”两种模式均可直接加入）</p>
<fieldset>
<legend class="toggle">各种短代码面板</legend>
	<div class="none">
      <table width="600" border="0" class="devetable">
      	<tr><td width="120">灰色项目面板：</td><td width="464"><code>[task]文字内容[/task]</code></td></tr>
  		<tr><td width="120">红色禁止面板：</td><td width="464"><code>[noway]文字内容[/noway]</code></td></tr>
        <tr><td width="120">黄色警告面板：</td><td width="464"><code>[warning]文字内容[/warning]</code></td></tr>
        <tr><td width="120">绿色购买面板：</td><td width="464"><code>[buy]文字内容[/buy]</code></td></tr>
       </table>
      </div>
</fieldset>

<fieldset>
<legend class="toggle">多功能区</legend>
	<div class="none">
      <table width="800" border="0" class="devetable">
      		<tr><td width="120"><strong>下载样式</strong></td><td width="584"><code>[Downlink href="http://www.xxx.com/xxx.zip"]download[/Downlink]</code></td></tr>
		<tr><td width="240"><strong>百度直链下载样式</strong></td><td width="584"><code>[Downlink href="http://www.xxx.com/download.php?shareid=xxx&uk=xxx"]download[/Downlink]
		</code></td>
</tr>
		<tr><td width="120"><strong>回复显示</strong></td><td width="584"><code>[reply]隐藏内容[/reply]</code></td></tr>
  </table>
  </div>
</fieldset>


<fieldset>
<legend class="toggle">音乐播放器</legend>
	<div class="none">
      <table width="800" border="0" class="devetable">
	  	<tr><td width="120"><strong>通用音乐播放器</strong></td><td>&nbsp;</td></tr>
      	<tr><td width="120">默认不自动播放：</td><td width="463"><code>[music]http://www.xxx.com/xxx.mp3[/music]</code></td></tr> 
        <tr><td width="120">自动播放:</td><td><code>[music auto=1]http://www.xxx.com/xxx.mp3[/music]</code></td></tr>

		<tr><td width="120"><strong>Mp3专用播放器</strong></td><td>&nbsp;</td></tr>
        <tr><td width="210">默认不循环不自动播放：</td><td><code>[mp3]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
         <tr><td width="120">自动播放：　</td><td><code>[mp3 auto="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>  
         <tr><td width="120">循环播放：	</td><td><code>[mp3 replay="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
         <tr><td width="120">自动及循环播放：</td><td><code>[mp3 auto="1" replay="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
       </table>
      </div>
</fieldset> 

<fieldset>
<legend class="toggle">Flv专用播放器</legend>
	<div class="none">
		<table width="600" border="0" class="devetable">
		<tr><td width="120"><strong>Flv专用播放器</strong></td><td>&nbsp;</td></tr>
         <tr><td width="120">默认不自动播放：</td><td><code>[flv]http://www.xxx.com/xxx.flv[/flv]</code></td></tr>
         <tr><td width="120">自动播放：</td><td><code>[flv auto="1"]http://www.xxx.com/xxx.flv[/flv]</code></td></tr>
		</table> 
       <p><span style="color: #808000;">注意：如果要使用这个播放器，一定要添加flv格式的视频文件</span></p>
  </div>
</fieldset>

<fieldset>
<legend class="toggle">视频网站Flash嵌入</legend>
	<div class="none">
    <br>
      <table width="600" border="0" class="devetable">
      	<tr><td width="120"><span style="color: #993300;"> 通用代码：</span></td><td width="504"><code>[embed]视频播放页面网址或Flash地址[/embed]</code></td></tr>
      </table>
       <br>
        <fieldset>
        <legend>使用视频播放页面网址的网站</legend>
            <p><span style="color: #808000;">以下网站中的视频，直接复制浏览器中的地址，粘贴到短代码中即可 </span></p>
              <table width="810" border="0" class="devetable">
               <tr><td width="80">优酷网：</td><td width="714"><code>[embed]http://v.youku.com/v_show/id_XMjgyNDk1NTYw.html[/embed]</code></td></tr>
               <tr><td width="80">土豆网：</td><td width="714"><code>[embed]http://www.tudou.com/programs/view/tFny-0UbTEM/[/embed]</code>&nbsp;&nbsp;(注意:网址的最后有个斜杠不能漏掉)</td></tr>
               <tr><td width="80">酷6网：</td><td width="714"><code>[embed]http://v.ku6.com/show/7eenXUV4xNfiUsSu.html[/embed]</code></td></tr>
               <tr><td width="80">Youtube：</td><td width="714"><code>[embed]http://youtu.be/vtjJe4elifI/[/embed]</code>&nbsp;&nbsp;(此为分享中给出的分享网址,记得在网址的最后加上斜杠)</td></tr>
              </table>
        </fieldset>  
           <br>   
       <fieldset>
        <legend>使用Flash地址的网站</legend>
            <p><span style="color: #808000;">以下网站中的视频，需要复制视频给出的分享中的flash地址，粘贴到短代码中即可 </span></p>
              <table width="810" border="0" class="devetable">
               <tr><td width="80">56.com：</td><td width="714"><code>[embed]http://player.56.com/v_NTM4ODY0NjY.swf[/embed]</code></td></tr>
               <tr><td width="80">搜狐视频：</td><td width="714"><code>[embed]http://share.vrs.sohu.com/374302/v.swf[/embed]</code> </td></tr>
               <tr><td width="80">6房间：</td><td width="714"><code>[embed]http://6.cn/p/1/n4WbeuI_Gn7GBxCVccLQ.swf[/embed]</code></td></tr>
               <tr><td width="80">乐视网：</td><td width="714"><code>[embed]http://www.letv.com/player/x725792.swf [/embed]</code></td></tr>
               <tr><td width="80">新浪视频：</td><td width="714"><code>[embed]http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=XXX/s.swf[/embed]</code></td></tr>
           </table>    
        </fieldset 
      ></div>
</fieldset>   
    </div>
  
</div>
<?php }
function mystyle_shortcode_page(){
  add_theme_page("短代码提示","短代码提示",'edit_themes','mystyle_shortcode_page','mystyle_Shortpage'); 
}
add_action('admin_menu','mystyle_shortcode_page');

?>