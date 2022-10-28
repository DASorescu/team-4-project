<template>
    <div>

        <div class="d-flex justify-content-center">

            <button class="btn btn-primary" @click="show = !show">
                Ricerca Avanzata
            </button>


        </div>


        <div v-if="show" class="text-center">
            <div class="my-2">
                <select class="form-select" aria-label="Default select example" v-model="selectedPropriety">
                    <option value="">{{ 'Filtra per...' }}</option>
                    <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">
                        {{ propriety }}
                    </option>

                </select>

            </div>
            <div>
                <input type="text" v-model="searched">
            </div>


        </div>












        <!--Stampa Dati-->
        <div v-for="(doctor, index) in filteredDoctorsBy" :key="index">
            <div class="card-body d-flex align-items-center">
                            <div class="w-25 mr-2">
                                <input class="img-fluid rounded-circle" type="image" :src="doctor.detail.image"
                                    alt="" />
                            </div>
                            <div>
                                <p>Specializzazione:</p>
                                <p>Città: {{ doctor.detail.address }}</p>
                                <p>Email: {{ doctor.email }}</p>
                                <p>
                                    Rating:
                                    <RateReview :value="averageReviews[doctor.id].avg" />({{
                                            averageReviews[doctor.id].count
                                    }})
                                    <router-link class="btn btn-primary"
                                        :to="{ name: 'reviews', params: { userId: doctor.id } }">
                                        mostra
                                    </router-link>
                                </p>
                            </div>
                        </div>
        </div>





    </div>
</template>


<script>
export default {
    props: {
        result: Array
    },
    components: {
    },
    name: 'AdvancedResearch',
    data() {
        return {
            doctors: [],
            specializations: [],

            show: false,
            selectedPropriety: "",
            searched: "",
            proprieties: ['Nome', 'Cognome', 'Città'],
            isLoading: false,
        }
    },
    computed: {

        filteredDoctorsBy() {
            if (this.selectedPropriety === "Nome")
                return this.result.filter(
                    (doctor) => doctor.detail.first_name === this.searched
                );
            if (this.selectedPropriety === "Cognome")
                return this.result.filter(
                    (doctor) => doctor.detail.last_name === this.searched
                );
            if (this.selectedPropriety === "Città")
                return this.result.filter(
                    (doctor) => doctor.detail.address === this.searched
                );
        },
        averageReviews() {
            const res = {};
            for (const doctor of this.filteredDoctorsby) {
                res[doctor.id] = {
                    count: doctor.reviews.length,
                    // faccio una chiamata per avere i dettagli  di un dottore
                    avg:
                        doctor.reviews.reduce(
                            (oldValue, value) => oldValue + value.rating,
                            0
                        ) / doctor.reviews.length,
                };
            }
            return res;
        },
    },
    methods: {
        emitChange() {
            this.$emit('selected-research', this.selected)
        },

        getSpecializations() {
            axios.get('http://localhost:8000/api/specializations/')
                .then(res => {
                    this.specializations = res.data
                })
        },

        async searchDoctorBySpecialization(specializationId) {
            if (specializationId === 0) {
                this.result = [];
                return;
            }
            // richiedo una ricerca per specializzazione, ottengo tutti i dottori che hanno quella specializzazione.
            const res = await axios.get(
                "http://localhost:8000/api/search/" + specializationId
            );
            this.fetching = true;
            if (Array.isArray(res.data)) {
                // ciclo sui dottori che ho ottenuto
                for (const doctor of res.data) {
                    // prendo i dettagli del dottore corrente
                    const doctorDetail = (await this.getDoctorDetails(doctor.id)).data;

                    // prendo le reviews del dottore corrente
                    const doctorReviews = (await this.getDoctorReviews(doctor.id)).data;

                    // compongo un oggetto più semplice da usare con i dettagli.
                    // se voglio posso ottenere anche altre proprietù del dottore con la stessa logica. per esempio posso prendere le sponsorship.
                    this.result.push({
                        id: doctor.id,
                        email: doctor.email,
                        detail: doctorDetail,
                        reviews: doctorReviews,
                    });
                    //cosi non si ripetono le città :)
                    if (
                        doctorDetail.address !== null &&
                        !this.cities.includes(doctorDetail.address)
                    ) {
                        this.cities.push(doctorDetail.address);
                    }
                }
            }
            this.fetching = false;
        },

        // faccio una chiamata per avere i dettagli  di un dottore
        getDoctorDetails(doctorId) {
            return axios.get("http://localhost:8000/api/users/" + doctorId);
        },
        // faccio una chiamata per avere le reviews  di un dottore
        getDoctorReviews(doctorId) {
            return axios.get("http://localhost:8000/api/user/reviews/" + doctorId);
        },
    }


}



</script>

<style lang="scss" scoped>

</style>