import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

const app = createApp(App);

// axios
import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.post["Content-Type"] = "multipart/form-data";

// bootstrap
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

//vue-feather
import VueFeather from "vue-feather";

//Sweetalert
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

app.use(router);
app.use(VueSweetalert2);
app.component(VueFeather.name, VueFeather);

app.mount("#app");
