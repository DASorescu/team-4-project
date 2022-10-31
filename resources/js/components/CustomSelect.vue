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
                    <input type="text" v-model="searchedSpec" placeholder="search">
                </div>
                <ul class="options" id="options-list">
                    <li v-for="(specialization, i) in filteredSpecs" :key="'spec-' + i" @click="updateName">
                        {{ specialization }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'customSelect',
    data() {
        return {
            isActive: false,
            searchedSpec: '',
            specializations: [

                'Allergologia ed immunologia clinica',
                'Malattie dell’apparato respiratorio',
                'Malattie dell’apparato digerente',
                'Medicina d’emergenza-urgenza',
                'Dermatologia e venereologia',
                'Malattie infettive e tropicali',
                'Scienza dell’alimentazione',
                'Oncologia medica',
                'Medicina termale',
                'Medicina interna',
                'Reumatologia',
                'Ematologia',
                'Nefrologia',
                'Geriatria',
            ]



        }
    },
    computed: {
        filteredSpecs() {
            if (!this.searchedSpec) this.filteredSpecs = this.specializations;
            return this.filteredSpecs = this.specializations.filter((specialization) => specialization.toLowerCase().includes(this.searchedSpec.toLowerCase()));
        }
    },
    methods: {
        toggleClass() {
            // al click toggolo la classe active sul div con classe Wrapper
            // const wrapper = document.querySelector('.wrapper')
            // wrapper.classList.toggle('active')
            this.isActive = !this.isActive
        },
        // addSpecialization() {
        //     this.specializations.forEach(spec => {

        //         // const wrapper = document.querySelector('.wrapper')
        //         const options = document.getElementById('options-list')
        //         // adding options inside select
        //         let li = `<li onclick="updateName(this)">${spec}</li>`
        //         // console.log(options)
        //         options.insertAdjacentHTML('beforeend', li);

        //     });


        // },
        updateName(event) {
            this.searchedSpec = event.target.innerText
            const button = document.getElementById('spec');
            button.innerText = this.searchedSpec;
            this.searchedSpec = ''
            this.isActive = !this.isActive
        },

    },
    // mounted() {
    //     this.addSpecialization();
    // }
}


</script>
<style lang="scss" >
// imported locally the font for the select 
@import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap');

#main {
    font-family: 'Comfortaa', cursive;
    height: 100vh;
    background-color: rgb(36, 113, 255);

    .wrapper {
        width: 370px;
        margin: 0px auto;
        padding-top: 130px;
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
        padding: 20px;
        margin-top: 15px;
        border-radius: 7px;
        background: #fff;


    }

    .wrapper.active .content {
        display: block;
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