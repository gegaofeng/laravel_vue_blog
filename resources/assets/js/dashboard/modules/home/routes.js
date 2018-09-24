export default [{
    path: '/',
    redirect: {name: 'dashboard.home'},
}, {
    name: 'dashboard.home',
    path: 'home',
    meta:{
        title:'sidebar.dashboard'
    },
    component: () => import('./Home'),
}]