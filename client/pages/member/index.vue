    ``
<template>
    <div style="">
        <div style="width: 100%; height: auto;">
            <div class="centerHead__users_main__1fT82 undefined">
                <!--mobile show-->
                <div class="mobile_hide w-100">
                    <div class="userInformation" @click="drawer=true">
                        <i class="el-icon el-icon-user-solid el-icon-minus_font"></i>
                    </div>
                    <el-drawer
                            class="mobile_draw"
                            title="用户中心"
                            :visible.sync="drawer"
                        >
                    <person_left :message_info="member" :verify="verify_info" :user_pic="user_pic"></person_left>
                    </el-drawer>
                </div>
                <!--mobile show end-->
                <div class="centerHead__users_content__3jK8m">

                    <!--                        left-->
                    <person_left :message_info="member" :verify="verify_info" :user_pic="user_pic"></person_left>
                    <!--                        left end-->
                    <div class="centerHead__centerContent__1K_n0">
                        <div class="transiton_container" style="height: auto;">
                            <div class="userInfo__userContent__3EZA1 route-fade-enter-done">
                                <div class="userInfo__userCenter__mPYhs">
                                    <div class="userInfo__safe_wrap__3SNpQ userInfo__info_wrap__2j3tc">
                                        <div class="userInfo__title__1wWSj">个人资料</div>
                                        <div class="userInfo__header_content__3gR1F">
                                            <div class="userInfo__info__WVYf7">
                                                <span class="userInfo__strong__3zqRn">账户安全等级：</span>
                                                <span
                                                    v-if="member.name!=null && member.phone!=null && member.email!=null">高</span>
                                                <span v-else-if="member.name!=null && member.phone!=null">中</span>
                                                <span v-else-if="member.name!=null && member.email!=null">中</span>
                                                <span v-else>低</span>
                                            </div>
                                            <p>为了确保您的账户安全，请您填写相关安全信息，以备不时之需</p>
                                            <ul>
                                                <li v-if="member.name==null">
                                                    <div class="userInfo__icon__3IJCF"
                                                         style="background-position: 0px 0px;"></div>
                                                    <div class="userInfo__info_text__2nnw7">填写基本资料</div>
                                                </li>
                                                <li v-if="member.name!=null">
                                                    <div class="userInfo__icon__3IJCF"
                                                         style="background-position: -40px 0px;"></div>
                                                    <div class="userInfo__info_text__2nnw7">已填写基本资料</div>
                                                </li>
                                                <!--                                                <li v-if="member.phone==null" @click="dialogFormPhone = true">-->
                                                <!--                                                    <div class="userInfo__icon__3IJCF"-->
                                                <!--                                                         style="background-position: -76px 0px;"></div>-->
                                                <!--                                                    <div class="userInfo__info_text__2nnw7">绑定手机号码</div>-->
                                                <!--                                                </li>-->
                                                <li v-if="member.phone!=null">
                                                    <div class="userInfo__icon__3IJCF"
                                                         style="background-position: -115px 0px;"></div>
                                                    <div class="userInfo__info_text__2nnw7">已绑定手机号码</div>
                                                </li>
                                                <el-dialog title="手机号码" width="30%" :visible.sync="dialogFormPhone">
                                                    <el-form :model="Phone" :rules="rules" ref="Phone"
                                                             label-width="100px" class="demo-ruleForm">
                                                        <div class="modal__body__3K3W3">
                                                            <div class="userInfo__phone_wrap__3BTCB">
                                                                <p class="userInfo__text__2_YL5">
                                                                    为了您的安全，信息在确认后将无法修改，如需帮助请联系客服</p>
                                                                <div class="userInfo__users_layout_modal_form__3v_OH">
                                                                    <div>
                                                                        <div class="userInfo__form_input__1YRt7">
                                                                            <el-form-item label="电话号码" prop="number">
                                                                                <el-input v-model="Phone.number"
                                                                                          placeholder="请填写电话号码"></el-input>
                                                                            </el-form-item>
                                                                        </div>
                                                                        <div class="userInfo__form_input__1YRt7">
                                                                            <el-form-item label="验证码"
                                                                                          prop="verification">
                                                                                <el-input v-model="Phone.verification"
                                                                                          placeholder="请填写验证码">
                                                                                </el-input>
                                                                            </el-form-item>
                                                                            <span data-analytics="button"
                                                                                  data-label="账户安全-手机管理-获取验证码"
                                                                                  class="userInfo__code_btn__1TBFI">获取验证码</span>
                                                                        </div>
                                                                    </div>
                                                                    <el-button
                                                                        type="primary"
                                                                        @click="submitPhone('Phone')">完成
                                                                    </el-button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </el-form>
                                                </el-dialog>
                                                <li v-if="member.email==null" @click="dialogFormEmail = true">
                                                    <div class="userInfo__icon__3IJCF"
                                                         style="background-position: -152px 0px;"></div>
                                                    <div class="userInfo__info_text__2nnw7">绑定电子邮箱</div>
                                                </li>
                                                <li v-if="member.email!=null">
                                                    <div class="userInfo__icon__3IJCF"
                                                         style="background-position: -190px 0px;"></div>
                                                    <div class="userInfo__info_text__2nnw7">已绑定电子邮箱</div>
                                                </li>
                                                <el-dialog title="电子邮箱" width="30%"
                                                           :visible.sync="dialogFormEmail">
                                                    <el-form :model="Emeail" :rules="rules" ref="Emeail"
                                                             label-width="100px" class="demo-ruleForm">
                                                        <div class="modal__body__3K3W3">
                                                            <div class="userInfo__phone_wrap__3BTCB">
                                                                <p class="userInfo__text__2_YL5">
                                                                    为了您的安全，信息在确认后将无法修改，如需帮助请联系客服</p>
                                                                <div class="userInfo__users_layout_modal_form__3v_OH">
                                                                            <el-form-item label="电子邮箱" prop="emeail">
                                                                                <el-input v-model="Emeail.emeail"
                                                                                          placeholder="请填写电子邮箱"></el-input>
                                                                            </el-form-item>
                                                                            <el-form-item label="验证码"
                                                                                          prop="verification">
                                                                                <el-input v-model="Emeail.verification"
                                                                                          placeholder="请填写验证码"></el-input>
                                                                                <span
                                                                                    data-analytics="button"
                                                                                    data-label="账户安全-手机管理-获取验证码"
                                                                                    @click="getcode"
                                                                                    class="userInfo__code_btn__1TBFI">获取验证码
                                                                                </span>
                                                                            </el-form-item>

                                                                    <el-button

                                                                        type="primary"
                                                                        @click="submitEmail('Emeail')">完成
                                                                    </el-button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </el-form>
                                                </el-dialog>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="userInfo__person_wrap__pkUTy userInfo__info_wrap__2j3tc"
                                         v-show="isShow">
                                        <el-form
                                            :model="user" :rules="rules" ref="user"
                                            label-width="100px" class="demo-ruleForm">
                                            <div class="userInfo__title__1wWSj">基本资料</div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="用户名:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{ member.username }}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="昵称:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{ member.name }}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="性别:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__form_radio__WOonN" data-analytics="button"
                                                             data-label="账户安全-基本资料-性别">
                                                            <span v-if="member.gender=='男'"
                                                                  class="userInfo__active__290pb">男</span>
                                                            <span v-if="member.gender=='女'"
                                                                  class="userInfo__active__290pb">女</span>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="出生日期:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="YBDatePicker">
                                                            <div class="userInfo__users_layout_spanFont__2DC-H">
                                                                {{ this.renderTime(member.birthday) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </el-form-item>

                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="注册日期:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{ this.renderTime(member.created_at) }}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="邀请码:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H"
                                                             :data-clipboard-text=member.invitation_code
                                                             v-if="member.invitation_code">
                                                            {{ member.invitation_code }} <el-button size="mini" round type="primary" @click="copy()">点击复制</el-button>
                                                        </div>
                                                        <div class="userInfo__users_layout_spanFont__2DC-H" v-else>
                                                            暂无 <el-button size="mini" round type="primary" @click="start_invitation">生成邀请码</el-button>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="个人说明:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{user.description}}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <el-button type="primary"
                                                       class="userInfo__btn__2VXMC  userInfo__disabled__3yA5b"
                                                       @click="showToggle()">修改
                                            </el-button>
                                        </el-form>
                                    </div>
                                    <div class="userInfo__person_wrap__pkUTy userInfo__info_wrap__2j3tc"
                                         v-if="isShow==false">
                                        <el-form
                                            :model="user" :rules="rules" ref="user"
                                            label-width="100px" class="demo-ruleForm">
                                            <div class="userInfo__title__1wWSj">基本资料</div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="用户名:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{ member.username }}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="昵称:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="YB_input">
                                                            <div class="input_wrapper ">
                                                                <el-input v-model="user.name"
                                                                          :placeholder="member.name"></el-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="性别:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__form_radio__WOonN" data-analytics="button"
                                                             data-label="账户安全-基本资料-性别">
                                                    <span :class="{'userInfo__active__290pb':user.info=='男'}"
                                                          @click="userInfo('男')">男</span>
                                                            <span :class="{'userInfo__active__290pb':user.info=='女'}"
                                                                  @click="userInfo('女')">女</span>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="出生日期:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="YBDatePicker">
                                                            <el-date-picker
                                                                v-model="user.value"
                                                                type="date"
                                                                :placeholder="this.renderTime(member.birthday)">
                                                            </el-date-picker>
                                                        </div>
                                                    </div>
                                                </el-form-item>

                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="注册日期:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            {{ this.renderTime(member.created_at) }}
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="邀请码:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H"
                                                             :data-clipboard-text=member.invitation_code
                                                             v-if="member.invitation_code">
                                                            {{ member.invitation_code }} <el-button size="mini" round type="primary" @click="copy()">点击复制</el-button>
                                                        </div>
                                                        <div class="userInfo__users_layout_spanFont__2DC-H" v-else>
                                                            暂无 <el-button size="mini" round type="primary" @click="start_invitation">生成邀请码</el-button>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <div class="userInfo__users_layout_form_item__2wkd0">
                                                <el-form-item label="个人说明:">
                                                    <div class="userInfo__users_layout_form_input__2t-NB">
                                                        <div class="userInfo__users_layout_spanFont__2DC-H">
                                                            <el-input
                                                                type="textarea"
                                                                placeholder="请输入内容"
                                                                :autosize="{ minRows: 2, maxRows: 4}"
                                                                v-model="user.description"
                                                                maxlength="50"
                                                                show-word-limit
                                                            >
                                                            </el-input>
                                                        </div>
                                                    </div>
                                                </el-form-item>
                                            </div>
                                            <el-button type="primary"
                                                       class="userInfo__btn__2VXMC  userInfo__disabled__3yA5b"
                                                       @click="submitUser('user')">完成
                                            </el-button>

                                        </el-form>
                                    </div>
                                    <div class="userInfo__account_wrap__1JUQX userInfo__info_wrap__2j3tc">
                                        <div class="userInfo__title__1wWSj">账户安全</div>
                                        <!--                                        <div class="userInfo__users_layout_safe_item__1FRzo">-->
                                        <!--                                            <div class="userInfo__users_layout_form_label__2XXjy">手机号码：</div>-->
                                        <!--                                            <p v-if="member.phone==null" class="userInfo__gray__1_sEA">未验证</p>-->
                                        <!--                                            <p v-if="member.phone!=null" class="userInfo__gray__1_sEA">-->
                                        <!--                                                {{ mobile(member.phone)}}</p>-->
                                        <!--                                            <span v-if="member.phone==null" class="userInfo__btn__2VXMC"-->
                                        <!--                                                  @click="dialogFormPhone = true">验证</span>-->
                                        <!--                                            <span v-if="member.phone!=null" class="userInfo__btn__2VXMC"-->
                                        <!--                                            >已验证</span>-->

                                        <!--                                        </div>-->
                                        <div class="userInfo__users_layout_safe_item__1FRzo">
                                            <div class="userInfo__users_layout_form_label__2XXjy">电子邮箱：</div>
                                            <p v-if="member.email==null" class="userInfo__gray__1_sEA">未验证</p>
                                            <p v-if="member.email!=null" class="userInfo__gray__1_sEA">
                                                {{ email(member.email) }}
                                            </p>
                                            <span v-if="member.email==null" class="userInfo__btn__2VXMC"
                                                  @click="dialogFormEmail = true">验证</span>
                                            <span v-if="member.email!=null" class="userInfo__btn__2VXMC">已验证</span>
                                        </div>
                                        <div
                                            class="userInfo__users_layout_safe_item__3y_RM userInfo__same_yb__1sCrk">
                                            <div class="userInfo__users_layout_form_label__2V7le">账户密码：</div>
                                            <span class="userInfo__users_layout_spanFont__mFW6W">*******</span>
                                            <button class="index__Button__It0J4 index__Button2__2-XSS"
                                                    style="width: 120px; height: 40px; position: absolute; right: 0px; font-size: 14px;"
                                                    @click="dialogFormPassword =true">
                                                修改
                                            </button>
                                        </div>

                                        <el-dialog title="修改账号密码" width="30%"
                                                   :visible.sync="dialogFormPassword">
                                            <el-form :model="Modify" :rules="rules" ref="Modify" label-width="100px"
                                                     class="demo-ruleForm">
                                                <div>
                                                    <div>
                                                        <div class="userInfo__users_layout_form_modal_item__CxFXF">
                                                            <el-form-item label="原密码" prop="password">
                                                                <el-input v-model="Modify.password"
                                                                          placeholder="请输入原密码"></el-input>
                                                            </el-form-item>
                                                        </div>
                                                        <div class="userInfo__users_layout_form_modal_item__CxFXF">

                                                            <el-form-item label="新密码" prop="newpassword">
                                                                <el-input v-model="Modify.newpassword"
                                                                          placeholder="请输入8-12位字母+数字的组合"></el-input>
                                                            </el-form-item>

                                                        </div>
                                                        <div class="userInfo__users_layout_form_modal_item__CxFXF">
                                                            <el-form-item label="确认新密码" prop="newpassword2">
                                                                <el-input v-model="Modify.newpassword2"
                                                                          placeholder="请再次输入密码"></el-input>
                                                            </el-form-item>
                                                        </div>
                                                    </div>
                                                    <el-button
                                                        class="index__Button__It0J4 index__Button3__1Pn-Q index__disabled__ocTSE"
                                                        style="width: 100%;"
                                                        @click="submitPassword('Modify')">
                                                        完成
                                                    </el-button>
                                                </div>
                                            </el-form>
                                        </el-dialog>

                                    </div>
                                </div>
                                <div class="userInfo__userRight__2oJ5S">
                                    <div class="style__sidepanel_container__33Bxf" v-loading="loadings">
                                        <div class="style__header_warp__2szlM">
                                            <span class="style__title__1TRfa">连续签到 <span
                                                class="jinsom-sign-page-btn-span">{{ signcount }}</span> 天</span>
                                        </div>
                                        <div class="style__content_warp__fhV-L">
                                            <el-button class="jinsom-sign-page-btn" type="primary"
                                                       @click="dialogVisible = true">点击签到
                                            </el-button>
                                            <el-dialog
                                                :visible.sync="dialogVisible"
                                                width="30%"
                                            >
                                                <div class="ivu-modal-content">
                                                    <div class="ivu-modal-header">
                                                        <div><h5>在线签到<span class="qiandao_day">{{ signcount }}</span>天
                                                        </h5></div>
                                                    </div>
                                                    <div class="ivu-modal-body">
                                                        <div class="insign-date-line">
                                                            <div class="qiandao-row no-gutters text-center">
                                                                <div class="col  " v-for="(item , rol) in signmeta">
                                                                    <div class="text-xs text-muted mb-1">
                                                                        +{{ item.integral }}
                                                                    </div>
                                                                    <span
                                                                        class="current btn btn-icon btn-light btn-circle "
                                                                        :class="{'btnlin':signcount>=item.day}">
                                                                        <span>{{ item.day }}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span slot="footer" class="dialog-footer">
                                                    <el-button @click="buqain">补 签</el-button>
                                                    <el-button @click="birthday_get" type="success">领取生日积分</el-button>
                                                    <el-button type="primary" @click="sign">签 到</el-button>
                                                </span>
                                            </el-dialog>
                                            <el-dialog
                                                title="提示"
                                                :visible.sync="dialogbuqain"
                                                width="30%"
                                            >
                                                <span>您一共漏签{{ diff }}天，确定要花费{{ pay_integrals }}积分进行补签吗？</span>
                                                <span slot="footer" class="dialog-footer">
                                                        <el-button @click="dialogbuqain = false">取 消</el-button>
                                                        <el-button type="primary" @click="signatures">确 定</el-button>
                                                        </span>
                                            </el-dialog>
                                            <div class="jinsom-sign-page-btn" v-for="(item,los) in gifts">
                                                <img class="jinsom-sign-page-btn-img" src="~/assets/images/liwu.png"
                                                     alt=""><span>{{ item.signcount }}天</span>
                                                <el-button class="jinsom-sign-page-btn-button" type="primary"
                                                           @click="Collect_gifts(item.signcount)">领取
                                                </el-button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style__sidepanel_container__2cXFM userInfo__panel_full__1NWOE"
                                         v-loading="loadings">
                                        <div class="style__header_warp__1HNjV">
                                            <div class="style__activityTab__1ryaQ">签到排行榜 - TOP6</div>
                                        </div>
                                        <div class="style__content_warp__3Ec1V-item"
                                             v-for="(item,lol) in Attendancelist">
                                            <p><span class="style__content_warp__3Ec1V-top">{{ lol + 1 }}</span> <img
                                                class="style__content_warp__3Ec1V-img" :src="item.pic"> <span
                                                class="style__content_warp__3Ec1V-span">{{ item.name }}</span> <span
                                                class="style__content_warp__3Ec1V-spans">{{ item.signcount }}天</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {setphone} from '~/plugins/index';
import {setemail} from '~/plugins/index';
import {setuser} from '~/plugins/index';
import {setpassword} from '~/plugins/index';
import {user_sign} from '~/plugins/index';
import {get_user_sign} from '~/plugins/index';
import {signature} from '~/plugins/index';
import {collectgifts, sendEmailCode} from '~/plugins/index';
import axios from "axios";

export default {
    auth:true,
    name: "Index",
    layout: 'default',
    components: {
        person_left
    },
    data() {
        return {
            //弹窗
            dialogFormPhone: false,
            dialogFormEmail: false,
            dialogFormPassword: false,
            dialogVisible: false,
            dialogbuqain: false,
            //手机号码验证
            Phone: {
                number: '',
                verification: '',
            },
            //邮箱验证
            Emeail: {
                emeail: '',
                verification: '',
            },
            formLabelWidth: '120px',
            //个人资料
            user: {
                name: '',
                //单选框
                info: '男',
                //日期选择器
                value: '',
                description:'',
            },
            //修改账号密码
            Modify: {
                password: '',
                newpassword: '',
                newpassword2: '',
            },
            //判断字段
            rules: {
                number: [
                    {required: true, message: '请输入电话号码', trigger: 'blur'},
                ],
                emeail: [
                    {required: true, message: '请输入电子邮箱', trigger: 'blur'},
                    {pattern: /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/, message: '请输入正确邮箱地址'}
                ],
                verification: [
                    {required: true, message: '请输入验证码', trigger: 'blur'},
                ],
                password: [
                    {required: true, message: '请输入原密码', trigger: 'blur'},
                ],
                newpassword: [
                    {required: true, message: '请输入新密码', trigger: 'blur'},
                ],
                newpassword2: [
                    {required: true, message: '请再次输入密码', trigger: 'blur'},
                ],
            },
            //用户信息
            member: {},
            //基本资料修改
            btnText: "隐藏",
            isShow: true,
            loadings: true,
            signcount: 0,
            diff: '',
            pay_integrals: '',
            signmeta: [],
            gifts: [],
            drawer:false,
            Attendancelist: [],
            verify_info:'',
            user_pic:'',
            title: '会员中心',
            now_times:'',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        };
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            this.user.name = users.name;
            this.user.value = users.birthday;
            this.user.description = users.description;
        }
    },

    async asyncData({app}) {
        let [listA, listB, listC,listD,listE] = await Promise.all([
            app.$axios.$post("/api/get_user_sign"),
            app.$axios.$post("/api/gifttable"),
            app.$axios.$post("/api/Attendance_list"),
            app.$axios.$get(`/api/get_verify_auth`),
            app.$axios.$post("/api/get_user_avatar"),
        ])
        return {
            signcount: listA.signcounts,
            diff: listA.diffs,
            pay_integrals: listA.pay_integral,
            signmeta: listA.signmetas,
            gifts: listB.gifttable,
            Attendancelist: listC.gifttable,
            loadings: false,
            verify_info:listD.data,
            user_pic:listE.data
        }
    },

    methods: {
        birthday_get(){
            return axios.post(`/api/birthday_get`,  {user_id: this.member.id}).then(res => {
                if (res.data.status==401){
                    this.$message.warning(res.data.msg)
                }else{
                    this.$message.success(res.data.msg)
                }
            })
        },
        copy(){
            var clipboard = new this.Clipboard('.userInfo__users_layout_spanFont__2DC-H');
            clipboard.on('success', e => {
                this.$message.success('复制成功')
                // 释放内存
                clipboard.destroy()
            })
            clipboard.on('error', e => {
                // 不支持复制
                console.log('该浏览器不支持自动复制')
                // 释放内存
                clipboard.destroy()
            })
        },
        async getcode() {
            const that = this;
            const emailCode = await sendEmailCode(this.Emeail.emeail)
                .then(function (msg) {

                })
        },
        //手机号码显示
        mobile(value) {
            let start = value.toString().slice(0, 3)
            let end = value.toString().slice(-4)
            return start + '****' + end;
        },
        //电子邮箱显示
        email(value) {
            let start = value.toString().slice(0, 3)
            let end = value.toString().slice(-4)
            return start + '****' + end;
        },
        //基本资料修改
        showToggle: function () {
            this.isShow = !this.isShow
            if (this.isShow) {
                this.btnText = "隐藏"
            } else {
                this.btnText = "显示"
            }
        },
        //单选框
        userInfo(info) {
            this.user.info = info;
        },
        //绑定手机号码
        submitPhone(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.setPhone();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        async setPhone() {
            const that = this;
            const shuju = await setphone(this.Phone.number, this.Phone.verification)
                .then(function (msg) {
                    that.$message({
                        message: '填写成功',
                        type: 'success',
                    })
                })
        },
        //绑定电子邮箱
        submitEmail(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.setemail();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        async setemail() {
            const that = this;
            const shuju = await setemail(this.Emeail.emeail, this.Emeail.verification)
                .then(function (msg) {
                    if (msg.status == 200) {
                        that.dialogFormEmail = false
                        that.member.email = that.Emeail.emeail
                    }
                })
        },
        //填写基本资料
        submitUser(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.setuser();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        async setuser() {
            const that = this;
            const shuju = await setuser(this.user.name, this.user.info, this.renderTime(this.user.value),this.user.description)
                .then(function (msg) {
                    if (msg.status == 403) {
                        that.$message({
                            message: '验证码错误',
                            type: 'error',
                        })
                    }
                })
        },
        //时间戳转化
        renderTime(value) {
            var dateee = new Date(value).toJSON();
            return new Date(+new Date(dateee) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '').substr(0, 11);
        },
        //修改密码
        submitPassword(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.setpassword();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        async setpassword() {
            const that = this;
            const shuju = await setpassword(this.Modify.password, this.Modify.newpassword, this.Modify.newpassword2)
                .then(function (msg) {
                    that.$message({
                        message: '修改成功',
                        type: 'success',
                    });
                })
        },
        start_invitation(){
            return axios.post(`/api/update_user_invitation`, {
                user_id: this.$store.state.auth.user.id,
            }).then(res => {
                this.$message.success(res.data.msg);
                this.member.invitation_code = res.data.data;
            })
        },
        //签到
        async sign() {
            const qian = await user_sign();
            const signs = await get_user_sign();
            this.signcount = signs.signcounts;
            this.diff = signs.diffs;
        },
        async signatures() {
            this.dialogbuqain = false;
            const signatured = await signature()
            const signs = await get_user_sign();
            this.signcount = signs.signcounts;
            this.diff = signs.diffs;
        },
        buqain() {
            if (this.diff >= 1) {
                this.dialogbuqain = true
            } else {
                this.$message({
                    message: '您不需要补签',
                    type: 'error',
                });
            }
        },
        //礼物领取
        async Collect_gifts(signcount) {
            const Collect_gifts = await collectgifts(signcount);
        }
    },
    head() {
        return {
            title: this.title + "-" + this.title_for,
            meta: [
                {name: 'keywords', content: this.keywords},
                {hid: 'description', name: 'description', content: this.description}
            ],
            link: [
                { rel: 'icon', type: 'image/x-icon', href: this.ico }
            ]
        }
    }
}
</script>

<style >
.userInfo__users_layout_spanFont__2DC-H .el-textarea{
    width: 300px;
}
</style>

