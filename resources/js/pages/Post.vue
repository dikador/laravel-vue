<template>
    <div class="main-wrapper">
        <v-card class="card" max-width="70%">
            <v-container fluid>
                <v-row>
                    <v-col :cols="12">
                        <v-card>
                            <v-img
                                :src="posts.image"
                                :contain="true"
                                class="white--text align-end"
                                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                height="200px"
                            >
                                <v-card-title
                                    class="justify-space-between d-flex title"
                                >
                                    <span
                                        >{{ posts.title }} {{ posts.id }}</span
                                    >
                                </v-card-title>
                            </v-img>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    mounted() {
        this.$store.dispatch("post/fetchPosts", [
            "/api/posts/" + this.$route.params.id,
            this.$router,
        ]);
    },

    beforeMount() {
        if (!window.Laravel.isLoggedin) {
            this.$router.push("../auth");
        }
    },

    computed: {
        ...mapState({
            loading: (state) => state.post.loading,
            posts: (state) => state.post.posts,
        }),
    },
};
</script>

<style lang="scss" scoped>
.card {
    margin: 0px auto 0px auto;
}
</style>
