<template>
    <div class="mt-5">
        <h3>Scrivi una recensione</h3>
            <div class="form-group">
                <label for="name">Inserisci il tuo nome</label>
                <input type="text" id="name" class="form-control" v-model="guestName"></input>
            </div>
                 <div class="form-group">
                <label for="email">Inserisci la tua mail</label>
                <input type="email" id="email" class="form-control" v-model="guestEmail"></input>
            </div>
        <div>
            <RateReview v-model="review" clickable />
        </div>
        <div class="form-group">
            <label for="review">Scrivi la tua recensione</label>
            <textarea class="form-control" id="review" v-model="reviewText" rows="5"></textarea>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success" type="button" @click="invia()"> Invia </button>
            <slot></slot>
        </div>
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
            reviewText: '',
            guestName: '',
            guestEmail: ''
        }
    },
    methods: {
        invia() {
            const data = {
                rating: this.review,
                content: this.reviewText,
                guest_name: this.guestName,
                guest_email: this.guestEmail,
            };
        // sistemo la richiesta da inviqae nel back le reviews
            axios.post('http://localhost:8000/api/user/'+this.doctorId+'/reviews', data)
                .then(()=>{this.$emit('submitted', data)})
                .catch((e) => { this.$emit('error', e) })
        }
    },

}
</script>
