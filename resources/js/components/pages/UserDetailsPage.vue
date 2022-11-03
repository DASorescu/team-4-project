<template>
  <div id="user-details">
    <header>
      <NavBar />
    </header>
    <main>
      <!-- MAIN BANNER -->
      <div id="main-banner">
        <div class="doctor-card">
          <figure>
            <img class="img-fluid" :src="`${user.image}`" :alt="`${user.name}`" />
          </figure>
          <div class="info">
            <p>{{ user.first_name }} {{ user.last_name }}</p>
            <span><strong>SPECIALIZZAZIONI</strong></span>
            <font-awesome-icon class="arrow bounce ml-2" icon="fa-solid fa-arrow-right" />
            <span
              v-for="specialization in specializations.slice(0, 3)"
              :key="specialization.id"
            >
              {{ specialization.label }}
            </span>
          </div>
        </div>
      </div>
      <!-- INFO BANNER -->
      <div id="info-banner">
        <ul>
          <li><a href="#info">Informazioni generali</a></li>
          <li><a href="#address">Indirizzo</a></li>
          <li><a href="#cv">Curriculum</a></li>
          <li><a href="#rates">Tariffe</a></li>
          <li><a href="#message">Invia un messaggio</a></li>
          <li><a href="#faq">FAQ</a></li>
        </ul>
      </div>
      <!-- INFO -->
      <div class="doctor-info">
        <div class="address">
          <div><strong>Indirizzo</strong></div>
          <div><font-awesome-icon class="text-center" icon="fa-solid fa-house" /></div>
          {{ user.city_address }}
        </div>
        <div class="contacts">
          <a name="info"></a>
          <div id="hours">
            <strong>Orari e contatti</strong>
            <div>
              <div>Oggi:</div>
              <font-awesome-icon icon="fa-solid fa-clock" /> 7:30 - 18:30
            </div>
          </div>
          <div class="text-center">
            <strong>Recapito telefonico</strong>
            <div class="mt-2">
              <font-awesome-icon icon="fa-solid fa-phone" class="mr-2" /> {{ user.phone }}
            </div>
            <div>
              <font-awesome-icon icon="fa-solid fa-fax" class="mr-2" /> {{ user.phone }}
            </div>
          </div>
        </div>
      </div>
      <!-- PRESENTATION -->
      <div class="user-page-details">
        <a name="cv"></a>
        <h4><font-awesome-icon icon="fa-solid fa-file" /> Il Curriculum</h4>
        <hr />
        <p>
          Il Dottor {{ user.first_name }} {{ user.last_name }} si è laureato in Medicina a
          {{ user.address }}e successivamente, nel medesimo ateneo, ha conseguito la
          specializzazione in Chirurgia Vascolare. Svolge la sua attività presso il
          Policlinico di {{ user.address }} e si occupa del trattamento delle malattie
          delle arterie, delle vene e dei vasi linfatici. Riceve su appuntamento.
        </p>
      </div>
      <!-- RATES -->
      <div class="user-page-details">
        <h4>
          <a name="rates"></a>
          <font-awesome-icon icon="fa-solid fa-euro-sign" /> Le tariffe
        </h4>
        <hr />
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="mb-2">Prima visita specialistica</h5>
          <div>100 €</div>
        </div>
        <p>
          Le tariffe sono fornite a titolo indicativo dal professionista sanitario e
          pertanto possono variare a seconda del tipo di trattamento effettuato, il numero
          di visite e le eventuali prestazioni accessorie. In caso di supplementi, il
          professionista si impegna ad avvertire il paziente prima di fornire le
          prestazioni.
        </p>
      </div>
      <!-- FAQ -->
      <div class="user-page-details">
        <a name="faq"></a>
        <h4 class="mb-5 question">
          <font-awesome-icon icon="fa-solid fa-info" /> Domande Frequenti
        </h4>
        <div>
          <div class="question">
            <font-awesome-icon icon="fa-solid fa-arrow-right" /> Qual'é l'indirizzo?
          </div>
          <p>- L'indirizzo è {{ user.city_address }},{{ user.address }}.</p>
        </div>
        <hr />
        <div>
          <div class="question">
            <font-awesome-icon icon="fa-solid fa-arrow-right" /> Si accetta anche
            pagamento con Bancomat/Carta di Credito?
          </div>
          <p>- Si,sono accettati anche questi metodi di pagamento.</p>
        </div>
        <hr />
        <div>
          <div class="question">
            <font-awesome-icon icon="fa-solid fa-arrow-right" /> Qual'é la fascia oraria
            per le prenotazioni?
          </div>
          <p>
            - Il centralino è operativo dalle ore 9:00 alle ore 15:00 tutti i
            giorni,Domenica esclusa.
          </p>
        </div>
      </div>
      <div class="user-page-details">
        <!-- invio messaggi -->
        <a name="message"></a>
        <NewMessage :doctor-id="'' + user.id" @submitted="messageSubmitted" />
      </div>
      <section
        id="buttons"
        class="container d-flex align-items-center justify-content-end"
      >
        <router-link
          class="btn btn-success mr-2"
          :to="{ name: 'reviews', params: { userId: user.id } }"
        >
          <font-awesome-icon icon="fa-solid fa-pen-to-square" /> Scrivi una recensione
        </router-link>

        <button class="btn btn-secondary" @click="$router.back()">
          <font-awesome-icon icon="fa-solid fa-rotate-left" /> Torna Indietro
        </button>
      </section>
    </main>
    <Footer />
  </div>
</template>

<script>
import NavBar from "../homePageSections/NavBar.vue";
import Footer from "../homePageSections/Footer.vue";
import axios from "axios";
import NewMessage from "../NewMessage.vue";
export default {
  name: "UserDetailPage",
  components: {
    NavBar,
    Footer,
    NewMessage,
  },
  data: () => ({
    user: {},
    specializations: [],
    isLoading: false,
  }),
  methods: {
    fetchUser($id) {
      this.isLoading = true;
      axios
        .get("/api/users/" + $id)
        .then((res) => {
          this.user = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
    getDoctorSpecializations($id) {
      axios.get("/api/specializations/" + $id).then((res) => {
        this.specializations = res.data;
      });
    },
    messageSubmitted(message) {
      console.log("messagesubmitted", message);
    },
  },
  mounted() {
    this.fetchUser(this.$route.params.id);
    this.getDoctorSpecializations(this.$route.params.id);
  },
};
</script>

<style lang="scss">
#user-details {
  main {
    background-image: url("https://www.freevector.com/uploads/vector/preview/30831/medicine_backgorund_Mesa_de_trabajo_1.jpg");
    animation: scroll 100s linear infinite;
  }

  @keyframes scroll {
    100% {
      background-position: 0 -2000px;
    }
  }

  #main-banner {
    height: 200px;
    background: linear-gradient(#0451cb, 60%, #fff);

    .doctor-card {
      display: flex;
      margin-left: 100px;
      padding-top: 20px;

      figure {
        width: 150px;

        img {
          border-radius: 50%;
          border: 1px solid #fff;
        }
      }

      span {
        padding-left: 20px;
        color: #fff;
        font-size: 1.2rem;
      }

      p {
        font-size: 1.8rem;
        color: #fff;
        padding-left: 15px;
        padding-top: 10px;
        font-weight: 800;
      }
    }

    .arrow {
      width: 40px;
      height: 40px;
      color: #fff;
      margin-right: 20px;
      line-height: 40px;
      vertical-align: middle;
    }
    .bounce {
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateX(0);
      }
      40% {
        transform: translateX(30px);
      }
      60% {
        transform: translateX(15px);
      }
    }
  }

  #info-banner {
    height: 60px;
    background-color: #fff;
    border-bottom: 1px solid #dedede;

    ul {
      display: flex;
      padding-left: 100px;

      li {
        font-style: 1.2rem;
        padding: 20px 10px;
        list-style-type: none;
      }
    }
  }

  .doctor-info {
    display: flex;
    margin: 0 auto;
    width: 800px;
    padding: 50px 0;
    .address {
      width: 40%;
      padding: 20px 0;
      text-align: center;
      background: linear-gradient(#72a6fb, 15%, #fff);
      border-radius: 10px;
    }

    .contacts {
      display: flex;
      align-items: center;
      margin-left: 30px;
      background: linear-gradient(#72a6fb, 15%, #fff);
      opacity: 0.8;
      border-radius: 10px;
      padding: 10px;

      #hours {
        padding-right: 4.5rem;
        text-align: center;
      }
    }

    strong {
      color: #31a0f5;
      font-size: 1.5rem;
    }
  }

  .user-page-details {
    width: 800px;
    background-color: #fff;
    margin: 0 auto;
    padding: 30px;
    margin-bottom: 50px;

    h5 {
      text-align: center;
      font-size: 1.5rem;
    }

    .question {
      color: #0d2339;
      font-size: 1.2rem;
      font-weight: bold;
    }
  }

  #buttons {
    padding: 30px;
  }

  h3,
  h5 {
    color: #003f5e;
    font-weight: bold;
    font-size: 1.5rem;
    padding-bottom: 10px;
  }
}
</style>
