<template>
<div>
   <div class="login-page">
      <div class="form">
         <v-form class="login-form" lazy-validation ref="form">
            <h1>Login</h1>
            <!-- color="#76b852" -->
            <v-text-field :rules="emailRules" color="#76b852" required v-model="email" hide-details="auto" class="main-input" label="email" />
            <v-text-field :rules="passwordRules" type="password" color="#76b852" required v-model="password" hide-details="auto" class="main-input" label="password" />
            <v-btn :loading="loader" :disabled="loader" @click="login" class="loginBtn btn-login" color="success" block>Login</v-btn>
            <p class="message">
               <router-link to="registration">Registration</router-link>
            </p>
         </v-form>
      </div>
   </div>
</div>
</template>

<script>
import axios from "axios";

export default {
   data() {
      return {
         valid: true,
         loader: false,
         // error: '',

         email: '',
         emailRules: [
            v => !!v || 'Это обязательное поле',
            // v => /.+@.+\..+/.test(v) || 'Введите корректный email',
         ],
         password: '',
         passwordRules: [
            v => !!v || 'Это обязательное поле',
            // v => v.length >= 4 || 'Пароль должен содержать минимум 4 знаков',
         ],
      }
   },

   methods: {
      async login() {
         if (this.$refs.form.validate()) {
            this.loader = true;
            await axios.get('/sanctum/csrf-cookie').then(response => {
               axios.post('api/login', {
                     email: this.email,
                     password: this.password
                  })
                  .then(response => {
                     if (response.data.success) {
                        this.$store._mutations.setAlertSuccessText[0]('Вы успешно автроризировались!')
            
                        window.location.href = '/'
                     } else {
                        this.$store._mutations.setAlertErrorText[0]('Вы ввели не верный логин или пароль')
                     }
                  })
                  .catch(function (error) {
                     console.error(error);
                  })
                  .finally(() => {
                     this.loader = false;
                  })
            })
         }
      },

   }

}
</script>

<style lang="scss" scoped>
.form .message {
   margin: 20px 0 0px 0px;
   color: #b3b3b3;
   font-size: 16px;
   font-weight: 500;
}


</style>
