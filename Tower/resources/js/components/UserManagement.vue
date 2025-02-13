<template>
  <v-container>
    <h4>Usuários Existentes</h4>
    <v-list>
      <v-list-item-group>
        <v-list-item v-for="usuario in usuarios" :key="usuario.id" class="bg-dark text-white">
          <v-list-item-content>
            <v-list-item-title>{{ usuario.Nome }}</v-list-item-title>
          </v-list-item-content>
          <v-list-item-action>
            <v-btn @click="openEditUser (usuario)" color="warning" small>Editar</v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list-item-group>
    </v-list>

    <!-- Modal para Editar Usuário -->
    <v-dialog v-model="editDialog" max-width="600px">
      <v-card>
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
              v-model="selectedUser.Nome"
              label="Nome"
              :rules="[v => !!v || 'Nome é obrigatório']"
              required
            ></v-text-field>
            <v-select
              v-model="selectedUser.função"
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
      selectedUser: {}, // Armazena o usuário selecionado para edição
      editDialog: false, // Controle do modal de edição
      funcoes: [
        { value: 1, text: 'Mestre' }, // Role for Game Master
        { value: 2, text: 'Jogador' }, // Role for Player
        { value: 3, text: 'Visitante' }, // Role for Visitor
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
    async saveUser  () {
      if (this.$refs.form.validate()) {
        try {
          await axios.put(`/api/usuarios/${this.selectedUser.id}`, {
            Nome: this.selectedUser.Nome,
            função: this.selectedUser.função,
          });
          this.snackbarMessage = 'Usuário editado com sucesso!';
          this.snackbar = true; // Exibe o snackbar
          this.fetchUsuarios(); // Atualiza a lista de usuários
          this.closeEditDialog(); // Fecha o modal
        } catch (error) {
          // Exibe a mensagem de erro do servidor, se disponível
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
.bg-dark {
  background-color: #343a40 !important; /* Cor de fundo escura */
}
.text-white {
  color: white !important; /* Cor do texto branca */
}
</style>