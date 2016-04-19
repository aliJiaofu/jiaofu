window.onload=function(){
//加载学院信息
    $('#school').click(function(){
        if($('#school').val()!=''){
            var school=$('#school').val();
            $.ajax({
                'url':"../Register/get_dept?school="+school,
                'type':'GET',
                success:function(response,status,xhr){
                    if(status=='success'){
                        $('#deptname_box').show();
                       var dept=$.parseJSON(response);
                        //$('#deptname').get(0).hide();
                        for(var i=0;i<dept.length;i++){
                            $('#deptname').append('<option value="'+dept[i].dept_name+'">'+dept[i].dept_name+"</option>");
                        }

                    }else{
                        alert('数据请求失败');
                    }
                }
            });
        }else{
            $('#deptname_box').hide();
        }
    })
    //防止刷新
    if($.cookie("captcha")){
        var count = $.cookie("captcha");
        var btn = $('#getting');
        btn.val(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');
        var resend = setInterval(function(){
            count--;
            if (count > 0){
                btn.val(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');
                $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
            }else {
                clearInterval(resend);
                btn.val("获取验证码").removeClass('disabled').removeAttr('disabled style');
            }
        }, 1000);
    }
    //获取验证码
    $('#getting').click(function(){
        var btn = $(this);
        var count = 5;
        var resend = setInterval(function(){
            count--;
            if (count > 0){
                btn.val(count+"秒后可重新获取");
                $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
            }else {
                clearInterval(resend);
                btn.val("获取验证码").removeAttr('disabled style');
            }
        }, 1000);
        btn.attr('disabled',true).css('cursor','not-allowed');
        $.ajax({
            'url':"../Register/getcode",
            'type':'POST',
            'data':{email:$('#email').val()},
            success : function(response ,status,xhr) {
                if(status == 'success'){
                    if(response=='success'){
                        alert('验证码已经成功发送');
                    }else if(response=='err_email'){
                        alert('错误的邮箱格式');
                    }
                    else{
                        alert('验证码发送失败');
                    }
                }else{
                    alert('获取数据失败');
                }
            }
        });
    })
//邮箱补全------------------------
    $('.email_type ul li').hover(function(){
        $(this).css('background','#ccc');
        $(this).css('color','#369');
    },function(){
        $(this).css('background','none');
        $(this).css('color','#666');
    });
    $('.email_type ul li').bind('mousedown',function(){
        $(':input[name=email]').val($(this).text());
    })
    $(':input[name=email]').bind('keyup',function(){

        $('.email_type li').eq(this.index).css('background','#f1f1f1');
        $('.email_type li').eq(this.index).css('color','#666');

        if($(this).val().indexOf('@') == -1){
            $('.email_type').css('display','block');
            $('.email_type li span').html($(this).val());
        }else $('.email_type').css('display','none');

        if(event.keyCode == 40){
            if(this.index == undefined
                || this.index >= $('.email_type li').length - 1
            ){
                this.index = 0;
            }else this.index ++;
        }else if(event.keyCode == 38){
            if(this.index == undefined
                || this.index <= 0){
                this.index = $('.email_type li').length - 1;
            }else this.index --;
        }else if(event.keyCode == 13){
            $(this).val($('.email_type li').eq(this.index).text());
            $('.email_type').css('display','none');
            this.index = undefined;
        }

        if(this.index != undefined){
            $('.email_type li').eq(this.index).css('background','#e5edf2');
            $('.email_type li').eq(this.index).css('color','#369');
        }
    }).bind('blur',function(){
        $('.email_type').css('display','none');
        $.ajax({
            'url':"../Register/check_email",
            'type':"GET",
            'data':{
                email:$(':input[name=email]').val()
            },
            success : function(response,status,xhr){
                if(status != 'success') alert('获取数据失败');
                else if(response == 1){
                    $('#err_4').html('该邮箱已经被注册');
                }else{
                    $('#err_4').html('');
                }
            }
        });
    });
//注册信息检测
    function check(){
        var info=new Array();
        info[0] = $.trim($(':input[name=name]').val());
        info[1] = $.trim($('select[name=school]').val());
        info[2] = $.trim($('select[name=deptname]').val());
        info[3] = $.trim($(':input[name=ins_number]').val());
        info[4] = $.trim($(':input[name=email]').val());
        info[5] = $.trim($(':input[name=code]').val());
        info[6] = $.trim($(':input[name=phone]').val());
        info[7] = $.trim($(':input[name=password]').val());
        for(var i = 0;i <info.length; i++){
            if(info[i] == ''){
                $('#err_'+i).html('请填写相关信息');
                return false;
            }else{
                $('#err_'+i).html('');
            }
        }
        if(!/^[\w\-\.]+@[\w\-\.]+.edu.cn$/.test(info[4])){
            $('#err_4').html('错误的邮箱格式');
            return false;
        }
        if(info[7].length < 6 || info[7].length > 11) {
            $('#err_7').html('密码长度应该在６到11位');
            return false;
        }
        $('#psw').blur(function(){
            if(info[7].length < 6 || info[7].length > 11) {
                $('#err_7').html('密码长度应该在６到11位');
                return false;
            }
        })
        if(info[7]!=$('#repeat').val()){
            $('#err_8').html('两次密码输入不一致');
            return false;
        }else{
            $('#err_8').html('');
        }
        if(!/^[1-9]\d*$/.test(info[6])||info[6].length!=11){
            $('#err_6').html('请填写正确的电话格式');
            return false;
        }else{
            $('#err_6').html('');
        }
        $.ajax({
            'url':"../Register/check_verify",
            'type':'GET',
            'data':{code:info[5]},
            success : function(response ,status,xhr) {
                if(status == 'success'){
                    if(response == 1){
                        $('#err_5').html('');
                    }else{
                        $('#err_5').html('验证码错误，请重新输入');

                    }
                }else{
                    alert('获取数据失败');
                }
            }
        });
    }
//邮箱失去焦点事件
    $(':input[name=email]').blur(function(){
        var email=$.trim($(':input[name=email]').val());
        $.ajax({
            'url':"../Register/check_email",
            'type':'GET',
            'data':{email:$(this).val()},
            success : function(response ,status,xhr) {
                if(status == 'success'){
                    if(response == '1'){
                        $('#err_4').html('邮箱已经被注册');
                    }else if(!/^[\w\-\.]+@[\w\-\.]+.edu.cn$/.test(email)){
                        $('#err_4').html('错误的邮箱格式');
                    }
                    else{
                        $('#err_4').html('');
                    }
                }else{
                    alert('获取数据失败');
                }
            }
        });
    })
//验证码失去焦点事件
    $(':input[name=code]').blur(function(){
        $.ajax({
            'url':"../Register/check_verify",
            'type':'GET',
            'data':{code:$(this).val()},
            success : function(response ,status,xhr) {
                if(status == 'success'){
                    if(response == 1){
                        $('#err_5').html('');
                    }else{
                        $('#err_5').html('验证码错误，请重新输入');
                    }
                }else{
                    alert('获取数据失败');
                }
            }
        });
    })
//密码失去焦点
    $('#psw').blur(function(){
        if($(this).val().length < 6 || $(this).val().length > 11) {
            $('#err_7').html('密码长度应该在６到11位');
            return false;
        }else{
            $('#err_7').html('');
        }
    })
//重复密码失去焦点
    $('#repeat').blur(function(){
        if($('#psw').val()!=$(this).val()){
            $('#err_8').html('两次密码输入不一致');
            return false;
        }else{
            $('#err_8').html('');
        }
    })
    $('#phone').blur(function(){
        if(!/^[1-9]\d*$/.test($(this).val())||$(this).val().length!=11){
            $('#err_6').html('请填写正确的电话格式');
            return false;
        }else{
            $('#err_6').html('');
        }
    })
//注册信息最终检验
    $('#submit').click(function(){
        check();
        if(check()!=false) {
            $.ajax({
                'url': "../Register/checkreg",
                'type': 'POST',
                'data': $('form').eq(0).serialize(),
                success: function (response, status, xhr) {
                    if (status == 'success') {
                        if (response=='注册成功') {
                            window.location.href="../Index/index";
                        } else if(response=='fail'){
                            $('#err_5').html('验证码错误');
                        }else{
                            $('#err_4').html('邮箱已经存在');
                        }
                    } else {
                        alert('获取数据失败');
                    }
                }
            });
        }
    })
}