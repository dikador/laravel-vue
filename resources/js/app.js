require('./bootstrap');
import router from './router'
import store from './store'
import App from './App.vue'
import vuetify from './plugins/vuetify'


window.Vue = require('vue').default;
Vue.config.productionTip = false;

const app = new Vue({
   el: '#app',
   store,
   vuetify,
   router,
   render: h => h(App)
});

