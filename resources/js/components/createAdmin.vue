<template>
    <v-form class="form login-form" ref="form">
        <h2>Добавить администратора</h2>

        <v-text-field
            color="#76b852"
            required
            v-model="fields.name"
            :rules="requiredRules"
            hide-details="auto"
            class="main-input"
            label="Имя"
        />
        <v-text-field
            color="#76b852"
            required
            v-model="fields.email"
            :rules="emailRules"
            hide-details="auto"
            class="main-input"
            label="Email"
        />
        <v-text-field
            color="#76b852"
            required
            v-model="fields.phone"
            :rules="phoneRules"
            hide-details="auto"
            class="main-input"
            label="Телефон"
        />

        <v-text-field
            type="password"
            color="#76b852"
            required
            v-model="fields.password"
            :rules="passwordRules"
            hide-details="auto"
            class="main-input"
            label="Пароль"
        />
        <v-btn
            :loading="fields.adminLoader"
            :disabled="fields.adminLoader"
            @click="registration"
            class="loginBtn btn-login"
            color="success"
            block
            >Создать</v-btn
        >
    </v-form>
</template>

<script>
import { mapState } from "vuex";
export default {
    props: {
        fields: {
            required: true,
            type: Object,
        },
    },

    methods: {
        async registration() {
            if (this.$refs.form.validate()) {
                this.fields.adminLoader = true;
                let formBody = [
                    {
                        name: this.fields.name,
                        email: this.fields.email,
                        phone: this.fields.phone,
                        password: this.fields.password,
                        admin: true,
                    },
                    {
                        success: "Администратор успешно создан!",
                        error: "Такой пользователь уже существует",
                    },
                    "api/register",
                ];

                this.fields.name = "";
                this.fields.email = "";
                this.fields.phone = "";
                this.fields.password = "";

                await this.$store.dispatch("login/registrationUser", formBody);
                this.fields.adminLoader = false;
            }
        },
    },

    computed: {
        ...mapState({
            requiredRules: (state) => state.rule.requiredRules,
            emailRules: (state) => state.rule.emailRules,
            passwordRules: (state) => state.rule.passwordRules,
            phoneRules: (state) => state.rule.phoneRules,
        }),
    },
};
</script>

<style lang="scss" scoped></style>
