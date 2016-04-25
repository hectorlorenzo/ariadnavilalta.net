var Vue = require('vue');

module.exports = (function() {

    return Vue.extend({

        template: document.getElementById('project-thumbnail-template').innerHTML,

        props: ['commentcount']

    });

})();
