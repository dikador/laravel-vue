<template>
    <div class="main-wrapper">
        <h1>Добро пожаловать {{ this.$store.state.auth.name }}!</h1>
    </div>
</template>

<script>
export default {
    beforeMount() {
        if (!window.Laravel.isLoggedin) {
            this.$router.push("auth");
        }
    },
};
</script>
