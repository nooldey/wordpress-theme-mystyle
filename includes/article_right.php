  <div class="article_right">
    <div id="shopbox-info_sideroll">
      <div class="shopbox-info">
          <a href="<?php echo get_post_meta($post->ID,"taobao_value",true);?>" rel="bookmark" title="淘宝购买：<?php the_title(); ?>">
          <?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail'); }
          else { ?>
          <img class="home-thumb" src="<?php echo catch_first_image() ?>" width="180px" height="180px" alt="<?php the_title(); ?>"/>
          <?php } ?>
          </a>
		<span class="price"><del>原价：¥<?php echo get_post_meta($post->ID,"price_value",true);?></del></span>
        <span class="price">特价：¥<?php echo get_post_meta($post->ID,"price2_value",true);?></span>
        <a href="<?php echo get_post_meta($post->ID,"taobao_value",true);?>" rel="bookmark" title="淘宝购买：<?php the_title(); ?>" target="_blank"><span class="buy">立即抢购！</a></span>
		<div class="clear"></div>
      </div>
	  </div>
   </div>
   <div class="clear"></div>