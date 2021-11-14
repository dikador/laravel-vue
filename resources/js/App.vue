<template>
<div>
   <v-alert class="main-alert" max-width="400px" :value="this.$store.state.alertError" color="#F44336" border="left" transition="fade-transition" type="error">
      {{this.$store.state.alertErrorText}}
   </v-alert>

   <v-alert class="main-alert" max-width="400px" :value="this.$store.state.alertSuccess" color="#4CAF50" border="left" transition="fade-transition" type="success">
      {{this.$store.state.alertSuccessText}}
   </v-alert>
   <v-app>
      <div id="nav">
         <div class="flexApp">
            <div v-if="this.$store.state.auth">
               <router-link to="/">Home</router-link> |
               <router-link to="/blog">Blog</router-link>
            </div>

            <div class="buttons">
               <div v-if="!this.$store.state.auth">
                  <router-link to="/auth">
                     <v-btn style="margin-right:10px">Authorize</v-btn>
                  </router-link>
                  <router-link to="/registration">
                     <v-btn>Registration</v-btn>
                  </router-link>
               </div>

               <router-link to="/admin" v-if="this.$store.state.auth && this.$store.state.auth.email == 'root@mail.ru'">
                  <v-btn style="margin-right:10px">Admin</v-btn>
               </router-link>
               <v-btn @click="logout" v-if="this.$store.state.auth">Log out</v-btn>
            </div>
         </div>
      </div>

      <router-view />
   </v-app>
</div>
</template>

<script>
import axios from 'axios'
export default {
   methods: {
      async logout() {
         await axios.get('/sanctum/csrf-cookie').then(response => {
            console.log(response);
            axios.post('api/logout').then(responseq => window.location.href = 'auth')
               .catch(err => console.log(err));
         })
      }
   }
}
</script>

<style lang="scss">
@import "../sass/app.scss";

.main-wrapper {
   padding-top: 100px;
}

.buttons {
   a.router-link-exact-active.router-link-active {
      .theme--light.v-btn.v-btn--has-bg {
         background-color: #31da8e !important;
         color: #2c3e50 !important;
      }
   }
}

#app {
   font-family: 'Roboto', 'Avenir', Helvetica, Arial, sans-serif;
   -webkit-font-smoothing: antialiased;
   -moz-osx-font-smoothing: grayscale;
   color: #2c3e50;
}

h1 {
   text-align: center;
}

a {
   text-decoration: none !important;
}

#nav {
   padding: 20px 10px;
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;

   a {
      font-weight: bold;
      color: #2c3e50;

      &.router-link-exact-active {
         color: #42b983;
      }
   }
}

.flexApp {
   display: flex;
   justify-content: space-around;
   align-items: center;
}
</style>
