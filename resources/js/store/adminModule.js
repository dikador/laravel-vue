export const cardModule = {
   state: () => ({
      posts: [],
      loading: true
   }),

   actions: {
      async fetchPosts({ commit }, url) {
         await axios.get(url)
            .then(response => {
               commit('setLoading', false)
               commit('setPosts', response.data)
            })
            .catch(error => console.log('Ошибка ' + error));
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
      setLoading(state, data) {
         return state.loading = data;
      }
   },

   namespaced: true
}