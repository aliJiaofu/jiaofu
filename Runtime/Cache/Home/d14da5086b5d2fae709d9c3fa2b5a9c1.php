<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="/jf/Public/js/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="/jf/Public/js/index/login.js"></script>
    <link rel="stylesheet" href="/jf/Public/css/index/login.css" type="text/css"/>
</head>
<body>
<center>
    <div id="login_center">
        <div id="nav_login">
            <div id="te_login">教师登陆</div>
            <div id="stu_login">学生登陆</div>
        </div>
        <div id="telogin_box">
            <form id="login"action="/jf/index.php/Home/Index/ins_login" method="post">
               邮箱：<input type="text" id="email"name="email"/>
                        <span id="err_0"></span>
                        <br/><br/>
                密码：<input type="password" id="psw"name="password"/>
                        <span id="err_1"></span>
                        <br/><br/>
                <input type="button" id='confirm'value="confirm"/>
                <a href="/jf/index.php/home/Register/index">教师注册</a>
            </form>
        </div>
        <div id="stulogin_box">
            <form id="stulogin"action="/jf/index.php/Home/Student/check_login" method="post">
                邮箱：<input type="text" id="stuemail"name="email"/>
                <span id="stuerr_0"></span>
                <br/><br/>
                密码：<input type="password" id="stupsw"name="password"/>
                <span id="stuerr_1"></span>
                <br/><br/>
                <input type="button" id='stuconfirm'value="confirm"/><br/>
                <a href="/jf/index.php/home/Student/first_login">学生无账号登陆</a>
            </form>
        </div>
    </div>
</center>
</body>
</html>