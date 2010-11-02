<h1>class name: urlNavigation </h1>
<p><strong>功能：</strong>以 url 參數做頁面導覽</p>
<p><strong>需求：</strong>navigation.xml</p>
<h3>Motheds:</h3>
<p><strong>導覽相關：</strong></p>
<p>listMenu() -&gt; 以 html list 方式列出導覽</p>
<p><strong>輸出內容相關函式：</strong></p>
<p>includePage() -&gt; include url 參數對應的檔案</p>
<p>iframePage() -&gt; iframe url 參數對應的檔案 ( 隨內容自動調整內容高度 )</p>
<p>iframePage2()-&gt; 另一個 iframe url 參數對應的檔案 ( 根據螢幕高度固定高度 )</p>
<p>&nbsp;</p>
<h3>navigation.xml 範例：</h3>
<p>&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;<br>
	&lt;pageTray urlKey=&quot;imkey&quot; currentClass=&quot;current&quot;&gt;<br>
&lt;page urlValue=&quot;1&quot; file=&quot;childPage1.php&quot; menuTitle=&quot;Page1&quot; /&gt;<br>
&lt;page urlValue=&quot;2&quot; file=&quot;{SRVROOT}/childPage2.php&quot; menuTitle=&quot;Page2&quot; /&gt;<br>
&lt;page urlValue=&quot;3&quot; file=&quot;{WEBROOT}/childPage3.php&quot; menuTitle=&quot;Page3&quot; hide=&quot;hide&quot; /&gt;<br>
&lt;/pageTray&gt;</p>
<h3><strong>說明：</strong></h3>
<p><strong>Tag1: </strong>根目錄 &lt;pageTray&gt;</p>
<p>Attribute:</p>
<ul>
	<li>urlKey: url 參數key 值</li>
	<li>currentClass: 輸出 list 時，正在此頁的 class</li>
</ul>
<p><strong>Tag2: </strong>頁面 &lt;page&gt;</p>
<p>Attribute:</p>
<ul>
	<li>urlValue: url 參數的值</li>
	<li>file: 對應的檔案位置</li>
	<li>menuTitle: 於導覽中顯示的標題文字</li>
	<li>hide: 預設隱藏 (hide=”hide”)</li>
</ul>
<p>預設變數：</p>
<ul>
	<li>{SRVROOT}: 將轉換為 cms 根目錄的 Server 絕對路徑</li>
	<li>{WEBROOT}: 將轉換為 cms 根目錄的 web 絕對路徑</li>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
