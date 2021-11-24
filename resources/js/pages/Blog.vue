<template>
    <div class="main-wrapper">
        <div class="main">
            <v-progress-circular
                :size="50"
                color="primary"
                v-if="loading"
                indeterminate
            ></v-progress-circular>
            <modal :activePost="activePost" ref="modal" />
            <posts
                @openDialog="openDialog"
                class="cards"
                v-if="sortedPosts.length > 0 && !loading"
                :posts="sortedPosts"
            />
            <h1 v-if="sortedPosts.length == 0 && !loading">Постов нет</h1>
        </div>
    </div>
</template>

<script>
import posts from "../components/posts.vue";
import { mapGetters, mapState } from "vuex";
import Modal from "../components/modal.vue";
export default {
    components: {
        posts,
        Modal,
    },

    data() {
        return {
            activePost: {},
        };
    },

    methods: {
        openDialog(post) {
            this.$refs.modal.dialog = true;

            this.activePost = post;
        },
    },

    beforeMount() {
        if (!window.Laravel.isLoggedin) {
            this.$router.push("../auth");
        }
    },

    mounted() {
        this.$store.dispatch("post/fetchPosts", ["/api/posts"]);
    },

    computed: {
        ...mapState({
            loading: (state) => state.post.loading,
        }),
        ...mapGetters({
            sortedPosts: "post/sortedPosts",
        }),
    },
};
</script>

<style lang="scss" scoped>
.main {
    margin: 30px auto 0px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.cards {
    display: flex;
    flex-wrap: wrap;
}
</style>
