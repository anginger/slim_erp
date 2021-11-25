import Vue from 'vue'
import VueRouter from 'vue-router'
import manage from "./manage";
import Manage from "../views/Manage";

Vue.use(VueRouter)

const routes = [
  {
    path: '/manage',
    name: 'Manage',
    component: Manage,
    children: manage
  }
]

const router = new VueRouter({
  routes
})

export default router
