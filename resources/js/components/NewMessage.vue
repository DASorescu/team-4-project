<template>
    <div class="mt-5">
        <h3>Invia un Messaggio</h3>
        <div class="form-group">
            <label for="name">Inserisci il tuo Nome</label>
            <input type="text" id="name" :class="['form-control', errorsMessages.name.length > 0 ? 'is-invalid': '']" v-model="guestName" ></input>
            <div v-for="(nameError,i) in errorsMessages.name" :key="'n-msg-'+i" class="invalid-feedback">{{nameError}}</div>
        </div>
        <div class="form-group">
            <label for="email">Inserisci la tua Email </label>
            <input type="email" id="email" :class="['form-control', errorsMessages.email.length > 0 ? 'is-invalid': '']" v-model="guestEmail"></input>
            <div v-for="(emailError,i) in errorsMessages.email" :key="'e-msg-'+i" class="invalid-feedback">{{ emailError }}</div>
        </div>
        <div class="form-group">
            <label for="content">Scrivi il tuo Messaggio</label>
            <textarea :class="['form-control', errorsMessages.content.length > 0 ? 'is-invalid': '']" id="content" v-model="messageText" rows="5"></textarea>
            <div v-for="(textError,i) in errorsMessages.content" :key="'m-msg-'+i" class="invalid-feedback"> {{ textError }}</div>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success" type="button" @click="invia()"> Invia </button>
            <slot></slot>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'NewMessage',
    props: {doctorId: {type: String, required: true}},
    data() {
        return {
            messageText: '',
            guestName: '',
            guestEmail: '',
            errors: {},
        }
    },
    computed: {
        errorsMessages() {
            return {
                name: this.errors && this.errors.name && this.errors.name !== '' ? this.errors.name : [],
                email: this.errors && this.errors.email && this.errors.email !== '' ? this.errors.email : [],
                content: this.errors && this.errors.content && this.errors.content !== '' ? this.errors.content : [],
            }
        }
    },
    methods: {
        invia() {
            const data = {
                content: this.messageText,
                name: this.guestName,
                email: this.guestEmail,
            };
        // sistemo la richiesta da inviare nel back dei messages
            axios.post('http://localhost:8000/api/user/'+this.doctorId+'/messages', data)
                .then(() => {
                    this.$emit('submitted', data)
                    this.clear()
                })
                .catch((e,val) => {
                    this.$emit('error', e)
                    if (e && e.response && e.response.data && e.response.data.errors) {
                        console.log('setting errors...', e.response.data.errors)
                        Vue.set(this, 'errors', e.response.data.errors)
                    }
                })
        },
        clear() {
            this.messageText= ''
            this.guestName=''
            this.guestEmail = ''
            Vue.set(this,'errors',{})

        }
    },

}
</script>
