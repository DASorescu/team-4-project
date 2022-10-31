<template>
    <div id="user-details">
        <header>
            <NavBar/>
        </header>
        <main>
           <section class="doctor-card container">
                <div id="info">
                    <h3>{{user.first_name}} {{user.last_name}}</h3>
                    <h5>Specializzazioni:</h5>
                    <ul class="list-group pb-3">
                        <li v-for="specialization in specializations.slice(0,3)" :key="specialization.id"  :class="'list-group-item list-group-item-'+specialization.color">{{specialization.label}}</li>
                    </ul>
                    <div id="contacts">
                        <h5>Contatti:</h5>
                        <font-awesome-icon icon="fa-solid fa-house" /> Città:<p>{{user.address}}</p>
                        <font-awesome-icon icon="fa-solid fa-phone" /> Telefono:<p>{{user.phone}}</p>
                    </div>
                </div>
                <div id="img-side">
                    <figure>
                        <img :src= "`${user.image}`" :alt="`${user.name}`">
                    </figure>
                </div>
           </section>
        </main>
        <footer class="container d-flex align-items-center justify-content-end mb-3">
            <router-link class="btn btn-success mr-2" :to="{ name:'reviews', params: { id: user.id }}">
                <font-awesome-icon icon="fa-solid fa-pen-to-square" />Scrivi una recensione
            </router-link>

            <button class="btn btn-primary mr-2">
                <font-awesome-icon icon="fa-solid fa-envelope" />Contatta il medico
            </button>
            <button class="btn btn-secondary" @click="$router.back()">
                <i class="fa-solid fa-arrow-rotate-left"></i> Torna Indietro
            </button>
        </footer>
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
    // CARD
    .doctor-card{
        width: 800px;
        display: flex;
        margin-top: 50px;
        margin-bottom: 50px;
        border: 1px solid black;

        #info{
            flex-basis: 50%;
            border-right:1px solid black;
            padding: 20px;

            h3{
                color: dodgerblue;
                font-size: 2rem;
                font-weight: bold;
            }
        }

        #img-side{
            flex-basis: 50px;

            img{
                border-radius: 50%;
                box-shadow: 2px black;
                margin-top: 30px;
                margin-left: 25px;
            }
        }
    }
   
</style>
