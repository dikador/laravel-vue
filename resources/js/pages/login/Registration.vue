<template>
    <div>
        <div class="login-page">
            <div class="form">
                <v-form class="login-form" lazy-validation ref="form">
                    <h1>Регистрация</h1>
                    <v-text-field
                        color="#76b852"
                        required
                        v-model="name"
                        :rules="nameRules"
                        hide-details="auto"
                        class="main-input"
                        label="Имя"
                    />
                    <v-text-field
                        color="#76b852"
                        required
                        v-model="email"
                        :rules="emailRules"
                        hide-details="auto"
                        class="main-input"
                        label="Email"
                    />
                    <v-text-field
                        color="#76b852"
                        required
                        v-model="phone"
                        :rules="phoneRules"
                        hide-details="auto"
                        class="main-input"
                        label="Телефон"
                    />
                    <v-text-field
                        type="password"
                        color="#76b852"
                        required
                        v-model="password"
                        :rules="passwordRules"
                        hide-details="auto"
                        class="main-input"
                        label="Пароль"
                    />
                    <v-btn
                        :loading="this.$store.state.loader"
                        :disabled="this.$store.state.loader"
                        @click="registration"
                        class="loginBtn btn-login"
                        color="success"
                        block
                        >Зарегистрироваться
                    </v-btn>
                </v-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            error: "",
            nameRules: [(v) => !!v || "Это обязательное поле"],
            email: "",
            emailRules: [
                (v) => !!v || "Это обязательное поле",
                (v) => /.+@.+\..+/.test(v) || "Введите корректный email",
            ],
            phone: "",
            phoneRules: [
                (v) => !!v || "Это обязательное поле",
                (v) =>
                    v.length >= 11 ||
                    "Телефон должен содержать не менее 11 символов",
            ],
            password: "",
            passwordRules: [
                (v) => !!v || "Это обязательное поле",
                (v) =>
                    v.length >= 4 || "Пароль должен содержать минимум 4 знаков",
            ],
        };
    },

    methods: {
        async registration() {
            if (this.$refs.form.validate()) {
                this.$store.state.loader = true;
                let formBody = [
                    {
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        password: this.password,
                        admin: false,
                    },
                    {
                        success: "Вы успешно зарегистрировались!",
                        error: "Такой пользователь уже существует",
                        location: "auth",
                    },
                    "api/register",
                ];
                await this.$store.dispatch("login/registrationUser", formBody);
                //  window.location.href = "auth";
                this.$store.state.loader = false;
            }
        },
    },
};
</script>

<style lang="scss">
.main-alert {
    position: absolute;
    right: 20px;
    top: 30px;
}

a {
    text-decoration: none !important;
}

.main-input {
    margin-top: 15px !important;
}

.error--text {
    color: #ff5252 !important;

    .theme--light.v-label.error--text {
        color: #ff5252 !important;
    }
}

.error {
    color: #ff5252 !important;
}

.login-page {
    width: 100%;
    background: #76b852 !important;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(right, #76b852, #8dc26f);
    background: -moz-linear-gradient(right, #76b852, #8dc26f);
    background: -o-linear-gradient(right, #76b852, #8dc26f);
    background: linear-gradient(to left, #76b852, #8dc26f);
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    height: 100vh;
    padding-top: 90px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form {
    position: relative;
    margin: auto;
    z-index: 1;
    background: #ffffff;
    width: 450px;
    margin: 0 auto 100px;
    padding: 20px 30px 25px 30px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);

    .btn-login {
        margin: 30px 0px 0px 0px !important;
    }
}

.form .loginBtn {
    background: #43a047 !important;
    height: 45px !important;
    font-size: 18px;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 300px;
    margin: 0 auto;
}

.container:before,
.container:after {
    content: "";
    display: block;
    clear: both;
}

.container .info {
    margin: 50px auto;
    text-align: center;
}
</style>
