window.onload=function(){
    $('#screen').height($(document).height());
    if($(':input[name=stu_status]').val()!=0){
        $('#screen').hide();
    }
    function check(){
        var info=Array();
        info[0]=$('#major_name').val();
        info[1]=$('#grade').val();
        info[2]=$('#email').val();
        info[3]=$('#password').val();
        info[4]=$('#repeat').val();
        info[5]=$('#dept').val();
        for(var i=0;i<info.length;i++){
            if(info[i]==''){

                $('#err_'+i).html('请填写相关信息');
                return false;
            }else{
                $('#err_'+i).html('');
            }
        }
        if(info[4]!=info[3]){
            $('#err_4').html('两次密码输入不一致');
            return false;
        }else{
            $('#err_4').html('');
        }
    }

    function check_text(obj,i){
        if(obj.val()==''){
            $('#err_'+i).html('请填写相关信息');
        }else{
            $('#err_'+i).html('');
        }
    }

    $('#major_name').blur(function(){
        check_text($(this),0);
    })
    $('#grade').blur(function(){
        check_text($(this),1);
    })
    $('#email').blur(function(){
        check_text($(this),2);
    })
    $('#password').blur(function(){
        check_text($(this),3);
    })
    $('#repeat').blur(function(){
        check_text($(this),4);
        if($(this).val()!=$('#password').val()){
            $('#err_4').html('两次密码输入不一致');
        }else{
            $('#err_4').html('');
        }
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

    });

    $('#modify_submit').click(function(){
        check();
        if(check()!=false){
            $.ajax({
                'url':'../Student/modify_info',
                'type':'POST',
                'data':$('#modify_info').serialize(),
                'success':function(response,status,xhr){
                    if(status=='success'){
                        if(response=='exited_email'){
                            $('err_2').html('邮箱已经存在');
                        }else{
                            alert('账号激活成功');
                            $('#screen').hide();
                            $(':input[name=stu_status]').val(response);
                        }
                    }else{
                        alert('数据获取失败，请重试');
                    }
                }
            })
        }
    })
}
