$("body").delegate('.tag-guanzhu-yes', 'mouseover', function () {
    $(this).removeClass('tag-guanzhu-yes').addClass('tag-guanzhu-no').html('<i class="iconfont icon-quxiaoguanzhuren"></i> 取消Ta');
})

$("body").delegate('.tag-guanzhu-no', 'mouseout', function () {
    $(this).addClass('tag-guanzhu-yes').removeClass('tag-guanzhu-no').html('<i class="iconfont icon-yiguanzhuren"></i> 已关注');
})

$("body").delegate('.tag-guanzhu-no', 'click', function () {
    layer.msg('已取关');
    $(".tagguanzhubox").html('<span class="tag-guanzhu tag-add"> <i class="iconfont icon-jiaguanzhuren"></i> 关注</span>');
})
$("body").delegate('.tag-add', 'click', function () {
    layer.msg('已关注');
    $(".tagguanzhubox").html('<span class="tag-guanzhu tag-guanzhu-yes "> <i class="iconfont icon-yiguanzhuren"></i> 已关注</span>');
})


$(".zan-btn-i").hover(function () {
    $(this).addClass('hover');
}, function () {
    $(this).removeClass('hover');
})

$(".zan-btn-i").click(function () {
    /*点赞成功后 执行*/
    $(this).removeClass('hover').addClass('zanok');
    var _this = $(this);
    setTimeout(function () {
        $(_this).removeClass('zanok');
        $(_this).find('.zan-numver').html(parseInt($(_this).find('.zan-numver').html()) + 1);
    }, 500);

})