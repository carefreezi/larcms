$.fn.countTo = function (a) {
    a = a || {};
    return $(this).each(function () {
        var c = $.extend({}, $.fn.countTo.defaults, {
            from: $(this).data("from"),
            to: $(this).data("to"),
            speed: $(this).data("speed"),
            refreshInterval: $(this).data("refresh-interval"),
            decimals: $(this).data("decimals")
        }, a);
        var h = Math.ceil(c.speed / c.refreshInterval), i = (c.to - c.from) / h;
        var j = this, f = $(this), e = 0, g = c.from, d = f.data("countTo") || {};
        f.data("countTo", d);
        if (d.interval) {
            clearInterval(d.interval)
        }
        d.interval = setInterval(k, c.refreshInterval);
        b(g);

        function k() {
            g += i;
            e++;
            b(g);
            if (typeof (c.onUpdate) == "function") {
                c.onUpdate.call(j, g)
            }
            if (e >= h) {
                f.removeData("countTo");
                clearInterval(d.interval);
                g = c.to;
                if (typeof (c.onComplete) == "function") {
                    c.onComplete.call(j, g)
                }
            }
        }

        function b(m) {
            var l = c.formatter.call(j, m, c);
            f.html(l)
        }
    })
};
$.fn.countTo.defaults = {
    from: 0,
    to: 0,
    speed: 1000,
    refreshInterval: 100,
    decimals: 0,
    formatter: formatter,
    onUpdate: null,
    onComplete: null
};

function formatter(b, a) {
    return b.toFixed(0).replace(/\B(?=(?:\d{3})+(?!\d))/g, ",")
}


function count(a) {
    var b = $(this);
    a = $.extend({}, a || {}, b.data("countToOptions") || {});
    b.countTo(a)
};

$(window).scroll(function () {
    InitToData();
})

function InitToData() {
    $(".timer").each(function (e) {
        if (!$(this).hasClass('showend')) {
            var eTop = $(this).offset().top;//橙色容器距离整个页面顶部的距离
            var wTop = $(window).height();//绿色框可视区域的高度
            var dTop = $(document).scrollTop();
            if (dTop + wTop > eTop) {//动画播放事件}
                $(this).addClass('showend').countTo();
            }
        }

    })
}

InitToData();