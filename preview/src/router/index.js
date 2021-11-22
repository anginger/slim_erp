import Vue from 'vue'
import VueRouter from 'vue-router'
import Overview from '@/views/Overview.vue'
import Users from "@/views/Users";
import Logout from "@/views/Logout";
import Products from "@/views/Products";
import Provider from "@/views/Providers";
import Levels from "@/views/Levels";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Overview
  },
  {
    path: '/users',
    name: 'Users',
    component: Users
  },
  {
    path: '/products',
    name: 'Products',
    component: Products
  },
  {
    path: '/providers',
    name: 'Providers',
    component: Provider
  },
  {
    path: '/levels',
    name: 'Levels',
    component: Levels
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
