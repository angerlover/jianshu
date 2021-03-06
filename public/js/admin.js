/**
 * Created by pepe on 2017/10/26.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.post-audit').click(function(){
    var target = $(this);
    var status = target.attr('article-action-status'); // 获取状态
    var article_id = target.attr('article-id'); // 文章的id
    if(confirm('确定拒绝吗？'))
    {

        $.ajax({
            url:'/admin/shenhe/'+article_id,
            method:'post',
            data:{'status':status},
            dataType:'json',
            success:function(data)
            {
                if(data.error != 0)
                {
                    alert(msg);
                }
                else
                {
                    target.parent().parent().remove();
                }
            },
        });
    }
});

$('.resource-delete').click(function(event){
    var target = $(this);
    var url = target.attr('delete-url');
    if(confirm('确定删除吗？'))
    {
        event.preventDefault();
        $.ajax({
            url:url,
            method:'post',
            data:{'_method':'DELETE'},
            dataType:'json',
            success:function(data)
            {
                if(data.error != 0)
                {
                    alert(msg);
                }

                // 刷新页面
                window.location.reload();
            },
        });
    }
});