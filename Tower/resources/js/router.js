import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue'; // Certifique-se de que o componente Home.vue existe
import Login from './components/Login.vue'; // Importando o componente de Login
import TestScreen from './components/TestScreen.vue'; // Importando o componente de teste

const routes = [
  {
    path: '/test',
    name: 'Test',
    component: TestScreen,
  },
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
