<template>
  <div class="bg">  
    <canvas :style="{ width: '90vh', height: '90vh' }" class="background-canvas" ref="el"></canvas>
  </div>
  <v-container class="login-container">
    <v-card elevation="16">
      <v-tabs v-model="tab" bg-color="primary">
        <v-tab value="login">Login</v-tab>
        <v-tab value="register">Cadastro</v-tab>
      </v-tabs>

      <v-card-text elevation="16">
        <v-tabs-window v-model="tab">
          <v-tabs-window-item value="login">
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
          </v-tabs-window-item>

          <v-tabs-window-item value="register">
            <v-form @submit.prevent="register">
              <v-text-field
                label="Nome"
                v-model="newNome"
                required
              ></v-text-field>
              <v-text-field
                label="Senha"
                type="password"
                v-model="newSenha"
                required
              ></v-text-field>
              <v-btn type="submit" color="primary">Cadastrar</v-btn>
              <v-alert v-if="registerErrorMessage" type="error">{{ registerErrorMessage }}</v-alert>
            </v-form>
          </v-tabs-window-item>
        </v-tabs-window>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import createGlobe from 'cobe';

export default {
  setup() {
    const router = useRouter();
    const el = ref(null);
    const phi = ref(0);
    const tab = ref('login'); // Controla a aba ativa
    const nome = ref('');
    const senha = ref('');
    const newNome = ref('');
    const newSenha = ref('');
    const errorMessage = ref('');
    const registerErrorMessage = ref('');

    const login = async () => {
      try {
        const response = await axios.post('/login', {
          Nome: nome.value,
          senha: senha.value
        });
        console.log('Login bem-sucedido:', response.data);
        router.push('/'); // Redireciona para a home após o login
      } catch (error) {
        errorMessage.value = 'Credenciais inválidas';
      }
    };

    const register = async () => {
      try {
        const response = await axios.post('/register', {
          Nome: newNome.value,
          senha: newSenha.value,
          funcao: '3' // Define a função como Visitante
        });
        console.log('Cadastro bem-sucedido:', response.data);
        // Você pode redirecionar ou mostrar uma mensagem de sucesso
      } catch (error) {
        registerErrorMessage.value = 'Erro ao cadastrar. Tente novamente.';
      }
    };

    onMounted(() => {
      const canvasSize = 90 * window.innerHeight / 100; // 90% da altura da viewport
      createGlobe(el.value, {
        devicePixelRatio: 2,
        width: canvasSize * 2,
        height: canvasSize * 2,
        phi: 0,
        theta: 0,
        offset: [1, 1],
        dark: 1,
        diffuse: 1.2,
        mapSamples: 16000,
        mapBrightness: 6,
        baseColor: [0.1, 0.3, 0.1],
        markerColor: [0.9, 0.6, 0.3],
        glowColor: [0.1, 1, 0.1],
        markers: [
          { location: [37.7595, -122.4367], size: 0.03 },
          { location: [40.7128, -74.006], size: 0.1 },
        ],
        onRender: (state) => {
          state.phi = phi.value;
          phi.value += 0.01;
        },
      });
    });

    return {
      el,
      tab,
      nome,
      senha,
      newNome,
      newSenha,
      errorMessage,
      registerErrorMessage,
      login,
      register,
    };
  },
};
</script>

<style scoped>
.login-container {
  position: relative; /* Para permitir o posicionamento absoluto dos filhos */
  max-width: 400px;
  margin: auto;
  padding: 20px;
}

.bg {
  position: absolute; /* Posiciona o canvas atrás dos outros elementos */
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 0; /* Coloca o canvas atrás */
}

.background-canvas {
  width: 100%;
  height: 100%;
}

.v-card {
  background: rgba(10, 20, 10, 0.90); /* Fundo semi-transparente para melhor legibilidade */
  border-radius: 8px; /* Bordas arredondadas */
  color: rgb(0 255 0 / 90%);
  box-shadow: 0 8px 10px -5px var(--v-shadow-key-umbra-opacity, rgba(0, 0, 0, .2)), 0 16px 24px 2px var(--v-shadow-key-penumbra-opacity, rgba(0, 0, 0, .14)), 0 6px 30px 5px var(--v-shadow-key-ambient-opacity, rgba(0, 0, 0, .12)) !important;
  
}

.bg-primary {
  box-shadow: 0 8px 10px -5px var(--v-shadow-key-umbra-opacity, rgba(0, 0, 0, .2)), 0 16px 24px 2px var(--v-shadow-key-penumbra-opacity, rgba(0, 0, 0, .14)), 0 6px 30px 5px var(--v-shadow-key-ambient-opacity, rgba(0, 0, 0, .12)) !important;
    --v-theme-overlay-multiplier: var(--v-theme-primary-overlay-multiplier);
    background-color: rgba(30, 60, 30, 0.90) !important;
    color: rgb(var(--v-theme-on-primary)) !important;
}
</style>