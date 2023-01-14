import VuexPersistence from 'vuex-persist'
export default ({ store }) => {
    window.onNuxtReady(() => {
        new VuexPersistence({
            /* your options */
        }).plugin(store);
    });
}
