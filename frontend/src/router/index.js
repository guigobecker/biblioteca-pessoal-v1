import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import Create from '../views/Create.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },

    {
      path: '/create',
      name: 'create',
      component: Create
    }
  ]
})

export default router
