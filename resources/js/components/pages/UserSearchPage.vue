<template>
    <div v-if="hasResult" class="mt-5 container flex-wrap d-flex">
        <CitySelect :cities="cities" @address-change="(city) => selectedAddress = city" />
        <div class="card shadow" v-for="doctor in filteredDoctors" :key="'res-' + doctor.id">
            <div class="card-header">
                Doctor: {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}
            </div>
            <div class="card-body">
                Città: {{ doctor.detail.address }}
                Email: {{ doctor.email }}
            </div>
        </div>
    </div>
    <AppLoader v-else/>
</template>

<script>
import axios from 'axios';
import AppLoader from '../AppLoader.vue';
import CitySelect from '../CitySelect.vue'
export default {
    name: 'UserSearchPage',
    components: {
        AppLoader,
        CitySelect,
    },
    data() {
        return {
            result: [],
            cities: [],
            fetching: false,
            selectedAddress: '',
        }
    },
    computed: {
        hasResult() {
            return this.result.length > 0 && !this.fetching
        },
        hasSpecializationId() {
            return typeof this.$route.params.specializationId === 'number';
        },
        filteredDoctors() {
            if (!this.selectedAddress) return this.result;
            return this.result.filter((doctor)=>doctor.detail.address == this.selectedAddress)
            
        },
        
    },
    methods: {
        async searchDoctorBySpecialization(specializationId) {
            if (specializationId === 0) {
                this.result = [];
                return
            }
            // richiedo una ricerca per specializzazione, ottengo tutti i dottori che hanno quella specializzazione.
            const res = await axios.get('http://localhost:8000/api/search/' + specializationId)
            this.fetching = true
            if (Array.isArray(res.data)) {
                // ciclo sui dottori che ho ottenuto
                for (const doctor of res.data) {
                    // prendo i dettagli del dottore corrente
                    const doctorDetail = (await this.getDoctorDetails(doctor.id)).data

                    // compongo un oggetto più semplice da usare con i dettagli.
                    // se voglio posso ottenere anche altre proprietù del dottore con la stessa logica. per esempio posso prendere le sponsorship.
                    this.result.push({
                        id: doctor.id,
                        email: doctor.email,
                        detail: doctorDetail
                    })
                    this.cities.push(doctorDetail.address)

                }
            }
            this.fetching = false
        },
        getDoctorDetails(doctorId) {
            return axios.get('http://localhost:8000/api/detail/' + doctorId)
        },
    },
    mounted() {
        if (this.hasSpecializationId) {
            this.searchDoctorBySpecialization(this.$route.params.specializationId);
        }
    }
}
</script>


<style lang="scss" scoped>
.container {
    padding: 2em 8em;
}

.card {
    width: calc((100% / 3) - 1em);
    margin: 0.5em;
}
</style>


