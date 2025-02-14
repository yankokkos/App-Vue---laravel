<template>
  <v-app>
    <v-navigation-drawer app v-model="drawer" permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>
              <img src="./@/assets/logo.svg" alt="Logo" class="logo" />
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="navigateTo('fichas')">
          <v-list-item-title>Gerenciar Fichas</v-list-item-title>
        </v-list-item>
        <v-list-item v-if="user.função === 1" @click="navigateTo('usuarios')">
          <v-list-item-title>Gerenciar Usuários</v-list-item-title>
        </v-list-item>
        <v-list-item @click="navigateTo('contos')">
          <v-list-item-title>Contos</v-list-item-title>
        </v-list-item>
        <v-list-item @click="navigateTo('relatorios')">
          <v-list-item-title>Relatórios</v-list-item-title>
        </v-list-item>
        <v-list-item @click="navigateTo('biografias')">
          <v-list-item-title>Biografias</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-toolbar-title>Bem-vindo, {{ user.Nome }}!</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="logout" color="red">Logout</v-btn>
    </v-app-bar>

    <v-main>
    <v-container>
      <v-alert v-if="errorMessage" type="error">{{ errorMessage }}</v-alert>
      <v-alert v-else-if="!userFichas.length && !loading" type="info">Você não tem fichas cadastradas.</v-alert>

      <div class="components">
        <div v-if="loading">
          <SkeletonLoader />
        </div>
        <div v-if="!loading">
          <h2 class="text-yellow-500">Conteúdo</h2>
          <component :is="currentComponent" />
        </div>
      </div>

      <v-divider v-if="!loading"></v-divider>

      <v-btn v-if="!loading" @click="showCreateFichaDialog" color="blue">Criar Nova Ficha</v-btn>

      <v-dialog v-model="createDialog" max-width="600px">
        <v-card>
          <v-card-title>
            <span class="headline">Criar Ficha</span>
          </v-card-title>
          <v-card-text>
            <v-text-field v-model="newFicha.nome" label="Nome" required></v-text-field>
            <v-textarea v-model="newFicha.descricao" label="Descrição"></v-textarea>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="createFicha" color="green">Salvar</v-btn>
            <v-btn @click="createDialog = false">Cancelar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </v-main>
  </v-app>
</template>

<script>
import axios from 'axios';
import FichaManagement from './FichaManagement.vue';
import UserManagement from './UserManagement.vue';
import Contos from './Contos.vue';
import Relatorios from './Relatorios.vue';
import Biografias from './Biografias.vue';
import SkeletonLoader from './SkeletonLoader.vue';

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
      },
      loading: true,
      drawer: true,
      currentComponent: 'FichaManagement', // Componente padrão
    };
  },
  mounted() {
    this.fetchUserData();
    this.fetchUserFichas();
  },
  methods: {
    async fetchUserData() {
      try {
        const response = await axios.get('/api/user');
        this.user = response.data;
      } catch (error) {
        this.errorMessage = 'Erro ao recuperar informações do usuário.';
      }
    },
    async fetchUserFichas() {
      this.loading = true;
      try {
        const response = await axios.get('/api/fichas');
        this.userFichas = response.data;
      } catch (error) {
        this.errorMessage = 'Erro ao recuperar suas fichas.';
      } finally {
        this.loading = false;
      }
    },
    async createFicha() {
      try {
        await axios.post('/fichas', this.newFicha);
        this.createDialog = false;
        this.newFicha = { nome: '', descricao: '' };
        this.fetchUserFichas();
      } catch (error) {
        this.errorMessage = 'Erro ao criar ficha.';
      }
    },
    async logout() {
      try {
        await axios.post('/logout');
        this.$router.push('/login');
      } catch (error) {
        this.errorMessage = 'Erro ao fazer logout.';
      }
    },
    navigateTo(component) {
      this.currentComponent = component === 'fichas' ? 'FichaManagement' :
                             component === 'usuarios' ? 'UserManagement' :
                             component === 'contos' ? 'Contos' :
                             component === 'relatorios' ? 'Relatorios' :
                             'Biografias';
    },
  },
  components: {
    FichaManagement,
    UserManagement,
    Contos,
    Relatorios,
    Biografias,
    SkeletonLoader,
  },
};
</script>

<style scoped>
/* Estilo para o Navigation Drawer */
.v-navigation-drawer {
  background-color: rgba(10, 20, 10, 0.95); /* Fundo semi-transparente */
  color: rgb(0 255 0 / 90%); /* Cor do texto */
}

/* Estilo para a Toolbar */
.v-toolbar {
  background-color: rgba(30, 60, 30, 0.90); /* Fundo semi-transparente */
  color: white; /* Cor do texto */
}

/* Estilo para os itens da lista no Navigation Drawer */
.v-list-item--density-default:not(.v-list-item--nav).v-list-item--one-line {
  padding: 10px 20px; /* Espaçamento interno */
  transition: background-color 0.3s; /* Transição suave para o hover */
}

.v-list-item--density-default:not(.v-list-item--nav).v-list-item--one-line:hover {
  background-color: rgba(255, 255, 255, 0.1); /* Efeito de hover */
}

/* Estilo para o título da Toolbar */
.v-toolbar-title {
  font-size: 1.5em; /* Tamanho da fonte */
  font-weight: bold; /* Negrito */
  color: rgb(0 255 0 / 90%); /* Cor do texto */
}
</style>