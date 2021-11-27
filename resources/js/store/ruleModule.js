export const ruleModule = {
   state: () => ({
      requiredRules: [(v) => !!v || "Это обязательное поле"],
      emailRules: [
         (v) => !!v || "Это обязательное поле",
         (v) => /.+@.+\..+/.test(v) || "Введите корректный email",
      ],
      phoneRules: [
         (v) => !!v || "Это обязательное поле",
         (v) =>
            v.length >= 11 ||
            "Телефон должен содержать не менее 11 символов",
      ],
      passwordRules: [
         (v) => !!v || "Это обязательное поле",
         (v) =>
            v.length >= 4 || "Пароль должен содержать минимум 4 знаков",
      ],
      fileRules: [
         (value) =>
            value.type === "image/jpeg" ||
            value.type === "image/jpg" ||
            value.type === "image/png" ||
            value.type === "image/svg+xml" ||
            "Загрузите картинку",
         (value) =>
            value.size < 2000000 || "Картинка не должна превышать 2Мб",
      ],
   }),


   namespaced: true
}