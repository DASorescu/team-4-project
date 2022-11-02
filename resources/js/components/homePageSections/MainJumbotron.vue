<template>
    <div id="jumbotron">
        <div class="container d-flex  align-items-center h-100 p-relative">
            <div class="select-wrapper">
                <div class="select-heading">
                    <img src="../../../../public/img/doctor.png" alt="doc">
                    <h2 class="text-white">Prenota online la tua visita medica</h2>
                </div>
                <div>
                    <customSelect :specializations="specializations" @click="toggleClass"/>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import customSelect from '../CustomSelect.vue';
export default {
    name: 'MainJumbo',
    data() {
        return {
            specializations: [],
            currentSpecialization: 0,
            isActive: false,
        };
    },
    computed: {
        hasSpecializations() {
            return this.specializations.length > 0;
        },
    },
    components: {
        customSelect,
    },
    methods: {
        getSpecializations() {
            axios.get("http://localhost:8000/api/specializations/")
                .then(res => {
                    this.specializations = res.data;
                });
        },
        search() {
            this.$router.push({ name: "search", params: { specializationName: this.currentSpecialization } });
        },
        toggleClass() {
            // al click toggolo la classe active sul div con classe Wrapper
            this.isActive = !this.isActive
        },
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
                top: 46px;
                left: 11px;
                width: 150px;
            }
        }

        h2 {
            transform: translate(130px, 15px);
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
                // transition: width 1000ms ease;
            
                &:hover {
                    // width: 700px;
            border-color: rgb(48, 158, 227);
        }
    }

}
</style>