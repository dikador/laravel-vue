import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../pages/Home.vue'
import Admin from '../pages/admin/Admin.vue'
import Blog from '../pages/Blog.vue'
import Auth from '../pages/login/Auth.vue'
import Registration from '../pages/login/Registration.vue'
import post from '../pages/post.vue'

Vue.use(VueRouter)

const routes = [
   {
      path: '/',
      component: Home
   },
   {
      path: '/admin',
      component: Admin
   },
   {
      path: '/blog',
      component: Blog
   },
   {
      path: '/post/:id',
      component: post,
   },
   {
      path: '/auth',
      component: Auth,
   },
   {
      path: '/registration',
      component: Registration,
   },
]

const router = new VueRouter({
   mode: 'history',
   base: process.env.BASE_URL,
   routes
})

export default router
