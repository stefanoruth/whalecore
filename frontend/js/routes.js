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
        path: '/pages/:id',
        name: 'page.edit',
        component: require('./content-builder/ContentEditor'),
    },
    {
        path: '/buckets',
        component: require('./views/Buckets'),
    },
    {
        path: '/templates',
        component: require('./views/Templates'),
    },
    {
        path: '/templates/:id',
        name: 'template.edit',
        component: require('./template-builder/TemplateEditor'),
    },
];