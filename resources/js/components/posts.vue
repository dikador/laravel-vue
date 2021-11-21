<template>
    <v-card class="mx-auto" min-width="350px" max-width="90%">
        <v-container fluid>
            <v-row>
                <v-col v-for="post in posts" :key="post.id" :cols="12">
                    <v-card>
                        <v-img
                            :src="post.image"
                            contain
                            class="white--text align-end main-img"
                            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                            height="200px"
                        >
                            <v-card-title
                                class="justify-space-between d-flex title"
                            >
                                <span>{{ post.title }} </span>
                            </v-card-title>
                        </v-img>
                        <!-- https://via.placeholder.com/150 -->
                        <v-card-actions
                            class="justify-space-between"
                            justify-space-between
                        >
                            <div class="d-flex">
                                <v-btn
                                    @click="$emit('openDialog', post)"
                                    class="mr-4"
                                    outlined
                                    color="indigo"
                                >
                                    Edit
                                </v-btn>

                                <v-btn
                                    @click="deletePost(post.id)"
                                    class="mr-4 deleteBtn"
                                    color="red"
                                    dark
                                >
                                    delete
                                </v-btn>
                            </div>

                            <router-link :to="'blog/' + post.id">
                                <v-btn outlined color="indigo">
                                    Learn more
                                </v-btn>
                            </router-link>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-card>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
        },
    },

    data() {
        return {
            alertSuccess: false,
            alertError: false,
        };
    },

    methods: {
        async deletePost(id) {
            await axios
                .delete(`api/posts/${id}`)
                .then((response) => {
                    this.$store.state.post.posts = this.posts.filter(
                        (post1) => post1.id !== id
                    );

                    this.$store._mutations.setAlertSuccessText[0](
                        "Пост успешно удален!"
                    );
                })
                .catch((err) => {
                    this.$store._mutations.setAlertErrorText[0](
                        "Произошла ошибка"
                    );

                    console.log(err + " Ошибка");
                });
        },
    },
};
</script>

<style lang="scss">
.justify-space-between {
    justify-content: space-between !important;
}

.main-alert {
    position: absolute;
    right: 20px;
    top: 30px;
}

.deleteBtn {
    color: #fff !important;
}

.v-responsive__content {
    flex: 1 0 100% !important;
}

.b-btn {
    font-weight: 700 !important;
}

.title {
    color: #fff;
    align-items: flex-end !important;
    height: 100%;
}
</style>
