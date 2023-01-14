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


var HomeInit;


$(".CdPlayerBox").click(function () {
    if (!$(this).hasClass('playLoding')) {//开始播放
        ClearVideoMuice();
        var videourl = $(this).attr('data-src');

        if (!$(this).find('audio').attr('src')) {
            $(this).find('audio').attr('src', videourl);
        }

        var video = $(this).find('audio').attr('id');
        var vde = document.getElementById(video);
        vde.play()
        $(this).addClass('playLoding');
        $(this).find(".CD-icon").addClass('active');
        $(this).find(".ibtntool i:first-child").removeClass('active');
        $(this).find(".ibtntool i:last-child").addClass('active');
        HomeInit = setInterval(function () {
            GetPoressMusic(vde);
        }, 500);
    } else {//暂停播放
        var video = $(this).find('audio').attr('id');
        var vde = document.getElementById(video);
        vde.pause();
        clearInterval(HomeInit);
        $(this).removeClass('playLoding');
        $(this).find(".CD-icon").removeClass('active');
        $(this).find(".ibtntool i:last-child").removeClass('active');
        $(this).find(".ibtntool i:first-child").addClass('active');
        $(vde).parents('.row').find('.progress-bar').removeClass('progress-bar-animated');
    }
})


function ClearVideoMuice() {
    $(".CdPlayerBox.playLoding").each(function () {
        clearInterval(HomeInit);
        var video = $(this).find('audio').attr('id');
        var vde = document.getElementById(video);
        vde.pause();
        $(this).removeClass('playLoding');
        $(vde).parents('.row').find('.progress-bar').removeClass('progress-bar-animated');
        $(this).find(".CD-icon").removeClass('active');
        $(this).find(".ibtntool i:last-child").removeClass('active');
        $(this).find(".ibtntool i:first-child").addClass('active');
    })
}


function GetPoressMusic(Video) {
    var max = Video.duration;
    var curre = Video.currentTime;
    $(Video).parents('.row').find('.durationtimexc').html(formatSeconds(max));
    $(Video).parents('.row').find('.progress-time').html(formatSeconds(curre));
    var posr100 = curre / max * 100;
    $(Video).parents('.row').find('.progress-bar').css("width", posr100 + "%").attr('aria-valuenow', posr100).addClass('progress-bar-animated');

    if (posr100 == 100 || posr100 > 100) {
        clearInterval(HomeInit);
        ClearVideoMuice();
    }
}


$('.progress').click(function (e) {
    if ($(this).parents('.row').find('.CdPlayerBox').hasClass('playLoding')) {

        var de = $(this).offset().left;
        var xx = e.originalEvent.x || e.originalEvent.layerX || 0;
        var new_posr = (xx - de) / $(this).width();
        var videoid = $(this).parents('.row').find('audio').attr('id');
        var vde = document.getElementById(videoid);
        vde.currentTime = vde.duration * new_posr;
    }else{
        layer.msg('请先点击播放');
    }

})
