function formatSeconds(value) {
    if(!value){
        return '加载中';
    }
    var secondTime = parseInt(value);// 秒
    var minuteTime = 0;// 分
    var hourTime = 0;// 小时
    if (secondTime > 60) {//如果秒数大于60，将秒数转换成整数
        //获取分钟，除以60取整数，得到整数分钟
        minuteTime = parseInt(secondTime / 60);
        //获取秒数，秒数取佘，得到整数秒数
        secondTime = parseInt(secondTime % 60);
        //如果分钟大于60，将分钟转换成小时
        if (minuteTime > 60) {
            //获取小时，获取分钟除以60，得到整数小时
            hourTime = parseInt(minuteTime / 60);
            //获取小时后取佘的分，获取分钟除以60取佘的分
            minuteTime = parseInt(minuteTime % 60);
        }
    }

    if (parseInt(secondTime) < 10) {
        secondTime = "0" + secondTime;
    }

    if (parseInt(minuteTime) < 10) {
        minuteTime = "0" + minuteTime;
    }

    if (parseInt(hourTime) < 10) {
        hourTime = "0" + hourTime;
    }

    var result = "" + secondTime + "";

    if (minuteTime > 0) {
        result = "" + minuteTime + ":" + result;
    }else{
        result = "00" + ":" + result;
    }
    if (hourTime > 0) {
        result = "" + hourTime + ":" + result;
    }
    return result;
}


toastr.options = {
    "closeButton": false,
    "positionClass": "toast-top-right",
    "showDuration": "300",
    "hideDuration": "1500",
    "timeOut": "1500",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};


$.fn.formData = function () {
    var arr_data = $(this).serializeArray();
    var data = {};
    if (arr_data.length > 0) {
        arr_data.forEach(function (item, index) {
            var type = typeof data[item.name];
            if (type === 'undefined') {
                data[item.name] = item.value;
            } else {
                if (type === 'object') {
                    data[item.name].push(item.value);
                } else {
                    data[item.name] = [data[item.name], item.value];
                }
            }
        });
    }
    return data;
};





/**
 *
 * @param option
 * @returns {boolean}
 */
function request(option) {

    if (typeof(option) !== 'object') {
        console.warn("option is not a 'object'");
        return false;
    }
    var btn = option.btn && (typeof(option.btn) === 'string') ? $(option.btn) : option.btn;
    var btn_text = "";
    if (btn && btn.prop("disabled") === true) {
        return false;
    }
    if (btn) {
        btn_text = btn.html();
        btn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
    }

    option.url = option.url || $("form[action]").attr("action");

    $.ajax({
        url: option.url || location.pathname,
        data: option.data || null,
        dataType: option.dataType || 'JSON',
        type: option.type || 'post',
        async: typeof(option.async) === 'boolean' ? option.async : true,
        success: option.success || function (res) {
            var url = res.url;
            if (url) {
                setTimeout(function () {
                    window.location = url;
                }, 1000)
            }
            if (!res.code) {
                option.reload = false;
            }
            setTimeout(function () {
                if (res.code) {
                    toastr.success(res.msg, {timeOut: 2000})
                }
                else {
                    toastr.error(res.msg, {timeOut: 2000})
                }
            }, 10);
            option.done && option.done(res);
        },
        complete: function (res) {
            // console.log(res.responseJSON);
            if (btn) {
                setTimeout(function () {
                    btn.prop("disabled", false).html(btn_text);
                }, 500)
            }

            setTimeout(function () {
                var ret = option.reload || false;

                if (ret) {
                    ret = (typeof(ret) === 'number') ? ret : 0;
                    setTimeout(function () {
                        location.reload();
                    }, ret * 1000);
                }

            }, 10)
        },
        error: option.error || function (e) {
            toastr.error('error:' + e.statusText || e.statusMessage);
        }
    });
}

/**
 * 退出登录
 */
function login_out() {

    layer.confirm("确定要退出登录吗?", function (index) {

        request({
            url: "/admin/index/login_out", done: function () {
                layer.close(index);
            }
        });

    });

}

//音頻播放监听出错
document.addEventListener("error", function (e) {
    var elem = e.target;
    if (elem.tagName.toLowerCase() == "audio") {
        $(elem).removeAttr('src');
        $(elem).parents('.CdPlayerBox').removeClass('playLoding');
        $(elem).parents('.CdPlayerBox').find('.CD-icon').removeClass('active');
        $(elem).parents('.CdPlayerBox').find(".ibtntool i:last-child").removeClass('active');
        $(elem).parents('.CdPlayerBox').find(".ibtntool i:first-child").addClass('active');
        clearInterval(HomeInit);
       layer.msg('播放出错,请重试!');
    }
}, true);