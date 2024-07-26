import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '@/views/HomeView.vue'

const routes = [
  {
    meta: {
      title: 'Home'
    },
    path: '/',
    name: 'style',
    component: Home
  },
  {
    meta: {
      title: 'Error'
    },
    path: '/error',
    name: 'error',
    component: () => import('@/views/ErrorView.vue')
  },
  {
  meta: {
    title: 'Create'
  },
  path: '/create',
  name: 'create',
  component: () => import('@/views/CreateView.vue')
  },
  {
  meta: {
    title: 'Cadastrar'
  },
  path: '/create',
  name: 'create',
  component: () => import('@/views/CreateView.vue')
  },
  {
  meta: {
    title: 'Editar'
  },
  path: '/edit',
  name: 'edit',
  component: () => import('@/views/EditView.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { top: 0 }
  }
})

export default router
