<template>
    <div class="main">
        <h1>Страница не найдена</h1>
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

<style lang="scss" scoped>
.main {
    text-align: center;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #8bcf66 !important;

    h1 {
        font-size: 70px;
        text-transform: uppercase;
        font-weight: 900;
    }
}
</style>
