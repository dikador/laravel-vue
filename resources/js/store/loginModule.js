export const loginModule = {
   actions: {
      registrationUser({ commit }, body) {
         axios.get("/sanctum/csrf-cookie").then((response) => {
            axios
               .post(body[2], body[0])
               .then((response) => {
                  if (response.data.success) {
                     this._mutations.setAlertSuccessText[0](
                        body[1].success
                     );

                     if (body[1].location) {
                        window.location.href = body[1].location
                     }

                     // if (body[2] === "api/login") window.location.href = "/"
                     // if (body[2] === "login/registrationUser") window.location.href = "auth"

                  } else {
                     this._mutations.setAlertErrorText[0](
                        body[1].error
                     );
                  }
               })
               .catch(function (error) {
                  console.error(error);
                  this._mutations.setAlertErrorText[0](
                     "Произошла ошибка"
                  );
               })
         });
      },
   },

   namespaced: true
}