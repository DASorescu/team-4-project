<template>
    <div class="mt-5 container">
        <h3>Scrivi una recensione</h3>
        <div class="form-group">
            <label for="name">Inserisci il tuo nome</label>
            <input type="text" id="name" :class="['form-control', errorsMessages.name.length > 0 ? 'is-invalid': '']" v-model="guestName"></input>
            <div v-for="(nameError,i) in errorsMessages.name" :key="'n-msg-'+i" class="invalid-feedback">{{nameError}}</div>

        </div>
        <div class="form-group">
            <label for="email">Inserisci la tua mail</label>
            <input type="email" id="email" :class="['form-control', errorsMessages.email.length > 0 ? 'is-invalid': '']" v-model="guestEmail"></input>
            <div v-for="(emailError,i) in errorsMessages.email" :key="'e-msg-'+i" class="invalid-feedback">{{emailError}}</div>
        </div>
        <div class="form-group">
            <label for="rating">Inserisci un Voto da 1 a 5 Stelle</label>
            <RateReview id="rating" v-model="review" clickable :class="['form-control', errorsMessages.rating.length > 0 ? 'is-invalid': '']" />
            <div v-for="(ratingError,i) in errorsMessages.rating" :key="'rw-msg-'+i" class="invalid-feedback">{{ ratingError }}</div>
        </div>
        <div class="form-group">
            <label for="review">Scrivi la tua recensione</label>
            <textarea :class="['form-control', errorsMessages.content.length > 0 ? 'is-invalid': '']" id="review" v-model="reviewText" rows="5"></textarea>
            <div v-for="(contentError,i) in errorsMessages.content" :key="'r-msg-'+i" class="invalid-feedback">{{contentError}}</div>
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
            guestEmail: '',
            errors: {},
        }
    },
    computed: {
        errorsMessages() {
            return {
                name: this.errors && this.errors.guest_name && this.errors.guest_name !== '' ? this.errors.guest_name : [],
                email: this.errors && this.errors.guest_email && this.errors.guest_email !== '' ? this.errors.guest_email : [],
                rating: this.errors && this.errors.rating && this.errors.rating !== '' ? this.errors.rating : [],
                content: this.errors && this.errors.content && this.errors.content !== '' ? this.errors.content : [],
            }
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
            axios.post('/api/user/'+this.doctorId+'/reviews', data)
                .then(() => {
                    this.$emit('submitted', data)
                    this.clear()
                })
                .catch((e) => {
                    this.$emit('error', e)
                    if (e && e.response && e.response.data && e.response.data.errors) {
                        console.log('setting errors...', e.response.data.errors)
                        Vue.set(this, 'errors', e.response.data.errors)
                    }
                })
        },
        clear() {
            this.review= 0,
            this.reviewText= '',
            this.guestName= '',
            this.guestEmail= ''
        }
    },

}
</script>
