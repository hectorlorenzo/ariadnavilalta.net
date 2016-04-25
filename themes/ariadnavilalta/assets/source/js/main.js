var Vue = require('vue'),
    VueResource = require('vue-resource'),

    ProjectWrapper = require('./components/project-wrapper'),
    ProjectThumbnail = require('./components/project-thumbnail');

Vue.use(VueResource);
Vue.component('project-wrapper', ProjectWrapper);
Vue.component('project-thumbnail', ProjectThumbnail);

new Vue({

    el: '#content'

});
