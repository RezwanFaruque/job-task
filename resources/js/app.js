import "../css/app.css"
import {createApp} from "vue";
import router from "@/routes/index.js";
import App from "./App.vue"
import PrimeVue from 'primevue/config';


    createApp(App)
    .use(router)
    .use(PrimeVue, {
    })
    .mount("#app")


