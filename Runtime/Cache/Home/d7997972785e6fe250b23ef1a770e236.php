<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="/jf/Public/js/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="/jf/Public/js/register.js"></script>
    <script type="text/javascript" src="/jf/Public/js/jq_cookie/jquery.cookie.js"></script>
    <link href="/jf/Public/css/register.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <form id="register" action="/jf/index.php/Home/Register/checkreg" method="post">
        姓　　名：<input type="text" name="name"/>
             <span id="err_0" class="err_message"></span><br/>
        性　　别：<input type="radio" name="sex" value="1" checked="checked"/>男
                   <input type="radio" name="sex" value="2"/>女<br/>
        学　　校：<select id="school" name="school">
                <option style="display: none" value="">请选择学校</option>
                <?php if(is_array($school)): $i = 0; $__LIST__ = $school;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sch): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sch["name"]); ?>"><?php echo ($sch["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span id="err_1" class="err_message"></span>
        <br/>
        <div id="deptname_box">
            学　　院：<select id="deptname" name="deptname">
                        <option style="display:none" value="">请选择学院</option>
                    </select>
            <span id="err_2" class="err_message"></span>
            <br/>
        </div>
        工　　号：<input type='text' name='ins_number'/>
             <span id="err_3" class="err_message"></span>
        <br/>
        邮　　箱：<input id="email"type="text" name="email"/>
                <span id="err_4" class="err_message"></span>
                <br/>
                <div class="email_type">
                    <ul>
                        <li><span></span>@gdufs.edu.cn</li>

                    </ul>
                </div>

        <div class="captcha-box">
        验　证码：<input type="text" id="code" placeholder="请输入验证码" name="code">
            <input type="button" id="getting" value="获取验证码">
            <span id="err_5" class="err_message"></span>
        </div><br/>
        手　机号：<input type="text" id="phone"name='phone'/>
                <span id="err_6" class="err_message"></span>
        <br/>
        密　　码：<input type="password" id="psw" name="password"/>
                <span id="err_7" class="err_message"></span><br/>
        确认密码：<input type="password" id="repeat" name="repeat"/>
                <span id="err_8" class="err_message"></span><br/>
        <input type="button" id='submit' value="confirm"/>

    </form>

    <div class="window">
        <p><strong>该账号已被注册，您可以直接
            <a href="login" style="color: red;">登录</a>
        </strong></p>
        <span>如非本人操作，请尝试 <span>联系客服 或 投稿邮箱</span></span>
    </div>

</body>
</html>