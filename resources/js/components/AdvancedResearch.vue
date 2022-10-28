<template>
    <div class="d-flex flex-column">
        <div class="btn btn-primary w-100 mt-5" v-on:click="isShow = !isShow">
                Ricerca avanzata 
        </div>

        <div v-if="isShow">

            

            
            <select class="form-select" aria-label="Default select example" v-model="selectedPropriety" >
                <option value="">{{ 'Filtra per...' }}</option>
                <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">
                    {{ propriety }}
                </option>
                
            </select>

            <input type="text" v-model="searched">

            <div v-for="(doctor, index) in filteredDoctorsBy" :key="index">
                {{doctor}}
            </div>
    


        </div>

    </div>
</template>


<script>
export default {
    props:{
        result: Array
    },
    components:{
    },
    name: 'AdvancedResearch',
    data() {
        return {
            selectedPropriety: "",
            searched: "",
            proprieties: ['Nome','Cognome','Città'],
            isShow: false,
            isLoading: false,
        }
    },
    computed:{
        
        filteredDoctorsBy() {
            if (this.selectedPropriety === "Nome")
            return this.result.filter(
                (doctor) => doctor.detail.first_name === this.searched
            );
            if (this.selectedPropriety === "Cognome")
            return this.result.filter(
                (doctor) => doctor.detail.last_name === this.searched
            );
            if (this.selectedPropriety === "Città")
            return this.result.filter(
                (doctor) => doctor.detail.address === this.searched
            );
        }
    },
    
    
}



</script>

<style lang="scss" scoped>

</style>