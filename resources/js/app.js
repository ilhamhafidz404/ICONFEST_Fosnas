import "./bootstrap";
import { createApp } from "vue";
import router from "./router";

// stisla
import "../../public/template/css/components.css";

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

app.use(router);
app.mount("#app");
