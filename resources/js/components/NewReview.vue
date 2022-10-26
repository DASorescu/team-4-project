<template>
    <div class="mt-5">
        <h3>Scrivi una recensione</h3>
        <div>
            <RateReview v-model="review" clickable />
        </div>
        <div class="form-group">
            <label for="review">Scrivi la tua recensione</label>
            <textarea class="form-control" v-model="reviewText" rows="5"></textarea>
        </div>
        <button type="button" @click="invia()"> Invia </button>
    </div>
</template>

<script>
import RateReview from './RateReview';
import axios from 'axios';
export default {
    name: 'NewReview',
    components: {
        RateReview,
    },
    props: {doctorId: {type: String, required: true}},
    data() {
        return {
            review: 0,
            reviewText: ''
        }
    },
    methods: {
        invia() {
            const data = { rating: this.review, content: this.reviewText };
        // sistemo la richiesta da inviqae nel back le reviews
            axios.post('...', data)
                .then(()=>{this.$emit('submitted', data)})
                .catch((e) => { this.$emit('error', e) })
        }
    },

}
</script>
