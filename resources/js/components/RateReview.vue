<template>
  <span>
    <span
      v-for="n in 5"
      :key="'s-' + n"
      :style="style"
      @click="handlerClick(n)"
      :class="n <= value ? 'e-primary' : 'e-white'"
      >⭐</span
    >
  </span>
</template>

<script>
export default {
  name: "RateReview",
  props: {
    value: { type: Number, required: true },
    clickable: Boolean,
  },
  computed: {
    style() {
      return {
        cursor: this.clickable ? "pointer" : undefined,
      };
    },
  },
  methods: {
    handlerClick(value) {
      if (this.clickable) {
        console.log("handlerClick called:", value);
        this.$emit("input", value);
      }
    },
  },
};
</script>

<style lang="scss">
.e-primary {
  color: transparent;
  text-shadow: 0 0 0 rgb(204, 204, 3);
}
.e-white {
  color: transparent;
  text-shadow: 0 0 0 lightgray;
}
</style>
