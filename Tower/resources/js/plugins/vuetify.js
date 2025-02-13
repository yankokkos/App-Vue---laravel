import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { createVuetify } from 'vuetify';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    createVuetify() // Adicione o Vuetify aqui
  ],
});