<template>
    <div>
        <NavBar />
        <CitySelect v-if="hasResult" class="d-flex justify-content-center mt-3" :cities="cities"
            @address-change="(city) => selectedAddress = city" label="Seleziona Una Città" />
        <div v-if="hasResult" class="mt-3 container flex-wrap d-flex">
            <div class="card shadow" v-for="doctor in filteredDoctors" :key="'res-' + doctor.id">
                <div class="card-header">
                    Dr. {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}
                    <router-link class="btn btn-primary d-flex align-items-center"
                        :to="{ name: 'user-detail', params: { id: doctor.id } }">
                        Visualizza profilo
                    </router-link>
                </div>
                <div class="card-body">
                    <p>Città: {{ doctor.detail.address }}</p>
                    <p>Email: {{ doctor.email }}</p>
                    <p>
                        Rating: <RateReview  :value="averageReviews[doctor.id].avg" />({{averageReviews[doctor.id].count}})
                    <router-link class="btn btn-primary" :to="{ name: 'reviews', params: {  userId: doctor.id } }">
                        mostra
                    </router-link>
                    </p>
                    <font-awesome-icon icon="fa-solid fau-secret" />

                </div>
            </div>
        </div>
        <AppLoader v-else />
    </div>
</template>

<script>
import axios from 'axios';
import NavBar from '../homePageSections/NavBar.vue'
import AppLoader from '../AppLoader.vue'
import CitySelect from '../CitySelect.vue'
import RateReview from '../RateReview.vue'

export default {
    name: 'UserSearchPage',
    components: {
        AppLoader,
        CitySelect,
        RateReview,
        NavBar,
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
        hasSpecializationName() {
            return this.$route.params.specializationName
        },
        filteredDoctors() {
            if (!this.selectedAddress) return this.result;
            return this.result.filter((doctor)=>doctor.detail.address === this.selectedAddress)
        },
        // devo farmi un oggetto che come chiave utilizzo l'id del dottore e come valore avrà un oggetto.
        // In questo oggetto le proprietà sono la media del rating e il numero di review su cui è basata la media.
        averageReviews() {
            const res = {};
            for (const doctor of this.filteredDoctors) {
                res[doctor.id] = {
                    count: doctor.reviews.length,
                    // faccio una chiamata per avere i dettagli  di un dottore
                    avg: doctor.reviews.reduce(
                        (oldValue, value) => oldValue + value.rating,
                        0
                    ) / doctor.reviews.length
                }
            }
            return res
        }
    },
    methods: {
        async searchDoctorBySpecialization(specializationName) {
            if (!specializationName) {
                this.result = [];
                return
            }
            // richiedo una ricerca per specializzazione, ottengo tutti i dottori che hanno quella specializzazione.
            const res = await axios.get('/api/search/' + specializationName)
            this.fetching = true
            if (Array.isArray(res.data)) {
                // ciclo sui dottori che ho ottenuto
                for (const doctor of res.data) {
                    // prendo i dettagli del dottore corrente
                    const doctorDetail = (await this.getDoctorDetails(doctor.id)).data

                    // prendo le reviews del dottore corrente
                    const doctorReviews = (await this.getDoctorReviews(doctor.id)).data

                    // compongo un oggetto più semplice da usare con i dettagli.
                    // se voglio posso ottenere anche altre proprietù del dottore con la stessa logica. per esempio posso prendere le sponsorship.
                    this.result.push({
                        id: doctor.id,
                        email: doctor.email,
                        detail: doctorDetail,
                        reviews: doctorReviews,
                    })
                    //cosi non si ripetono le città :)
                    if (doctorDetail.address !== null && !this.cities.includes(doctorDetail.address)) {
                        this.cities.push(doctorDetail.address)
                    }

                }
            }
            this.fetching = false
        },

        // faccio una chiamata per avere i dettagli  di un dottore
        getDoctorDetails(doctorId) {
            return axios.get('/api/users/' + doctorId)
        },
        // faccio una chiamata per avere le reviews  di un dottore
        getDoctorReviews(doctorId) {
            return axios.get('/api/user/reviews/' + doctorId)
        },
    },
    mounted() {
        if (this.hasSpecializationName) {
            this.searchDoctorBySpecialization(this.$route.params.specializationName);
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


