$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// 操作关注和取关
$('.like-button').click(function(event){

    var target = $(event.target);
    var like_value = target.attr('like-value');
    var like_user = target.attr('like-user');

    // 发送ajax
    if(like_value == 1)
    {
        // 取关操作
        $.ajax({
            url:'/unfan/'+like_user,
            dataType:'json',
            method:'post',
            success:function(data){

                if(data.error==0)
                {
                    alert(data.msg);
                    target.attr('like-value',0);
                    target.text('关注');
                }


            },

        });
    }

    else
    {
        // 关注操作
        $.ajax({
            url:'/fan/'+like_user,
            dataType:'json',
            method:'post',
            success:function(data){

                if(data.error==0)
                {
                    alert(data.msg);
                    target.attr('like-value',1);
                    target.text('取消关注');
                }


            },

        });
    }
});

var editor = new wangEditor('content');

editor.config.uploadImgUrl = '/articles/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();


