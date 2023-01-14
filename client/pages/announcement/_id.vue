<template>
    <section id="blog" class="blog blog-single pb-70">
        <div class="container">
            <div class="entry-header-web pd20"><img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAMAAADzN3VRAAAAq1BMVEVHd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/9Hd/+pwP/////9/f+Ip/9qkf9vlP90mf9OfP+Kqf+Qrf+guf9Rfv+yxv+3yv/A0f/Z4//c5f/i6v/o7v9Ugf9njv/w9P93m//t8v9IuNPeAAAAIHRSTlMABAUGBwgeJyg0NTdIVFVmaHJ0mJ/N0dLT1Obp7e7w8Q+S9IIAAADBSURBVHheddDpUoQwEIXRCw7KKKAyMSjMZDqZfXFf3//JLLqlCsX+/p5O1a1AwiibWEfOTrIR+kWXNXU11yfowpmlfjbt4HxKv5tdCKSO/ub4VWxpWBUDKOm/SiBpGNZPR4HDvSxMkDO8fTwK7MIncQWMXIa9yMtiK2JQsTyHDcN7eCXpFjJ5ER68XxEtw5f3noeDuNC2bKWNjzFX5U4Vo0qhSfcHw4BSldhqgtRpgnGjCU5vNEF0VSsCJLmp5r/kG5aRQ2S8oRFnAAAAAElFTkSuQmCC">
                <h1 class="entry-title-web">{{servues.title}}</h1></div>
            <div class="row">
                <div class="site-content">
                    <div class="blog-entry">
                        <div class="entry--content">
                            <article class="article-content" v-html="servues.content">

                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    auth:false,
    name: "announcement",
    data() {
        return {
            servues:[],
            title: '',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async created() {

    },
    async asyncData({app, params}) {
        let [listA] = await Promise.all([
            app.$axios.$get(`/api/single_page`, {params: {id: params.id}}),
        ])
        return {
            servues:listA.sevice,
            title:listA.sevice.title
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

<style scoped>
.styles__button_group__3Q8uW {
    display: flex;
}
</style>

