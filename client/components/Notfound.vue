<template>
    <div>
        <section class="no-results not-found">
            <div>
                <div class="empty-page">
                    <img src="@/assets/images/empty.png">
                    <p>啥也没有...</p>
                    <h2>不信你看！</h2></div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "Nofound"
}
</script>

<style>
.no-results{
    margin-top: 20px;
    margin-bottom: 20px;
}
.empty-page {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    flex-flow: column;
    color: #ccc;
    font-weight: 200;
    width: 100%;
    background: #fff;
}
.empty-page img{
    width: 260px;
}
.empty-page h2 {
    font-size: 21px;
    font-weight: inherit;
}
</style>
