<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
/* ]]> */
</script>
<div id="smilelink">
<a href="javascript:grin('[/疑问]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_question.gif" title="疑问" alt="疑问" /></a>
<a href="javascript:grin('[/调皮]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_razz.gif" title="调皮" alt="调皮" /></a>
<a href="javascript:grin('[/难过]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_sad.gif" title="难过" alt="难过" /></a>
<a href="javascript:grin('[/愤怒]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_smile.gif" title="愤怒" alt="愤怒" /></a>
<a href="javascript:grin('[/可爱]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_redface.gif" title="可爱" alt="可爱" /></a>
<a href="javascript:grin('[/坏笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_biggrin.gif" title="坏笑" alt="坏笑" /></a>
<a href="javascript:grin('[/惊讶]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_surprised.gif" title="惊讶" alt="惊讶" /></a>
<a href="javascript:grin('[/发呆]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_eek.gif" title="发呆" alt="发呆" /></a>
<a href="javascript:grin('[/撇嘴]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_confused.gif" title="撇嘴" alt="撇嘴" /></a>
<a href="javascript:grin('[/大兵]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_cool.gif" title="大兵" alt="大兵" /></a>
<a href="javascript:grin('[/偷笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_lol.gif" title="偷笑" alt="偷笑" /></a>
<a href="javascript:grin('[/得意]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_mad.gif" title="得意" alt="得意" /></a>
<a href="javascript:grin('[/白眼]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_rolleyes.gif" title="白眼" alt="白眼" /></a>
<a href="javascript:grin('[/鼓掌]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_wink.gif" title="鼓掌" alt="鼓掌" /></a>
<a href="javascript:grin('[/亲亲]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_neutral.gif" title="亲亲" alt="亲亲" /></a>
<a href="javascript:grin('[/流泪]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_cry.gif" title="流泪" alt="流泪" /></a>
<a href="javascript:grin('[/流汗]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_arrow.gif" title="流汗" alt="流汗" /></a>
<a href="javascript:grin('[/吓到]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_exclaim.gif" title="吓到" alt="吓到" /></a>
<a href="javascript:grin('[/抠鼻]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_evil.gif" title="抠鼻" alt="抠鼻" /></a>
<a href="javascript:grin('[/呲牙]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/icon_mrgreen.gif" title="呲牙" alt="呲牙" /></a>
<br />
</div>