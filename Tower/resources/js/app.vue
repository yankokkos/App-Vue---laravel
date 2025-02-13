<!-- resources/js/App.vue -->
<template>
  <v-app>
    <router-view></router-view> <!-- Renderiza o componente correspondente à rota -->
  </v-app>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
html,
body {
  margin: 0;
  background: black;
  color: white;
  font-family: sans-serif;
  text-align: center;
}
.v-application {
    display: flex;
    background: rgb(0 30 0);
    color: rgb(0 255 0 / 90%);
}
.app {
  display: grid;
  place-items: center;
  place-content: center;
  height: 100vh;
}
</style>