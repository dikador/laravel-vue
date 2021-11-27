<template>
    <div>
        <div class="main-wrapper">
            <h1>
                Добро пожаловть в админ панель {{ this.$store.state.auth.name }}
            </h1>

            <create-post :fields="postFields" />
            <create-admin :fields="adminFields" />
        </div>
    </div>
</template>

<script>
import createAdmin from "../../components/createAdmin.vue";
import CreatePost from "../../components/createPost.vue";
export default {
    data() {
        return {
            postFields: {
                title: "",
                switch1: false,
                files: [],
            },

            adminFields: {
                adminLoader: false,
                name: "",
                email: "",
                phone: "",
                password: "",
            },
        };
    },

    components: {
        createAdmin,
        CreatePost,
    },

    beforeMount() {
        if (!window.Laravel.isLoggedin || !this.$store.state.auth.admin) {
            this.$router.push("/");
        }
    },
};
</script>

<style lang="scss" scoped>
.main-alert {
    position: absolute;
    right: 20px;
    top: 30px;
}

.form {
    margin-top: 40px;
}

.mainq-switch {
    .v-label.theme--light {
        padding-left: 10px !important;
    }
}

.file-inp {
    margin-top: 10px !important;
}
</style>
