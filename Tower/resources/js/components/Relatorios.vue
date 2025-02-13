<template>
    <v-container>
      <v-row>
        <v-col
          v-for="relatorio in relatorios"
          :key="relatorio.id"
          cols="6"
          md="4"
          lg="2"
        >
          <v-card class="bg-dark text-white mb-4">
            <v-img
              :src="relatorio.imagem"
              height="150"
              contain
            ></v-img>
            <v-card-title>{{ relatorio.titulo }}</v-card-title>
            <v-card-text>
              <p>{{ relatorio.resumo }}</p>
              <p><strong>Agente:</strong> {{ relatorio.agente }}</p>
            </v-card-text>
            <v-card-actions>
              <v-btn color="success" :href="'ler_relatorio.php?id=' + relatorio.id">Ler</v-btn>
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
        relatorios: [
          {
            id: 1,
            titulo: "Título do Relatório 1",
            resumo: "Resumo do relatório 1. Este é um breve resumo que descreve o conteúdo do relatório.",
            agente: "Agente 1",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 2,
            titulo: "Título do Relatório 2",
            resumo: "Resumo do relatório 2. Este é um breve resumo que descreve o conteúdo do relatório.",
            agente: "Agente 2",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 3,
            titulo: "Título do Relatório 3",
            resumo: "Resumo do relatório 3. Este é um breve resumo que descreve o conteúdo do relatório.",
            agente: "Agente 3",
            imagem: "https://via.placeholder.com/150",
          },
          // Adicione mais relatórios conforme necessário
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