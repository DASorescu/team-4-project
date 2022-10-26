<template>
    <div class="mt-5">
        <CitySelect
            v-if="hasResult"
            class="d-flex justify-content-center"
            :cities="cities"
            @address-change="(city) => selectedAddress = city"
            label="Seleziona Una Città"
        />
        <div v-if="hasResult" class="mt-3 container flex-wrap d-flex">
            <div class="card shadow" v-for="doctor in filteredDoctors" :key="'res-' + doctor.id">
                <div class="card-header">
                    Dr. {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}
                    <router-link class="btn btn-primary d-flex align-items-center" :to="{name:'user-detail',params:{id:doctor.id}}">
                        <i class="fa-solid fa-eye mx-1"></i>
                    </router-link>
                </div>
                <div class="card-body">
                    <p>Città: {{ doctor.detail.address }}</p>
                    <p>Email: {{ doctor.email }}</p>
                </div>
            </div>
        </div>
        <AppLoader v-else />
    </div>
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
            return typeof this.$route.params.specializationId === 'number' &&
                !Number.isNaN(this.$route.params.specializationId)
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
                    //cosi non si ripetono le città :)
                    if(doctorDetail.address !== null && !this.cities.includes(doctorDetail.address)){
                        this.cities.push(doctorDetail.address)
                    }

                }
            }
            this.fetching = false
        },
        getDoctorDetails(doctorId) {
            return axios.get('http://localhost:8000/api/users/' + doctorId)
        },
    },
    mounted() {
        if (typeof this.$route.params.specializationId === 'string') {
            this.$route.params.specializationId = parseInt(this.$route.params.specializationId)
        }
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


