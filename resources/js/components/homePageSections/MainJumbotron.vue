<template>
    <div id="jumbotron">
        <div class="container d-flex  align-items-center h-100 p-relative">
            <div class="select-wrapper">
                <div class="select-heading">
                    <img src="../../../../public/img/doctor.png" alt="doc">
                    <h2 class="text-white">Prenota online la tua visita medica</h2>
                </div>
                <div>
                    <select v-if="hasSpecializations" v-model="currentSpecialization" @change="search()">
                        <option :value="0">Seleziona una specializzazione</option>
                        <option v-for="specialization in specializations" :key="'spec-' + specialization.id"
                            :value="specialization.id" :selected="currentSpecialization === specialization.id">
                            {{ specialization.label }}
                        </option>
                    </select>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'MainJumbo',
    data() {
        return {
            specializations: [],
            currentSpecialization: 0,
        };
    },
    computed: {
        hasSpecializations() {
            return this.specializations.length > 0;
        },
    },
    methods: {
        getSpecializations() {
            axios.get("http://localhost:8000/api/specializations/")
                .then(res => {
                    this.specializations = res.data;
                });
        },
        search() {
            this.$router.push({ name: "search", params: { specializationId: this.currentSpecialization } });
        }
    },
    mounted() {
        this.getSpecializations();
    },
}
</script>
<style lang="scss" scoped>
#jumbotron {

    height: 400px;
    background: linear-gradient(#0451CB, #3884ff);

    .select-wrapper {
        .select-heading {
            img {
                position: absolute;
                top: 20px;
                left: 20px;
                width: 150px;
            }
        }

        h2 {
            transform: translate(140px, -20px);
        }
    }

    select::-webkit-scrollbar {
        width: 7px;
    }

    select::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 25px;
    }

    select::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 25px;
    }

    select {
        outline: none;
        padding: 10px;
        height: 50px;
        width: 700px;
        border-radius: 10px;
        border-width: 3px;
        border-color: #fff;
        transform: translateY(-28px);

        &:hover {

            border-color: rgb(48, 158, 227);
        }
    }

}
</style>