@extends('public.public')
@section('content')

    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <div class="right-personal personal-set clearfix">
                    <div class="personal-bd personal-bd-nobg">
                        <div class="my-information">
                            <div class="message_tip message_zhu"><span class="title">账户管理</span></div>
                            <div class="information-con">

                                <div class="buser-box">
                                    <dl class="grzl">
                                        <dt><i class=""></i> 个人资料</dt>
                                        <dd><a href="javascript:void(0)" class="compiler"><i></i>编辑</a> Carefree</dd>
                                    </dl>
                                    <div class="box">
                                        <form action="javascript:void(0)" method="get">
                                            <ul class="inputFrame_info bind_info clearfix">
                                                <li class="dlmc">登录名称：qq_mpsugxs</li>
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons"><i>*</i>昵称</label>
                                                        <input type="text" id="nickName" maxlength="15" class="txt"
                                                               value="Carefree"
                                                               placeholder="请输入您的昵称">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons">性别</label>
                                                        <label>
                                                            <input id="chkSexMan" type="radio" class="xb-l"
                                                                   checked="checked"
                                                                   name="rdosex" value="1">
                                                            男
                                                        </label>
                                                        <label>
                                                            <input id="chkSexWoman" class="xb-l" type="radio" name="rdosex"
                                                                   value="2">
                                                            女
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons">姓名</label>
                                                        <input type="text" id="realName" value="" class="txt"
                                                               placeholder="请输入您的真实姓名">
                                                    </div>
                                                </li>

                                                <li>
                                                    <input id="submitInfo" type="submit" value="保存" class="inputFrame_btn">
                                                </li>
                                                <li class="w1"> “ <em>*</em> ”为必填项</li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>


                                <div class="buser-box">
                                    <dl class="yhtx">
                                        <dt><i class=""></i>用户头像</dt>
                                        <dd><a href="javascript:void(0)" class="compiler"><i></i>编辑</a> <img
                                                src="//qzapp.qlogo.cn/qzapp/100270923/7AD3C2F1D53CE1E2B4279EF3E12089E6/30">
                                            <span>赶快设置属于自己的头像吧~~</span>
                                        </dd>
                                    </dl>
                                    <div class="box">
                                        <div class="tx-pic">
                                            <div class="recommend clearfix">
                                                <h3>推荐头像</h3>
                                                <ul>
                                                    <li><a href="javascript:void(0)"><img
                                                                src="/static/index/images/avater/default3.png" alt="墨镜男"
                                                                title="墨镜男"></a></li>
                                                    <li><a href="javascript:void(0)"><img
                                                                src="/static/index/images/avater/default4.png" alt="墨镜女"
                                                                title="墨镜女"></a></li>
                                                    <li><a href="javascript:void(0)"><img
                                                                src="/static/index/images/avater/default1.png" alt="电脑人小蓝"
                                                                title="电脑人小蓝"></a></li>
                                                    <li><a href="javascript:void(0)"><img
                                                                src="/static/index/images/avater/default2.png" alt="电脑人小粉"
                                                                title="电脑人小粉"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="rg-dimensions">
                                            <div class="tis">
                                                <h3>效果预览</h3>
                                            </div>
                                            <div class="pic-180">
                                                <img id="bigAvatarBox" data-pid="0"
                                                     src="//qzapp.qlogo.cn/qzapp/100270923/7AD3C2F1D53CE1E2B4279EF3E12089E6/30">
                                                <p>180*180像素</p>
                                            </div>
                                            <div class="pic-50">
                                                <img id="smailAvatarBox"
                                                     src="//qzapp.qlogo.cn/qzapp/100270923/7AD3C2F1D53CE1E2B4279EF3E12089E6/30">
                                                <p>50*50像素</p>
                                            </div>
                                        </div>
                                        <div class="box-btn clear"><a id="updateAvatarBtn" href="javascript:void(0)">保存</a>
                                            <a
                                                href="javascript:void(0)" class="quxiao">取消</a></div>
                                    </div>
                                </div>


                                <div class="buser-box">
                                    <dl class="zhmm _password">
                                        <dt><i></i>账户密码</dt>
                                        <dd><a href="javascript:void(0)" class="compiler"><i></i>编辑</a> ******</dd>
                                    </dl>
                                    <div class="box">
                                        <form action="javascript:void(0)" method="get">
                                            <ul class="inputFrame_info bind_info clearfix modifyPassword">
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons mm"></label>
                                                        <input type="password" class="txt inputPassword mm-passw"
                                                               placeholder="请输入原始密码" data-type="0">
                                                    </div>
                                                    <div class="warn " style=" display:block"><span
                                                            class="errorTag">&nbsp;</span><span style="display:none"
                                                                                                class="ztag"></span></div>
                                                </li>
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons mm"></label>
                                                        <input type="password" class="txt inputPassword mm-passw"
                                                               placeholder="请输入新密码" data-type="1">
                                                    </div>
                                                    <div class="warn " style=" display:block"><span
                                                            class="errorTag">&nbsp;</span><span style="display:none"
                                                                                                class="ztag">新密码必须与旧密码不同</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cline">
                                                        <label class="inptIcons mm"></label>
                                                        <input type="password" class="txt mm-passw newPassword"
                                                               placeholder="请再次输入新密码">
                                                    </div>
                                                    <div class="warn warn2"><span class="errorTag false">&nbsp;</span><span
                                                            style="display:none" class="ztag">确认密码和新密码不一致</span></div>
                                                </li>
                                                <li>
                                                    <input name="" type="submit" value="确认提交" class="inputFrame_btn">
                                                    <a href="https:#/findpwd" class="forget-password">忘记密码</a>
                                                </li>
                                                <li class="w1"><em>*</em>1.为保证您的账户安全，新密码必须与旧密码不同。</li>
                                                <li class="w1"><em>*</em> 2.密码由8-20位字符（字母、数字、符号）组合而成， 不能只使用一种字符。</li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>

                                <div class="buser-box">
                                    <dl class="bdsj">
                                        <dt><i class=""></i> 绑定手机</dt>
                                        <dd><a href="javascript:void(0)" class="compiler"><i></i>编辑</a> 132****44444 <span>若手机更换或停用，请立即修改，避免账户被盗</span>
                                        </dd>
                                    </dl>

                                    <div class="box">

                                        <form action="javascript:void(0)">
                                            <ul class="inputFrame_info bind_info bindPhone  clearfix">
                                                <li class="w1"><em>*</em>重新绑定手机请验证您的用户信息</li>
                                                <li class="dlmc">132444444444</li>
                                                <li class="checkLi">
                                                    <div class="cline">
                                                        <label class="inptIcons mm"></label>
                                                        <input type="password" class="txt inputPassword mm-passw"
                                                               placeholder="请输入当前登录密码">
                                                    </div>
                                                    <div class="warn warn2" style="display:none"><span
                                                            class="flase">&nbsp;</span><span class="ztag">密码输入错误</span>
                                                    </div>
                                                </li>
                                                <li class="checkLi">
                                                    <div class="cline">
                                                        <label class="inptIcons mm sj"></label>
                                                        <input type="txt" class="txt inputPhone mm-passw"
                                                               placeholder="请输入您要新绑定的手机号码">
                                                    </div>
                                                    <div class="warn" style="display:none"><span
                                                            class="flase">&nbsp;</span><span class="ztag">手机号码格式错误</span>
                                                    </div>
                                                </li>
                                                <li class="w3 dt-mm checkLi">
                                                    <div class="cline">
                                                        <label class="inptIcons mm yx "></label>
                                                        <input type="text" class="txt _code" placeholder="请输入右侧验证码">
                                                    </div>
                                                    <div class="warn" style="display:none"><span
                                                            class="ture">&nbsp;</span><span
                                                            style="display:none" class="ztag"></span></div>

                                                    <a href="javascript:;" class="get-code get-code-img"><img
                                                            class="_changeImgCode" style="padding-top:2px;"
                                                            data-src="/uc/captcha?style=3&amp;border=false&amp;fontSize=22&amp;imgh=40&amp;num=5"
                                                            title="点击更换验证码"></a>
                                                </li>
                                                <li class="w3 dt-mm">
                                                    <div class="cline">
                                                        <label class="inptIcons mm dx"></label>
                                                        <input type="text" class="txt _code" placeholder="请输入短信验证码">
                                                    </div>
                                                    <div class="warn" style="display:none"><span
                                                            class="ture">&nbsp;</span><span
                                                            style="display:none" class="ztag"></span></div>
                                                    <a href="javaScript:;" class="get-code _getCode">发送验证码</a>
                                                </li>
                                                <li>
                                                    <input name="" type="submit" value="重新绑定" class="inputFrame_btn">
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>

                                <div class="buser-box">
                                    <dl class="dsf">
                                        <dt><i class=""></i> 第三方账号绑定</dt>
                                        <dd>
                                            <a href="javascript:void(0)" class="compiler"><i></i>编辑</a>
                                            <a href="javascript:void(0)" class="bding bd-weibo sina "></a>
                                            <a href="javascript:void(0)" class="bding bd-qq qq this"></a>
                                            <a href="javascript:void(0)" class="bding bd-wxin weixin "></a>
                                        </dd>
                                    </dl>
                                    <div class="box">

                                        <ul class="bundles-id clearfix">
                                            <li class="info"> 绑定第三方账号,可以使用第三方账号直接登录</li>
                                            <li class="">
                                                <i class="sina"></i> <span>未绑定新浪微博账号</span>
                                                <a href="#/oauth/login">绑定新浪微博</a>
                                            </li>
                                            <li class="this">
                                                <i class="qq"></i> <span>已绑定QQ账号</span>
                                                <a href="javascript:void(0)" data-type="qq"
                                                   class="relieve _open_remove">解除绑定</a>
                                            </li>
                                            <li class="">
                                                <i class="weixin"></i><span>未绑定微信账号</span>
                                                <a href="#/oauth/login">绑定账号</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="message-cont message-ip">
                            <div class="message_tip clearfix"><span class="title">登录历史记录</span></div>
                            <p class="tips">由于宽带运营商不定期调整网络，我们获取IP所在地可能不准确，请通过登录时间与产品判断是否为您本人操作</p>
                            <p class="orange">
                                如确定非您本人登录，建议您<a href="#" class="link">【立即修改密码】</a>
                            </p>
                            <ul>
                                <li>日期</li>
                                <li>时间</li>
                                <li>IP</li>
                                <li>城市</li>
                                <li>登录产品</li>
                            </ul>
                            <div>
                                <ul class="bgcolor">
                                    <li>2020年04月05日</li>
                                    <li>17:00</li>
                                    <li>140.205.132.*</li>
                                    <li>全国</li>
                                    <li>PC网页登录</li>
                                </ul>
                                <ul class="">
                                    <li>2020年04月04日</li>
                                    <li>19:02</li>
                                    <li>140.205.132.*</li>
                                    <li>全国</li>
                                    <li>PC网页登录</li>
                                </ul>
                                <ul class="bgcolor">
                                    <li>2019年12月17日</li>
                                    <li>21:19</li>
                                    <li>125.77.4.*</li>
                                    <li>全国</li>
                                    <li>PC网页登录</li>
                                </ul>
                                <ul class="">
                                    <li>2019年11月18日</li>
                                    <li>22:53</li>
                                    <li>36.251.37.*</li>
                                    <li>全国</li>
                                    <li>PC网页登录</li>
                                </ul>
                                <ul class="bgcolor">
                                    <li>2019年09月04日</li>
                                    <li>23:14</li>
                                    <li>36.251.39.*</li>
                                    <li>全国</li>
                                    <li>PC网页登录</li>
                                </ul>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--    右侧结束-->
    </div>
    <!--中部 end-->
    <script>
        $(".buser-box").click(function () {
            if ($(this).hasClass('curr')) {
                $(".buser-box").removeClass('curr');
                $(".buser-box").find(".compiler").html('<i></i>编辑').removeClass('this');
            } else {
                $(".buser-box").removeClass('curr');
                $(".buser-box").find(".compiler").html('<i></i>编辑').removeClass('this');
                $(this).addClass('curr');
                $(this).find(".compiler").html('<i></i>收起').addClass('this');
            }
        })

        $(".box").click(function (e) {
            window.event ? window.event.cancelBubble = true : e.stopPropagation();
        })

            /*
             * 天选择
             */
            .on('click', '#dayListId li', function () {
                var self = $(this),
                    prev = self.parent().prev();
                prev.html("<i></i>" + self.attr('data-date') + "日");
                prev.attr('data-date', self.attr('data-date'));
                self.parent().hide();
            })
            /*
             * 天选择
             */
            .on('click', '#dayId', function () {
                var self = $(this),
                    box = self.next();
                year = $("#yearId").attr('data-date'),
                    month = $("#monthId").attr('data-date');
                if (year.length === 0 && month.length === 0)
                    return;
                box.is(":hidden") ? box.show() : box.hide();
            })
            /*
             * 月份选择
             */
            .on('click', '#monthListId li', function () {
                var self = $(this),
                    prev = self.parent().prev();
                prev.html("<i></i>" + self.attr('data-date') + "月");
                prev.attr('data-date', self.attr('data-date'));
                self.parent().hide();
            })
            /*
             * 月份选择
             */
            .on('click', '#monthId', function () {
                var self = $(this),
                    box = self.next();
                box.is(":hidden") ? box.show() : box.hide();
            })
            /*
             * 年份选择
             */
            .on('click', '#yearListId li', function () {
                var self = $(this),
                    prev = self.parent().prev();
                prev.html("<i></i>" + self.attr('data-date') + "年");
                prev.attr('data-date', self.attr('data-date'));
                self.parent().hide();
            })
            /*
             * 年份选择
             */
            .on('click', '#yearId', function () {
                var self = $(this),
                    box = self.next();
                box.is(":hidden") ? box.show() : box.hide();
            })
            /*
             * 绑定系统图片
            */
            .on('click', ".recommend ul li", function () {
                $(this).siblings().removeClass("this");
                $(this).addClass("this");
                var imgLink = $(this).data("link");
                $("#bigAvatarBox").attr("src", imgLink);
                $("#bigAvatarBox").data("pid", $(this).data("pid"));
                $("#smailAvatarBox").attr("src", imgLink);
            })
            /*
             * 图片提交
             */
            .on('click', '.quxiao', function () {
                $(this).parents('.box').prev().click();
            });


    </script>
@endsection
