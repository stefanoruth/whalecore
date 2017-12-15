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
        path: '/content',
        component: require('./views/Content'),
    },
    {
        path: '/content/:id',
        name: 'content.edit',
        component: require('./content-builder/ContentEditor'),
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
    {
        path: '/media',
        component: require('./views/MediaLibrary'),
    },
    {
        path: '/settings',
        component: require('./views/Settings'),
    }
];