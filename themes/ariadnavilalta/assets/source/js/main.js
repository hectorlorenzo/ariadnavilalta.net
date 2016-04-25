var Vue = require('vue'),
    VueResource = require('vue-resource'),
    VueRouter = require('vue-router'),

    ProjectWrapper = require('./components/project-wrapper'),
    ProjectThumbnail = require('./components/project-thumbnail'),
    ProjectDetails = require('./components/project-details');

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.component('project-wrapper', ProjectWrapper);
Vue.component('project-thumbnail', ProjectThumbnail);

var Foo = Vue.extend({
    template: '<p>This is foo!</p>'
})

var App = Vue.extend({});

var router = new VueRouter();

router.map({
    '/projects': {
        component: ProjectWrapper
    },
    '/project/:pid': {
        name: 'project',
        component: ProjectDetails
    }
});

router.start(App, '#content');
