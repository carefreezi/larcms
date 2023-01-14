<template>
    <div class="main write_all">
        <el-row :gutter="20">
            <el-col :xs="24" :sm="20" :md="20" :lg="20" :xl="20">
                <div class="write_body">
                    <el-form ref="postForm" v-loading="start_loading" v-if="verify_state==1 && is_writer_or" :model="postForm" :rules="rules">
                        <div class="createPost-main-container">
                            <el-upload
                                class="cover-uploader"
                                action="/api/post_upload"
                                :show-file-list="false"
                                :on-success="handlecoverSuccess"
                                :before-upload="beforecoverUpload"
                                :headers="auths"
                            >
                                <el-image
                                    v-if="postForm.cover"
                                    :src="postForm.cover"
                                    :fit="postForm.cover"
                                    class="cover">
                                </el-image>
                                <!--<img v-if="postForm.cover" :src="postForm.cover" class="cover">-->
                                <div v-else>
                                    <i class="el-icon-camera-solid cover-uploader-icon">
                                        <p>点击此处上传文章封面图</p>
                                    </i>
                                </div>
                            </el-upload>
                            <el-form-item prop="title">
                                <el-input v-model="postForm.title" name="name" required placeholder="请输入标题"
                                          class="titles"></el-input>
                            </el-form-item>
                            <el-form-item prop="content" style="margin-bottom: 30px;">
                                <client-only>
                                    <div class="tinymce-container">
                                        <editor v-if="!reloading" :id="tinymceId" v-model="postForm.content"
                                                :init="init" :disabled="disabled" @onClick="onClick"></editor>
                                        <div class="editor-custom-btn-container">
                                            <editorImage color="#1890ff" class="editor-upload-btn"
                                                         @successCBK="imageSuccessCBK"/>
                                        </div>
                                    </div>
                                </client-only>
                            </el-form-item>
                            <el-form-item style="margin-left: 10px;margin-right: 10px;margin-bottom: 30px;">
                                <el-collapse>
                                    <el-collapse-item title="分类/专题（必填）" name="1">
                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="分类:" class="postInfo-container-item"
                                                          prop="category">
                                                <el-select v-model="postForm.category" placeholder="请选择"
                                                           @change="$forceUpdate()" required>
                                                    <el-option
                                                        v-for="item in category"
                                                        :key="item.id"
                                                        :label="item.name"
                                                        :value="item.id">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="专题:" class="postInfo-container-item" prop="special">
                                                <el-select v-model="postForm.special" placeholder="请选择" @change="$forceUpdate()" multiple required>
                                                    <el-option
                                                        v-for="item in specials"
                                                        :key=item.id
                                                        :label="item.name"
                                                        :value=item.id>
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                    </el-collapse-item>
                                    <el-collapse-item title="标签（选填）" name="2">
                                        <el-col :span="24">
                                            <el-form-item label-width="100px" label="标签:"
                                                          class="postInfo-container-item">
                                                <el-tag
                                                    :key="tag"
                                                    v-for="tag in dynamicTags"
                                                    closable
                                                    :disable-transitions="false"
                                                    @close="handleClose(tag)">
                                                    {{ tag }}
                                                </el-tag>
                                                <el-input
                                                    class="input-new-tag"
                                                    v-if="inputVisible"
                                                    v-model="inputValue"
                                                    ref="saveTagInput"
                                                    size="small"
                                                    @keyup.enter.native="handleInputConfirm"
                                                    @blur="handleInputConfirm"
                                                >
                                                </el-input>
                                                <el-button v-else class="button-new-tag" size="small"
                                                           @click="showInput">+ 新标签
                                                </el-button>

                                            </el-form-item>
                                        </el-col>
                                    </el-collapse-item>
                                    <el-collapse-item title="权限设置（选填）" name="3">
                                        <el-col :span="8">
                                            <el-form-item label-width="100px" label="价格:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.price" placeholder="输入价格"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item label-width="100px" label="vip价格:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.vip_price" placeholder="输入VIP价格"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item label-width="100px" label="积分:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.integral" placeholder="输入积分价格"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="24">
                                            <el-form-item label-width="100px" label="下载地址:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.dw_url" placeholder="输入下载地址"
                                                          @input="$forceUpdate()"></el-input>
                                            </el-form-item>
                                        </el-col>

                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="提取码:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.traction" placeholder="输入提取码"
                                                          @input="$forceUpdate()"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="12">
                                            <el-form-item label-width="100px" label="解压码:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.trac" placeholder="输入解压码"
                                                          @input="$forceUpdate()"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item label-width="100px" label="限制vip等级:"
                                                          class="postInfo-container-item">
                                                <el-select v-model="postForm.isvip_level" placeholder="请选择">
                                                    <el-option label="不限制" value=""></el-option>
                                                    <el-option
                                                        v-for="item in isvip"
                                                        :key=item.vip_level
                                                        :label="item.vip_name"
                                                        :value=item.vip_level>
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                    </el-collapse-item>
                                    <el-collapse-item title="扩展设置（选填）" name="4">
                                        <el-col :span="16">
                                            <el-form-item label-width="100px" label="演示网站:"
                                                          class="postInfo-container-item">
                                                <el-input v-model="postForm.source_uri"
                                                          placeholder="输入演示站点http://或https://开头"></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="8">
                                            <el-form-item label-width="100px" label="文章样式:"
                                                          class="postInfo-container-item">
                                                <el-select v-model="postForm.style_type" placeholder="请选择">
                                                    <el-option label="全屏文章" :value=1></el-option>
                                                    <el-option label="左右分屏文章" :value=2></el-option>
                                                </el-select>
                                            </el-form-item>
                                        </el-col>
                                    </el-collapse-item>
                                </el-collapse>
                            </el-form-item>
                            <el-form-item
                                style="margin-left: 10px;margin-right: 10px;margin-bottom: 30px;text-align: right">
                                <el-button :loading="loading" type="primary" @click="submitForm">
                                    发布
                                </el-button>
                            </el-form-item>
                        </div>
                    </el-form>
                    <section class="no-results not-found" v-else>
                        <div>
                            <div class="empty-page">
                                <img src="@/assets/images/empty.png">
                                <h2>您的权限不足，未经过用户认证或该文章作者权限不属于您！</h2>
                            </div>
                        </div>
                    </section>
                </div>
            </el-col>
            <el-col :xs="24" :sm="4" :md="4" :lg="4" :xl="4">
                <ul class="write_box">
                    <li>
                        <p><b>尊重原创</b></p>
                        <p>请不要发布任何盗版下载链接，包括软件、音乐、电影等等。我们尊重原创。</p>
                    </li>
                    <li>
                        <p><b>友好互助</b></p>
                        <p>您的文章将会有成千上万人阅读，保持对陌生人的友善，用知识去帮助别人也是一种快乐。</p>
                    </li>
                    <li>
                        <p><b>处罚</b></p>
                        <p>禁止发布垃圾广告</p>
                        <p>发现垃圾广告，本站会立刻封停您的账户</p>
                    </li>
                </ul>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import editorImage from '@/components/EditorImage'
import axios from 'axios'

let tinymce
if (process.client) {
    tinymce = require('tinymce/tinymce')
    require('tinymce/themes/silver/theme')
    require('tinymce/plugins/image')
    require('tinymce/plugins/codesample')
    require('tinymce/plugins/emoticons')
    require('tinymce/plugins/code')
    require('tinymce/plugins/link')
    require('tinymce/plugins/media')
    require('tinymce/plugins/table')
    require('tinymce/plugins/lists')
    require('tinymce/plugins/contextmenu')
    require('tinymce/plugins/wordcount')
    require('tinymce/plugins/colorpicker')
    require('tinymce/plugins/textcolor')
    require('tinymce/plugins/fullscreen')
    require('tinymce/icons/default')
}

export default {
    auth: true,
    name: "edit",
    components: {
        Editor,
        editorImage
    },
    props: {
        id: {
            type: String,
            default: 'vue-tinymce-' + +new Date() + ((Math.random() * 1000).toFixed(0) + '')
        },
        value: {
            type: String,
            required: false,
        },
        triggerChange: {
            type: Boolean,
            default: false,
            required: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        plugins: {
            type: [String, Array],
            default: 'lists image link media table textcolor wordcount codesample emoticons contextmenu fullscreen',
        },
        toolbar: {
            type: [String, Array],
            default:
                'undo redo |  formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | lists link unlink image emoticons table | removeformat | fullscreen codesample',
            branding: false,
        },

        width: {
            type: String,
            default: '100%'
        },
        height: {
            type: Number,
            default: 400
        }
    },
    data() {
        return {
            verify_state:'',
            auths: {Authorization: 'Bearer ' + this.$store.state.auth.user.api_token},
            tinymceId: this.id || 'vue-tinymce' + Date.parse(new Date()),
            init: {
                language_url: '/tinymce/langs/zh_CN.js',
                language: 'zh_CN',
                emoticons_database_url: '/tinymce/plugins/emoticons/emojis.js',
                skin_url: '/tinymce/skins/lightgray',
                content_css : '/tinymce/skins/lightgray/content.min.css' ,
                width: this.width,
                height: this.height,
                selector: `#${this.tinymceId}`,
                object_resizing: false,
                // selector: 'tinymce-editor',
                content_style: `
                  .mce-content-body {
                    width: ${this.width};
                    overflow-x: hidden;
                  }
                  .mce-content-body table {
                    width: auto !important;
                  }
                `,
                plugins: this.plugins,
                toolbar: this.toolbar,
                branding: false,
                menubar: false,
                toolbar_drawer: true,
                statusbar: false, // 隐藏底部状态栏
                //预防xss攻击，同时不希望用户直接粘贴进来一些富文本,在你的 init 里面，添加以下属性
                //修改默认属性
                saveImgList() {
                    let html = '';
                    this.seeting.fileList.forEach(item => {
                        html += `<img src="` + item.url + `" width="300" height="auto" alt="">`
                    })
                    this.editor.insertContent(html);
                    this.saveImgs = false
                },
                paste_preprocess: (pl, o) => {
                    o.content = $stripTags(o.content, 'sup,sub')
                },
                images_upload_handler: (blobInfo, success) => {
                    let formData = new FormData()
                    formData.append('file', blobInfo.blob(), blobInfo.filename())
                    formData.append('biz', 'jeditor')
                    formData.append('jeditor', '1')
                    this.$axios.post('/api/post_upload', formData).then((res) => {
                        if (res.status == 200) {
                            const img = res.data.files.file
                            success(img)
                        }
                    })
                },
            },
            post_id:'',
            reloading: false,
            loading: false,
            tempRoute: {},
            dynamicTags: [],
            inputVisible: false,
            inputValue: '',
            iswrite: false,
            userListOptions: [],
            category: [],
            specials: [],
            isvip: [],
            start_loading:true,
            postForm: {
                status: 'draft',
                title: '', // 文章题目
                content: this.value, // 文章内容
                content_short: '', // 文章摘要
                source_uri: '', // 文章外链
                cover: '', // 文章图片
                display_time: undefined, // 前台展示时间
                id: undefined,
                platforms: ['a-platform'],
                comment_disabled: false,
                importance: 0,
                dw_url: '',
                author: this.$store.state.auth.user.id,
                price: '',
                vip_price: '',
                traction: '',
                trac: '',
                isvip_level: '',
                category: '',
                style_type: 1,
                special: '',
                integral: '',
            },
            rules: {
                title: [
                    {required: true, message: '请输入标题', trigger: 'blur'},
                ],
                content: [
                    {required: true, message: '请输入内容', trigger: 'blur'},
                ],
                category: [
                    {required: true, message: '请选择分类', trigger: 'blur'},
                ],
            },
            is_writer_or:false,
            title: '编辑文章',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app, params}) {
        try {
            let [listA, listB,listC,listD,listE] = await Promise.all([
                app.$axios.$post(`/api/get_cate`),
                app.$axios.$post(`/api/get_vip`),
                app.$axios.$get(`/api/get_verify_auth`),
                app.$axios.$post(`/api/get_special`),
                app.$axios.$post(`/api/is_writer`,{id:params.id}),
            ])
            return {
                category: listA.cates,
                isvip: listB.vips,
                verify_state:listC.data.state,
                specials:listD.specials,
                is_writer_or:listE.data
            }
        } catch (error) {
            return {
                category: []
            }
        }
    },
    mounted() {
        this.init.selector = '#' + this.tinymceId;
        this.get_post_info();
        this.get_cate();
    },
    methods: {
        get_cate(){
            return axios.post(`/api/get_cate`).then(response => {
                if (!response.data.cates) return
                this.category = response.data.cates.map(item => {
                    return {id: `${item.id}`, name: `${item.name}`}
                })
            })
        },
        get_post_info(){
            this.start_loading=true;
            return axios.post(`/api/fetch_edit_post`, {
                ids:this.$route.params.id
            }).then(response => {
                this.postForm = response.data.data
                this.post_id = response.data.data.id;
                this.postForm.dw_url = response.data.data.download_url;
                this.postForm.traction = response.data.data.extraction_code;
                this.postForm.trac = response.data.data.extract_code;
                this.dynamicTags = JSON.parse(response.data.data.tags);
                this.postForm.category = String(response.data.data.cate_id);
                this.postForm.source_uri = response.data.data.show_url;
                this.postForm.author = String(response.data.data.author_id);
                this.postForm.cover = response.data.data.cover;
                this.postForm.style_type = response.data.data.style_type
                this.postForm.special = response.data.specials
                this.postForm.integral = response.data.data.integral
                this.start_loading = false;
            }).catch(error => {
            })
        },
        handlecoverSuccess(res, file) {
            this.postForm.cover = res.files.file;
            if (res.status == 200) {
                this.$message.success(res.msg)
            }
        },
        beforecoverUpload(file) {
            // 文件类型进行判断
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png' || file.type === 'image/PNG' || file.type === 'image/JPG';
            const isLt2M = file.size / 1024 / 1024 < 2;
            if (!isJPG) {
                this.$message.error("上传封面图片只能是 JPG或PNG 格式!");
                return isJPG && isLt2M;
            }
            if (!isLt2M) {
                this.$message.error("上传封面图片大小不能超过 2MB!");
                return isJPG && isLt2M;
            }
        },
        destroyTinymce() {
            const tinymce = window.tinymce.get(this.tinymceId)
            if (this.fullscreen) {
                tinymce.execCommand('mceFullScreen')
            }

            if (tinymce) {
                tinymce.destroy()
            }
        },
        setContent(value) {
            window.tinymce.get(this.tinymceId).setContent(value)
        },
        getContent() {
            window.tinymce.get(this.tinymceId).getContent()
        },
        imageSuccessCBK(arr) {
            const _this = this
            arr.forEach(v => window.tinymce.get(_this.tinymceId).insertContent(`<img class="wscnph" src="${v.url}" >`))
        },
        handleInputConfirm() {
            let inputValue = this.inputValue;
            if (inputValue) {
                this.dynamicTags.push(inputValue);
            }
            this.inputVisible = false;
            this.inputValue = '';
        },
        handleClose(tag) {
            this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
        },
        showInput() {
            this.inputVisible = true;
            this.$nextTick(_ => {
                this.$refs.saveTagInput.$refs.input.focus();
            });
        },
        submitForm() {
            this.$refs.postForm.validate(valid => {
                if (valid) {
                    this.loading = true
                    return axios.post(`/api/update_article`, {
                        id:this.postForm.id,
                        title:this.postForm.title,
                        author:this.postForm.author,
                        content:this.postForm.content,
                        price:this.postForm.price,
                        vip_price:this.postForm.vip_price,
                        dynamicTags:this.dynamicTags,
                        category:this.postForm.category,
                        isvip_level:this.postForm.isvip_level,
                        source_uri:this.postForm.source_uri,
                        dw_url:this.postForm.dw_url,
                        style_type:this.postForm.style_type,
                        traction:this.postForm.traction,
                        trac:this.postForm.trac,
                        cover:this.postForm.cover,
                        special:this.postForm.special,
                        integral:this.postForm.integral
                    }).then(res => {
                        this.$message({
                            title: '成功',
                            message: res.data.msg,
                            type: 'success',
                            duration: 2000
                        })
                        this.get_post_info();
                        this.loading = false
                    }).catch(error => {
                        this.loading = false
                    })
                    this.postForm.status = 'published'
                    this.loading = false
                } else {
                    this.$notify.warning({
                        title: '注意',
                        message: '请填写必填项：标题、分类、内容'
                    });
                    return false
                }
            })
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
        reload() {
            this.reloading = true
            this.$nextTick(() => (this.reloading = false))
        },

        onClick(e) {
            this.$emit('onClick', e, tinymce)
        },
        //可以添加一些自己的自定义事件，如清空内容
        clear() {
            this.postForm.content = ''
        },

        /**
         * 自动判断父级是否是 <a-tabs/> 组件，然后添加事件监听，自动触发reload()
         *
         * 由于 tabs 组件切换会导致 tinymce 无法输入，
         * 只有重新加载才能使用（无论是vue版的还是jQuery版tinymce都有这个通病）
         */
        initATabsChangeAutoReload() {
            // 获取父级
            let tabs = getVmParentByName(this, 'ATabs')
            let tabPane = getVmParentByName(this, 'ATabPane')
            if (tabs && tabPane) {
                // 用户自定义的 key
                let currentKey = tabPane.$vnode.key
                // 添加事件监听
                tabs.$on('change', (key) => {
                    // 切换到自己时执行reload
                    if (currentKey === key) {
                        this.reload()
                    }
                })
            } else {
                let tabLayout = getVmParentByName(this, 'TabLayout')
                tabLayout.excuteCallback(() => {
                    this.reload()
                })
            }
        },
    },
    watch: {
        value(val) {
            if (!this.hasChange && this.hasInit) {
                this.$nextTick(() =>
                    window.tinymce.get(this.tinymceId).setContent(val || ''))
            }
        },
        myValue(newValue) {
            if (this.triggerChange) {
                this.$emit('change', newValue)
            } else {
                this.$emit('input', newValue)
            }
        },
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

<style>

.el-tag + .el-tag {
    margin-left: 10px;
}

.button-new-tag {
    height: 31px;
    line-height: 30px;
    padding-top: 0;
    padding-bottom: 0;
}

.input-new-tag {
    width: 90px;
    margin-left: 10px;
    vertical-align: bottom;
}

.tinymce-container {
    position: relative;
}

.editor-custom-btn-container {
    position: absolute;
    right: 4px;
    top: 0px;
}

.write_body {
    background: #fff;
    margin: 10px 0px;
}

.tox .tox-dialog-wrap__backdrop {
    background-color: rgba(0, 0, 0, .5) !important;
}

.tox-tinymce {
    border: none !important;
}

.tox button.tox-tbtn:hover:before, .tox-split-button:hover:before {
    content: attr(aria-label);
    position: absolute;
    top: 39px;
    background: #484848;
    color: #fff;
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 3px;
    white-space: nowrap;
    z-index: 1;
}

.tox button.tox-tbtn:hover:after, .tox-split-button:hover:after {
    position: absolute;
    top: 36px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 10px 10px;
    border-color: transparent transparent #484848;
    content: '';
}

.write_box {
    position: relative;
    margin-top: 10px;
    background: #fff;
}

ul.write_box li {
    display: flex;
}

ul.write_box li {
    font-size: 13px;
    padding: 16px;
    border-bottom: 1px solid #f3f3f3;
    box-sizing: border-box;
}

ul.write_box li {
    flex-flow: column;
}

.cover-uploader {
    height: 300px;
}

.cover-uploader .el-upload {
    border: none;
    border-bottom: 1px solid #ddd;
    border-radius: 0px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    width: 100%;
}

.cover-uploader .el-upload:hover {
    border-color: #409EFF;
}

.cover-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 100%;
    height: 300px;
    line-height: 50px;
    text-align: center;
    padding-top: 100px;
}

.write_all .cover {
    width: 100%;
    height: 300px;
    display: block;
}

.write_all .titles~ .el-form-item__error {
    top: 20%;
    right: 0;
    left: 90%;
    font-size: 16px;
}
.write_all .el-upload img{
    width: 100%;
    height: auto;
}
.write_all .titles input {
    border-left: 0;
    border-right: 0;
    border-radius: 0px;
    border-color: #efefef;
    font-size: 27px;
    color: #000;
}

.write_all .el-form-item {
    margin-bottom: 0px;
}
.tox .tox-editor-header{
    z-index:auto !important;
}
</style>
