<template>
    <div>
        <div id="doctor-details">
            Dettagli Dottore
            
            
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
            axios.get('http://localhost:8000/api/users/' + this.$route.params.id)
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