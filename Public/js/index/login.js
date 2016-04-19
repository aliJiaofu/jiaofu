window.onload=function(){

    function check_login(){
        var info=new Array();
        info[0]=$('#email').val();
        info[1]=$('#psw').val();
        for(var i=0;i<info.length;i++){
            if(info[i]==''){
                $('#err_'+i).html('请填写相关信息');
                return false;
            }else{
                $('#err_'+i).html('');
            }
        }
    }

    $('#confirm').click(function(){
        check_login();
        if(check_login()!=false){
            $.ajax({
                'url':'../Index/check_login',
                'type':'POST',
                'data':$('#login').serialize(),
                'success':function(response,status,xhr){
                    if(response=='fail'){
                        alert('用户名或密码错误');
                    }else{
                        window.location.href='index'
                    }
                }
            })
        }

    })

    $('#te_login').click(function(){
        $(this).css('border-bottom','none');
        $('#stu_login').css('border-bottom','thin #000 solid');
        $('#telogin_box').show();
        $('#stulogin_box').hide();
    })

    $('#stu_login').click(function(){
        $(this).css('border-bottom','none');
        $('#te_login').css('border-bottom','thin #000 solid');
        $('#telogin_box').hide();
        $('#stulogin_box').show();
    })

    function check_stulogin(){
        var info=new Array();
        info[0]=$('#stuemail').val();
        info[1]=$('#stupsw').val();
        for(var i=0;i<info.length;i++){
            if(info[i]==''){
                $('#err_'+i).html('请填写相关信息');
                return false;
            }else{
                $('#err_'+i).html('');
            }
        }
    }

    $('#stuconfirm').click(function(){
        check_stulogin();
        if(check_stulogin()!=false){
            $.ajax({
                'url':'../Student/check_login',
                'type':'POST',
                'data':$('#stulogin').serialize(),
                'success':function(response,status,xhr){
                    if(response=='fail'){
                        alert('用户名或密码错误');
                    }else{
                        window.location.href='../Student/index'
                    }
                }
            })
        }

    })
}
