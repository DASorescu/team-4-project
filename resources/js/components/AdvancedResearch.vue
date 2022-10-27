<template>
    <div>
        <button class="btn btn-primary" v-on:click="isShow = !isShow">
                Ricerca avanzata 
                <i class="fa-solid fa-chevron-down"></i> 
                <i class="fa-solid fa-chevron-up"></i>
        </button>

        <div v-if="isShow">

            <HomePageComponent/>

            <select class="form-select" aria-label="Default select example" v-model="selectedPropriety" @change="AlChangeFai">
                <option value="">{{ label || 'Select an option' }}</option>
                <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">{{ propriety }}</option>
            </select>    


        </div>

    </div>
</template>


<script>
import axios from 'axios';
import HomePageComponent from './HomePageComponent.vue'
export default {
    components:{
        HomePageComponent
    },
    name: 'AdvancedResearch',
    data() {
        return {
            selectedPropriety: '',
            proprieties: ['first_name','last_name','address','specialization'],
            isShow: false
        }
    },
    methods: {
        AlChangeFai() {
            this.$emit('propriety-change', this.selectedPropriety)
        },
        fetchUser() {
            this.isLoading = true;
            axios.get('http://127.0.0.1:8000/api/users')
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
        mounted() {
        this.fetchUser();
    }
    },
    props: {
        label: String
    },
}


</script>

<style lang="scss" scoped>
select {
    width: 300px;
    height: 30px;
}
</style>