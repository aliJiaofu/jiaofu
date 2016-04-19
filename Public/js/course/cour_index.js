/**
 * Created by root on 16-1-18.
 */
window.onload=function(){
    function check(){
        var info = new Array();
        info[0] = $.trim($(':input[name=course_name]').val());
        info[1] = $.trim($('select[name=year]').val());
        info[2] = $.trim($('select[name=semester]').val());
        info[3] = $.trim($('select[name=date]').val());
        info[4] = $.trim($('select[name=start_time]').val());
        info[5] = $.trim($(':input[name=cor_address]').val());
        for(var i=0;i<info.length;i++){
            if(i==0||i==5){
                if(info[i]==''){
                    $('#err_'+i).html('请填写相关信息');
                    return false;
                }
                else{
                    $('#err_'+i).html('');
                }
            }else{
                if(info[i]==0){
                    $('#err_time').html('请填写详细时间');
                    return false;
                }else{
                    $('#err_time').html('');
                }
            }
        }
    }

    $('#course_name').blur(function(){
        check_empty($(this).val(),0)
    });

    function check_empty(val,i){
        if(val==''){
            $('#err_'+i).html('该处不能为空');
        }else{
            $('#err_'+i).html('');
        }
    }

    $('#stu_file').ajaxForm({
        //定义返回JSON数据，还包括xml和script格式
        dataType: 'json',
        beforeSubmit: function () {
            return check();

        },
        success: function (data){
            if(data.message=='上传成功！'){
                alert(data.message);
                window.location.href='../Course/cor_browse';
            }else{
                $('#err_7').html(data.message);
            }
        }

    })

    $('#check_file').click(function(){
        $('#screen').height($(document).height());
        $('#screen').show();
    })

    $('#screen').click(function(){
        $(this).hide();
    })
}