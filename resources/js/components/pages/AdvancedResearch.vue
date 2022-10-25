<template>
    <div>
        <h1>Ricerca Avanzata</h1>

        <nav class="navbar navbar-light bg-light">

            
                <input class="form-control mr-sm-2" 
                v-model="input"
                type="search" 
                placeholder="Search" 
                aria-label="Search">
            
            
        </nav>

        <div class="doctors">

            <div class="" v-if=" !input " >
            <p>No results found!</p>
            </div>
            
            <div v-else class="" v-for="( doctor, index ) in filteredDoctors()" :key="index">
                <div class="card my-2">{{ doctor }}</div>
            </div>
            
            

        </div>
    </div>
</template>

<script>

export default {
    name: 'AdvancedResearch',
    data() {
        return {
            input: "",
            doctors: [
                {first_name: 'gennaro',
                last_name: 'savastano',
                address: 'secondigliano',
                specializations: 'spaccio'
            },
            {   first_name: 'genny',
                last_name: 'savastano',
                address: 'secondigliano',
                specializations: 'spaccio'
            }
                
            ],
        }
    },
    computed:{

        
    },
    methods: {
        filteredDoctors(){
        return this.doctors.filter(doctor => {
            return doctor.address.toLowerCase().includes(this.input.toLowerCase())
        })
    },
    
}
}
</script>

<style scoped>

*{
    list-style-type: none;
}

li{
    margin: 0 10px;
}

</style>