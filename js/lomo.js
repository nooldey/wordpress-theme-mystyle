//加载效果
jQuery(document).ready(function(){
jQuery('.article h2 a').click(function(){
    jQuery(this).text('努力打开中，稍等...');
    window.location = jQuery(this).attr('href');
    });
});


// 滚屏
jQuery(document).ready(function($) {
$(window).scroll(function(){var scroller = $('.rolltotop');document.documentElement.scrollTop+document.body.scrollTop>800?scroller.fadeIn():scroller.fadeOut();})
$(window).scroll(function(){var scroller = $('.rolltofall');document.documentElement.scrollTop+document.body.scrollTop<801?scroller.fadeIn():scroller.fadeOut();})
$('.roll-top').click(function(){$('html,body').animate({scrollTop:0},300);})
$('.roll-respond').click(function(){scrollTo('.roll-respond');$('#comment').focus();})
$('.roll-fall').click(function(){$('html,body').animate({scrollTop:$('#footer').offset().top}, 300);});})


//主导航下拉菜单
jQuery(document).ready(function(){
jQuery(".topnav ul li").hover(function(){
jQuery(this).children("ul").show();
jQuery(this).addClass("li01");
},function(){
jQuery(this).children("ul").hide();
jQuery(this).removeClass("li01");
});
});

//页首导航下拉菜单
jQuery(document).ready(function(){
jQuery(".footnav ul li").hover(function(){
jQuery(this).children("ul").show();
jQuery(this).addClass("li01");
},function(){
jQuery(this).children("ul").hide();
jQuery(this).removeClass("li01");
});
});

//侧边栏TAB效果
jQuery(document).ready(function(){
jQuery('#tab-title span').mouseover(function(){
jQuery(this).addClass("selected").siblings().removeClass();
jQuery("#tab-content > ul").eq(jQuery('#tab-title span').index(this)).fadeIn(500).siblings().hide();
});});

//图片渐隐
jQuery(function () {
jQuery('.thumbnail img').hover(
function() {jQuery(this).fadeTo("fast", 0.5);},
function() {jQuery(this).fadeTo("fast", 1);
});
});

//新窗口打开
jQuery(document).ready(function(){
	jQuery("a[rel='external'],a[rel='external nofollow']").click(
	function(){window.open(this.href);return false})
});

//顶部微博等图标渐隐
jQuery(document).ready(function(){
			jQuery('.icon1,.icon2,.icon3,.icon4').wrapInner('<span class="hover"></span>').css('textIndent','0').each(function () {
				jQuery('span.hover').css('opacity', 0).hover(function () {
					jQuery(this).stop().fadeTo(350, 1);
				}, function () {
					jQuery(this).stop().fadeTo(350, 0);
				});
			});
});

//预加载广告
function speed_ads(loader, ad) {
var ad = document.getElementById(ad),
loader = document.getElementById(loader);
if (ad && loader) {
ad.appendChild(loader);
loader.style.display='block';
ad.style.display='block';
}
}
window.onload=function() {
speed_ads('adsense-loader1', 'adsense1');
speed_ads('adsense-loader2', 'adsense2');
speed_ads('adsense-loader3', 'adsense3');
};

//侧边滑动
jQuery(document).ready(function($) {
    if (!isie6()) {
        var rollStart = $('#rollstart'),
        rollSet = $('.article_right');
        rollStart.before('<div class="taobao_rollbox"></div>');
        var offset = rollStart.offset(),
        objWindow = $(window),
        rollBox = rollStart.prev();
        if (objWindow.width() > 960) {
            objWindow.scroll(function() {
                if (objWindow.scrollTop() > offset.top) {
                    if (rollBox.html(null)) {
                        rollSet.clone().prependTo('.taobao_rollbox')
                    }
                    rollBox.show().stop().animate({
                        top: 0,
                        paddingTop: 15
                    },
                    400)
                } else {
                    rollBox.hide().stop().animate({
                        top: 0
                    },
                    400)
                }
            })
        }
    }
    function isie6() {
        if ($.browser.msie) {
            if ($.browser.version == "6.0") return true;
        }
        return false;
    }
});
