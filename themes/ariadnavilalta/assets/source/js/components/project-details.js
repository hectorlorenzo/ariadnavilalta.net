var Vue = require('vue');

module.exports = (function() {

    return Vue.extend({

        template: document.getElementById('project-details-template').innerHTML,

        ready: function() {

            var resource = this.$resource('api/projects/' + this.$route.params.pid);

            // get item
            resource.get().then(function (response) {
                console.log(response);
            });

        }

    });

})();
