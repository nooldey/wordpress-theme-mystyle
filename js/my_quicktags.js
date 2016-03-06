//这儿共有四对引号，分别是按钮的ID、显示名、点一下输入内容、再点一下关闭内容（此为空则一次输入全部内容），\n表示换行。
QTags.addButton( 'hr', '添加横线', "\n<hr />\n", '' );//添加横线
QTags.addButton( 'h2', '添加标题2', "\n<h2>", "</h2>\n" ); //添加标题2
QTags.addButton( 'h3', '添加标题3', "\n<h3>", "</h3>\n" ); //添加标题3
QTags.addButton( 'task', '灰色项目面板', "\n[task]\n灰色项目面板\n", "[/task]\n" );//添加灰色项目面板
QTags.addButton( 'noway', '红色禁止面板', "\n[noway]\n红色禁止面板\n", "[/noway]\n" );//添加红色禁止面板
QTags.addButton( 'warning', '添加黄色警告面板', "\n[warning]\n黄色警告面板\n", "[/warning]\n" );//添加黄色警告面板
QTags.addButton( 'buy', '绿色购买面板', "\n[buy]\n绿色购买面板\n", "[/buy]\n" );//添加绿色购买面板
QTags.addButton( 'Down', '下载链接', "\n[Downlink href='下载链接']下载[/Downlink]\n", "" );//添加下载链接
QTags.addButton( 'mp3', '音乐播放器', "\n[mp3]", "[/mp3]\n" );//添加音乐播放器
QTags.addButton( 'flv', 'flv播放器', "\n[flv]", "[/flv]\n" );//添加flv播放器
QTags.addButton( 'embed', '网络视频', "\n[embed]", "[/embed]\n" );//添加网络视频
QTags.addButton( 'reply', '回复可见', "\n[reply]", "[/reply]\n" );//回复可见