<template>
    <div>
        <select class="form-select" aria-label="Default select example" v-model="selectedPropriety" @change="AlChangeFai">
            <option value="">{{ label || 'Select an option' }}</option>
            <option v-for="(propriety, index) in proprieties" :key="index" :value="propriety">{{ propriety }}</option>
        </select>
    </div>
</template>


<script>
export default {
    name: 'AdvancedResearch',
    data() {
        return {
            selectedPropriety: '',
            proprieties: ['first_name','last_name','address','specialization']
        }
    },
    methods: {
        AlChangeFai() {
            this.$emit('propriety-change', this.selectedPropriety)
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