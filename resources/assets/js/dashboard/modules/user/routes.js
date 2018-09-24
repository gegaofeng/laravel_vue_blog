export default [{
    path: 'users',
    component: () => import ('js/App.vue'),
    children: [{
        path: '/',
        name: 'dashboard.user',
        meta:{
            title:'sidebar.user',
        },
        component: () =>
            import ('./User')
    }, {
        path: 'create',
        name: 'dashboard.user.create',
        meta:{
            title:'创建用户',
        },
        component: () =>
            import ('./Create')
    }, {
        path: ':id/edit',
        name: 'dashboard.user.edit',
        component: () =>
            import ('./Edit')
    }]
}]
