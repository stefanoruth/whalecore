module.exports = [
    {
        path: '/',
        component: require('./views/Dashboard'),
    },
    {
        path: '*',
        component: require('./views/404')
    }
];