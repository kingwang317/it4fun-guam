<h4>利用 url 操作之相關函數:</h4>
<ol>
	<li>cutUrl($queryStringSet, $baseUrl='')</li>
	<li>addUrl($queryString='', $baseUrl='')</li>
	<li>keepUrl($queryStringSet, $baseUrl='')</li>
	<li>makeUrl($addUrl, $cutUrl='', $baseUrl='')</li>
</ol>

<?php require('url.func.php'); ?>
<?php 
$nowurl=$_SERVER['REQUEST_URI'];
$testurl='http://www.cool.com/index.php?pageid=22&v1=abc&v2=中&v3=123';
?>
</p>
<p><strong>範例使用之變數：</strong></p>
<p>現在的url為：<?php echo $_SERVER['REQUEST_URI']; ?></p>
<p>$testurl為：<?php echo $testurl; ?>
<h3>1.cutUrl($queryStringSet, $baseUrl='')</h3>
<p><strong>功能：</strong>去除url中的參數</p>
<p><strong>參數說明：</strong></p>
<p>$queryStringSet 為要去除的參數key值，以','隔開 例如 $queryStringSet= 'v1,v2,v3';</p>
<p>$baseUrl 為 optional 預設為 $_SERVIER['REQUEST_URI']</p>
<p><strong>範例：</strong></p>
<p>Ex1:
	<?php highlight_string('<?php echo cutUrl("v1,v2,v3");?>'); ?>
</p>
<p><?php echo cutUrl('v1,v2,v3');?></p>
<p>Ex2:<?php highlight_string('<?php echo cutUrl("v1,v2,v3",$testurl); ?>'); ?></p>
<p><?php echo cutUrl('v1,v2,v3',$testurl); ?></p>
<h3>2.addUrl($queryString='', $baseUrl='')</h3>
<p><strong>功能：</strong>為url加上參數</p>
<p><strong>參數說明：</strong></p>
<p>$queryString為要加上的url參數key與value， 例如 $queryString= 'v1=abc&amp;v2=def';</p>
<p>$baseUrl 為 optional 預設為 $_SERVIER['REQUEST_URI']</p>
<p><strong>範例：</strong></p>
<p>Ex1:
	<?php highlight_string('<?php echo addUrl("v3=100&v4=哈&v5=12345"); ?>'); ?>
</p>
<p><?php echo addUrl("v3=100&v4=哈&v5=12345"); ?></p>
<p>Ex2:<?php highlight_string('<?php echo addUrl("v3=100&v4=哈&v5=12345",$testurl); ?>'); ?></p>
<p><?php echo addUrl("v3=100&v4=哈&v5=12345",$testurl); ?></p>
<h3>3.keepUrl($queryStringSet, $baseUrl='')</h3>
<p><strong>功能：</strong>保留url中的參數，其它去除</p>
<p><strong>參數說明：</strong></p>
<p>$queryStringSet 為要保留的參數key值，以','隔開 例如 $queryStringSet= 'v1,v2,v3';</p>
<p>$baseUrl 為 optional 預設為 $_SERVIER['REQUEST_URI']</p>
<p><strong>範例：</strong></p>
<p>Ex1:
	<?php highlight_string('<?php echo keepUrl("v1,v2,v3"); ?>'); ?>
</p>
<p><?php echo keepUrl("v1,v2,v3"); ?></p>
<p>Ex2:<?php highlight_string('<?php echo keepUrl("v1,v2,v3",$testurl); ?>'); ?></p>
<p><?php echo keepUrl("v1,v2,v3",$testurl); ?></p>
<h3>4. makeUrl($addUrl, $cutUrl='', $baseUrl='')</h3>
<p><strong>功能：</strong>結合 addUrl 與 cutUrl使用</p>
<p><strong>參數說明：</strong></p>
<p>$addUrl 如 'v1=a&amp;v2=b'</p>
<p>$cutUrl 如 'v2,v3'</p>
<p>$baseUrl 為 optional 預設為 $_SERVIER['REQUEST_URI']</p>
<p><strong>範例：</strong></p>
<p>Ex1:
	<?php highlight_string('<?php echo makeUrl("v4=test","v1,v2,v3");?>'); ?>
</p>
<p><?php echo makeUrl("v4=test","v1,v2,v3");?></p>
<p>Ex2:<?php highlight_string('<?php echo makeUrl("v4=test","v1,v2,v3",$testurl);?>'); ?></p>
<p><?php echo makeUrl("v4=test","v1,v2,v3",$testurl);?></p>
<p>&nbsp;</p>
