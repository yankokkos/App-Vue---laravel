<template>
  <v-container class="login-container">
    <h2>Login</h2>
    <v-form @submit.prevent="login">
      <v-text-field
        label="Nome"
        v-model="nome"
        required
      ></v-text-field>
      <v-text-field
        label="Senha"
        type="password"
        v-model="senha"
        required
      ></v-text-field>
      <v-btn type="submit" color="primary">Login</v-btn>
      <v-alert v-if="errorMessage" type="error">{{ errorMessage }}</v-alert>
    </v-form>
  </v-container>
</template>

<script>


import axios from 'axios';
import { useRouter } from 'vue-router'; // Importando o useRouter

export default {
  data() {
    return {
      nome: '',
      senha: '',
      errorMessage: '',
    };
  },
  setup() {
    const router = useRouter(); // Usando o router
    return { router };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/login', {
          Nome: this.nome,
          senha: this.senha
        });
        console.log('Login bem-sucedido:', response.data);
        this.router.push('/'); // Redireciona para a home após o login
      } catch (error) {
        this.errorMessage = 'Credenciais inválidas';
      }
    }
  }
};
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: auto;
  padding: 20px;
}
</style>