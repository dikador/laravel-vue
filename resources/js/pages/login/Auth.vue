<template>
    <div class="login-page">
        <div class="form">
            <v-form class="login-form" ref="form">
                <h1>Авторизация</h1>
                <v-text-field
                    :rules="emailRules"
                    color="#76b852"
                    v-model="email"
                    hide-details="auto"
                    class="main-input"
                    label="Email"
                />
                <v-text-field
                    :rules="passwordRules"
                    type="password"
                    color="#76b852"
                    v-model="password"
                    hide-details="auto"
                    class="main-input"
                    label="Пароль"
                />
                <v-btn
                    :loading="$store.state.loader"
                    :disabled="$store.state.loader"
                    @click="login"
                    class="loginBtn btn-login"
                    color="success"
                    block
                    >Авторизоваться</v-btn
                >
            </v-form>

            <p class="message">
                Admin: login - root@gmail.com; password - 2341
            </p>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },

    methods: {
        async login() {
            if (this.$refs.form.validate()) {
                this.$store.state.loader = true;
                let formBody = [
                    {
                        email: this.email,
                        password: this.password,
                    },
                    {
                        success: "Вы успешно автроризировались!",
                        error: "Вы ввели не верный логин или пароль",
                        location: "/",
                    },
                    "api/login",
                ];

                await this.$store.dispatch("login/registrationUser", formBody);
                this.$store.state.loader = false;
            }
        },
    },

    computed: {
        ...mapState({
            emailRules: (state) => state.rule.emailRules,
            passwordRules: (state) => state.rule.passwordRules,
        }),
    },
};
</script>

<style lang="scss" scoped>
.message {
    margin: 20px 0px 0px 0px;
    color: #4caf50;
    font-size: 14px;
    font-weight: 500;
}
</style>
