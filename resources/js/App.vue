<template>
    <div>
        <v-alert
            class="main-alert"
            max-width="400px"
            :value="$store.state.alertError"
            color="#F44336"
            border="left"
            transition="fade-transition"
            type="error"
        >
            {{ $store.state.alertErrorText }}
        </v-alert>

        <v-alert
            class="main-alert"
            max-width="400px"
            :value="$store.state.alertSuccess"
            color="#4CAF50"
            border="left"
            transition="fade-transition"
            type="success"
        >
            {{ $store.state.alertSuccessText }}
        </v-alert>
        <v-app>
            <div id="nav">
                <div
                    class="flexApp"
                    :style="
                        !$store.state.auth
                            ? 'justify-content: space-around'
                            : ''
                    "
                >
                    <div v-if="$store.state.auth">
                        <router-link to="/">Home</router-link> |
                        <router-link to="/blog">Blog</router-link>
                    </div>

                    <div class="buttons">
                        <div v-if="!$store.state.auth">
                            <router-link to="/auth">
                                <v-btn style="margin-right: 10px">
                                    Авторизация
                                </v-btn>
                            </router-link>
                            <router-link to="/registration">
                                <v-btn>Регистрация</v-btn>
                            </router-link>
                        </div>

                        <router-link
                            to="/admin"
                            v-if="$store.state.auth && $store.state.auth.admin"
                        >
                            <v-btn style="margin-right: 10px"
                                >Админ панель</v-btn
                            >
                        </router-link>
                        <v-btn @click="logout" v-if="$store.state.auth"
                            >Выйти</v-btn
                        >
                    </div>
                </div>
            </div>

            <router-view />
        </v-app>
    </div>
</template>

<script>
import axios from "axios";
export default {
    methods: {
        logout() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("api/logout")
                    .then((responseq) => (window.location.href = "auth"));
            });
        },
    },
};
</script>

<style lang="scss">
@import "../sass/app.scss";
</style>
