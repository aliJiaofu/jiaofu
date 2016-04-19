window.onload=function(){
    function check(){
        var info=Array();
        info[0]=$('#school').val();
        info[1]=$('#name').val();
        info[2]=$('#stu_number').val();
        info[3]=$('#default').val();
        for(var i=0;i<info.length;i++){
            if(info[i]==''){

                $('#err_'+i).html('请填写相关信息');
                return false;
            }else{
                $('#err_'+i).html('');
            }
        }
    }

    function check_text(obj,i){
        if(obj.val()==''){
            $('#err_'+i).html('请填写相关信息');
        }else{
            $('#err_'+i).html('');
        }
    }

    $('#name').blur(function(){
        check_text($(this),1);
    })

    $('#stu_number').blur(function(){
        check_text($(this),2);
    })

    $('#button').click(function(){
        check();
        if(check()!=false){
            $.ajax({
                'url':'../Student/check_firstlogin',
                'type':'POST',
                'data':$('#first_login').serialize(),
                'success':function(response,status,xhr){
                    if(status=='success'){
                        if(response=='success'){
                            window.location.href='../Student/index';
                        }else if(response=='初始密码错误，请重新填写'){
                            $('#err_3').html('初始密码错误，请重新填写');
                        }else{
                            alert(response);
                        }
                    }else{
                        alert('数据获取失败，请重新连接');
                    }
                }
            })
        }
    })
}
