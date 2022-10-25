<template>
    <div>
        <div>{{ params }}</div>

        <h1>Ciao</h1>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'HomePage',
    data() {
        return {
            params: '',
        }
    },
    methods: {
        fetchParams() {
            axios.get('http://localhost:8000/api/')
                .then(res => {
                    this.params = res.data
                })
        }
    },
    mounted() {
        this.fetchParams();
    }
}
</script>
