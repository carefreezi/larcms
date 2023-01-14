<template>
    <div class="layout-404">
        <div class="inner-wrapper"><h1 class="fs-50 mb-7">Page Not Found</h1>
            <p class="text-muted">未找到相关页面，请检查网址是否正确。</p>
            <nuxt-link to="/" class="btn btn-outline-theme fs-18 py-1 px-7 btn-round btn-lg">回到首页</nuxt-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "error",
    props: ['error']
}
</script>

<style scoped>

</style>
