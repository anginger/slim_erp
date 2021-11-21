import Vue from 'vue'
import VueRouter from 'vue-router'
import Overview from '@/views/Overview.vue'
import Logout from "@/views/Logout";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Overview
  },
  {
    path: '/logout',
    name: 'Logout',
    component: Logout
  }
]

const router = new VueRouter({
  routes
})

export default router
