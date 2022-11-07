<template>
  <div>
    <NavBar />
    <main class="pb-5">
      <div class="container">
        <!--Ricerca Campi-->
        <div id="selezione-campi" class="py-5">
          <select
            v-if="hasSpecializations"
            v-model="currentSpecialization"
            @change="searchDoctorBySpecialization(currentSpecialization)"
          >
            <option value="" disabled>Scegli una specializzazione</option>
            <option
              v-for="specialization in specializations"
              :key="'spec-' + specialization.label"
              :value="specialization.label"
              :selected="currentSpecialization === specialization.label"
            >
              {{ specialization.label }}
            </option>
          </select>

          <select v-model="selectedRating">
            <option value="" disabled>Filtra per rating</option>
            <option value="Tutti">Tutti</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>

          <select v-model="selectedReview">
            <option value="" disabled>Filtra per reviews</option>
            <option value="Tutti">Tutti</option>
            <option value="0-5">da 0 a 5</option>
            <option value="6-10">da 6 a 10</option>
            <option value="+ di 10">+ di 10</option>
          </select>
        </div>

        <!--Render su pagina-->
        <div v-if="hasResult" class="flex-wrap d-flex">
          <div
            class="card shadow w-100 my-2"
            v-for="doctor in filteredDoctorsBy"
            :key="'res-' + doctor.id"
          >
            <div class="card-header d-flex justify-content-between align-items-center">
              <div class="name">
                <span
                  >Dr. {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}</span
                >
              </div>

              <div>
                <router-link
                  class="btn btn-sm btn-primary d-flex align-items-center"
                  :to="{ name: 'user-detail', params: { id: doctor.id } }"
                >
                  Visualizza profilo
                </router-link>
              </div>
            </div>
            <div class="card-body d-flex align-items-center">
              <div class="col-0 col-sm-0 col-md-2 col-lg-4 col-xl- w-25 mr-2">
                
                  <img
                    :src="
                      doctor.detail.image.startsWith('http')
                        ? doctor.detail.image
                        : `/storage/${doctor.detail.image}`
                    "
                    class="img-fluid rounded-circle bg-white shadow"
                    :alt="`${doctor.detail.name}`"
                  />
                
              </div>
              <div
                class="col-6 col-sm-6 col-md-5 col-lg-4 col-xl-5 border-left border-white"
              >
                <div id="specialization" v-if="currentSpecialization !== ''">
                  <!--tramite printSp stampo specializzazione corrente-->
                  <span
                    v-for="specialization in printSp"
                    :key="specialization.id"
                    :class="'badge badge-' + specialization.color"
                    >{{ specialization.label }}
                  </span>
                </div>

                <div class="my-3">Città: {{ doctor.detail.address }}</div>
                <div>Email: {{ doctor.email }}</div>
              </div>
              <div
                class="col-6 col-sm-6 col-md-5 col-lg-4 col-xl-4 border-left border-white"
              >
                <div>
                  Rating:
                  <RateReview :value="averageReviews[doctor.id].avg" />
                  <div class="my-3">
                    Recensioni: ({{ averageReviews[doctor.id].count }})
                  </div>

                  <router-link
                    class="btn btn-sm btn-primary"
                    :to="{ name: 'reviews', params: { userId: doctor.id } }"
                  >
                    Recensioni
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <AppLoader v-if="isLoading" />
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import AppLoader from "../AppLoader.vue";
import CitySelect from "../CitySelect.vue";
import RateReview from "../RateReview.vue";
import NavBar from "../homePageSections/NavBar.vue";
import Footer from "../homePageSections/Footer.vue";

export default {
  name: "UserSearchPage",
  components: {
    AppLoader,
    CitySelect,
    RateReview,
    NavBar,
    Footer
  },
  data() {
    return {
      currentSpecialization: "",
      specializations: [],

      selectedRating: "",
      selectedReview: "",

      showBar: false,
      isLoading: false,

      result: [],
      cities: [],
      fetching: false,
      selectedAddress: "",
    };
  },
  computed: {
    printSp() {
      return this.specializations.filter(
        (specialization) => specialization.label === this.currentSpecialization
      );
    },
    hasSpecializations() {
      return this.specializations.length > 0;
    },
    hasResult() {
      return this.filteredDoctorsBy.length > 0 && !this.fetching;
    },
    hasSpecializationName() {
      return this.$route.params.specializationName;
    },
    filteredDoctorsBy() {
      if (this.selectedRating === "Tutti" || this.selectedRating === "") {
        return this.result;
      }
      if (this.selectedRating === "1") {
        return this.result.filter((doctor) => Math.round(this.averageReviews[doctor.id].avg) === 1);
      }
      if (this.selectedRating === "2") {
        return this.result.filter((doctor) => Math.round(this.averageReviews[doctor.id].avg) === 2);
      }
      if (this.selectedRating === "3") {
        return this.result.filter((doctor) => Math.round(this.averageReviews[doctor.id].avg) === 3);
      }
      if (this.selectedRating === "4") {
        return this.result.filter((doctor) => Math.round(this.averageReviews[doctor.id].avg) === 4);
      }
      if (this.selectedRating === "5") {
        return this.result.filter((doctor) => Math.round(this.averageReviews[doctor.id].avg) === 5);
      }

      if (this.selectedReview === "Tutti" || this.selectedReview === "") {
        return this.result;
      }
      if (this.selectedReview === "0-5") {
        return this.result.filter((doctor) => this.averageReviews[doctor.id].count < 6);
      }
      if (this.selectedReview === "6-10") {
        return this.result.filter(
          (doctor) =>
            this.averageReviews[doctor.id].count >= 6 &&
            this.averageReviews[doctor.id].count < 11
        );
      }
      if (this.selectedReview === "+ di 10") {
        return this.result.filter((doctor) => this.averageReviews[doctor.id].count > 10);
      }
    },

    // devo farmi un oggetto che come chiave utilizzo l'id del dottore e come valore avrà un oggetto.
    // In questo oggetto le proprietà sono la media del rating e il numero di review su cui è basata la media.
    averageReviews() {
      const res = [];
      for (const doctor of this.result) {
        res[doctor.id] = {
          count: doctor.reviews.length,
          // faccio una chiamata per avere i dettagli  di un dottore
          avg:
            Math.round(
            doctor.reviews.reduce((oldValue, value) => oldValue + value.rating, 0) /
            doctor.reviews.length)
        };
      }
      return res;
    },
  },
  methods: {
    //fai una chiamata per restituire tutte le specializzazioni disponibili
    getSpecializations() {
      axios
        .get("/api/specializations/")

        .then((res) => {
          this.specializations = res.data;
        });
    },

    async searchDoctorBySpecialization(specializationName) {
      this.showBar = false;
      this.isLoading = true;
      this.result = [];
      if (!specializationName) {
        return;
      } else {
        // richiedo una ricerca per specializzazione, ottengo tutti i dottori che hanno quella specializzazione.
        const res = await axios.get("/api/search/" + specializationName);
        this.fetching = true;
        if (Array.isArray(res.data)) {
          // ciclo sui dottori che ho ottenuto
          for (const doctor of res.data) {
            // // prendo i dettagli del dottore corrente
            // const doctorDetail = (await this.getDoctorDetails(doctor.id)).data;

            // // prendo le reviews del dottore corrente
            // const doctorReviews = (await this.getDoctorReviews(doctor.id)).data;

            // // compongo un oggetto più semplice da usare con i dettagli.
            // // se voglio posso ottenere anche altre proprietù del dottore con la stessa logica. per esempio posso prendere le sponsorship.
            //    this.result.push({
            //        id: doctor.id,
            //        email: doctor.email,
            //        detail: doctorDetail,
            //        reviews: doctorReviews,
            // });

            this.result.push(doctor);
            //cosi non si ripetono le città :)
            if (
              doctor.detail.address !== null &&
              !this.cities.includes(doctor.detail.address)
            ) {
              this.cities.push(doctor.detail.address);
            }
          }
        }
      }
      this.isLoading = false;
      this.fetching = false;
    },
  },

  mounted() {
    if (this.hasSpecializationName) {
      this.searchDoctorBySpecialization(this.$route.params.specializationName);
    }
    this.getSpecializations();
  },
};
</script>

<style lang="scss" scoped>
#selezione-campi span {
  font-size: 1rem;
}

.card {
  background-color: rgb(5, 81, 203);
  color: white;
}

@media (min-width: 476px) {
  .card {
    font-size: 0.7rem;

    .name {
      font-size: 0.9rem;
    }
  }
}

@media (min-width: 576px) {
  .card {
    font-size: 0.9rem;

    .name {
      font-size: 1rem;
    }
  }
}

@media (min-width: 1200px) {
  .card {
    font-size: 1.2rem;
  }
}

main {
  background-image: url("https://www.freevector.com/uploads/vector/preview/30831/medicine_backgorund_Mesa_de_trabajo_1.jpg");
  animation: scroll 100s linear infinite;
  min-height: 1000px;
}

@keyframes scroll {
  100% {
    background-position: 0 -2000px;
  }
}

.card-header {
  font-size: 1.3rem;
}
</style>
