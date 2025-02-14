<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <h4 class="mb-2">Usuários Existentes</h4>
      </v-col>
    </v-row>
    <v-row>
      <v-col v-for="usuario in usuarios" :key="usuario.id" 
            cols="8"   
            sm="6"      
            md="4"     
            lg="2">
        <v-card class="User1 text-white" elevation="16">
          <v-card-title>{{ usuario.Nome }}</v-card-title>
          <v-card-actions>
            <v-btn @click="openEditUser (usuario)" color="warning" small>Editar</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <!-- Modal para Editar Usuário -->
    <v-dialog v-model="editDialog" max-width="600px">
      <v-card class="User2 text-white">
        <v-card-title>
          <span class="headline">Editar Usuário</span>
          <v-spacer></v-spacer>
          <v-btn icon @click="closeEditDialog">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid">
            <v-text-field
              v-model="selectedUser .Nome"
              label="Nome"
              :rules="[v => !!v || 'Nome é obrigatório']"
              required
            ></v-text-field>
            <v-select
              v-model="selectedUser .função"
              :items="funcoes"
              item-value="value"
              item-title="text"
              label="Função"
              :rules="[v => !!v || 'Função é obrigatória']"
              required
            ></v-select>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveUser " color="success">Salvar Alterações</v-btn>
          <v-btn @click="closeEditDialog">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Snackbar para feedback -->
    <v-snackbar v-model="snackbar" :timeout="3000">
      {{ snackbarMessage }}
      <v-btn color="pink" text @click="snackbar = false">Fechar</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuarios: [], // Armazena a lista de usuários
      selectedUser:  {}, // Armazena o usuário selecionado para edição
      editDialog: false, // Controle do modal de edição
      funcoes: [
        { value: 1, text: 'Mestre' }, // Função para Mestre
        { value: 2, text: 'Jogador' }, // Função para Jogador
        { value: 3, text: 'Visitante' }, // Função para Visitante
      ],
      valid: false, // Validação do formulário
      snackbar: false, // Controle do snackbar
      snackbarMessage: '', // Mensagem do snackbar
    };
  },
  mounted() {
    this.fetchUsuarios(); // Busca a lista de usuários ao montar o componente
  },
  methods: {
    async fetchUsuarios() {
      try {
        const response = await axios.get('/api/usuarios'); // Ajuste a URL conforme necessário
        this.usuarios = response.data; // Armazena a lista de usuários
      } catch (error) {
        console.error('Erro ao buscar usuários:', error);
      }
    },
    openEditUser (usuario) {
      this.selectedUser  = { ...usuario }; // Clona o usuário selecionado
      this.editDialog = true; // Abre o modal de edição
    },
    closeEditDialog() {
      this.editDialog = false; // Fecha o modal de edição
    },
    async saveUser () {
      if (this.$refs.form.validate()) {
        try {
          await axios.put(`/api/usuarios/${this.selectedUser .id}`, {
            Nome: this.selectedUser .Nome,
            função: this.selectedUser .função,
          });
          this.snackbarMessage = 'Usuário editado com sucesso!';
          this.snackbar = true; // Exibe o snackbar
          this.fetchUsuarios(); // Atualiza a lista de usuários
          this.closeEditDialog(); // Fecha o modal
        } catch (error) {
          const errorMessage = error.response?.data?.message || 'Erro ao editar usuário. Tente novamente.';
          this.snackbarMessage = errorMessage;
          this.snackbar = true; // Exibe o snackbar
          console.error('Erro ao editar usuário:', error);
        }
      }
    }
  },
};
</script>

<style scoped>

/* Estilo para o fundo escuro */
.User1 {
  display: grid;
  place-items: center;
  place-content: center;
  height: 13vh;
  background-color: rgba(10, 20, 10, 0.90) !important; /* Cor de fundo escura e semi-transparente */
}

.User2 {
  height: 13vh;
  background-color: rgba(10, 20, 10, 0.90) !important; /* Cor de fundo escura e semi-transparente */
}

/* Estilo para o texto branco */
.text-white {
  color: rgb(255, 255, 255) !important; /* Cor do texto branca */
}

/* Estilo para o botão de edição */
.v-btn {
  transition: background-color 0.3s; /* Transição suave para o botão */
}

.v-btn:hover {
  background-color: rgba(255, 255, 255, 0.1); /* Efeito hover no botão */
}
</style>