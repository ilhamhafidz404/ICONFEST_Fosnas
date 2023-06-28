import "./bootstrap";
import { createApp } from "vue";
import router from "./router";

// stisla
import "../../public/template/css/components.css";

//
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

// import { QuillEditor } from "@vueup/vue-quill";
// import "@vueup/vue-quill/dist/vue-quill.snow.css";

const app = createApp({});

// app.component("my-app", myApp);

import myApp from "./App.vue";
import navbar from "./components/navbar.vue";
import sidebar from "./components/sidebar.vue";
import feet from "./components/feet.vue";

const components = {
    navbar,
    sidebar,
    feet,
    myApp,
};

Object.entries(components).forEach(([name, component]) => {
    app.component(name, component);
});

// app.component("QuillEditor", QuillEditor);

app.use(router);
app.use(VueSweetalert2);
app.mount("#app");
