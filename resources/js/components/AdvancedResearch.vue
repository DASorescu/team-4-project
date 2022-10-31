<template>
    <div>

        <div class="d-flex justify-content-center">

            <button class="btn btn-primary" @click="show = !show">
                Ricerca Avanzata
            </button>


        </div>


        <div v-if="show" class="text-center">
            <div class="my-2">
                <select class="form-select" aria-label="Default select example" ref="month-picker" v-model="selectedPropriety" @change="emitPropriety">
                    <option value="">{{ 'Filtra per...' }}</option>
                    <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">
                        {{ propriety }}
                    </option>

                </select>

            </div>
            <div>
                <input type="text" v-model="searched" ref="month-picker">
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

            show: false,
            selectedPropriety: "",
            searched: "",
            proprieties: ['Nome', 'Cognome', 'Città'],
            isLoading: false,
        }
    },
    computed: {

        
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

        getSpecializations() {
            axios.get('http://localhost:8000/api/specializations/')
                .then(res => {
                    this.specializations = res.data
                })
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