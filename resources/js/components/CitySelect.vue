<template>
    <div>
        <select class="form-select" aria-label="Default select example" v-model="selectedAddress" @change="emitChange">
            <option value="">{{ 'Select an option' }}</option>
            <option v-for="(city, index) in cities" :key="index" :value="city">{{ city }}</option>
        </select>
    </div>
</template>






<script>
export default {
    name: 'OptionSelect',
    data() {
        return {
            selectedAddress: ''
        }
    },
    props: {
        cities: Array,
    },
    methods: {
        emitChange() {
            this.$emit('address-change', this.selectedAddress)
        }
    }
}


</script>

<style lang="scss" scoped>
select {
    width: 300px;
    height: 30px;
}
</style>

