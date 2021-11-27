import Vue from 'vue'
import Vuex from 'vuex'
import { cardModule } from "./cardModule.js";
import { loginModule } from "./loginModule.js";
import { ruleModule } from "./ruleModule.js";

Vue.use(Vuex)

export default new Vuex.Store({
   state: {
      loader: false,
      dialog: false,
      alertSuccess: false,
      alertSuccessText: null,
      alertError: false,
      alertErrorText: null,
      auth: window.Laravel.user
   },

   modules: {
      post: cardModule,
      login: loginModule,
      rule: ruleModule
   },

   mutations: {
      setAlertErrorText(state, data) {
         state.alertError = true;
         setTimeout(() => {
            state.alertError = false;
         }, 3000);

         return state.alertErrorText = data;
      },

      setAlertSuccessText(state, data) {
         state.alertError = false;
         state.alertSuccess = true;
         setTimeout(() => {
            state.alertSuccess = false;
         }, 3000);

         return state.alertSuccessText = data;
      },
   }
})
