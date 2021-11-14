<template>
<div class="main-wrapper">
   <h1> Welcome {{ this.$store.state.auth.name }}</h1>
</div>
</template>

<script>
export default {
   beforeRouteEnter(to, from, next) {
      if (!window.Laravel.isLoggedin) {
         window.location.href = 'auth';
         this.$router.push('auth');
      }
      next();
   },
}
</script>
