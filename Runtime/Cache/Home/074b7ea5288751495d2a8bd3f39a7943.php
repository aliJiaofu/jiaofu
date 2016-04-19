<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录页面</title>
<link href="/jf/Public/css/layout.css" rel="stylesheet" type="text/css">

<meta name="Keywords" content="中国某某教育辅导" />
<meta name="Description" content="中国某某教育辅导" />

</head>

<body>
<!--头部-->
<div id="header">
   <div id="header_main">
     <img src="/jf/Public/images/logo.jpg"/>
     <a href="teacher_login.html" style="border: solid 1px #ffa200; color:#ffa200;">教师登录</a>
     <a href="student_login.html" style="border: solid 1px #05a4f6; color:#05a4f6; margin-right:20px;">学生登录</a>
   </div>
</div>
<!--导航-->
<div id="nav">
  <div id="nav_main">
     <ul>
      <li><a href="#">网站首页</a></li>
       <li><a href="#">我的课程</a></li>
       <li><a href="#">我的信息</a></li>
       <li><a href="#">我的社交</a></li>
       <li><a href="#">我的文件</a></li>
     </ul>  
  </div>
</div>

<!--导航-->
<div id="banner">
   <img src="/jf/Public/images/banner.jpg"/>
</div>

<!--主体-->
<div id="container">
<!--老师注册-->
  <div class="dmjg_jbjg">
    <div class="zddm_jbxxcon" style="overflow:visible;">
      <table width="100%" height="482" border="0" cellpadding="0" cellspacing="0" style="border:none;">
        <tr>
          <form id="lszcForm" name="lszcForm" method="post" action="/jf/index.php/Home/Index/check_login">
            <th width="70%" scope="col" bordercolor="#fff;" style=" border:none; text-align:left;"> <div class="lszc_con1"> <span>身份：</span>
                <input type="radio" class="lszc_sex" value="teacher" name="lszcsex" checked="checked">
                <small style="color:#000; margin-left:2px;font-size:13px;">我是老师</small>
                <input type="radio" class="lszc_sex" value="student" name="lszcsex">
                <small style="color:#000; margin-left:2px; font-size:13px;">我是学生</small> </div>
              <div class="lszc_con1"> <span>用户名：</span>
                <input type="text" name="email" class="lszc_yx"/>
              </div>
              <div class="lszc_con1">
                <div class="parentCls"> <span>密码：</span>
                  <input type="password" name="password"  class="inputEmail"/>
                </div>
              </div>
              <div class="lszc_zc" style="padding-left:110px;">
                <input name="Submit2" class="lszc_btn" type="submit" value="登录" onClick="lszcCheck()" style="float:left;">
                <a href="老师注册页面.html"><input name="Submit2" class="lszc_btn" type="button" value="注册" onClick="lszcCheck()" style="float:left; margin-left:10px;"></a>
                <small class="inputEmailt" style="line-height:30px; margin-left:18px;">新用户请注册</small> </div>
            </th>
          </form>
          <th width="23%" scope="col" style=" border:none;"><img src="/jf/Public/images/lszc_01.jpg"/></th>
        </tr>
      </table>
      </form>
      <script src="/jf/Public/js/zhece.js"></script>
    </div>
  </div>
  <!--老师注册完-->
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