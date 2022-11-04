<template>
  <div class="py-4 slider">
    <h1 class="text-center py-4">The Best</h1>
    <Flicking
      :options="{
        align: 'prev',
        circular: true,
      }"
      :plugins="plugins"
      class="shadow"
    >
      <div
        class="card shadow w-3-m-2 m-query"
        v-for="(doctor, i) in sponsorizedDoctors"
        :key="'sponsorized-' + i"
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
          <div class="w-25 mr-2">
            <input
              class="img-fluid rounded-circle"
              type="image"
              :src="doctor.detail.image"
              alt=""
            />
          </div>
          <div>
            <div>
              Specializzazioni:<br />
              <span
                class="ml-2"
                v-for="specialization in doctor.specializations"
                :key="specialization.id"
                :class="'badge badge-' + specialization.color"
                >{{ specialization.label }}
              </span>
            </div>
            <p>Città: {{ doctor.detail.address }}</p>
            <p>Email: {{ doctor.email }}</p>
            <p>
              Rating:
              <RateReview :value="averageReviews[doctor.id].avg" />({{
                averageReviews[doctor.id].count
              }})
              <router-link
                class="btn btn-primary"
                :to="{ name: 'reviews', params: { userId: doctor.id } }"
              >
                mostra
              </router-link>
            </p>
          </div>
        </div>
      </div>
      <span slot="viewport" class="flicking-arrow-prev"></span>
      <span slot="viewport" class="flicking-arrow-next"></span>
    </Flicking>
  </div>
</template>

<script>
import RateReview from "../RateReview.vue";
import { Flicking } from "@egjs/vue-flicking";
import { Arrow } from "@egjs/flicking-plugins";
import "@egjs/flicking-plugins/dist/arrow.css";
import "@egjs/vue-flicking/dist/flicking.css";
import { AutoPlay } from "@egjs/flicking-plugins";

export default {
  name: "SponsorizedSlider",
  components: { RateReview, Flicking },
  data() {
    return {
      sponsorizedDoctors: [],
      showDoctors: false,
      plugins: [
        new Arrow({ moveCount: 1 }),
        new AutoPlay({ duration: 2000, direction: "NEXT", stopOnHover: true }),
      ],
    };
  },
  computed: {
    hasSponsorizedDoctors() {
      return this.sponsorizedDoctors.length > 0 && this.showDoctors;
    },
    // devo farmi un oggetto che come chiave utilizzo l'id del dottore e come valore avrà un oggetto.
    // In questo oggetto le proprietà sono la media del rating e il numero di review su cui è basata la media.
    averageReviews() {
      const res = {};
      for (const doctor of this.sponsorizedDoctors) {
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
    getSponsorizedDoctors() {
      axios.get("/api/sponsorizedDoctors").then((res) => {
        for (const doctor of res.data) {
          this.sponsorizedDoctors.push(doctor);
        }
        this.showDoctors = true;
      });
    },
  },
  mounted() {
    this.getSponsorizedDoctors();
  },
};
</script>

<style>
.slider {
  background: #fff;
}
.flicking-arrow-prev::before,
.flicking-arrow-prev::after,
.flicking-arrow-next::before,
.flicking-arrow-next::after {
  background-color: var(--primary);
}
.w-3-m-2 {
  margin-right: 2em;
  width: calc((100% / 3) - 2em);
}

@media (max-width: 820px) {
  .m-query {
    width: calc((100% / 2) - 2em);
  }
}
@media (max-width: 560px) {
  .m-query {
    width: calc((100% / 1) - 2em);
  }
}
</style>
