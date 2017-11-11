module.exports = [
    {
        path: '/',
        component: require('./views/Dashboard'),
    },
    {
        path: '*',
        component: require('./views/404'),
    },
    {
        path: '/pages',
        component: require('./views/Pages'),
    },
    {
        path: '/buckets',
        component: require('./views/Buckets'),
    },
    {
        path: '/templates',
        component: require('./views/Templates'),
    }
];