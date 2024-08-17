import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Todos from '@/views/Todos.vue';
import CreateTodo from '@/views/CreateTodo.vue';
import EditTodo from '@/views/EditTodo.vue'; 
import Profile from '@/views/Profile.vue';
import ProfileEdit from '@/views/ProfileEdit.vue';
import ChangePassword from '@/views/ChangePassword.vue';
import Auth from '@/views/Auth.vue'; 

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/todos', name: 'Todos', component: Todos, meta: { requiresAuth: true } },
  { path: '/create-todo', name: 'CreateTodo', component: CreateTodo, meta: { requiresAuth: true } },
  { path: '/todos/:id/edit', name: 'EditTodo', component: EditTodo, meta: { requiresAuth: true } }, 
  { path: '/profile', name: 'Profile', component: Profile, meta: { requiresAuth: true } },
  { path: '/profile/edit', name: 'ProfileEdit', component: ProfileEdit, meta: { requiresAuth: true } },
  { path: '/profile/change-password', name: 'ChangePassword', component: ChangePassword, meta: { requiresAuth: true } },
  { path: '/auth', name: 'Auth', component: Auth }, 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token');

  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: 'Auth' });  
  } else {
    next();
  }
});

export default router;
