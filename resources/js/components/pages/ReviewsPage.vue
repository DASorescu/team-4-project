<template>
    <div class="content">
        <NavBar/>
        <div class="d-flex flex-column mt-5 container">
                <div v-for="(review,i) in reviews" :key="'rev-'+i" class="card shadow mt-2">
                    <div class="card-header" >
                        <RateReview :value="review.rating"/>
                        {{review.guest_email}}
                        {{review.guest_name}}
                    </div>
                    <div class="card-body">
                        {{review.content}}
                    </div>
                </div>
            <div class="card shadow mt-5 py-3 px-3">
                <NewReview @submitted="addNewReview" :doctorId="$route.params.userId">
                    <button class="btn btn-secondary" @click="$router.back()">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        Torna Indietro
                    </button>
                </NewReview>
            </div>
        </div>
        <Footer class="mt-3"/>
    </div>
</template>

<script>
import RateReview from '../RateReview';
import axios from 'axios';
import NewReview from '../NewReview'
import NavBar from '../homePageSections/NavBar.vue';
import Footer from '../homePageSections/Footer.vue';
export default {
    name: 'ReviewsPage',
    components: {
    RateReview,
    NewReview,
    NavBar,
    Footer
},
    data() {
        return {
            reviews: []
        }
    },
    methods: {
        addNewReview(review) {
            this.reviews.push(review)
        },
       async getDoctorReviews(doctorId) {
            const res = await axios.get('/api/user/reviews/' + doctorId)
            if (Array.isArray(res.data)) {
                // ciclo sui dottori che ho ottenuto
                for (const review of res.data) {
                    this.reviews.push(review)
                }
            }
        },
    },
    mounted() {
        this.getDoctorReviews(this.$route.params.userId)
    }


}

// devo fare la chiamata per prendere tutte le review di quel dottore.
// come abbiamo fatto in usersearchpage
</script>
<style scoped>
.content {
    background: #fff;

}
</style>
