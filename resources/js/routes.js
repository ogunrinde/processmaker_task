import Login from './components/login.vue';
import Register from './components/register.vue';
import List from './components/list.vue';
import CreateRecord from './components/create.vue';

 
export const routes = [
    {
        name: 'login',
        path: '/',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'list',
        path: '/list',
        component: List,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'create',
        path: '/createrecord',
        component: CreateRecord,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'login',
        path: '*',
        redirect: '/'
    },
]