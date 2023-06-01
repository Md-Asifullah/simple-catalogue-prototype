import "./bootstrap";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.min.js";
import "bootstrap-vue/dist/bootstrap-vue.css";

import { createApp } from "vue";

import app from "./components/app.vue";

import router from "./router/index.js";

createApp(app).use(router).mount("#app");
