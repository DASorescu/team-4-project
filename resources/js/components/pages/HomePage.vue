<template>
    <div>
        <h1>Prenota La tua visita medica</h1>
        <div>
            <select v-if="hasSpecializations" v-model="currentSpecialization" @change="search()">
                <option :value="0">Scegli la specializzazione dei medici</option>
                <option v-for="specialization in specializations" :key="'spec-'+ specialization.id" :value="specialization.id" :selected="currentSpecialization===specialization.id">
                    {{specialization.label}}
                </option>
            </select>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'HomePage',
    data() {
        return {
            specializations: [],
            currentSpecialization: 0,
        }
    },
    computed: {
        hasSpecializations() {
            return this.specializations.length > 0
        },
    },
    methods: {
        getSpecializations() {
            axios.get('http://localhost:8000/api/specializations/')
                .then(res => {
                    this.specializations = res.data
                })
        },
        search() {
            this.$router.push({ name: 'search', params: { specializationId: this.currentSpecialization } })
        }
    },
    mounted() {
        this.getSpecializations();
    }
}
</script>

<style lang="scss" scoped>
</style>
