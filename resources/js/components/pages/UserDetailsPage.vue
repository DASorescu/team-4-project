<template>
    <div id="user-details">
        <header>
            <NavBar/>
        </header>
        <main>
            <!-- MAIN BANNER -->
           <div id="main-banner">
              <div class="doctor-card">
                <figure>
                    <img class="img-fluid" :src= "`${user.image}`" :alt="`${user.name}`">
                </figure>
                <div class="info">
                    <p>{{user.first_name}} {{user.last_name}}</p>
                    <span>Specializzazioni:</span><span v-for="specialization in specializations.slice(0,3)" :key="specialization.id"> {{specialization.label}} </span>
                </div>
              </div>
           </div>
           <!-- INFO BANNER -->
           <div id="info-banner">
                <ul>
                    <li><a href="#">Informazioni generali</a></li>
                    <li><a href="#">Indirizzo</a></li>
                    <li><a href="#">Curriculum</a></li>
                    <li><a href="#">Tariffe</a></li>
                </ul>
           </div>
           <!-- INFO -->
           <div class="doctor-info">
                <div class="address">
                    <strong>Indirizzo</strong>
                    <h5>F-Medical Group</h5>
                    <font-awesome-icon icon="fa-solid fa-house" /> Via dei Mille 64,<div>{{user.address}}</div>
                </div>
                <div class="contacts"> 
                    <div id="hours">
                        <strong>Orari e contatti</strong>
                        <div><h5>Oggi:</h5> <font-awesome-icon icon="fa-solid fa-clock" /> 7:30 - 18:30</div>
                    </div>
                    <div>
                        <strong>Recapito telefonico</strong>
                        <div><font-awesome-icon icon="fa-solid fa-phone" /> {{user.phone}}</div>
                    </div>
                </div>
           </div>
           <!-- PRESENTATION -->
           <div class="user-page-details">
              <h4><font-awesome-icon icon="fa-solid fa-file" /> Il Curriculum</h4>
              <hr>
              <p>Il Dottor {{user.first_name}} {{user.last_name}} si è laureato in Medicina e Chirurgia nel 2012 all'Università "La Sapienza" di Roma e successivamente, nel medesimo ateneo, ha conseguito la specializzazione in Chirurgia Vascolare. Svolge la sua attività presso il Policlinico di {{user.address}} e si occupa del trattamento delle malattie delle arterie, delle vene e dei vasi linfatici. Riceve su appuntamento a {{user.address}} presso F-Medical.</p>
           </div>
           <!-- RATES -->
           <div class="user-page-details">
              <h4><font-awesome-icon icon="fa-solid fa-euro-sign" /> Le tariffe</h4>
              <hr>
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-2">Prima visita specialistica</h5>
                <div> 100 €</div>
              </div>
              <p>Le tariffe sono fornite a titolo indicativo dal professionista sanitario e pertanto possono variare a seconda del tipo di trattamento effettuato, il numero di visite e le eventuali prestazioni accessorie. In caso di supplementi, il professionista si impegna ad avvertire il paziente prima di fornire le prestazioni.</p>
           </div>
           <!-- FAQ -->
           <div class="user-page-details">
              <h4 class="mb-5 question"><font-awesome-icon icon="fa-solid fa-info" /> Domande Frequenti</h4>
              <div>
                <div class="question"><font-awesome-icon icon="fa-solid fa-arrow-right" /> Qual'é l'indirizzo?</div>
                <p>- L'indirizzo è {{user.address}}.</p>
              </div>
              <hr>
              <div>
                <div class="question"><font-awesome-icon icon="fa-solid fa-arrow-right" /> Si accetta anche pagamento con Bancomat/Carta di Credito?</div>
                <p>- Si,sono accettati anche questi metodi di pagamento.</p>
              </div>
              <hr>
              <div>
                <div class="question"><font-awesome-icon icon="fa-solid fa-arrow-right" /> Qual'é la fascia oraria per le prenotazioni?</div>
                <p>- Il centralino è operativo dalle ore 9:00 alle ore 15:00 tutti i giorni,Domenica esclusa.</p>
              </div>
           </div>
            <section id="buttons" class="container d-flex align-items-center justify-content-end">
                <router-link class="btn btn-success mr-2" :to="{ name:'reviews', params: { id: user.id }}">
                    <font-awesome-icon icon="fa-solid fa-pen-to-square" /> Scrivi una recensione
                </router-link>

                <button class="btn btn-secondary" @click="$router.back()">
                    <font-awesome-icon icon="fa-solid fa-rotate-left" /> Torna Indietro
                </button>
            </section>
        </main>
        <Footer/>
    </div>
</template>

<script>
import NavBar from '../homePageSections/NavBar.vue';
import Footer from '../homePageSections/Footer.vue';
import axios from 'axios';
export default {
    name: "UserDetailPage",
    components:{
      NavBar,
      Footer
    },
    data: () => ({
        user: [],
        specializations: [],
        isLoading: false,
    }),
    methods: {
        fetchUser($id) {
            this.isLoading = true;
            axios.get('/api/users/' + $id)
                .then((res) => {
                    this.user = res.data;
                })
                .catch((err) => {
                    console.error(err);
                })
                .then(() => {
                    this.isLoading = false;
                })
        },
        getDoctorSpecializations($id) {
            axios.get('/api/specializations/' + $id)
            .then((res) => {
                this.specializations = res.data;
            })
        },
    },
    mounted() {
        this.fetchUser(this.$route.params.id);
        this.getDoctorSpecializations(this.$route.params.id);
    }
}
</script>

<style scoped lang="scss">
    
    main{
        background-color: #EEF2F7;
    }

    #main-banner{
        height: 200px;
        background-color: #31a0f5;

        .doctor-card{
            display: flex;
            margin-left: 100px;
            padding-top: 20px;

            figure{
                width: 150px;

                img{
                    border-radius: 50%;
                    border: 1px solid #fff;
                }
            }

            span{
                padding-left: 20px;
                color: #fff;
                font-size: 1.2rem;
            }

            p{
                font-size: 1.8rem;
                color: #fff;
                padding-left: 15px;
                padding-top: 10px;
                font-weight: 800;
            }
        }
    }

    #info-banner{
        height: 60px;
        background-color: #fff;
        border-bottom: 1px solid #dedede;

        ul{
            display: flex;
            padding-left: 100px;

            li{
                font-style: 1.2rem;
                padding: 20px 10px;
                list-style-type: none;
            }
        }
    }

    .doctor-info{
        display: flex;
        width: 1000px;
        margin: 0 auto;
        padding: 50px 0;
        .address{
            width: 40%;
            padding: 20px 0;
            
        }

        .contacts{
            width: calc(60% / 2);
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;

            #hours{
                padding-right: 4.5rem;
            }
            
        }

        strong{
            color: #31a0f5;
        }
    }

    .user-page-details{
        width: 800px;
        background-color: #fff;
        margin: 0 auto;
        padding: 30px;
        margin-bottom: 50px;

        h5{
            text-align: center;
            font-size: 1.5rem;
        }

        .question{
            color: #0D2339;
            font-size: 1.2rem;
            font-weight: bold;
        }
    }


    #buttons{
        padding: 30px;
    }
   
</style>
