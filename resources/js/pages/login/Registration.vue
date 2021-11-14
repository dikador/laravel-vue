<template>
<div>
   <div class="login-page">
      <div class="form">
         <v-form class="login-form" lazy-validation ref="form">
            <h1>Registration</h1>
            <v-text-field color="#76b852" required v-model="name" :rules="nameRules" hide-details="auto" class="main-input" label="name" />
            <v-text-field color="#76b852" required v-model="email" :rules="emailRules" hide-details="auto" class="main-input" label="email" />
            <v-text-field color="#76b852" required v-model="phone" :rules="phoneRules" hide-details="auto" class="main-input" label="phone" />
            <v-text-field type="password" color="#76b852" required v-model="password" :rules="passwordRules" hide-details="auto" class="main-input" label="password" />
            <v-btn :loading="loader" :disabled="loader" @click="registration" class="loginBtn btn-login" color="success" block>Registration</v-btn>
            <p class="message">
               <router-link to="auth">Log in</router-link>
            </p>
         </v-form>
      </div>
   </div>
</div>
</template>

<script>
export default {
   data() {
      return {
         loader: false,
         name: '',
         error: '',
         nameRules: [
            v => !!v || 'Это обязательное поле',
         ],
         email: '',
         emailRules: [
            v => !!v || 'Это обязательное поле',
            v => /.+@.+\..+/.test(v) || 'Введите корректный email',
         ],
         phone: '',
         phoneRules: [
            v => !!v || 'Это обязательное поле',
            v => v.length >= 11 || 'Телефон должен содержать не менее 11 символов',
         ],
         password: '',
         passwordRules: [
            v => !!v || 'Это обязательное поле',
            v => v.length >= 4 || 'Пароль должен содержать минимум 4 знаков',
         ],
      }
   },

   methods: {
      async registration() {
         if (this.$refs.form.validate()) {
            this.loader = true;
            await axios.get('/sanctum/csrf-cookie')
               .then(response => {
                  axios.post('api/register', {
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        password: this.password,
                     })
                     .then(response => {
                        if (response.data.success) {
                        this.$store._mutations.setAlertSuccessText[0]('Вы успешно зарегестрировались!')

                           window.location.href = 'auth'
                        } else {
                        this.$store._mutations.setAlertErrorText[0]('Такой пользователь уже существует')
                        }
                     })
                     .catch(function (error) {
                        console.error(error);
                     })
                     .finally(response => {
                        this.loader = false;
                     })
               })
            this.loader = false;
         }
      }
   }
}

// {
//     "name": "Ivan",
//     "email": "ivan@mail.com",
//     "phone": "898312392184",
//     "password": "qwertyzxc"
// }
</script>

<style lang="scss">
.main-alert {
   position: absolute;
   right: 20px;
   top: 30px;
}

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

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
   background: -webkit-linear-gradient(right, #76b852, #8DC26F);
   background: -moz-linear-gradient(right, #76b852, #8DC26F);
   background: -o-linear-gradient(right, #76b852, #8DC26F);
   background: linear-gradient(to left, #76b852, #8DC26F);
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
   background: #FFFFFF;
   width: 420px;
   margin: 0 auto 100px;
   padding: 30px 35px 25px 35px;
   text-align: center;
   box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);

   .btn-login {
      margin: 30px 0px 0px 0px !important;
   }
}

.form .loginBtn {
   background: #43A047 !important;
   height: 45px !important;
   font-size: 18px;
}

.form .message {
   margin: 20px 0 0px 0px;
   color: #b3b3b3;
   font-size: 20px;
   font-weight: 500;
}

.form .message a {
   color: #4CAF50;
   text-decoration: none;
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
