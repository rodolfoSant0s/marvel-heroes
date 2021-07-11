import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import HeroStories from '../views/HeroStories'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/hero/stories/:id',
    name: 'HomeStories',
    component: HeroStories
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
