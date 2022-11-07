<template>
  <div id="main">
    <div class="wrapper" v-bind:class="{ active: isActive }">
      <div class="select-btn" @click="toggleClass">
        <span id="spec">Scegli una specializzazione</span>
        <font-awesome-icon icon="fa-solid fa-chevron-up" class="icon" />
      </div>
      <div class="content">
        <div class="search">
          <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="i" />
          <input type="text" v-model="searchedSpec" placeholder="search" />
        </div>
        <ul class="options" id="options-list">
          <li
            v-for="(specialization, i) in filteredSpecs"
            :key="'spec-' + i"
            @click="setFilteredSpecs"
          >
            {{ specialization.label }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "customSelect",
  data() {
    return {
      isActive: false,
      searchedSpec: "",
    };
  },
  props: {
    specializations: Array,
  },
  computed: {
    filteredSpecs() {
      if (!this.searchedSpec) return this.specializations;
      return this.specializations.filter((specialization) =>
        specialization.label.toLowerCase().includes(this.searchedSpec.toLowerCase())
      );
    },
  },
  methods: {
    toggleClass() {
      this.isActive = !this.isActive;
    },
    setFilteredSpecs(event) {
      this.searchedSpec = event.target.innerText;
      const button = document.getElementById("spec");
      button.innerText = this.searchedSpec;
      this.searchedSpec = "";
      this.isActive = !this.isActive;
      // alla ricerca eseguo un push del parametro specialization name in search bar
      this.$router.push({
        name: "search",
        params: { specializationName: event.target.innerText },
      });
    },
  },
};
</script>
<style lang="scss">
// imported locally the font for the select
@import url("https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap");

#main {
  font-family: "Comfortaa", cursive;
  .wrapper {
    width: 580px;
    margin: 0px auto;
    position: relative;
  }
  @media (max-width: 560px) {
    .wrapper {
      width: 400px;
      .content {
      max-width: 400px;
    }
  }
}

  .select-btn,
  .options li {
    cursor: pointer;
    display: flex;
    align-items: center;
  }

  .select-btn {
    height: 55px;
    padding: 0 20px;
    background: #fff;
    border-radius: 7px;
    justify-content: space-between;

    .icon {
      transition: transform 300ms linear;
    }
  }

  .wrapper.active .select-btn .icon {
    transform: rotate(-180deg);
  }

  .content {
    display: none;

    border-radius: 7px;
    background: #fff;
  }

  .wrapper.active .content {
    display: block;
    position: absolute;
    z-index: 2;
    padding: 25px 20px;
    top: 65px;
    width: 580px;
  }

  .content .search {
    position: relative;

    input {
      height: 50px;
      width: 100%;
      border-radius: 5px;
      font-size: 17px;
      padding: 0 15px 0 40px;
      outline: none;
      border: 1px solid #b3b3b3;
    }
  }

  .search .i {
    top: 15px;
    color: #999;
    height: 20px;
    vertical-align: middle;
    left: 15px;
    position: absolute;
  }

  span {
    font-size: 20px;
  }

  .content .options {
    margin-top: 10px;
    max-height: 250px;
    overflow-y: auto;
  }

  .options {
    padding: 0;
  }

  .options::-webkit-scrollbar {
    width: 7px;
  }

  .options::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 25px;
  }

  .options::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 25px;
  }

  .options li {
    height: 50px;
    padding: 0 13px;
    font-size: 17px;
    border-radius: 5px;

    &:hover {
      background: #f2f2f2;
    }
  }
}
</style>
