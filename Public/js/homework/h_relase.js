window.onload=function(){
    CKEDITOR.replace( 'homework_detail' );

    if($('.homework').length<=0){
        $('#info').hide();
        $('#homework').html('您尚未布置任何作业');
    }else{
        $('#info').show();
    }
    $('#relase').click(function(){
        if($('#name').val()==''){
            return false;
        }
        
    })

}
