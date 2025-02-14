<template>
  <v-container fluid>
    <v-row>
      <v-col
        v-for="conto in contos"
        :key="conto.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <v-card class="bg-dark text-white mb-4" elevation="16">
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
         ],   // Adicione mais contos conforme necessário ],
    };

  },
};
</script>

<style scoped>
.bg-dark {
    display: grid;
    place-items: center;
    place-content: center;
    background-color: rgba(10, 20, 10, 0.90) !important; /* Cor de fundo escura e semi-transparente */
  }

.text-white {
  color: rgb(255, 255, 255) !important; /* Cor do texto branca */
}

.v-btn {
  transition: background-color 0.3s; /* Transição suave para o botão */
}

.v-btn:hover {
  background-color: rgba(255, 255, 255, 0.1); /* Efeito hover no botão */
}

.mb-4 {
  margin-bottom: 16px; /* Ajuste conforme necessário */
}
</style>