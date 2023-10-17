import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import Create from '../views/Create.vue'
import LivroEdit from '../views/LivroEdit.vue'

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
    },

    {
      path: '/livros/:id/edit',
      name: 'livroEdit',
      component: LivroEdit
    }
  ]
})

export default router
