import { createRouter, createWebHashHistory } from 'vue-router'
import Login from '../components/login-page.vue'

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/Dashboard',
    name: 'Dashboard-page',
    component: () => import('../components/Dashboard.vue'),
    meta: {
      requiresAuth: true
    }
  }
  // {
  //   path: '/login',
  //   name: 'login',
  //   component: () => import('../components/login-page.vue')
  // }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
