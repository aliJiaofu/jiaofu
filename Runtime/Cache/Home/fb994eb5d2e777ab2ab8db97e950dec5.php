<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>老师教辅首页</title>
<link href="/jf/Public/css/layout.css" rel="stylesheet" type="text/css">
<link href="/jf/Public/css/lsjfsy.css" rel="stylesheet" type="text/css">


<meta name="Keywords" content="中国某某教育辅导" />
<meta name="Description" content="中国某某教育辅导" />

</head>

<body>
<!--头部-->
<div id="header">
   <div id="header_main">
     <img src="/jf/Public/images/logo.jpg"/>
      <a href="老师登录页面.html" style="border: solid 1px #ffa200; color:#ffa200;">退出登录</a>
   </div>
</div>
<!--导航-->
<div id="nav">
  <div id="nav_main">
     <ul>
     <li><a href="/jf/index.php/Home/CheckRoll">网站首页</a></li>
       <li><a href="老师教辅首页.html">我的课程</a></li>
       <li><a href="老师个人信息修改页面.html">我的信息</a></li>
       <li><a href="#">我的社交</a></li>
       <li><a href="老师资料管理.html">我的文件</a></li>
     </ul>  
  </div>
</div>

<!--导航-->
<div id="banner">
   <img src="/jf/Public/images/banner.jpg"/>
</div>

<!--主体-->
<div id="container">
	<div id="index_left">
        <div id="index_lefttit">课程列表</div>
        <div id="index_leftcon">
           <div class="index_leftcontop">已结束的课程</div>
		   <select >  
  				<option value ="1">2014-2015学年第一学期</option>  
 			    <option value ="2">2014-2015学年第二学期</option>  
 			    <option value="3">2015-2016学年第一学期</option>  
 			    <option value="4">2015-2016学年第二学期</option>  
		   </select>
           <iframe src="left(detail(t)).html" width="279" marginwidth="0" height="500" frameborder="0" vspace="0" id="Iframe1" border="0" framespacing="0" noresize="noResize"></iframe>  
                   
        </div>         
  </div>
   <div id="index_kcxx1" class="right1">
        <div class="index_kcxxtop">
          <h1 style=" font-size:16px; float:left;">本学期的课程</h1>
          <span><a href="老师创建课程.html"><img src="/jf/Public/images/tjkc.jpg" width="60" height="22"></a></span>
	 </div>
	    <div id="index_leftcon2">
              <ul >
                <li><span><a href="#">关闭课程</a></span><a href="老师本学期课程功能列表.html">Java语言程序设计（英）<br>
                  开设学期：2015-2016学年第一学期<br>
                  上课时间：周一第3，4，5节<br>
                上课地点：实验楼A43</a></li>
                <li><span><a href="#">关闭课程</a></span><a href="老师本学期课程功能列表.html">数据库系统原理（英）<br>
                开设学期：2015-2016学年第一学期<br>
上课时间：周一第3，4，5节<br>
上课地点：实验楼A403</a></li>
                <li><span><a href="#">关闭课程</a></span><a href="老师本学期课程功能列表.html">体育课<br>
                开设学期：2015-2016学年第一学期<br>
上课时间：周一第3，4，5节<br>
上课地点：实验楼A403</a></li>
                <li><span><a href="#">关闭课程</a></span><a href="老师本学期课程功能列表.html">微积分<br>
                开设学期：2015-2016学年第一学期<br>
上课时间：周一第3，4，5节<br>
上课地点：实验楼A403</a></li>
                <li><span><a href="#">关闭课程</a></span><a href="老师本学期课程功能列表.html">综合英语（2）<br>
                开设学期：2015-2016学年第一学期<br>
上课时间：周一第3，4，5节<br>
上课地点：实验楼A403</a></li>             
              </ul>           
     </div>
	 
   </div>


  <div class="clear"></div>
  <!--友情链接-->
  <div id="index_yqlj">
    <span>友情链接:</span>&nbsp;&nbsp;&nbsp; <a href="#">友情链接内容</a>&nbsp; |&nbsp;  <a href="#">友情链接内容</a>&nbsp;  | &nbsp; <a href="#">友情链接内容</a>&nbsp;  |&nbsp;  <a href="#">友情链接内容</a> &nbsp; |&nbsp;  <a href="#">友情链接内容</a> &nbsp; |&nbsp;  <a href="#">友情链接内容</a>&nbsp;   |  &nbsp;<a href="#">友情链接内容</a>  &nbsp;| &nbsp; <a href="#">友情链接内容</a>&nbsp;  | &nbsp; <a href="#">友情链接内容</a> 
  </div>
  
</div><!--主体完-->
<!--底部-->
<div id="footer">
<a href="#">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">广告投放</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">招聘信息</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">版权信息</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">免责声明</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">联系我们</a><br>教育部教育管理信息中心主办 京ICP备15022426号
</div>

</body>
</html>