<template>
<div>
   <v-alert class="main-alert" max-width="400px" :value="this.alertError" color="#F44336" border="left" transition="fade-transition" type="error">
      Произошла ошибка
   </v-alert>

   <v-alert class="main-alert" max-width="400px" :value="this.alertSuccess" color="#4CAF50" border="left" transition="fade-transition" type="success">
      Пост успешно изменен!
   </v-alert>

   <v-dialog persistent width="500" v-model="dialog">
      <v-card class="">
         <v-card-title class="text-h5 grey lighten-2">
            Изменть пост
         </v-card-title>
         <v-form class="login-form modal-card" lazy-validation>
            <v-text-field name="title" color="#76b852" v-model="activePost.title" class="main-input" label="Заголовок" />

            <input name="image" @change="changeFile" type="file" class="hiddenInput" id="hiddenInput1">

            <label style="max-width:100%; cursor: pointer;" for="hiddenInput1">
               <v-img :src="activePost.image" :contain="true" class="white--text align-end" gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)" height="180px">
               </v-img>
            </label>
            <br>

            <v-btn height="50px" style="margin-top:20px;" @click="editPost" class="loginBtn" color="success" block>Сохранить</v-btn>
         </v-form>
      </v-card>
   </v-dialog>
</div>
</template>

<script>
export default {
   data() {
      return {
         dialog: false,
         files: [],
         alertError: false,
         alertSuccess: false
      }
   },

   methods: {
      async editPost() {
         let formData = new FormData()
         formData.append('title', this.activePost.title)

         if (this.files.length > 0) {
            formData.append('image', this.files)
         }

         formData.append("_method", "PUT");

         await axios.post(`api/posts/${this.activePost.id}`, formData)
            .then(response => {
               this.$store._mutations.setAlertSuccessText[0]('Пост успешно изменен!')
            })
            .catch(err => {
               this.$store._mutations.setAlertErrorText[0]('Произошла ошибка')
               console.log(err + ' Ошибка');
            })

         this.dialog = false;
      },

      changeFile(event) {
         let file = event.target.files[0];
         this.files = file;
         let reader = new FileReader();

         reader.onload = e => {
            this.activePost.image = e.target.result
         }

         reader.readAsDataURL(file);
      }
   },

   props: {
      activePost: {
         type: Object
      }
   }
}
</script>

<style lang="scss" scoped>
.modal-card {
   padding: 10px 20px 20px 20px;
}

.v-label.theme--light {
   margin: 0 !important;
}

button {
   margin-left: 0 !important;
}

.hiddenInput {
   display: none;
}
</style>
