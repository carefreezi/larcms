@extends('public.public')
@section('content')
    <link rel="stylesheet" href="{{asset("/static/index/css/code_details.css")}}">

    <!--中部 start-->
    <div class="boxTop">
        <div class="main">
            <div class="row">
                <div class="col-9">
                    <div class="GiTit text-hd">
                        世界上最美的资源下载网站CMS源码下载
                    </div>
                    <div class="auther-box">
                        <div class="desmsg-box clearfix">
                            <div>
                                <img src="https://www.ziyedh.com/uploads/UserPic/20191101/af33f824558bd4d7e4905656df2983b8.jpeg"
                                     class="authericon-small">
                            </div>
                            <div class="anther-nick">
                                小upSetyono Dwi
                            </div>
                            <div class="tagguanzhubox">
                            <span class="tag-guanzhu tag-guanzhu-yes "> <i
                                    class="iconfont icon-yiguanzhuren"></i> 已关注</span>
                                <!--<span class="tag-guanzhu tag-add"> <i class="iconfont icon-jiaguanzhuren"></i> 关注</span>-->
                            </div>
                            <div class="desl-time">
                                2020-03-23 12:20:12
                            </div>
                            <div class="desc-msg">
                                优雅是锋芒，卓越是内敛。广受好评的昼夜双版，经典独到的三栏设计，2019 年收官力作——念念不忘，必有回响。在双十一大促之际，秉承始终不将就的设计理念：Echo，现在回应你的等待。
                            </div>

                        </div>
                    </div>
                    <div class="price-box">
                        <span class="vip-so">会员￥<span class="bue">0</span></span>
                        <span class="novip-so">原价￥<span class="bue">20</span></span>
                    </div>
                    <div class="row">
                        <div class="col-11 tool-view">
                            <a href="" target="_blank"><i class="iconfont icon-lianjie"></i> 前台预览</a>
                            <a href="" target="_blank"><i class="iconfont icon-lianjie"></i> 后台预览</a>
                            <a href="" target="_blank" class="phoneCode"
                               data-url="http://cloudcms.com/index/Details/code.html"><i class="iconfont icon-ico"></i>手机扫码
                                <div id="PhoneCode" class="views-cold"></div>
                            </a>
                        </div>
                        <div class="col-1 IlikeBar">
                            <div>
                                <i class="iconfont icon-shoucang ilikei"></i>
                            </div>
                            <div class="ilikesum">
                                12383
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-3">
                    <div class="btn-down-box">
                        <div class="btn-groupdown">
                            <div class="download-jifen-btn">
                                <i class="iconfont icon-jifen"></i> 立即下载 150积分
                            </div>

                            <div class="download-jifen-btn vip-down-btn">
                                <i class="iconfont icon-huiyuan"></i> VIP 会员免费下载
                            </div>
                        </div>
                        <div class="suicai-tips">
                            素材有问题？<a href="">请通知我们</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--滚动介绍-->
    <div class="swiper-container TopBarSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="title">#01_首页</div>
                <img data-src="http://codesign.designuuu.com/wp-content/uploads/2019/07/a244b582c8f7a49.png"
                     class="swiper-lazy">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <div class="title">#02_管理后台</div>
                <img data-src="http://codesign.designuuu.com/wp-content/uploads/2019/07/a244b582c8f7a49.png"
                     class="swiper-lazy">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <div class="title">#03_后代统计页面</div>
                <img data-src="http://codesign.designuuu.com/wp-content/uploads/2019/07/96a707f80055053.png"
                     class="swiper-lazy">
                <div class="swiper-lazy-preloader"></div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="main content-main">
        <!--富文本编辑器内容 -主体描述-->
        <div class="content-deatils">

            <p>一直以来，iOS 因缺少原生的字体管理功能而饱受诟病，虽然苹果在 WWDC 2019 对 iOS 和 iPadOS 增加了字体管理功能，但到目前的 Beta 2 版本中仍无法直接安装下载的字体，长期使用的如
                Anyfont 的字体管理类 App 对大体积中文字体支持不佳、优化欠缺，使我诞生了自己做一个字体管理应用的念头，可自己当时又没有
                Mac。山穷水尽，柳暗花明，偶然瞥见了捷径，想到用捷径实现字体管理，故有此文。</p>
            <h2 id="ss-H2-1561451167898">思路</h2>
            <div>在 iOS 13 Beta 2 中，通过自带的文件应用虽可以识别字体文件，但仍无法直接安装，和以往一样，需要把字体文件嵌入描述文件即 XML 格式的&nbsp;<code>*.mobileconfig</code>&nbsp;，另考虑到
                iOS 缺少良好的中文字体下载 App，添加一个良好的中文字体下载的平台是必要的。
            </div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-443"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/19ae454748d001a.png?imageView2/1/w/2240/h/1538#"
                        alt="" width="1120" height="769"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/19ae454748d001a.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/19ae454748d001a-300x206.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/19ae454748d001a-768x527.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/19ae454748d001a-1024x703.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">思路</figcaption>
                </figure>
            </div>
            <div>在这里选用 Google Fonts 和汉仪字库为主要的字体获取途径，同时支持安装下载好的字体文件。整体流程并不复杂，但要获得好的体验，细节处理十分重要，希望你能读到最后。</div>
            <h2 id="ss-H2-1561454262263">Google Fonts</h2>
            <div>Google Fonts 有可寻的 API，因此只需先访问&nbsp;<a class="insert-link" href="https://fonts.google.com/" target="_blank"
                                                       rel="noopener noreferrer">Google Fonts 官网</a>，选择需要的字体再通过调用&nbsp;<a
                    class="insert-link" href="https://developers.google.cn/fonts/?hl=zh-cn" target="_blank"
                    rel="noopener noreferrer">API</a>&nbsp;就可以完成下载。
            </div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-444"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/73dd9d9f915a464.png?imageView2/1/w/2240/h/1706#"
                        alt="" width="1120" height="853"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/73dd9d9f915a464.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/73dd9d9f915a464-300x228.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/73dd9d9f915a464-768x585.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/73dd9d9f915a464-1024x780.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">Google Fonts</figcaption>
                </figure>
            </div>
            <div>我们可以通过<a class="insert-link" href="https://www.icloud.com/shortcuts/89aa9b53f9fb4ffa94e2ac9ffb2bf7ff/"
                          target="_blank" rel="noopener noreferrer">此示例</a>来从&nbsp;<code>fonts.google.com</code>&nbsp;下载字体。首先选择需要的字体后，通过
                Safari 的共享菜单运行该捷径从而获取到 URL，观察 URL
                结构，使用正则表达式&nbsp;<code>(?&lt;=selection\.family=).*$</code>&nbsp;匹配&nbsp;<code>family=</code>&nbsp;后面的选中的字体名称，将字体名称添加到&nbsp;<code>https://fonts.google.com/download?family=</code>&nbsp;尾部得到下载链接。支持选中多个字体同时下载。需要注意的是，下载得到的字体可能为&nbsp;<code>*.zip</code>&nbsp;的压缩文件，所以需要在&nbsp;<code>Repeat</code>&nbsp;步骤中嵌套一个条件判断，如果该下载的文件后缀中含有&nbsp;<code>.zip</code>，则需要对其进行解压才能得到字体文件，具体请参见示例。
            </div>
            <h2>汉仪字库</h2>
            <div>由于没有找到汉仪字库供个人使用的 API，我们需要通过一些特殊方法来获取字体。笔者首先想到的是通过网页源代码提取网页渲染时加载项中的字体链接。</div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-445"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/928c86343738343.png?imageView2/1/w/2240/h/1538#"
                        alt="" width="1120" height="769"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/928c86343738343.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/928c86343738343-300x206.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/928c86343738343-768x527.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/928c86343738343-1024x703.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">网页源代码</figcaption>
                </figure>
            </div>
            <div>经过实践后，问题接踵而至，一方面是捷径内部需要重新加载一遍网页并转换为&nbsp;<code>*.md</code>&nbsp;费时费力，另一方面是难以用简单的方式在大量字符中提取到需要的字体链接。三思后我选择使用&nbsp;<a
                    class="insert-link" href="https://en.wikipedia.org/wiki/Man-in-the-middle_attack" target="_blank"
                    rel="noopener noreferrer">MitM</a>&nbsp;来获取 API，再通过 API 完成字体下载。
            </div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-446"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/3c9b05eb1d79dc3.png?imageView2/1/w/2240/h/1732#"
                        alt="" width="1120" height="866"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/3c9b05eb1d79dc3.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/3c9b05eb1d79dc3-300x232.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/3c9b05eb1d79dc3-768x594.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/3c9b05eb1d79dc3-1024x792.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">汉仪字库</figcaption>
                </figure>
            </div>
            <div>以“汉仪字酷堂邓氏小楷W”为例，开启支持 MitM 和 HTTP Capture 的 App 如 Surge、Quantumult X 等，通过 PC 视图下的 Safari
                在汉仪字库官网选择并下载需要的字体。观察 URL 尾部的数字为&nbsp;<code>6411</code>，以 Surge 为例在 REQUEST BODY 中可以找到&nbsp;<code>fontdetail=get&amp;fontId=6411</code>&nbsp;的请求，反推找到
                REQUEST URL 为<span style="color: #d7191a; font-family: PingFangSC-Regular;">&nbsp;</span><code>http://www.hanyi.studio/hanyiwebsite/fontmanagement/fontmanagerhandler.ashx</code>&nbsp;和
                REQUEST METHOD 为&nbsp;<code>POST</code>&nbsp;。同理用正则表达式&nbsp;<code>(?&lt;=productdetail.php\?id=).*$</code>&nbsp;获取
                Safari 共享菜单共享的 URL 尾部数字。最后用捷径的&nbsp;<code>Get contents of URL</code>&nbsp;向 REQUEST URL 模拟 POST 请求得到上图左侧
                JSON 格式的 RESPOND BODY，直接用捷径的&nbsp;<code>Get Value for</code>&nbsp;步骤就可以获得字体名称&nbsp;<code>ProductName</code>&nbsp;和字体下载链接<span
                    style="color: #d7191a; font-family: PingFangSC-Regular;">&nbsp;</span><code>ProductFileUrl</code>。
            </div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-447"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/a472596b13d4c4c.png?imageView2/1/w/2240/h/1744#"
                        alt="" width="1120" height="872"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/a472596b13d4c4c.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/a472596b13d4c4c-300x234.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/a472596b13d4c4c-768x598.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/a472596b13d4c4c-1024x797.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">汉仪字库</figcaption>
                </figure>
            </div>
            <div>在模拟 POST 请求时需要注意 Headers 尽量和抓取的 Headers 一致，避免请求失败，具体请参考<a class="insert-link"
                                                                           href="https://www.icloud.com/shortcuts/9cf43f738e5d4cdb9068396080893c76"
                                                                           target="_blank" rel="noopener noreferrer">此示例</a>捷径。
            </div>
            <h2>处理字体</h2>
            <div>获取字体后，需要对字体进行处理并嵌入到描述文件中才可以使用。对于描述文件，其结构以下图左侧为例。</div>
            <div>
                <figure class="ss-img-wrapper" tabindex="0" contenteditable="false" draggable="false"><img
                        class="alignnone size-full wp-image-448"
                        src="http://codesign.designuuu.com/wp-content/uploads/2019/07/c757fb9871ee193.png?imageView2/1/w/2240/h/1680#"
                        alt="" width="1120" height="840"
                        srcset="http://codesign.designuuu.com/wp-content/uploads/2019/07/c757fb9871ee193.png 1120w, http://codesign.designuuu.com/wp-content/uploads/2019/07/c757fb9871ee193-300x225.png 300w, http://codesign.designuuu.com/wp-content/uploads/2019/07/c757fb9871ee193-768x576.png 768w, http://codesign.designuuu.com/wp-content/uploads/2019/07/c757fb9871ee193-1024x768.png 1024w"
                        sizes="(max-width: 1120px) 100vw, 1120px">
                    <figcaption class="ss-image-caption">处理字体</figcaption>
                </figure>
            </div>
            <div>左侧用灰色标出的段落是我们要进行修改的地方。<code>UUID</code>&nbsp;生成流程如上图右侧，可通过&nbsp;<code>List-&gt;Random
                    Item-&gt;Replace</code>&nbsp;实现，不使用在线的 UUID 生成器 API，提高了捷径可用度。<code>Hash</code>&nbsp;则通过计算字体文件的&nbsp;<a
                    class="insert-link" href="https://en.wikipedia.org/wiki/SHA1" target="_blank" rel="noopener noreferrer">SHA1</a>&nbsp;得到。<code>Name</code>&nbsp;为之前获取的字体名称。最后将字体文件&nbsp;<a
                    class="insert-link" href="https://en.wikipedia.org/wiki/Base64" target="_blank"
                    rel="noopener noreferrer">base64</a>&nbsp;encode 后替换&nbsp;<code>Base64 Encode</code>。此外优化不可忽视，之所以保存到「文件」而不是在捷径跳转到
                Safari 直接安装，是因为跳转时要把文件用 URL Encode 转化为字符链接，耗费性能，对于体积较大的中文字体，会造成设备卡死；另外进行 base64
                处理时不分段，加快速度；描述文件去格式化压缩为一行，削减体积。在这里同样提供一个<a class="insert-link"
                                                           href="https://www.icloud.com/shortcuts/b7546c1b977942c2b803a0b79885b71a"
                                                           target="_blank" rel="noopener noreferrer">示例捷径</a>供参考。
            </div>
            <h2>安装字体</h2>
            <div>在「文件」中选择生成好的字体描述文件就可以将字体直接安装到设置中，通过 iCloud 云盘或 Airdrop 可直接同步到其它设备，在各种第三方 App 中使用十分方便，当然也存在一些兼容问题，部分 App
                无法使用，需要 Apple 和开发者们一起努力解决。
            </div>
            <h2>细节处理</h2>
            <div>
                一个工具仅仅能实现它的功能是远远不够的，还需要便捷高效的使用体验，而这些都离不开细节上的处理优化。对于一个捷径而言，其本身可以直接运行或通过共享菜单运行。在这里我的思考是，直接运行时没有指令输入，因此引导用户到字体下载网站或跳转到「文件」选择字体文件更佳；而共享菜单运行是有指令输入的，故适合作为主要的执行流程。对于直接运行和共享菜单运行的判断可以用&nbsp;<code>Count
                    Items</code>&nbsp;步骤实现。对于共享菜单，输入的内容可以是一条链接、多条链接、一个字体文件、多个字体文件等，因此需要对输入内容用&nbsp;<code>Repeat</code>&nbsp;步骤拆分，再逐个进行类型判断和过滤，巧用&nbsp;<code>Add
                    to Variable</code>&nbsp;和&nbsp;<code>Set Variable</code>&nbsp;步骤实现批量操作。
            </div>
            <h2 id="ss-H2-1561464168942">写在最后</h2>
            <div>最后附上&nbsp;<a class="insert-link" href="https://www.icloud.com/shortcuts/79863e94aff94a08bdcdf9e621ecbe10"
                              target="_blank" rel="noopener noreferrer">Anyfonts 捷径</a>，其实去年就写完了的，投稿 Shortcuts Gallery
                结果石沉大海；另这依旧是第一版，也许还有许多地方可以完善，欢迎大家反馈建议。名字是奔着律师函去的，因为实在想不到什么好的名字。一直想做一个字体管理软件的，奈何复读了一年，荒废了时间。匆匆成文，如有错误，还请斧正。微博&nbsp;<a
                    class="insert-link" href="https://weibo.com/u/6225220156" target="_blank" rel="noopener noreferrer">iChizer0</a>，欢迎关注。
            </div>


        </div>
        <!--分享点赞-->
        <div class="row  d-flex justify-content-center share-ilike-tool">
            <div class="col-1">
                <div>
                    <i class="iconfont icon-tupian"></i>
                </div>
                <div>
                    生成海报
                </div>
            </div>
            <div class="col-1">
                <div class="icon-zan-content clearfix">
                    <i class="iconfont icon-dianzan zan-btn-i"><span class="zan-numver">364</span></i>
                </div>
            </div>
            <div class="col-1 div-sharebox">
                <div>
                    <i class="iconfont icon-share-fill"></i>
                </div>
                <div>
                    乐于分享
                </div>
                <div class="shareBox social-share clearfix">

                </div>
            </div>
        </div>
    </div>

    <div class="Boottom-box">
        <div class="main">
            <div class="tag-tit">
                相关推荐
            </div>
            <ul class="box-list clearfix">
                <li>
                    <a href="">
                        <div class="cover-img-center-max coverimg-li">
                            <img src="/static/Test/1f958a479c5653.jpg"
                                 alt="">
                        </div>
                        <div class="li-tit">
                            200多个图标icon资源下载，全格式支持
                        </div>
                        <div class="tag-span-tool">
                            <span>源码下载</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-7 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-5 vip-desc">
                                <span class="downi"><i class="iconfont icon-xiazai"></i></span>
                            </div>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="cover-img-center-max coverimg-li">
                            <img src="/static/Test/1f958a479c5653.jpg"
                                 alt="">
                        </div>
                        <div class="li-tit">
                            200多个图标icon资源下载，全格式支持
                        </div>
                        <div class="tag-span-tool">
                            <span>源码下载</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-7 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-5 vip-desc">
                                <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="cover-img-center-max coverimg-li">
                            <img src="/static/Test/1f958a479c5653.jpg"
                                 alt="">
                        </div>
                        <div class="li-tit">
                            200多个图标icon资源下载，全格式支持
                        </div>
                        <div class="tag-span-tool">
                            <span>源码下载</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span class="disi"><i class="iconfont icon-yduizhekou"></i> <span
                                        class="dis-num">7折</span></span>
                                <span><span class="munsrcoe">125</span>积分</span>
                            </div>
                        </div>
                    </a>
                </li>


                <li>
                    <a href="">
                        <div class="cover-img-center-max coverimg-li">
                            <img src="/static/Test/1f958a479c5653.jpg"
                                 alt="">
                        </div>
                        <div class="li-tit">
                            200多个图标icon资源下载，全格式支持
                        </div>
                        <div class="tag-span-tool">
                            <span>源码下载</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span><span class="munsrcoe">325</span>积分</span>
                            </div>
                        </div>
                    </a>
                </li>


            </ul>
        </div>
    </div>

    <!--中部 end-->

    <script src="{{asset("/static/frame/swiper5.3.6/js/swiper.min.js")}}"></script>
    <script src="{{asset("/static/frame/share/js/social-share.min.js")}}"></script>
    <script src="{{asset("/static/frame/js/qrcode.min.j")}}s"></script>
    <script src="{{asset("/static/index/scripts/code_details.js")}}"></script>
@endsection
