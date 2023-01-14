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

$(".rankorderbox span").click(function () {
    $(".rankorderbox span").removeClass('active');
    $(this).addClass('active');
})


$(".video-gif-box").hover(function () {
    /*暂停主体播放*/
    var thevde = document.getElementById('TheVideo');
    thevde.pause();
    var videourl = $(this).attr('data-src');
    if (!$(this).find('video').attr('src')) {
        $(this).find('video').attr('src', videourl).attr('controls', true).attr('muted', true).attr('preload', true);
    } else {
        $(this).find('video').attr('controls', true).attr('muted', true).attr('preload', true);
    }
    var video = $(this).find('video').attr('id');
    var vde = document.getElementById(video);
    vde.play()
}, function () {
    $(this).find('video').attr('controls', false);
    var video = $(this).find('video').attr('id');
    var vde = document.getElementById(video);
    vde.currentTime = 0;
    vde.pause();
})

