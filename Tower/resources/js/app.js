// Importando o Bootstrap e Vue
import './bootstrap';
import { createApp } from 'vue';
import { createVuetify } from 'vuetify'; // Importando Vuetify
import 'vuetify/styles'; // Importando estilos do Vuetify
import * as components from 'vuetify/components'; // Importando todos os componentes
import * as directives from 'vuetify/directives'; // Importando todas as diretivas
import router from './router'; // Importando o router

// Importando o componente principal
import App from './App.vue'; // Importando o componente App

// Criando uma instância do Vuetify
const vuetify = createVuetify({
    components,
    directives,
});

// Criando a aplicação Vue
const app = createApp(App); // Passando o componente App como argumento

// Usando o Vuetify e o Router
app.use(vuetify);
app.use(router);

// Montando a aplicação no elemento com id "app"
app.mount('#app');