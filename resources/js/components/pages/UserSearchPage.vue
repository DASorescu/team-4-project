<template>
    <div>
        <NavBar />
        <div class="row justify-content-center my-3">



            <div id="main-content" class="">
                <!--Ricerca avanzata form-->
                <div class="d-flex justify-content-center">

                    <button class="btn btn-primary" @click="showBar = !showBar" v-if="showBtn">
                        Ricerca Avanzata
                    </button>


                </div>


                <div v-if="showBar" id="a-research" class="text-center card p-3 mt-3 mx-auto">
                    <div class="text-center mx-auto">

                        <div class="my-2">
                            <select v-if="hasSpecializations" v-model="currentSpecialization"
                                @change="searchDoctorBySpecialization(currentSpecialization)">
                                <option :value="0">Scegli una specializzazione</option>
                                <option v-for="specialization in specializations" :key="'spec-' + specialization.id"
                                    :value="specialization.id" :selected="currentSpecialization === specialization.id">
                                    {{ specialization.label }}
                                </option>
                            </select>


                            <select class="form-select" aria-label="Default select example" v-model="selectedPropriety">
                                <option value="">{{ 'Filtra per...' }}</option>
                                <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">
                                    {{ propriety }}
                                </option>

                            </select>

                        </div>
                        <div>
                            <input type="text" v-model="searched" placeholder="Cerca qui...">
                        </div>
                    </div>


                </div>



                <!--Render su pagina-->
                <div v-if="hasResult" class="mt-3 container flex-wrap d-flex">
                    <div class="row">

                        <div class="card shadow w-100 my-2" v-for="doctor in filteredDoctorsBy"
                            :key="'res-' + doctor.id">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                   <h4>Dr. {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}</h4> 
                                   
                                </div>

                                <div>
                                    <router-link class="btn btn-primary d-flex align-items-center"
                                        :to="{ name: 'user-detail', params: { id: doctor.id } }">
                                        Profilo
                                    </router-link>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="mr-2 col-4">
                                    <input class="img-fluid w-75 rounded-circle" type="image" :src="doctor.detail.image"
                                        alt="" />
                                </div>
                                <div class="col-4">

                                    <div class="mb-3" v-if="currentSpecialization > 0" >
                                        <span v-for="specialization in printSp" :key="specialization.id" :class="'badge badge-'+specialization.color">{{specialization.label}}</span>
                                        <span class="ml-1">  <font-awesome-icon icon="fa-solid fa-user-doctor" /> </span> 
                                    </div>
                                    <p>Città: {{ doctor.detail.address }} <span class="ml-1">  <font-awesome-icon icon="fa-solid fa-location-dot" /> </span> </p>
                                    <p> Telefono:{{ doctor.detail.phone }} <span class="ml-1">  <font-awesome-icon icon="fa-solid fa-phone"/> </span>   </p>   
                                    
                                </div>
                                <div col="col-4">
                                    <p>Email: {{ doctor.email }}</p>
                                    <div>
                                        Rating: 
                                        <span>
                                           <RateReview :value="averageReviews[doctor.id].avg" />
                                           {{"(" + averageReviews[doctor.id].count + " " + "recensione )"}} 
                                        </span>    
                                        

                                        <div class="my-3">
                                            <router-link class="btn btn-sm btn-success"
                                                :to="{ name: 'reviews', params: { userId: doctor.id } }">
                                                Recensioni
                                            </router-link>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <AppLoader v-else />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import AppLoader from '../AppLoader.vue'
import CitySelect from '../CitySelect.vue'
import RateReview from '../RateReview.vue'
import NavBar from '../homePageSections/NavBar.vue'
export default {
    name: "UserSearchPage",
    components: {
        AppLoader,
        CitySelect,
        RateReview,
        NavBar,
    },
    data() {
        return {
            //proprietà su cui ciclare
            proprieties: ['Nome', 'Cognome', 'Città'],
            //id di partenza nel v-model select su cui ciclare
            currentSpecialization: 0,
            specializations: [],

            showBtn: false,
            showBar: false,
            searched: "",
            selectedPropriety: "",
            proprieties: ['Nome', 'Cognome', 'Città'],
            isLoading: false,

            result: [],
            cities: [],
            fetching: false,
            selectedAddress: "",
        };
    },
    computed: {

        printSp(){
        
          return this.specializations.filter(specialization => specialization.id === this.currentSpecialization)
        },

        


        hasSpecializations() {
            return this.specializations.length > 0
        },
        hasResult() {
            return this.result.length > 0 && !this.fetching;
        },
        hasSpecializationId() {
            return (
                typeof this.$route.params.specializationId === "number" &&
                !Number.isNaN(this.$route.params.specializationId)
            );
        },

        filteredDoctors() {
            if (!this.selectedAddress) return this.result;
            return this.result.filter(
                (doctor) => doctor.detail.address === this.selectedAddress
            );
        },

        //Filtro per Proprietà oggetto dottore, va ottimizzato
        filteredDoctorsBy() {

            if ((this.selectedPropriety === "") && (this.searched === "")) { return this.result };
            if (this.selectedPropriety === "Nome")
                return this.result.filter(
                    (doctor) => doctor.detail.first_name === this.searched.toUpperCase()
                );
            if (this.selectedPropriety === "Cognome")
                return this.result.filter(
                    (doctor) => doctor.detail.last_name === this.searched.toUpperCase()
                );
            if (this.selectedPropriety === "Città")
                return this.result.filter(
                    (doctor) => doctor.detail.address === this.searched.toUpperCase()
                );
        },

        // devo farmi un oggetto che come chiave utilizzo l'id del dottore e come valore avrà un oggetto.
        // In questo oggetto le proprietà sono la media del rating e il numero di review su cui è basata la media.
        averageReviews() {
            const res = {};
            for (const doctor of this.filteredDoctors) {
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
        //fai una chiamata per restituire tutte le specializzazioni disponibili
        getSpecializations() {
            axios.get('http://localhost:8000/api/specializations/')

                .then(res => {
                    this.specializations = res.data
                })
        },
        async searchDoctorBySpecialization(specializationId) {
            this.showBar = this.showBtn = false
            this.result = [];
            if (specializationId === 0) {
                return;
            }
            // richiedo una ricerca per specializzazione, ottengo tutti i dottori che hanno quella specializzazione.
            const res = await axios.get('http://localhost:8000/api/search/' + specializationId)
            this.fetching = true
            if (Array.isArray(res.data)) {
                // ciclo sui dottori che ho ottenuto
                for (const doctor of res.data) {
                    // prendo i dettagli del dottore corrente
                    const doctorDetail = (await this.getDoctorDetails(doctor.id)).data;

                    // prendo le reviews del dottore corrente
                    const doctorReviews = (await this.getDoctorReviews(doctor.id)).data;

                    //prendo le specializazzioni del dottore
                    const doctorSpecializations = (await this.getDoctorSpecializations(doctor.id)).data;

                    // compongo un oggetto più semplice da usare con i dettagli.
                    // se voglio posso ottenere anche altre proprietù del dottore con la stessa logica. per esempio posso prendere le sponsorship.
                    this.result.push({
                        id: doctor.id,
                        email: doctor.email,
                        detail: doctorDetail,
                        reviews: doctorReviews,
                        //aggiungo specializzazioni nell'oggetto che arriva
                        specializations: doctorSpecializations
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
            this.showBtn = true
        },

        // faccio una chiamata per avere i dettagli  di un dottore
        getDoctorDetails(doctorId) {
            return axios.get('http://localhost:8000/api/users/' + doctorId)
        },
        // faccio una chiamata per avere le reviews  di un dottore
        getDoctorReviews(doctorId) {
            return axios.get('http://localhost:8000/api/user/reviews/' + doctorId)
        },
        // faccio una chiamata per avere le reviews  di un dottore
        getDoctorReviews(doctorId) {
            return axios.get('http://localhost:8000/api/user/reviews/' + doctorId)
        },
        //faccio una chiamata per avere le specializzazioni  di un dottore
        getDoctorSpecializations(doctorId) {
            return axios.get('http://localhost:8000/api/specializations/' + doctorId)
        },
    },

    mounted() {

        if (typeof this.$route.params.specializationId === "string") {
            this.$route.params.specializationId = parseInt(
                this.$route.params.specializationId
            );
        }
        if (this.hasSpecializationId) {
            this.searchDoctorBySpecialization(this.$route.params.specializationId);
        }

        this.getSpecializations();
    },
};
</script>


<style lang="scss" scoped>

#a-research{
    background-color: rgb(5,81,203);
}

</style>


