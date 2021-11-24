<template>
    <v-card class="mx-auto" width="90%" max-width="800">
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
                        <v-card-actions
                            class="justify-space-between"
                            justify-space-between
                        >
                            <div class="d-flex" v-if="$store.state.auth.admin">
                                <v-btn
                                    @click="$emit('openDialog', post)"
                                    class="mr-4"
                                    outlined
                                    color="indigo"
                                >
                                    Изменить
                                </v-btn>

                                <v-btn
                                    @click="deletedPost(post.id)"
                                    class="mr-4 deleteBtn"
                                    color="red"
                                    dark
                                >
                                    Удалить
                                </v-btn>
                            </div>

                            <router-link :to="'blog/' + post.id">
                                <v-btn outlined color="indigo">
                                    Подробнее
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
        deletedPost(id) {
            this.$store.dispatch("post/deletePost", id);
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
