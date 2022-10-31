<template>
    <div>
        <router-view></router-view>
        <!-- <customSelect/> -->
    </div>
</template>
            

<script>
import customSelect from './CustomSelect.vue'
    export default {
        name:'App',
    components: {
        customSelect,
    }
    }
</script>
