<template>
    <v-container>
      <v-row>
        <v-col
          v-for="biografia in biografias"
          :key="biografia.id"
          cols="6"
          md="4"
          lg="2"
        >
          <v-card class="bg-dark text-white mb-4">
            <v-img
              :src="biografia.imagem"
              height="150"
              contain
            ></v-img>
            <v-card-title>{{ biografia.nome }}</v-card-title>
            <v-card-actions>
              <v-btn color="success" :href="'ler_biografia.php?id=' + biografia.id">Ler</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  export default {
    data() {
      return {
        biografias: [
          {
            id: 1,
            nome: "Nome do Agente 1",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 2,
            nome: "Nome do Agente 2",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 3,
            nome: "Nome do Agente 3",
            imagem: "https://via.placeholder.com/150",
          },
          // Adicione mais biografias conforme necessário
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .bg-dark {
    background-color: #343a40 !important;
  }
  .text-white {
    color: #ffffff !important;
  }
  </style>