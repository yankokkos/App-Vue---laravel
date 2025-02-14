<template>
  <v-container fluid>
    <v-row>
      <v-col
        v-for="biografia in biografias"
        :key="biografia.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <v-card class="bg-dark text-white mb-4" elevation="16">
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