import axios from "axios"

const sitemap = {
    path: '/sitemap.xml', // 生成的文件路径
    hostname: process.env.BASE_URL, // 网址
    cacheTime:1,
    // cacheTime: 1000 * 60 * 60 * 24, // 1天 更新频率，只在 generate: false有用
    gzip: true, // 生成 .xml.gz 压缩的 sitemap
    generate: false, // 允许使用 nuxt generate 生成
    // 排除不要页面
    exclude: [
        '/404' //  这里的路径相对 hostname
    ],
    // xml默认的配置
    defaults: {
        changefreq: 'always',
        lastmod: new Date()
    },
    // 需要生成的xml数据, return 返回需要给出的xml数据
    routes (callback) {
        axios.all([
            // blog 分类
            axios.get('/api/all_category_sitemap'),
            // 文章列表
            axios.get('/api/all_post_sitemap', {
                params: {
                    page: 1,
                    per_page: 100,
                    _embed: true
                },
                data: { progress: false }
            }),
            // 标签

        ]).then(axios.spread(function (menu, posts) {
            let now = new Date();
            now.setHours(now.getHours(), now.getMinutes() - now.getTimezoneOffset());
            let indexRoutes = [
                {
                    url: '/',
                    changefreq: 'daily',
                    priority: 1,
                    lastmodISO: now.toISOString()
                }
            ]
            let menuRoutes = menu.data.data.map((data) => {
                return {
                    url: '/category/' + data.other,
                    changefreq: 'monthly',
                    priority: 0.8,
                    lastmodISO: now.toISOString()
                }
            });
            let postsRoutes = posts.data.data.map((data) => {
                return {
                    url: '/post/' + data.id,
                    changefreq: 'daily',
                    priority: 0.9,
                    lastmodISO: data.create_time
                }
            });

            // 用 concat 進行合併
            callback(null, indexRoutes.concat(menuRoutes, postsRoutes));
        }), function (err) {
            throw (err);
        });
    }

}

export default sitemap
