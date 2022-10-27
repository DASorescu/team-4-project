<template>
    <div id="user-details">
        <header>
            <div id="navbar">
               <div>
                <figure>
                    <img @click="$router.back()" src="" alt="LOGO">
                </figure>
               </div>
               <div>
                Servizi
               </div>
            </div>
        </header>
        <main>
            <section class="row card-details mt-5">
                <div class="col-6">
                    <div class="wrapper">
                        <div class="description">
                            <h3>{{user.first_name}} {{user.last_name}}</h3>
                            <p>Specializzazione: {{user.specializations}}</p>
                        <div id="contacts">
                            <h5>Contatti:</h5>
                            <font-awesome-icon icon="fa-solid fa-house" /> Città:<p>{{user.address}}</p>
                            <font-awesome-icon icon="fa-solid fa-phone" /> Telefono:<p>{{user.phone}}</p>
                        </div>
                            <h5>Descrizione:</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <figure>
                        <img src="#" alt="immagine profilo">
                    </figure>
                </div>
                
            </section>
        </main>
        <footer class="container d-flex align-items-center justify-content-end">
            <button class="btn btn-secondary" @click="$router.back()">
                <i class="fa-solid fa-arrow-rotate-left"></i> Torna Indietro
            </button>
        </footer>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "UserDetailPage",
    data: () => ({
        user: [],
        isLoading: false,
    }),
    methods: {
        fetchUser($id) {
            this.isLoading = true;
            axios.get('http://127.0.0.1:8000/api/users/' + $id)
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
            return axios.get('http://localhost:8000/api/specializations' + $id)
            .then((res) => {
                this.user.specializations = res.data;
                console.log(this.specializations)
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
    // NAVBAR
    #navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 80px;
        box-shadow: 2px 2px 2px #dedede;
    }
    // CARD
    .card-details{
    margin-top: 60px;
    margin-left: 80px;
    padding-bottom: 100px;
  
    .wrapper{
        display: flex;
        justify-content: space-between;
        align-items: stretch;

        .contacts{
            height: 50px;
            display: flex;
            justify-content: space-between;
            line-height: 50px;
            background-color: #55BA59;
            margin: 5px 0;

        }

        .description{
            flex-basis: 50%;

            h3,h5{
                color: #003F5E;
                font-weight: bold;
                font-size: 1.5rem;
                padding-bottom: 10px;
            }
            
        }
    }

}
</style>