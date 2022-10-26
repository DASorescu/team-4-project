<template>
    <div class="container">


        <h1 class="text-center">Ricerca Avanzata</h1>
                
            
        <h3 class="my-3 text-center">Seleziona un campo di ricerca e inizia a scrivere</h3>

            <label>filtra per...
            <select v-model="selected">

                <option v-for="propriety,index in proprieties" :key="index" :value="propriety">
                    {{propriety}}
                </option>
        
            </select>
            </label>
            

        <nav class="navbar navbar-light bg-light">

                <input class="form-control mr-sm-2" 
                v-model="input"
                type="search" 
                placeholder="filtra per..." 
                aria-label="Search">

            
            
        </nav>

        <div class="doctors">

            <div class="" v-if=" !input" > 
            <p>Nessun Risulato!</p>
            </div>
            
            <div v-else class="" v-for="( doctor, index ) in filteredDoctorsBy()" :key="index">
                <div class="card my-2">
                    <div class="card-header">
                       <h4> {{doctor.first_name}} {{doctor.last_name}} </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Specializzazione: {{doctor.specialization}}</h5>
                        <p class="card-text">Città: {{doctor.address}}</p>
                        <router-link to="/users/{user}" class="btn btn-primary">Contatta</router-link> 
                    </div>
                </div>
            </div>
            
            

        </div>
    </div>
</template>

<script>

export default {
    name: 'AdvancedResearch',
    props: {
        doctorsArray: Array,
    },
    data() {
        return {
            
            proprieties: ['nome', 'cognome', 'città', 'specializzazione'],

            selected: null,

            input: '',

            doctors: [

            {   first_name: 'Gennaro',
                last_name: 'Savastano',
                address: 'Napoli',
                specialization: 'Cardiologia'
            },
            {   first_name: 'Roberto',
                last_name: 'Salvi',
                address: 'Milano',
                specialization: 'Dentista'
            },
            {   first_name: 'Angelo',
                last_name: 'Esposito',
                address: 'Napoli',
                specialization: 'Dentista'
            },
            {   first_name: 'Anna',
                last_name: 'Magnani',
                address: 'Roma',
                specialization: 'Osteopata'
            },

                
            ],
        }
    },
    computed:{
        
        
        
        
        
    },
    methods: {

        filteredDoctorsBy(){

            if(this.selected == 'nome')
            return this.doctors.filter(doctor => {
            return doctor.first_name.toLowerCase().includes(this.input.toLowerCase())
            })
            if(this.selected == 'cognome')
            return this.doctors.filter(doctor => {
            return doctor.last_name.toLowerCase().includes(this.input.toLowerCase())
            })
            if(this.selected == 'città')
            return this.doctors.filter(doctor => {
            return doctor.address.toLowerCase().includes(this.input.toLowerCase())
            })
            if(this.selected == 'specializzazione')
            return this.doctors.filter(doctor => {
            return doctor.specialization.toLowerCase().includes(this.input.toLowerCase())
            })
            },

    },
    
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