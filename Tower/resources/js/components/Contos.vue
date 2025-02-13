<template>
    <v-container>
      <v-row>
        <v-col
          v-for="conto in contos"
          :key="conto.id"
          cols="6"
          md="4"
          lg="2"
        >
          <v-card class="bg-dark text-white mb-4">
            <v-img
              :src="conto.imagem"
              height="150"
              contain
            ></v-img>
            <v-card-title>{{ conto.titulo }}</v-card-title>
            <v-card-subtitle>
              <strong>Autor:</strong> {{ conto.autor }}
            </v-card-subtitle>
            <v-card-subtitle>
              <strong>Categoria:</strong> {{ conto.categoria }}
            </v-card-subtitle>
            <v-card-text>{{ conto.resumo }}</v-card-text>
            <v-card-actions>
              <v-btn color="success" :href="'ler_conto.php?id=' + conto.id">Ler</v-btn>
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
        contos: [
          {
            id: 1,
            titulo: "Título do Conto 1",
            resumo: "Resumo do conto 1. Este é um breve resumo que descreve o conteúdo do conto.",
            autor: "Autor 1",
            categoria: "Conto",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 2,
            titulo: "Título do Conto 2",
            resumo: "Resumo do conto 2. Este é um breve resumo que descreve o conteúdo do conto.",
            autor: "Autor 2",
            categoria: "Ficção",
            imagem: "https://via.placeholder.com/150",
          },
          {
            id: 3,
            titulo: "Título do Conto 3",
            resumo: "Resumo do conto 3. Este é um breve resumo que descreve o conteúdo do conto.",
            autor: "Autor 3",
            categoria: "Conto",
            imagem: "https://via.placeholder.com/150",
          },
          // Adicione mais contos conforme necessário
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