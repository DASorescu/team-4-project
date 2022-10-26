<template>
    <div>
        <div id="doctor-details">
            Dettagli Dottore
            <p>Città: {{ user.name}}</p>
            
        </div>
    </div>
</template>

<script>
 export default {
    name: "DoctorDetails",
    data (){
        return{
            details:null,
        }
    },
    methods:{
        fetchDetails(){
            axios.get('http://localhost:8000/api/users/1')
            .then((res)=>{
                this.details = res.data;
            })
            .catch((err)=>{
                console.error(err);
            })
            .then(()=>{
                console.log('chiamata terminata');
            })
        }
    },
    mounted(){
        this.fetchDetails();
    }
 };
</script>