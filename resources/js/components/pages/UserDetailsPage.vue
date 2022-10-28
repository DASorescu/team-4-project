<template>
    <div id="user-details">
        <main>
            <section class="row card-details mt-5">
                <div class="col-6">
                    <div class="wrapper">
                        <div class="description">
                            <h3>{{user.first_name}} {{user.last_name}}</h3>
                            <p>Specializzazioni: </p>
                            <ul class="list-group pb-3">
                                <li v-for="specialization in specializations" :key="specialization.id" :class="'list-group-item list-group-item-'+specialization.color">{{specialization.label}}</li>
                            </ul>
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
