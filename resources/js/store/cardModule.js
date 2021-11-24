export const cardModule = {
   state: () => ({
      posts: [],
      loading: true
   }),

   actions: {
      async fetchPosts({ commit }, url) {
         await axios.get(url[0])
            .then(response => {
               commit('setLoading', false)
               commit('setPosts', response.data)
            })
            .catch(error => {
               url[1].push('../blog')
            });
      },
      async deletePost({ commit }, id) {
         await axios
            .delete(`api/posts/${id}`)
            .then((response) => {
               commit('setDeletePost', id)
            })
            .catch((err) => {
               commit('setDeletePost', id, true)
            });
      }
   },

   getters: {
      sortedPosts(state) {
         if (state.posts.length !== undefined) {
            return [...state.posts].sort((id1, id2) => id2.id - id1.id);
         }
      }
   },

   mutations: {
      setPosts(state, data) {
         return state.posts = data;
      },
      setDeletePost(state, data, err) {
         state.posts = state.posts.filter(post1 => post1.id !== data)

         if (err) {
            this._mutations.setAlertErrorText[0]("Произошла ошибка");
         } else {
            this._mutations.setAlertSuccessText[0]("Пост успешно удален!");
         }

      },
      setLoading(state, data) {
         return state.loading = data;
      }
   },

   namespaced: true
}