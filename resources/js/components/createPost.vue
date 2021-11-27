<template>
    <v-form class="form login-form" ref="formPost">
        <h2>Добавить посты</h2>
        <v-text-field
            :rules="requiredRules"
            color="#76b852"
            v-model="fields.title"
            class="main-input"
            label="Заголовок"
        />

        <v-file-input
            dense
            :rules="fileRules"
            v-if="!fields.switch1"
            class="file-inp"
            v-model="fields.files"
            color="deep-purple accent-4"
            counter
            label="Загрузить картинку"
            small-chips
            :show-size="1000"
        >
            <template v-slot:selection="{ index, text }">
                <v-chip
                    v-if="index < 3"
                    color="deep-purple accent-4"
                    dark
                    label
                    small
                >
                    {{ text }}
                </v-chip>

                <span
                    v-else-if="index === 3"
                    class="text-overline grey--text text--darken-3 mx-2"
                >
                    +{{ fields.files.length - 3 }} File(s)
                </span>
            </template>
        </v-file-input>

        <v-text-field
            v-else
            color="#76b852"
            required
            v-model="fields.files"
            class="main-input"
            label="Введите путь"
        />

        <v-checkbox
            class="mainq-switch"
            v-model="fields.switch1"
            label="Добавить картинку по src"
        ></v-checkbox>
        <v-btn
            :loading="this.$store.state.loader"
            :disabled="this.$store.state.loader"
            @click="createPost"
            class="ma-2 loginBtn"
            color="success"
            block
            >Добавить пост</v-btn
        >
    </v-form>
</template>

<script>
import { mapState } from "vuex";
export default {
    props: {
        fields: {
            required: true,
            type: Object,
        },
    },

    methods: {
        async createPost() {
            if (this.$refs.formPost.validate()) {
                this.$store.state.loader = true;
                let formData = new FormData();
                formData.append("title", this.fields.title);
                formData.append("image", this.fields.files);

                if (typeof this.files === "string") {
                    formData = {
                        title: this.fields.title,
                        image: this.fields.files,
                    };
                }

                await axios
                    .post("api/posts", formData)
                    .then((response) => {
                        this.$store._mutations.setAlertSuccessText[0](
                            "Пост успешно создан"
                        );
                    })
                    .catch((err) => {
                        console.log("Ошибка: " + err);
                        this.$store._mutations.setAlertErrorText[0](
                            "Произошла ошибка"
                        );
                    });

                this.$store.state.loader = false;
            }
        },
    },

    computed: {
        ...mapState({
            requiredRules: (state) => state.rule.requiredRules,
            fileRules: (state) => state.rule.fileRules,
        }),
    },
};
</script>

<style lang="scss" scoped></style>
