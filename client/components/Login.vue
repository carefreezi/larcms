<template>
    <div>
        <!--login dialog-->
        <el-dialog
            title="提示"
            :visible.sync="dialogLogin"
            width="400px"
            custom-class="logins"
            :show-close="false"
        >
            <div slot="title" class="loginForm" id="form_key">
                <div class="tabBox">
                    <div class="tabBoxSwitch">
                        用户登录
                        <div class="ercode_tab swicth-ercode" @click="wechat_login" v-if="wechat_out && wechat_islogin=='true'">
                            <svg t="1621831388266" viewBox="0 0 1044 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6200" width="48" height="48"><path d="M0 0h387.71451v387.71451l-80.313726-80.313726V80.313725H80.313725L0 0z m120.470588 120.470588h146.773334v146.773334L120.470588 120.470588z m903.529412 903.529412L783.058824 783.058824h46.381176v-91.77851h-80.313725v57.825882l-80.313726-80.313725V622.431373h281.098039v60.235294h80.313726v140.549019h-80.313726v120.470589h80.313726v80.313725H1024zM582.27451 582.27451l-13.854118-13.854118V501.960784H501.960784l-80.313725-80.313725h106.61647v-120.470588h80.313726v120.470588h180.705882v80.313725h-80.313725v80.313726H582.27451z m-54.010981-361.411765v80.313726h-80.313725V160.627451h80.313725V80.313725h80.313726v140.54902h-80.313726z m421.647059 281.098039h80.313726v80.313726h-240.941177v-80.313726h80.313726v-80.313725h80.313725v80.313725z m-501.960784-501.960784h80.313725v80.313725h-80.313725V0z m220.862745 0h361.411765v361.411765h-361.411765V0z m72.282353 72.282353v216.847059h216.847059V72.282353h-216.847059z m48.188235 28.109804h140.54902v140.549019h-140.54902V100.392157z" fill="#409eff" p-id="6201"></path></svg>
                        </div>
                        <div class="ercode_tab switch-input" @click="wechat_res" v-if="wechat_on">
                            <svg width="52" height="52" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 fill="currentColor">
                                <defs>
                                    <path id="id-14580708-a" d="M0 0h48a4 4 0 0 1 4 4v48L0 0z"></path>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <mask id="id-14580708-b" fill="#fff">
                                        <use xlink:href="#id-14580708-a"></use>
                                    </mask>
                                    <use fill="#0084FF" xlink:href="#id-14580708-a"></use>
                                    <path fill="#FFF"
                                          d="M22.125 4h13.75A4.125 4.125 0 0 1 40 8.125v27.75A4.125 4.125 0 0 1 35.875 40h-13.75A4.125 4.125 0 0 1 18 35.875V8.125A4.125 4.125 0 0 1 22.125 4zm6.938 34.222c1.139 0 2.062-.945 2.062-2.11 0-1.167-.923-2.112-2.063-2.112-1.139 0-2.062.945-2.062 2.111 0 1.166.923 2.111 2.063 2.111zM21 8.333v24h16v-24H21z"
                                          mask="url(#id-14580708-b)"></path>
                                    <g mask="url(#id-14580708-b)">
                                        <path fill="#FFF"
                                              d="M46.996 15.482L39 19.064l-7.996-3.582A1.6 1.6 0 0 1 32.6 14h12.8a1.6 1.6 0 0 1 1.596 1.482zM47 16.646V24.4a1.6 1.6 0 0 1-1.6 1.6H32.6a1.6 1.6 0 0 1-1.6-1.6v-7.754l8 3.584 8-3.584z">
                                        </path>
                                        <path fill="#0084FF"
                                              d="M31 15.483v1.17l8 3.577 8-3.577v-1.17l-8 3.581z"
                                              fill-rule="nonzero"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
            <div class="loginBox">
                <!-- signContent -->
                <div class="signContent">
                    <div class="signContainer">
                        <div class="loginForm" v-if="wechat_out">
                            <!-- tabContent -->
                            <div class="tabContent">
                                <el-form :model="ruleForm" :rules="rules" ref="ruleForm"
                                         class="demo-ruleForm">
                                    <!-- tabContentAccount -->
                                    <div class="tabcont tabContentAccount active">
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="username">
                                                    <el-input placeholder="用户名"
                                                              v-model="ruleForm.username"
                                                              prefix-icon="el-icon-user"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="password">
                                                    <el-input placeholder="请输入密码"
                                                              v-model="ruleForm.password"
                                                              show-password
                                                              prefix-icon="el-icon-lock"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <el-row :gutter="20">
                                            <el-col :span="15">
                                                <div class="tabcontent">
                                                    <div class="userLoginGroup">
                                                        <el-form-item prop="captcha">
                                                            <el-input type='text' placeholder="请输入验证码"
                                                                      v-model="ruleForm.captcha"
                                                                      @keyup.enter="submitForm('ruleForm')"
                                                                      prefix-icon="el-icon-picture-outline"></el-input>
                                                            <el-input class="hideCap" type='hidden'
                                                                      v-model="ruleForm.ruleKey"
                                                                      @keyup.enter="submitForm('ruleForm')"></el-input>
                                                        </el-form-item>
                                                    </div>
                                                </div>
                                            </el-col>
                                            <el-col :span="9">
                                                <img :src="ruleForm.caps" alt="验证码" @click="changeCodeImg">
                                            </el-col>
                                        </el-row>

                                    </div>
                                </el-form>
                            </div>
                            <!-- loginbox -->
                            <div class="login_box">
                                <button type="button" class="phone-btn reg-btn sms-voice-btn"
                                        data-btn="account-forget-btn" data-forv="forget-voice" @click="go_reg">注册账号
                                </button>
                                <button type="button" class="phone-btn voice-btn sms-voice-btn"
                                        data-btn="account-forget-btn" data-forv="forget-voice" @click="go_forget">忘记密码
                                </button>
                            </div>
                            <el-button type="primary" @click="submitForm('ruleForm')" :loading="click_is">登录</el-button>
                            <div class="SignContainer-tip">
                                <div>未注册手机验证后自动登录，注册即代表同意<a href="#">《隐私保护指引》</a></div>
                            </div>
                        </div>
                        <!-- ercodeSgin -->
                        <div class="ercodeSignBox" v-if="wechat_on">
                            <!-- ercodeConent -->
                            <div class="ercodeContent">
                                <div class="Qrcode-title">扫码登录</div>
                                <div class="ercodeBox">
                                    <div class="Qrcode-img" id="qrcode" title="your content">
                                        <!-- <img width="150" height="150" src="../img/image.png" alt="二维码"> -->
                                        <canvas width="150" height="150"
                                                style="display: none;"></canvas>
                                        <img alt="Scan me!"
                                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAAJF0lEQVR4Xu2d23brKBBEk++e1znfnVm21xzJLJB2UbRiJ5XnRkD17gvIdj4//v36+nihv69/1i7m80//eb15erbUrjfLaC+jNbXPoFrQ561V9vhpnwFrEyhgrUMvYO20DFgBCyuQUoilWmqYjJWMtRSo/x/WBYs2je6KaOnpzeOMHa3baYKVJp/qS/dI7Vx/UT/c7ALWScaizghYz0oFrIBFY6drN8ryAStgBay9AhV9RXosnTE7Y60W/d7gdW7Faa9CG2C3UafrcW/e6TyO3UhzihOdW2reA9bxDX3AmmzeA1bASsYCuZ0GiiJmO63yEprO49ilFDYeor0Y4OmvScBS1HrYUqh/XI9FYRlJqghHspP7npL2bUrgORop+uB7rNULqjgVOmtUIzJgPRT4FdcNAWvDXenvaFFMxqJKNXaKcMlYyVgYs4B1LJWiz1v0WJSMiiaWikntlF6Ovl2o2LdzcHibU2HAOlYgYBXfT1UITDMRtUvGAhDQTKKcUGj6780dsHIqHN6BBKxzONqgqgioy3osmp0UO0UQIqYyN7VdDfpoXlpKHTu6Z8XOviBVJqO2Aes4O1F9qB31i2IXsBS1drbJWPqJVLpumPTL4TAn0tzXN3Q/AStgUVYku4AVsCRgqHHAWggWFb3Czjn1KKWV2q62u/cfi79EclVboPj7LX67YbUjrnKuezHs7FuBoMI2YJ2cAB3nBqwKZCefmVK4CedAPSn/smHJWMlYy2DaP+jz6+u1foOU7rKiYXVOgHTdIzuandx5rhofsE4y1mWOgCfFq9bjzhOwApbLUHd8wApYAeupORz8frujUnosR73nsVbGog20cp/T2xq9gqBjX/GClLq0An7Xj721B6wXuW4IWDsFXNKd8c7YZKymbMG2QsmWyVjJWMPfX2izaMACJz16IbnabpQtf1wp7P2TJoVMKgi1cxxZ0bzTdVfY0XJfsW/qh9G+8VfsK4TrnibgDTQVXTmRfmdAUS2oH9x9B6wTpV2BqSMr7GjwJGMB9WmkUNED1vkJkN4TKhk9pRA0+iAeSkxo8LxNxlIW2to6Yoy8QyOFZrthwwn7O0qRosV37pHuh67xfvKl/7qXPlQRc/WGAta5oo5/KAMBq/GDC6aTvanT3DUGrInep0J06nD3uoDOU7HH8zz3sKBrTMZKxqJM1YFV0dDTCKDpmz5Pad4l5RvjiqsOmrGoZkomUp6Jm/eApSMWsHTNpNQ4Ip1mGBop9HnJWM8KUN2oH6QeKxlLj75kLF2zZCygWcACIiVj6SL9arB634SmJw/37kZ3lT6C9g/3vmDxR3Tp85Rd0RfGo2dSPejah8ETsDYXuGK2zqTPC1hAgQoxwbRDExqhyVjPElI/JmMBOl0xk7F22T+lMKXQ6ZWHGYt+bAYEvHQF4V5SKiWOrp0KTBvo71yjsueKdVqvdJwriICluP7YlpZw96SorDhgnahFr16oneIcahuwgFJUpIr0nVIIHARNkrGSsaQP8EGuPl7utxteLRNRIWm2u9l9Z/NPSza1G/bKzo/bumXLXfxqp6+GWvm40FVa0HmoXcBqFHCFI1AHLKJSxyYZa+4aIKVworFV7rauyBrKfVlK4aaW6xt8KqSi2wuC30Z2syVN0s48Simk63Ht6H6UBNE9uNBXOgHr2KW0vI1OhS4wdHzA2imlOK0VmAaEUjJpNCdjAdypg1IKj/uUZKwGtoCVUkgZuCnVvXl3s07rAqWu07KnbBIk5LvJ6n0r5dXZt6Iv1YLqO5o7YO2UDlibGAGLhiCwC1gBq+aNPLxDA4wemlCAHTt3jclYroIphV0FbbCcfyDgRhRdfPdm18wuTsNLG+0R83Tfjr50jtGhhcar9GUKuihn4+59Dp1bOZk5YiqgXqEvnSNgNV4PWMcXsQGLpomAdVeAluGAFbCGCtCsTO2uagvu5TXNu042zRpp3nVtpRHDkwM82dHGWHE4tXXsJJE6xk4mUj5ZUTEP/qCfI1LAmlOvwuGrA2X4rpB+0G9OmseogDWnXsA60S1gBaw5BQLWy727/HE9lnJ/QimmzTt9nnIf1Hsm3aPiXLp2Vwu6drqe4RXG6h6rYuGumBQOOg/dY8By8dyNp6IrU1KHK8+kpyMKZc8uYCkemeynnCkC1qaeq0VF4HeDKqVQdxp1TjKWk05efOy7XHUopfQKyWnwXNa8X7FpZY6Apai12QasyZ6P3mrTnkY5DFCn0bnn0DkeRdeYjNUoELAClhWQKYVz8tkZy/mpyLkl66NoSVDEoBlLX61+ylTmUPa4+kCglHvrx20VQRzbgLWwqYb/Oq/nr4AFKE7GAiI1JgELaBawgEgB66GA0n8ErGKwVr/S0Zf7PEJJt+1cztiKdSvPdPpIJUjoPHTtw1N3wKISFt/7wKaaBo9yzeIoELAc9cBYpQw71wABCzjDPdKmFD4USCkEsNGIXA0lWNqhSTLWszzWN6FdZyiR1s7ljB2te3VjO5pndfAofqB7pIEifa+QPlTZEO0r6NwBa079gHWiW8AKWEMFHDicsSmF51A6leN+oHB+beZ8eccWDhzO2IB17rmAtdOIihGwXggs2vTRawDl/sWZWzmZncv9sHDX45wK6RoVOycg7VOhI6byeuEq0SvEpM68ao/OeujYgNUoFbA2QSq0wM17MtbmCEeL21OSsXZR7oiZUvicLgPWC4PlOsdJ/27/Qdfu2NE1KocRRbO3LYVU9IpTIXXaKMvTtTt2dI0BCzTfSrlWok9x0t42YC12WuuIih6LRnMy1nlY0IBUgjGl8Fz3aYtkrBfPWD3P0neFNBoVemjkKnM7GZiuZ9RP0fHKft4iYwWsY+wpGAELpI9krLmbc6obDeaRq5KxAMT0MNLaKaUjpXChI1ZHj+McZVu09AQs0LwrwlPb3wqWEwB0LIV/WMrM/8yGSyGFRbELWJtaNLsFLEBYwApYABPdJGAFLJ0aMCJg/TKwABNlJm7T6SyM9jnOHKOxq3unir0ovrnkX/cqjlAWrzyX2FY4g8x7swlYVKlJu4B1XB6pPhVBQue+7SAZaxcAFc6g8ZWMRZWatFOiYnKK4bCAdayo4ptkrGQsHJ8KWP8BFQuLmnWMPXkAAAAASUVORK5CYII="
                                             style="display: block;"></div>
                                    <p>打开
                                        微信</p>
                                    <p>点击右上角「+」号打开扫一扫</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--  -->
                <div class="css-1hmxk26" v-if="wechat_islogin=='true' || qq_islogin=='true' || weibo_islogin=='true'"></div>
                <!-- signSocial -->
                <div class="footSign signSocial" v-if="wechat_islogin=='true' || qq_islogin=='true' || weibo_islogin=='true'">
                    <span class="social-title">社交帐号登录</span>
                    <span class="Login-socialButtonGroup">
                        <button type="button" class="button Login-socialButton" v-if="wechat_islogin=='true'" @click="wechat_login">
                            <svg class="Zi Zi--WeChat Login-socialIcon" fill="#60c84d" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path
                                    d="M2.224 21.667s4.24-1.825 4.788-2.056C15.029 23.141 22 17.714 22 11.898 22 6.984 17.523 3 12 3S2 6.984 2 11.898c0 1.86.64 3.585 1.737 5.013-.274.833-1.513 4.756-1.513 4.756zm5.943-9.707c.69 0 1.25-.569 1.25-1.271a1.26 1.26 0 0 0-1.25-1.271c-.69 0-1.25.569-1.25 1.27 0 .703.56 1.272 1.25 1.272zm7.583 0c.69 0 1.25-.569 1.25-1.271a1.26 1.26 0 0 0-1.25-1.271c-.69 0-1.25.569-1.25 1.27 0 .703.56 1.272 1.25 1.272z"
                                    fill-rule="evenodd"></path>
                            </svg>
                            微信
                        </button>
                        <button type="button" class="button Login-socialButton " @click="qq_logins"  v-if="qq_islogin=='true'">
                            <svg class="Zi Zi--QQ Login-socialIcon" fill="#50c8fd" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path
                                    d="M12.003 2c-2.265 0-6.29 1.364-6.29 7.325v1.195S3.55 14.96 3.55 17.474c0 .665.17 1.025.281 1.025.114 0 .902-.484 1.748-2.072 0 0-.18 2.197 1.904 3.967 0 0-1.77.495-1.77 1.182 0 .686 4.078.43 6.29 0 2.239.425 6.287.687 6.287 0 0-.688-1.768-1.182-1.768-1.182 2.085-1.77 1.905-3.967 1.905-3.967.845 1.588 1.634 2.072 1.746 2.072.111 0 .283-.36.283-1.025 0-2.514-2.166-6.954-2.166-6.954V9.325C18.29 3.364 14.268 2 12.003 2z"
                                    fill-rule="evenodd">
                                </path>
                            </svg>
                            QQ
                        </button>
                        <button type="button" class="button Login-socialButton"  v-if="weibo_islogin=='true'" @click="weibo_logins">
                            <svg class="Zi Zi--Weibo Login-socialIcon" fill="#fb6622" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path fill="#FB6622"
                                      d="M15.518 3.06c8.834-.854 7.395 7.732 7.394 7.731-.625 1.439-1.673.309-1.673.309.596-7.519-5.692-6.329-5.692-6.329-.898-1.067-.029-1.711-.029-1.711zm4.131 6.985c-.661 1.01-1.377.126-1.376.126.205-3.179-2.396-2.598-2.396-2.598-.719-.765-.091-1.346-.091-1.346 4.882-.551 3.863 3.818 3.863 3.818zM5.317 7.519s4.615-3.86 6.443-1.328c0 0 .662 1.08-.111 2.797.003-.003 3.723-1.96 5.408.159 0 0 .848 1.095-.191 2.649 0 0 2.918-.099 2.918 2.715 0 2.811-4.104 6.44-9.315 6.44-5.214 0-8.026-2.092-8.596-3.102 0 0-3.475-4.495 3.444-10.33zm10.448 7.792s.232-4.411-5.71-4.207c-6.652.231-6.579 4.654-6.579 4.654.021.39.097 3.713 5.842 3.713 5.98 0 6.447-4.16 6.447-4.16zm-9.882.86s-.059-3.632 3.804-3.561c3.412.06 3.206 3.165 3.206 3.165s-.026 2.979-3.684 2.979c-3.288 0-3.326-2.583-3.326-2.583zm2.528 1.037c.672 0 1.212-.447 1.212-.998 0-.551-.543-.998-1.212-.998-.672 0-1.215.447-1.215.998 0 .551.546.998 1.215.998z"
                                      fill-rule="evenodd">
                                </path>
                            </svg>
                            微博
                        </button>
                    </span>
                </div>
                <!-- signDownload -->
            </div>
            <span slot="footer" class="dialog-footer">

                        </span>
        </el-dialog>
        <!--login dialog end-->
        <!--register dialog -->
        <el-dialog
            title="提示"
            :visible.sync="dialogReg"
            width="400px"
            custom-class="regs"
            :show-close="false"
        >
            <div slot="title" class="loginForm">
                <div class="tabBox">
                    <div class="tabBoxSwitch">
                        用户注册
                        <div class="ercode_tab swicth-ercode" @click="wechat_login" v-if="wechat_login && wechat_islogin=='true'">
                            <svg t="1621831388266" viewBox="0 0 1044 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6200" width="48" height="48"><path d="M0 0h387.71451v387.71451l-80.313726-80.313726V80.313725H80.313725L0 0z m120.470588 120.470588h146.773334v146.773334L120.470588 120.470588z m903.529412 903.529412L783.058824 783.058824h46.381176v-91.77851h-80.313725v57.825882l-80.313726-80.313725V622.431373h281.098039v60.235294h80.313726v140.549019h-80.313726v120.470589h80.313726v80.313725H1024zM582.27451 582.27451l-13.854118-13.854118V501.960784H501.960784l-80.313725-80.313725h106.61647v-120.470588h80.313726v120.470588h180.705882v80.313725h-80.313725v80.313726H582.27451z m-54.010981-361.411765v80.313726h-80.313725V160.627451h80.313725V80.313725h80.313726v140.54902h-80.313726z m421.647059 281.098039h80.313726v80.313726h-240.941177v-80.313726h80.313726v-80.313725h80.313725v80.313725z m-501.960784-501.960784h80.313725v80.313725h-80.313725V0z m220.862745 0h361.411765v361.411765h-361.411765V0z m72.282353 72.282353v216.847059h216.847059V72.282353h-216.847059z m48.188235 28.109804h140.54902v140.549019h-140.54902V100.392157z" fill="#409eff" p-id="6201"></path></svg>

                        </div>
                        <div class="ercode_tab switch-input" @click="wechat_res" v-if="wechat_on">
                            <svg width="52" height="52" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 fill="currentColor">
                                <defs>
                                    <path id="id-14580708-a" d="M0 0h48a4 4 0 0 1 4 4v48L0 0z"></path>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <mask id="id-14580708-b" fill="#fff">
                                        <use xlink:href="#id-14580708-a"></use>
                                    </mask>
                                    <use fill="#0084FF" xlink:href="#id-14580708-a"></use>
                                    <path fill="#FFF"
                                          d="M22.125 4h13.75A4.125 4.125 0 0 1 40 8.125v27.75A4.125 4.125 0 0 1 35.875 40h-13.75A4.125 4.125 0 0 1 18 35.875V8.125A4.125 4.125 0 0 1 22.125 4zm6.938 34.222c1.139 0 2.062-.945 2.062-2.11 0-1.167-.923-2.112-2.063-2.112-1.139 0-2.062.945-2.062 2.111 0 1.166.923 2.111 2.063 2.111zM21 8.333v24h16v-24H21z"
                                          mask="url(#id-14580708-b)"></path>
                                    <g mask="url(#id-14580708-b)">
                                        <path fill="#FFF"
                                              d="M46.996 15.482L39 19.064l-7.996-3.582A1.6 1.6 0 0 1 32.6 14h12.8a1.6 1.6 0 0 1 1.596 1.482zM47 16.646V24.4a1.6 1.6 0 0 1-1.6 1.6H32.6a1.6 1.6 0 0 1-1.6-1.6v-7.754l8 3.584 8-3.584z">
                                        </path>
                                        <path fill="#0084FF"
                                              d="M31 15.483v1.17l8 3.577 8-3.577v-1.17l-8 3.581z"
                                              fill-rule="nonzero"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
            <div class="loginBox">
                <!-- signContent -->
                <div class="signContent">
                    <div class="signContainer">
                        <div class="loginForm" v-if="wechat_out">
                            <!-- tabContent -->
                            <div class="tabContent">
                                <!-- tabContentAccount -->
                                <div class="tabcont tabContentAccount active">
                                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" class="demo-ruleForm">
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="username">
                                                    <el-input placeholder="输入您的用户名"
                                                              v-model="ruleForm.username"
                                                              prefix-icon="el-icon-user"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="emails">
                                                    <el-input placeholder="输入您的邮箱" v-model="ruleForm.emails"
                                                              prefix-icon="el-icon-message"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="password">
                                                    <el-input placeholder="请输入密码"
                                                              v-model="ruleForm.password"
                                                              show-password
                                                              prefix-icon="el-icon-lock"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="c_password">
                                                    <el-input placeholder="请输入二次密码"
                                                              v-model="ruleForm.c_password"
                                                              show-password
                                                              prefix-icon="el-icon-lock"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item>
                                                    <el-input placeholder="请输入邀请码(选填)"
                                                              v-model="ruleForm.invitation_code"
                                                              prefix-icon="el-icon-connection"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <el-row :gutter="20">
                                            <el-col :span="15">
                                                <div class="tabcontent">
                                                    <div class="userLoginGroup">
                                                        <el-form-item prop="captcha">
                                                            <el-input type='text' placeholder="请输入验证码"
                                                                      v-model="ruleForm.captcha"
                                                                      @keyup.enter="submitForm('ruleForm')"
                                                                      prefix-icon="el-icon-picture-outline"></el-input>
                                                            <el-input class="hideCap" type='hidden'
                                                                      v-model="ruleForm.ruleKey"
                                                                      @keyup.enter="submitForm('ruleForm')"></el-input>
                                                        </el-form-item>

                                                    </div>
                                                </div>
                                            </el-col>
                                            <el-col :span="9">
                                                <img :src="ruleForm.caps" alt="验证码" @click="changeCodeImg">
                                            </el-col>
                                        </el-row>
                                    </el-form>
                                </div>
                            </div>
                            <!-- loginbox -->
                            <div class="login_box">
                                <button type="button" class="phone-btn reg-btn sms-voice-btn"
                                        data-btn="account-forget-btn" data-forv="forget-voice" @click="go_login">登录账号
                                </button>
                            </div>
                            <el-button type="primary" @click="reg('ruleForm')" :loading="click_is">注册</el-button>
                            <div class="SignContainer-tip">
                                <div>第三方登录未注册自动注册信息，注册即代表同意<a href="#">《隐私保护指引》</a></div>
                            </div>
                        </div>
                        <!-- ercodeSgin -->
                        <div class="ercodeSignBox" v-if="wechat_on">
                            <!-- ercodeConent -->
                            <div class="ercodeContent">
                                <div class="Qrcode-title">扫码登录</div>
                                <div class="ercodeBox">
                                    <div class="Qrcode-img" id="qrcode" title="your content">
                                        <!-- <img width="150" height="150" src="../img/image.png" alt="二维码"> -->
                                        <canvas width="150" height="150"
                                                style="display: none;"></canvas>
                                        <img alt="Scan me!"
                                             src="data:image/png;base64,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"
                                             style="display: block;"></div>
                                    <p>打开
                                        微信</p>
                                    <p>点击右上角「+」号打开扫一扫</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--  -->
                <div class="css-1hmxk26" v-if="wechat_islogin=='true' || qq_islogin=='true' || weibo_islogin=='true'"></div>
                <!-- signSocial -->
                <div class="footSign signSocial" v-if="wechat_islogin=='true' || qq_islogin=='true' || weibo_islogin=='true'">
                    <span class="social-title">社交帐号注册</span>
                    <span class="Login-socialButtonGroup">
                        <button type="button" class="button Login-socialButton" v-if="wechat_islogin=='true'" @click="wechat_login">
                            <svg class="Zi Zi--WeChat Login-socialIcon" fill="#60c84d" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path
                                    d="M2.224 21.667s4.24-1.825 4.788-2.056C15.029 23.141 22 17.714 22 11.898 22 6.984 17.523 3 12 3S2 6.984 2 11.898c0 1.86.64 3.585 1.737 5.013-.274.833-1.513 4.756-1.513 4.756zm5.943-9.707c.69 0 1.25-.569 1.25-1.271a1.26 1.26 0 0 0-1.25-1.271c-.69 0-1.25.569-1.25 1.27 0 .703.56 1.272 1.25 1.272zm7.583 0c.69 0 1.25-.569 1.25-1.271a1.26 1.26 0 0 0-1.25-1.271c-.69 0-1.25.569-1.25 1.27 0 .703.56 1.272 1.25 1.272z"
                                    fill-rule="evenodd"></path>
                            </svg>
                            微信
                        </button>
                        <button type="button" class="button Login-socialButton " @click="qq_logins"  v-if="qq_islogin=='true'">
                            <svg class="Zi Zi--QQ Login-socialIcon" fill="#50c8fd" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path
                                    d="M12.003 2c-2.265 0-6.29 1.364-6.29 7.325v1.195S3.55 14.96 3.55 17.474c0 .665.17 1.025.281 1.025.114 0 .902-.484 1.748-2.072 0 0-.18 2.197 1.904 3.967 0 0-1.77.495-1.77 1.182 0 .686 4.078.43 6.29 0 2.239.425 6.287.687 6.287 0 0-.688-1.768-1.182-1.768-1.182 2.085-1.77 1.905-3.967 1.905-3.967.845 1.588 1.634 2.072 1.746 2.072.111 0 .283-.36.283-1.025 0-2.514-2.166-6.954-2.166-6.954V9.325C18.29 3.364 14.268 2 12.003 2z"
                                    fill-rule="evenodd">
                                </path>
                            </svg>
                            QQ
                        </button>
                        <button type="button" class="button Login-socialButton"  v-if="weibo_islogin=='true'" @click="weibo_logins">
                            <svg class="Zi Zi--Weibo Login-socialIcon" fill="#fb6622" viewBox="0 0 24 24" width="20"
                                 height="20">
                                <path fill="#FB6622"
                                      d="M15.518 3.06c8.834-.854 7.395 7.732 7.394 7.731-.625 1.439-1.673.309-1.673.309.596-7.519-5.692-6.329-5.692-6.329-.898-1.067-.029-1.711-.029-1.711zm4.131 6.985c-.661 1.01-1.377.126-1.376.126.205-3.179-2.396-2.598-2.396-2.598-.719-.765-.091-1.346-.091-1.346 4.882-.551 3.863 3.818 3.863 3.818zM5.317 7.519s4.615-3.86 6.443-1.328c0 0 .662 1.08-.111 2.797.003-.003 3.723-1.96 5.408.159 0 0 .848 1.095-.191 2.649 0 0 2.918-.099 2.918 2.715 0 2.811-4.104 6.44-9.315 6.44-5.214 0-8.026-2.092-8.596-3.102 0 0-3.475-4.495 3.444-10.33zm10.448 7.792s.232-4.411-5.71-4.207c-6.652.231-6.579 4.654-6.579 4.654.021.39.097 3.713 5.842 3.713 5.98 0 6.447-4.16 6.447-4.16zm-9.882.86s-.059-3.632 3.804-3.561c3.412.06 3.206 3.165 3.206 3.165s-.026 2.979-3.684 2.979c-3.288 0-3.326-2.583-3.326-2.583zm2.528 1.037c.672 0 1.212-.447 1.212-.998 0-.551-.543-.998-1.212-.998-.672 0-1.215.447-1.215.998 0 .551.546.998 1.215.998z"
                                      fill-rule="evenodd">
                                </path>
                            </svg>
                            微博
                        </button>
                    </span>
                </div>
                <!-- signDownload -->
            </div>
            <span slot="footer" class="dialog-footer">

                        </span>
        </el-dialog>
        <!--register dialog end-->

        <!--forget password-->
        <!--login dialog-->
        <el-dialog
            title="提示"
            :visible.sync="dialogForget"
            width="400px"
            custom-class="logins"
            :show-close="false"
        >
            <div slot="title" class="loginForm" id="form_forget">
                <div class="tabBox">
                    <div class="tabBoxSwitch">
                        忘记密码
                    </div>
                </div>
            </div>
            <div class="loginBox">
                <!-- signContent -->
                <div class="signContent">
                    <div class="signContainer">
                        <div class="loginForm" v-if="wechat_out">
                            <!-- tabContent -->
                            <div class="tabContent">
                                <el-form :model="ruleForm" :rules="rules" ref="ruleForm"
                                         class="demo-ruleForm">
                                    <!-- tabContentAccount -->
                                    <div class="tabcont tabContentAccount active">
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="forget_email">
                                                    <el-input placeholder="邮箱"
                                                              v-model="ruleForm.forget_email"
                                                              prefix-icon="el-icon-user"></el-input>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="tabcontent">
                                            <div class="userLoginGroup">
                                                <el-form-item prop="new_password">
                                                    <el-input placeholder="请输入新密码"
                                                              v-model="ruleForm.new_password"
                                                              show-password
                                                              prefix-icon="el-icon-lock"></el-input>
                                                </el-form-item>

                                            </div>
                                        </div>
                                        <el-row :gutter="20">
                                            <el-col :span="15">
                                                <div class="tabcontent">
                                                    <div class="userLoginGroup">
                                                        <el-form-item prop="email_code">
                                                            <el-input type='text' placeholder="请输入验证码"
                                                                      v-model="ruleForm.email_code"
                                                                      prefix-icon="el-icon-picture-outline">
                                                            </el-input>
                                                        </el-form-item>
                                                    </div>
                                                </div>
                                            </el-col>
                                            <el-col :span="9">
                                                <el-button type="primary" :loading="sendEmails" @click="send_email">发送验证码</el-button>
                                            </el-col>
                                        </el-row>

                                    </div>
                                </el-form>
                            </div>
                            <!-- loginbox -->
                            <div class="login_box">
                                <button type="button" class="phone-btn reg-btn sms-voice-btn"
                                        data-btn="account-forget-btn" data-forv="forget-voice" @click="go_login">登录账号
                                </button>
                            </div>
                            <el-button type="primary" @click="submitForget('ruleForm')" :loading="click_is">修改</el-button>
                        </div>
                    </div>
                </div>
            </div>
            <span slot="footer" class="dialog-footer"></span>
        </el-dialog>
        <!--login dialog end-->
        <!--forget password end-->

    </div>
</template>

<script>
import {captcha} from '~/plugins/index'
import {register,send_email,reset_pass} from '~/plugins/index';
import axios from "axios";

export default {
    props: ['loginto', 'regto'],
    name: "Login",
    data() {
        return {
            dialogLogin: false,
            dialogReg: false,
            dialogForget:false,
            wechat_out: true,
            wechat_on: false,
            userToken: null,
            loading: true,
            usersInfo: '',
            me: '',
            times: "60",
            timer:null,
            click_is: false,
            sendEmails:false,
            qq_islogin:this.WebConfigs('QQ_LOGIN'),
            wechat_islogin:this.WebConfigs('WECHAT_LOGIN'),
            weibo_islogin:this.WebConfigs('WEIBO_LOGIN'),
            ruleForm: {
                username: '',
                password: '',
                emails: '',
                c_password: '',
                caps: '',
                captcha: '',
                ruleKey: '',
                email_code:'',
                forget_email:'',
                new_password:'',
                invitation_code:'',
            },
            rules: {
                username: [
                    {required: true, message: '请输入用户名', trigger: 'blur'},
                    {min: 2, max: 20, message: '长度在 2 到 20 个字符', trigger: 'blur'}
                ],
                password: [
                    {required: true, message: '请输入密码', trigger: 'blur'},
                    {min: 6, max: 100, message: '长度需在6个字符以上', trigger: 'blur'}
                ],
                c_password: [
                    {required: true, message: '请输入二次密码', trigger: 'blur'},
                    {min: 6, max: 100, message: '长度需在6个字符以上', trigger: 'blur'}
                ],
                emails: [
                    {required: true, message: '请输入邮箱', trigger: 'blur'},
                    { type: 'email', message: '请输入正确的邮箱地址', trigger: ['blur', 'change'] }

                ],
                forget_email: [
                    {required: true, message: '请输入邮箱', trigger: 'blur'},
                    { type: 'email', message: '请输入正确的邮箱地址', trigger: ['blur', 'change'] }
                ],
                email_code: [
                    {required: true, message: '请输入邮箱验证码', trigger: 'blur'},
                ],
                new_password: [
                    {required: true, message: '请输入密码', trigger: 'blur'},
                    {min: 6, max: 100, message: '长度需在6个字符以上', trigger: 'blur'}
                ],
                captcha: [
                    {required: true, message: '请输入验证码', trigger: 'blur'}
                ]
            },

        }
    },
    async mounted() {
        const cap = await captcha();
        this.ruleForm.caps = cap.url.img;
        this.ruleForm.ruleKey = cap.url.key;
        if (this.$store.state.auth.user != null) {
            this.userToken = this.$store.state.auth.user.api_token;
        }
    },
    watch: {
        dialogLogin: function (newVal, oldVal) {
            this.$emit('newlogin', newVal)
        },
        dialogReg: function (newVal, oldVal) {
            this.$emit('newreg', newVal)
        },
        loginto: function (newVal, oldVal) {
            this.dialogLogin = newVal;
        },
        regto: function (newVal, oldVal) {
            this.dialogReg = newVal;
        },
    },
    methods: {
        qq_logins(){
          window.location.href = '/api/qq';
        },
        weibo_logins(){
            window.location.href = '/api/weibo';
        },
        countDown(){
            this.timer=setInterval(() => {
                this.times--;
                if(this.times<=0){
                    clearInterval(this.timer);
                    this.sendEmails=false;
                }
            },1000);
        },
        wechat_login() {
            this.wechat_on = true;
            this.wechat_out = false;
        },
        wechat_res() {
            this.wechat_on = false;
            this.wechat_out = true;
        },
        go_reg(){
            this.dialogLogin=false;
            this.dialogReg =true;
        },
        go_login(){
            this.dialogLogin=true;
            this.dialogReg =false;
        },
        go_forget(){
            this.dialogLogin=false;
            this.dialogForget=true;
        },
        async send_email(){
            this.sendEmails = true;
            this.countDown();
            const sendEmail = await send_email(this.ruleForm.forget_email)
                .catch(() => {
                    this.sendEmails = false;
                })
                .finally(() => {
                    this.loading = false;
                });
            if (sendEmail==undefined){
                this.sendEmails=false;
            }
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.click_is = true;
                    const userInfo = {
                        username: this.ruleForm.username,
                        password: this.ruleForm.password,
                        captcha: this.ruleForm.captcha,
                        key: this.ruleForm.ruleKey
                    }
                    this.$auth.loginWith('local', {data: userInfo})
                        .then((data) => {
                            this.$message.success('登录成功');
                            this.userToken = data.data.data.original.access_token;
                            this.dialogLogin = false;
                            this.click_is = false;
                            this.$emit('newToken', this.userToken);
                            this.$emit('newpic', this.$store.state.auth.user.pic);
                            this.$router.go(0)
                        }).catch((e) => {
                            this.click_is = false
                            return axios.get(`/api/captcha`).then(data => {
                                this.ruleForm.caps = data.data.url.img;
                                this.ruleForm.ruleKey =  data.data.url.key;
                            })
                        });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        reg(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.click_is = true;
                    this.register();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        submitForget(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.click_is = true;
                    this.reset_pass();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        async reset_pass(){
            const reset = await reset_pass(this.ruleForm.forget_email,this.ruleForm.new_password,this.ruleForm.email_code)
                .catch(() => {
                    this.click_is = false;
                })
                .finally(() => {
                    this.click_is = false;
                });
            if (reset.status==200){
                this.dialogForget=false;
                this.dialogLogin =true;
                this.ruleForm.emails='';
                this.ruleForm.new_password='';
                this.ruleForm.email_code=''
            }

        },
        async changeCodeImg() {
            const cap = await captcha();
            this.ruleForm.caps = cap.url.img;
            this.ruleForm.ruleKey = cap.url.key;
        },
        async register() {
            const registers = await register(this.ruleForm.username, this.ruleForm.emails, this.ruleForm.password, this.ruleForm.c_password, this.ruleForm.captcha, this.ruleForm.ruleKey,this.ruleForm.invitation_code)
                .catch(() => {
                    this.click_is = false;
                })
                .finally(() => {
                    this.click_is = false;
                    this.loading = false;
                    return captcha().then((data) => {
                        this.ruleForm.caps = data.url.img;
                        this.ruleForm.ruleKey = data.url.key;
                    })
                });
            if (registers.status == 200) {
                this.dialogReg = false;
            }
        },
        async logout() {
            this.$message({
                message: '退出成功!',
                type: 'success'
            })
            await this.$auth.logout('local');
            this.userToken = null;
            this.dialogLogin = false
        },
        Go_users() {
            this.$router.push('/users')
        }
    }
}
</script>

<style scoped>

</style>
