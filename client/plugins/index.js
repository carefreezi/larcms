import request from './request'

/**
 * 获取头部分类信息
 * @param
 */
export function headGet() {
    return request({
        url: 'headGet',
        method: 'get'
    })
}

/**
 * 获取头部分类
 * @param
 */
export function topUrl() {
    return request({
        url: 'topUrl',
        method: 'get'
    })
}


/**
 * 获取轮播图
 * @param
 */
export function banner() {
    return request({
        url: 'banner',
        method: 'get'
    })
}
/**
 * 首页分类排序
 * @param
 */
export function categorydesc() {
    return request({
        url: 'categorydesc',
        method: 'get'
    })
}
/**
 * 分类页
 * @param other路径名称
 */
export function details_portal(other,page,limit) {
    return request({
        url: 'details_portal',
        method: 'get',
        params: {other,page,limit}
    })
}

/**
 * 分类页筛选
 * @param other路径名称
 *        types查询方式
 */
export function details_portal_select(other,types) {
    return request({
        url: 'details_portal_select',
        method: 'get',
        params: {other,types}
    })
}

/**
 * 搜索页面
 * @param other路径名称
 */
export function search_page(other,page,limit) {
    return request({
        url: 'search_page',
        method: 'get',
        params: {other,page,limit}
    })
}

/**
 * 标签页面
 * @param other路径名称
 */
export function tags_page(other,page,limit) {
    return request({
        url: 'tags_page',
        method: 'get',
        params: {other,page,limit}
    })
}

/**
 * 获取验证码
 * @param
 */
export function captcha() {
    return request({
        url: 'captcha',
        method: 'get'
    })
}

/**
 * 首页
 * @param
 */
export function portal() {
    return request({
        url: 'portal',
        method: 'get'
    })
}

/**
 * 文章详情页
 * @param
 */
export function details_page(id) {
    return request({
        url: 'details_page',
        method: 'get',
        params: {id}
    })
}

/**
 * 绑定手机号
 * @param
 */
export function setphone(phone, phonecode) {
    return request({
        url: 'setphone',
        method: 'post',
        params: {phone, phonecode}
    })
}

/**
 * 绑定电子邮箱
 * @param
 */
export function setemail(email, phonecode) {
    return request({
        url: 'setemail',
        method: 'post',
        params: {email, phonecode}
    })
}

/**
 * 填写基本资料
 * @param
 */
export function setuser(name, infor, birthday,description) {
    return request({
        url: 'setuser',
        method: 'post',
        params: {name, infor, birthday,description}
    })
}

/**
 * 修改密码
 * @param
 */
export function setpassword(password, newpassword, newpassword2) {
    return request({
        url: 'setpassword',
        method: 'post',
        params: {password, newpassword, newpassword2}
    })
}

/**
 * 登录
 * @param
 */
export function login(username, password, captcha, key) {
    return request({
        url: 'login',
        method: 'post',
        params: {username, password, captcha, key}
    })
}

/**
 * 注册
 * @param
 */

export function register(username, email, password, c_password, captcha, key,invitation_code) {
    return request({
        url: 'register',
        method: 'post',
        params: {username, email, password, c_password, captcha, key,invitation_code}
    })
}

/**
 * 查询个人信息
 * @param
 */
export function me() {
    return request({
        url: 'me',
        method: 'post',
    })
}

/**
 * 查询用户vip信息
 * @param
 */
export function userVip() {
    return request({
        url: 'userVip',
        method: 'post',
    })
}

/**
 * 支付宝充值
 * @param
 */
export function payByAlipay(amount, id, payment, types) {
    return request({
        url: 'alipay',
        method: 'get',
        params: {amount, id, payment, types}
    })
}

/**
 * 微信充值
 * @param
 */
export function payByWechat(fee, id, payment, types, post_id) {
    return request({
        url: 'wechat',
        method: 'get',
        params: {fee, id, payment, types, post_id}
    })
}

/**
 * 用户订单信息
 * @param
 */
export function usertable(id) {
    return request({
        url: 'usertable',
        method: 'get',
        params: {id}

    })
}

/**
 * 用户订单信息
 * @param
 */
export function usertables(id) {
    return request({
        url: 'usertables',
        method: 'get',
        params: {id}

    })
}

/**
 * 提现
 * @param
 */
export function Cashwithdrawal(amount, id, payment, name, number) {
    return request({
        url: 'Cashwithdrawal',
        method: 'get',
        params: {amount, id, payment, name, number}
    })
}

/**
 * 使用余额进行vip充值
 * @param
 */
export function payByBlance(amount, id, payment, types) {
    return request({
        url: 'payByBlance',
        method: 'get',
        params: {amount, id, payment, types}
    })
}

/**
 * 文章支付
 * @param
 */
export function post_payment(post_price, id, payment, types, post_id, author_id,integral) {
    return request({
        url: 'post_payment',
        method: 'get',
        params: {post_price, id, payment, types, post_id, author_id,integral}
    })
}

/**
 * 判断是否是vip并输出文章价格
 * @param
 */
export function isvip_price(vip_id, post_id) {
    return request({
        url: 'isvip_price',
        method: 'post',
        params: {vip_id, post_id}
    })
}

/**
 * 判断文章是否被购买
 * @param
 */
export function ispaypost(user_id, post_id) {
    return request({
        url: 'ispaypost',
        method: 'post',
        params: {user_id, post_id}
    })
}

/**
 * 文章点赞和关注
 * @param
 */
export function likeinfor(user_id, post_id, author_id, types) {
    return request({
        url: 'likeinfor',
        method: 'post',
        params: {user_id, post_id, author_id, types}
    })
}

/**
 * 判断是否关注
 * @param
 */
export function isfollow(user_id, author_id) {
    return request({
        url: 'isfollow',
        method: 'post',
        params: {user_id, author_id}
    })
}

/**
 * 获取文章交易记录
 * @param
 */
export function postordes() {
    return request({
        url: 'postordes',
        method: 'post',
    })
}

/**
 * 获取消息记录
 * @param
 */
export function messagetable() {
    return request({
        url: 'messagetable',
        method: 'post',
    })
}
/**
 * 获取未读消息
 * @param
 */
export function nomessages() {
    return request({
        url: 'nomessages',
        method: 'post',
    })
}

/**
 * 点击消息
 * @param
 */
export function readmessage(id,activeName) {
    return request({
        url: 'readmessage',
        method: 'post',
        params: {id,activeName}
    })
}

/**
 * 意见反馈——问题类型
 * @param
 */
export function Question_type() {
    return request({
        url: 'Question_type',
        method: 'post',
        params: {}
    })
}

/**
 * 上传图片
 * @param
 */
export function upload(source) {
    return request({
        url: 'upload',
        method: 'post',
        params: {source}
    })
}
/**
 * 上传问题反馈
 * @param
 */
export function upQuestion(types,content,images) {
    return request({
        url: 'upQuestion',
        method: 'post',
        params: {types,content,images}
    })
}
/**
 * 用户头像上传
 * @param
 */
export function upuser_pic(images) {
    return request({
        url: 'upuser_pic',
        method: 'post',
        params: {images}
    })
}
/**
 * 获取用户头像
 * @param
 */
export function getuserpic() {
    return request({
        url: 'getuserpic',
        method: 'post',
    })
}
/**
 * 用户签到
 * @param
 */
export function user_sign() {
    return request({
        url: 'user_sign',
        method: 'post',
    })
}
/**
 * 获取用户签到信息
 * @param
 */
export function get_user_sign() {
    return request({
        url: 'get_user_sign',
        method: 'post',
    })
}
/**
 * 用户补签
 * @param
 */
export function signature() {
    return request({
        url: 'signature',
        method: 'post',
    })
}
/**
 * 礼物领取
 * @param
 */
export function collectgifts(signcount) {
    return request({
        url: 'collectgifts',
        method: 'post',
        params: {signcount}
    })
}
/**
 * 礼物表
 * @param
 */
export function gifttable() {
    return request({
        url: 'gifttable',
        method: 'post',
    })
}
/**
 * 获取排行榜
 * @param
 */
export function Attendance_list() {
    return request({
        url: 'Attendance_list',
        method: 'post',
    })
}
/**
 * 转账
 * @param
 */
export function transfer_accounts(amount,number) {
    return request({
        url: 'transfer_accounts',
        method: 'post',
        params: {amount,number}
    })
}
/**
 * 获取用户文章
 * @param
 */
export function userpost() {
    return request({
        url: 'userpost',
        method: 'post',
    })
}
/**
 * 获取帮助中心
 * @param
 */
export function Help_center() {
    return request({
        url: 'Help_center',
        method: 'post',
    })
}

/**
 * 获取底部信息
 * @param
 */
export function bottominformation() {
    return request({
        url: 'bottominformation',
        method: 'post',
    })
}
/**
 * single网页
 * @param
 */
export function single_page(id) {
    return request({
        url: 'single_page',
        method: 'post',
        params: {id}
    })
}

export function sendEmailCode(emails) {
    return request({
        url: 'sendEmailCode',
        method: 'post',
        params:{emails}
    })
}

// 提交评论
export function subComment(id,post_id,contents){
    return request({
        url:'subComment',
        method:'post',
        params:{id,post_id,contents}
    })
}

export function replyComment(parent_id,id,post_id,contents){
    return request({
        url:'replyComment',
        method:'post',
        params:{parent_id,id,post_id,contents}
    })
}

export function detail_author(author_id){
    return request({
        url:'detail_author',
        method:'post',
        params:{author_id}
    })
}

export function send_email(emails) {
    return request({
        url: 'send_email',
        method: 'post',
        params:{emails}
    })
}

export function reset_pass(emails,pass,email_code) {
    return request({
        url: 'reset_pass',
        method: 'post',
        params:{emails,pass,email_code}
    })
}
