<template>
<div>
   <div class="main-wrapper">
      <h1>Добро пожаловть в админ панель {{this.$store.state.auth.name}}</h1>
      <div class="form">
         <v-form class="login-form" lazy-validation ref="form">
            <h2>
               Добавить посты
            </h2>
            <v-text-field :rules="titleRules" color="#76b852" required v-model="title" class="main-input" label="Заголовок" />

            <v-file-input dense v-if="!switch1" class="file-inp" v-model="files" color="deep-purple accent-4" counter label="Загрузить картинку" small-chips :show-size="1000">
               <template v-slot:selection="{ index, text }">
                  <v-chip v-if="index < 3" color="deep-purple accent-4" dark label small>
                     {{ text }}
                  </v-chip>

                  <span v-else-if="index === 3" class="text-overline grey--text text--darken-3 mx-2">
                     +{{ files.length - 3 }} File(s)
                  </span>
               </template>
            </v-file-input>

            <v-text-field v-else color="#76b852" required v-model="files" class="main-input" label="Введите путь" />

            <v-checkbox class="mainq-switch" v-model="switch1" :label="!switch1 ? 'Добавить картинку по src' : 'Загрузить картинку'"></v-checkbox>
            <v-btn :loading="this.$store.state.loader" :disabled="this.$store.state.loader" @click="createPost" class="ma-2 loginBtn" color="success" block>Добавить пост</v-btn>
         </v-form>
      </div>
   </div>
</div>
</template>

<script>
export default {
   data() {
      return {
         files: [],
         switch1: false,
         title: '',
         error: '',

         titleRules: [
            v => !!v || 'Это обязательное поле',
         ],

      }
   },

   methods: {
      async createPost() {
         if (this.$refs.form.validate()) {
            this.$store.state.loader = true;
            let formData = new FormData()
            formData.append('title', this.title)
            formData.append('image', this.files)

            if (typeof this.files === 'string') {
               formData = {
                  title: this.title,
                  image: this.files
               }
            }

            await axios.post('api/posts', formData)
               .then(response => {
                  this.$store._mutations.setAlertSuccessText[0]('Пост успешно создан')

                  this.title = ' ';
               })
               .catch(err => {
                  console.log('Ошибка: ' + err);
                  this.$store._mutations.setAlertErrorText[0]('Произошла ошибка')
               });

            this.$store.state.loader = false
         }
      },
   },

   beforeRouteEnter(to, from, next) {
      if (!window.Laravel.isLoggedin || window.Laravel.user.email !== 'root@mail.ru') {
         window.location.href = 'auth';
      }

      next();
   },
}
</script>

<style lang="scss" scoped>
.main-alert {
   position: absolute;
   right: 20px;
   top: 30px;
}

.form {
   margin-top: 60px;
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
