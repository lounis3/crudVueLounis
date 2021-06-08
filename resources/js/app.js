require('./bootstrap');

window.Vue = require('vue').default;



Vue.component('cliente', require('./components/Cliente').default);
Vue.component('factura', require('./components/Factura').default);
Vue.component('empleado', require('./components/Empleado').default);

const app = new Vue({
    el: '#app',
});
