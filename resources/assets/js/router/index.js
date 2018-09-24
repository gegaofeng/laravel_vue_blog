import Vue from 'vue'
import Router from 'vue-router'
import beforeEach from './beforeEach'
import {routes as dashboard} from '../dashboard'
import {routes as home} from '../home'

Vue.use(Router);

const AppRoute = {
    path: '/',
    component: () => import('../App.vue'),
    children: [...dashboard],
};

const routes = [AppRoute];

const router = new Router({
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
    mode: 'history',
});

router.beforeEach(beforeEach);
// router.beforeEach((to, from, next) => {
//     window.document.title=to.meta.title;
//     next();
// });
console.log('路由组件')
export default router
