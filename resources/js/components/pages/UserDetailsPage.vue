<template>
    <div id="detail">
        <button class="btn btn-secondary" @click="$router.back()"><i class="fa-solid fa-arrow-rotate-left"></i> Torna
            Indietro</button>
    </div>
</template>

<script>
export default {
    name: "UserDetailPage",
    data: () => ({
        user: null,
        isLoading: false,
    }),
    methods: {
        fetchUser() {
            this.isLoading = true;
            axios.get('http://127.0.0.1:8000/api/users/' + this.$route.params.id)
                .then((res) => {
                    this.user = res.data;
                })
                .catch((err) => {
                    console.error(err);
                })
                .then(() => {
                    this.isLoading = false;
                })
        }
    },
    mounted() {
        this.fetchUser();
    }
}
</script>
