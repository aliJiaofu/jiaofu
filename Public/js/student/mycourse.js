window.onload=function(){
    $('.check_homework').click(function(){
        var id=$(this).attr("id");
        var id_arr=id.split('_');
        $.ajax({
            'url':'../Student/check_homework',
            'type':'POST',
            'data':{'student_id':'','course_id':''},
            'success': function(response,status,xhr) {
                if(status=='success'){
                    if(response==''){

                    }else{

                    }
                }else{
                    alert('');
                }
            }
        })
        console.log(id_arr);
    })
}