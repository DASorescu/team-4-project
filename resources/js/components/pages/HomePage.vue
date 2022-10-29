<template>
    <div>
        <MainJumbotron/>
        <HowItWorks/>
        <FeedBack/>
        <WorkWithUs/>
        <Footer/>
    </div>
</template>

<script>

import MainJumbotron from '../homePageSections/MainJumbotron.vue';
import HowItWorks from '../homePageSections/HowItWorks.vue';
import FeedBack from '../homePageSections/FeedBack.vue';
import WorkWithUs from '../homePageSections/WorkWithUs.vue';
import Footer from '../homePageSections/Footer.vue';
export default {
    name: "HomePage",
    components:{
        MainJumbotron,
        HowItWorks,
        FeedBack,
        WorkWithUs,
        Footer,
    },

}
</script>

<style lang="scss" scoped>

</style>
