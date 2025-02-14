<template>
  <v-container>
    <v-row>
      <v-col
        v-for="ficha in fichas"
        :key="ficha.id"
        cols="12"   
        sm="6"      
        md="4"     
        lg="3"      
      >
        <template v-if="loading">
          <SkeletonLoader />
        </template>
        <template v-else>
          <v-card class="mx-auto my-3" max-width="344">
            <v-container fill-height>
              <v-row align="center" justify="center">
                <v-avatar size="200" class="mx-auto">
                  <v-img :src="ficha.aparencia_personalidade" />
                </v-avatar>
              </v-row>
            </v-container>
            <v-card-title class="text-center">{{ ficha.nome }}</v-card-title>
            <v-card-subtitle class="text-center">Jogador: {{ ficha.jogador }}</v-card-subtitle>
            <v-card-actions class="justify-center">
              <v-btn :href="'ficha.php?id=' + ficha.id" color="success" class="ma-2">Usar Ficha</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';
import SkeletonLoader from './SkeletonLoader.vue'; // Importando o componente de skeleton loader

export default {
  components: {
    SkeletonLoader,
  },
  data() {
    return {
      usuario: {},
      fichas: [],
      loading: true, // Estado de carregamento
    };
  },
  mounted() {
    this.fetchUserData();
  },
  methods: {
    async fetchUserData() {
      try {
        const response = await axios.get('/api/user');
        this.usuario = response.data;
        await this.fetchFichas();
      } catch (error) {
        console.error('Erro ao buscar dados do usuário:', error);
        this.$router.push('/login');
      }
    },
    async fetchFichas() {
      this.loading = true; // Define loading como true antes de buscar as fichas
      try {
        let response;
        if (this.usuario.função === 1) {
          response = await axios.get('/api/fichas');
        } else {
          response = await axios.get(`/api/fichas?usuario_id=${this.usuario.id}`);
        }
        this.fichas = response.data;
      } catch (error) {
        console.error('Erro ao buscar fichas:', error);
      } finally {
        this.loading = false; // Define loading como false após a busca
      }
    },
  },
};
</script>

<style scoped>
.v-card {
  margin-bottom: 20px;
  padding: 6%;
  background: rgba(10, 20, 10, 0.90);
  border-radius: 8px;
  color: rgb(0 255 0 / 90%);
  box-shadow: 0 8px 10px -5px rgba(0, 0, 0, 0.2), 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12);
}

.v-card-title, .v-card-subtitle {
  color: #e0e0e0;
}

.v-btn {
  transition: background-color 0.3s;
}

.v-btn:hover {
  background-color: rgba(0, 255, 0, 0.8);
}
</style>