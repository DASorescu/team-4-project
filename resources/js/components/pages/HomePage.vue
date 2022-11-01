<template>
    <div>
        <NavBar />
        <MainJumbotron/>
        <SponsorizedSlider/>
        <HowItWorks/>
        <FeedBack/>
        <WorkWithUs/>
        <Footer/>
    </div>
</template>

<script>
import NavBar from '../homePageSections/NavBar.vue';
import MainJumbotron from '../homePageSections/MainJumbotron.vue';
import HowItWorks from '../homePageSections/HowItWorks.vue';
import FeedBack from '../homePageSections/FeedBack.vue';
import WorkWithUs from '../homePageSections/WorkWithUs.vue';
import Footer from '../homePageSections/Footer.vue';
import SponsorizedSlider from '../homePageSections/SponsorizedSlider.vue';

export default {
    name: "HomePage",
    components: {
        NavBar,
        MainJumbotron,
        HowItWorks,
        FeedBack,
        WorkWithUs,
        Footer,
        SponsorizedSlider,
    }
}
</script>

<style>
.w-33 {
    width: calc(100% / 3);
}
</style>
