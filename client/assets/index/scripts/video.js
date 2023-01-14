$(".rankorderbox span").click(function () {
    $(".rankorderbox span").removeClass('active');
    $(this).addClass('active');
})


$(".video-gif-box").hover(function () {
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