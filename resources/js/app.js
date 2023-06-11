import "./bootstrap";
import { createApp } from "vue";
import router from "./router";

const app = createApp({});

// app.component("my-app", myApp);

import myApp from "./App.vue";
import ExampleComponent from "./components/ExampleComponent.vue";

const components = {
    ExampleComponent,
    myApp,
};

Object.entries(components).forEach(([name, component]) => {
    app.component(name, component);
});

app.use(router);
app.mount("#app");
