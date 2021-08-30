require('./bootstrap');

window.Vue = require('vue').default;

$(function () {
    Vue.component('application-component', require('./components/ApplicationComponent.vue').default);

    const app = new Vue({
        el: '#app',
    });
});
