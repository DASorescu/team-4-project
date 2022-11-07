<template>
  <div class="content">
    <NavBar />
    <main>
      <div class="container">
        <!--Ricerca Campi-->
        <div id="selezione-campi" class="text-center py-5">
          <div>
            <div>
              <select
                v-if="hasSpecializations"
                v-model="currentSpecialization"
                @change="searchDoctorBySpecialization(currentSpecialization)"
              >
                <option :value="0">Scegli la specializzazione dei medici</option>
                <option
                  v-for="specialization in specializations"
                  :key="'spec-' + specialization.id"
                  :value="specialization.id"
                  :selected="currentSpecialization === specialization.id"
                >
                  {{ specialization.label }}
                </option>
              </select>

              <select
                class="form-select"
                aria-label="Default select example"
                v-model="selectedPropriety"
              >
                <option value="">{{ "Filtra per..." }}</option>
                <option
                  v-for="(propriety, index) in proprieties"
                  :key="index"
                  :value="propriety"
                >
                  {{ propriety }}
                </option>
              </select>
            </div>
            <div>
              <input type="text" v-model="searched" />
            </div>
          </div>
        </div>

        <!--Render su pagina-->
        <div v-if="hasResult" class="flex-wrap d-flex">
          <div
            class="card shadow w-100 my-2"
            v-for="doctor in filteredDoctorsBy"
            :key="'res-' + doctor.id"
          >
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>Dr. {{ doctor.detail.first_name }} {{ doctor.detail.last_name }}</div>
              <div>
                <router-link
                  class="btn btn-primary d-flex align-items-center"
                  :to="{ name: 'user-detail', params: { id: doctor.id } }"
                >
                  Visualizza profilo
                </router-link>
              </div>
            </div>
            <div class="card-body d-flex align-items-center">
              <div class="col-4 w-25 mr-2">
                <input
                  class="img-fluid rounded-circle"
                  type="image"
                  :src="doctor.detail.image"
                  alt=""
                />
              </div>
              <div class="col-4 border-left border-white">
                <div>
                  Specializzazione:
                  <!--tramite printSp stampo specializzazione corrente-->
                  <span
                    class="ml-2"
                    v-for="specialization in printSp"
                    :key="specialization.id"
                    :class="'badge badge-' + specialization.color"
                    >{{ specialization.label }}
                  </span>
                </div>
                <div class="my-3">Città: {{ doctor.detail.address }}</div>
                <div>Email: {{ doctor.email }}</div>
              </div>
              <div class="col-4 border-left border-white">
                <div>
                  Rating:
                  <RateReview :value="averageReviews[doctor.id].avg" />
                  <div class="my-3">
                    Recensioni: ({{ averageReviews[doctor.id].count }})
                  </div>

                  <router-link
                    class="btn btn-primary"
                    :to="{ name: 'reviews', params: { userId: doctor.id } }"
                  >
                    Recensioni
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <AppLoader v-else />
      </div>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import AppLoader from "../AppLoader.vue";
import CitySelect from "../CitySelect.vue";
import RateReview from "../RateReview.vue";
import NavBar from "../homePageSections/NavBar.vue";

function valoreODefault(valore, defaultValore) {
  if (valore !== null && valore) {
    return valore;
  }
  return defaultValore;
}

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
      proprieties: ["Nome", "Cognome", "Città"],
      //id di partenza nel v-model select su cui ciclare
      currentSpecialization: 0,
      specializations: [],

      showBar: false,
      searched: "",
      selectedPropriety: "",
      proprieties: ["Nome", "Cognome", "Città"],
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
        (specialization) => specialization.label === this.hasSpecializationName
      );
    },
    hasSpecializations() {
      return this.specializations.length > 0;
    },
    hasResult() {
      return this.result.length > 0 && !this.fetching;
    },
    hasSpecializationName() {
      return this.$route.params.specializationName;
    },

    //Filtro per Proprietà oggetto dottore, va ottimizzato
    filteredDoctorsBy() {
      if (this.searched === "") {
        return this.result;
      }
      if (this.selectedPropriety === "Nome")
        return this.result.filter((doctor) =>
          valoreODefault(doctor.detail.first_name, "")
            .toLowerCase()
            .startsWith(this.searched.toLowerCase())
        );
      if (this.selectedPropriety === "Cognome")
        return this.result.filter((doctor) =>
          valoreODefault(doctor.detail.last_name, "")
            .toLowerCase()
            .startsWith(this.searched.toLowerCase())
        );
      if (this.selectedPropriety === "Città")
        return this.result.filter((doctor) =>
          valoreODefault(doctor.detail.address, "")
            .toLowerCase()
            .startsWith(this.searched.toLowerCase())
        );
    },

    // devo farmi un oggetto che come chiave utilizzo l'id del dottore e come valore avrà un oggetto.
    // In questo oggetto le proprietà sono la media del rating e il numero di review su cui è basata la media.
    averageReviews() {
      const res = {};
      for (const doctor of this.filteredDoctorsBy) {
        res[doctor.id] = {
          count: doctor.reviews.length,
          // faccio una chiamata per avere i dettagli  di un dottore
          avg:
            doctor.reviews.reduce((oldValue, value) => oldValue + value.rating, 0) /
            doctor.reviews.length,
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
      this.result = [];
      if (!specializationName) {
        return;
      }
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
          // this.result.push({
          //     id: doctor.id,
          //     email: doctor.email,
          //     detail: doctorDetail,
          //     reviews: doctorReviews,
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
.content {
  background: #fff;
}
.card {
  background-color: rgb(5, 81, 203);
  color: white;
}

main {
  background-image: url("https://www.freevector.com/uploads/vector/preview/30831/medicine_backgorund_Mesa_de_trabajo_1.jpg");
  animation: scroll 100s linear infinite;
}

@keyframes scroll {
  100% {
    background-position: 0 -2000px;
  }
}
</style>
