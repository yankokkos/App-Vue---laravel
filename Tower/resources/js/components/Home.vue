<!-- resources/js/components/Home.vue -->
<template>
  <v-container>
    <h1>Bem-vindo, {{ user.Nome }}!</h1>
    <v-btn @click="logout" color="red">Logout</v-btn>

    <v-alert v-if="errorMessage" type="error">{{ errorMessage }}</v-alert>
    <v-alert v-else-if="!userFichas.length" type="info">Você não tem fichas cadastradas.</v-alert>

    <h2>Menu</h2>
        
    <div class="components">
      <div v-if="user.função === 1 || user.função === 2"> <!-- Mestre ou Jogador -->
        <v-divider></v-divider>
        <h2 class="text-yellow-500">Gerenciar Fichas</h2>
        <FichaManagement v-if="user.função === 1 || user.função === 2" />
      </div>

      <div v-if="user.função === 1"> <!-- Apenas para Mestres -->
        <v-divider></v-divider>
        <h2 class="text-yellow-500">Gerenciar Usuários</h2>
        <UserManagement /> <!-- Componente de gerenciamento de usuários -->
      </div>

      <v-divider></v-divider>
      <h2 class="text-yellow-500">Contos</h2>
      <Contos /> <!-- Componente de contos -->
      
      <v-divider></v-divider>
      <h2 class="text-yellow-500">Relatórios</h2>
      <Relatorios /> <!-- Componente de relatórios -->
      
      <v-divider></v-divider>
      <h2 class="text-yellow-500">Biografias</h2>
      <Biografias /> <!-- Componente de biografias -->
    </div>

    <v-divider></v-divider>

    <v-btn @click="showCreateFichaDialog" color="blue">Criar Nova Ficha</v-btn>

    <v-dialog v-model="createDialog" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Criar Ficha</span>
        </v-card-title>
        <v-card-text>
          <v-text-field v-model="newFicha.nome" label="Nome" required></v-text-field>
          <v-textarea v-model="newFicha.descricao" label="Descrição"></v-textarea>
          <!-- Adicione outros campos conforme necessário -->
        </v-card-text>
        <v-card-actions>
          <v-btn @click="createFicha" color="green">Salvar</v-btn>
          <v-btn @click="createDialog = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import axios from 'axios';
import FichaManagement from './FichaManagement.vue';
import UserManagement from './UserManagement.vue';
import Contos from './Contos.vue';
import Relatorios from './Relatorios.vue';
import Biografias from './Biografias.vue';

export default {
  data() {
    return {
      user: {},
      userFichas: [],
      errorMessage: '',
      createDialog: false,
      newFicha: {
        nome: '',
        descricao: '',
        // Adicione outros campos conforme necessário
      },
    };
  },
  mounted() {
    this.fetchUserData(); // Corrigido: Removido espaço em branco
    this.fetchUserFichas(); // Corrigido: Removido espaço em branco
  },
  methods: {
    async fetchUserData() { // Corrigido: Removido espaço em branco
      try {
        const response = await axios.get('/api/user');
        this.user = response.data;
      } catch (error) {
        this.errorMessage = 'Erro ao recuperar informações do usuário.';
      }
    },
    async fetchUserFichas() { // Corrigido: Removido espaço em branco
      try {
        const response = await axios.get('/api/fichas');
        this.userFichas = response.data;
      } catch (error) {
        this.errorMessage = 'Erro ao recuperar suas fichas.';
      }
    },
    async createFicha() {
      try {
        await axios.post('/fichas', this.newFicha);
        this.createDialog = false;
        this.newFicha = { nome: '', descricao: '' }; // Limpa os campos
        this.fetchUserFichas(); // Atualiza a lista de fichas
      } catch (error) {
        this.errorMessage = 'Erro ao criar ficha.';
      }
    },
    async deleteFicha(id) {
      try {
        await axios.delete(`/fichas/${id}`);
        this.fetchUserFichas(); // Atualiza a lista de fichas
      } catch (error) {
        this.errorMessage = 'Erro ao deletar ficha.';
      }
    },
    editFicha(id) {
      // Lógica para editar a ficha (pode abrir um diálogo ou redirecionar para uma página de edição)
      console.log(`Editando ficha com ID: ${id}`);
      // Aqui você pode implementar a lógica para abrir um diálogo de edição
    },
    async logout() {
      try {
        await axios.post('/logout');
        this.$router.push('/login'); // Redireciona para a página de login
      } catch (error) {
        this.errorMessage = 'Erro ao fazer logout.';
      }
    },
  },
  components: {
    FichaManagement,
    UserManagement,
    Contos,
    Relatorios,
    Biografias,
  },
};
</script>