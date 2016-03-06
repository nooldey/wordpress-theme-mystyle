<?php
/*
Template Name: Readers
*/
?>
<?php get_header(); ?>
<div id="content">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
<div class="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<div class="article">
<h2><?php the_title(); ?></h2>
        <div class="context"><?php the_content('Read more...'); ?></div>
		</br>
<!-- start 读者墙  -->
<?php
    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'openzws@163.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 48";//大家把管理员的邮箱改成你的,目的是从读者墙里面排除博客作者，最后的数字35是读者的个数，可以按照自己的情况修改！
    $wall = $wpdb->get_results($query);
    $maxNum = $wall[0]->cnt;
    foreach ($wall as $comment)
    {
        $width = round(40 / ($maxNum / $comment->cnt),2);//此处是对应的血条的宽度
        if( $comment->comment_author_url )
        $url = $comment->comment_author_url;
        else $url="#";
	$touxiang = get_avatar( $comment->comment_author_email, $size = '36', $default = get_bloginfo('template_directory').'/avatar/default.jpg' );
        $tmp = "<li><a target=\"_blank\" rel=\"nofollow\" href=\"".$comment->comment_author_url."\">".$touxiang." <em>".$comment->comment_author."</em><strong>+".$comment->cnt."</strong></br>".$comment->comment_author_url."</a></li>";
        $output .= $tmp;
     }
    $output = "<ul class=\"readerwall\">".$output."</ul>";
    echo $output ;
?>
<!-- end 读者墙 -->
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