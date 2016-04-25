var Vue = require('vue');

module.exports = (function() {

    return Vue.extend({

        template: document.getElementById('project-wrapper-template').innerHTML,

        data: function() {
            return {
                items: []
            }
        },

        ready: function() {

            var resource = this.$resource('api/projects/all');

            // get item
            resource.get().then(function (response) {
                this.$set('items', JSON.parse(response.data.data));
            });

        }

    });

})();
