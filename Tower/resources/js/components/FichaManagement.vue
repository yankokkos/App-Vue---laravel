<template>
    <v-container>
      <v-row>
        <v-col v-for="ficha in fichas" :key="ficha.id" cols="12" md="4" lg="3">
          <v-card class="bg-dark text-white">
            <v-img
              :src="ficha.aparencia_personalidade"
              alt="Aparência do Personagem"
              class="white--text"
              height="150px"
              width="150px"
              contain
            >
              <v-container fill-height>
                <v-row align="center" justify="center">
                  <v-avatar size="100" class="mx-auto">
                    <v-img :src="ficha.aparencia_personalidade" />
                  </v-avatar>
                </v-row>
              </v-container>
            </v-img>
            <v-card-title class="text-center">{{ ficha.nome }}</v-card-title>
            <v-card-subtitle class="text-center">Jogador: {{ ficha.jogador }}</v-card-subtitle>
            <v-card-actions class="justify-center">
              <v-btn :href="'ficha.php?id=' + ficha.id" color="success">Usar Ficha</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
  data() {
    return {
      usuario: {}, // Armazena as informações do usuário
      fichas: [], // Array para armazenar as fichas
    };
  },
  mounted() {
    this.fetchUserData(); // Chama a função para buscar os dados do usuário ao montar o componente
  },
  methods: {
    async fetchUserData() {
      try {
        const response = await axios.get('/api/user'); // Ajuste a URL conforme necessário
        this.usuario = response.data; // Supondo que a resposta contenha os dados do usuário
        this.fetchFichas(); // Chama a função para buscar as fichas após obter os dados do usuário
      } catch (error) {
        console.error('Erro ao buscar dados do usuário:', error);
        this.$router.push('/login'); // Redireciona para a página de login se houver erro
      }
    },
    async fetchFichas() {
      try {
        let response;
        if (this.usuario.função === 1) { // Se o usuário for mestre
          response = await axios.get('/api/fichas'); // Busca todas as fichas
        } else {
          response = await axios.get(`/api/fichas?usuario_id=${this.usuario.id}`); // Busca apenas as fichas do usuário
        }
        this.fichas = response.data; // Supondo que a resposta contenha as fichas
      } catch (error) {
        console.error('Erro ao buscar fichas:', error);
      }
    },
  },
};
  </script>
  
  <style scoped>
  .v-card {
    margin-bottom: 20px; /* Espaçamento entre os cartões */
  }
  </style>