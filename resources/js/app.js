/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue           from 'vue'
import Notifications from 'vue-notification'
import BootstrapVue from 'bootstrap-vue'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)
Vue.use(VModal)
Vue.use(Notifications);

require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent').default);
Vue.component('items-component', require('./components/ItemsComponent').default);
Vue.component('modal-component', require('./components/ModalComponent').default);
Vue.component('table-component', require('./components/TableComponent').default);
Vue.component('list-component', require('./components/ListComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {

    },
    created()
    {
        // window.Echo.private('item.created')
        //     .listen('itemadded', (e) => {
        //         this.$notify({
        //             group: 'foo',
        //             title: 'Important message',
        //             text: 'finally'
        //         });
        //     });
    },
    methods: {
        copyText(item) {
            navigator.clipboard.writeText(item);
        }
    },
    // data: {
    //     items: {}
    // },

    // created()
    // {
    //     window.Echo.private('item.created')
    //         .listen('ItemCreated', (e) => {
    //             this.$notify({
    //                 group: 'foo',
    //                 title: 'Important message',
    //                 text: 'FINALLY'
    //             });
    //         });
    // },
    // methods() {
        // Echo.private('item.created')
        //     .listen('ItemCreated', (e) => {
        //         alert(e.item.name + 'has been published now');
        //         console.log(e.item.name)
        //         console.log("Loaded")
        //     });


        // addItem()
        // {
        //     window.Echo.private('item.created')
        //         .listen('itemAdded', (e) => {
        //             alert('hi!')
        //         });
        // }
    // }
});
