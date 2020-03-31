/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

window.events = new Vue();

window.flash = function(message, level = "success") {
    window.events.$emit("flash", { message, level });
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Departments
Vue.component(
    "index-departments-component",
    require("./components/Departments/Index.vue").default
);
Vue.component(
    "create-update-department-component",
    require("./components/Departments/CreateUpdate.vue").default
);

// Roles
Vue.component(
    "index-roles-component",
    require("./components/Roles/Index.vue").default
);
Vue.component(
    "create-update-role-component",
    require("./components/Roles/CreateUpdate.vue").default
);

// Users
Vue.component(
    "index-users-component",
    require("./components/Users/Index.vue").default
);
Vue.component(
    "create-update-users-component",
    require("./components/Users/CreateUpdate.vue").default
);
Vue.component(
    "update-users-department-component",
    require("./components/Users/EditDepartment.vue").default
);

// Utilities
Vue.component("flash", require("./components/Utilities/Flash.vue").default);
Vue.component(
    "submit-button",
    require("./components/Utilities/SubmitButton.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
