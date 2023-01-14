import sitemap from './plugins/sitemap'
module.exports = {
    // Global page headers: https://go.nuxtjs.dev/config-head

    srcDir: __dirname,
    head: {
        title: 'LarCms系统',
        titleTemplate: '%s ',
        htmlAttrs: {
            lang: 'en'
        },
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        ],
        scripts: [

        ],
        link: [
        ]
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        '@/assets/css/min.css',
        '@/assets/css/chat.css',
        '@/assets/css/member.css',
        'element-ui/lib/theme-chalk/index.css',
        '@/assets/css/main.css',
        '@/assets/css/icon/iconfont.css',
        '@/assets/css/mobile.css'
    ],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [
        '@/plugins/element-ui',
        { src: '@/plugins/axios', ssr: false },
        { src: '@/plugins/vueqr.js', ssr: false },
        { src: '@/plugins/vuex-persist', ssr: false },
        '@/plugins/component-login',
        { src: '@/plugins/vueLazyLoad', ssr: false }
    ],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        '@nuxtjs/color-mode'
    ],
    router: {
        middleware: ['auth'],
        routeNameSplitter: '/'
    },
    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        '@nuxtjs/axios',
        // '@nuxtjs/router',
        'nuxt-vuex-localstorage',
        '@nuxtjs/auth',
        '@nuxtjs/sitemap',
        '@nuxtjs/robots'
    ],
    robots: {
        UserAgent: '*',
        Allow: '*',
    },
    sitemap:sitemap,
    axios: {
        proxy: true,
    },
    server: {
        port: 3000, // default: 3000
        host: '0.0.0.0', // default: localhost
    },

    auth: {
        strategies: {
            local: {
                endpoints: {
                    login: {
                        url: '/api/login',
                        method: 'post',
                        propertyName: 'data.original.access_token'
                    },
                    logout: { url: '/api/logout', method: 'post' },
                    user: {
                        url: '/api/me',
                        method: 'post',
                        propertyName: 'data'
                    }
                }
            }
        },
        redirect: {
            login: '/',
            logout: '/',
            callback: '/',
            home: '/'
        },
        cookie: {
            options: {
                maxAge: 60 * 60 * 24 * 1
            }
        },
        localStorage: false
    },
    proxy: {
        '/api': {
            target: 'http://127.0.0.12/',
            changeOrigin: true,
        }
    },
    build: {
        transpile: [/^element-ui/],
        vendor: ["axios"],
        extractCSS: { allChunks: true },
        babel: {
            plugins: [
                [
                    'prismjs',
                    {
                        languages: [
                            'html',
                            'css',
                            'javascript',
                            'php',
                            'dart',
                            'bash',
                            'nginx',
                            'sql',
                            'c',
                            'cpp',
                            'python',
                            'go',
                            'java'
                        ],
                        plugins: [
                            'line-numbers',
                            'show-language',
                            'copy-to-clipboard'
                        ],
                        theme: 'tomorrow',
                        css: true
                    }
                ]
            ]
        }

    },
    loading: {
        color: 'blue',
        height: '2px'
    },
}
