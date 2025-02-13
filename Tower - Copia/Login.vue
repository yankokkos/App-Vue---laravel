<template>
  <div class="bg">  
    <canvas :style="{ width: '90vh ', height: '90vh ' }" class="background-canvas"  ref="el"></canvas>
  </div>
  <v-container class="login-container">
    <div class="form-container">
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
    </div>
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
    const nome = ref('');
    const senha = ref('');
    const errorMessage = ref('');

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

    onMounted(() => {
      const canvasSize = 90 * window.innerHeight / 100; // 60% da altura da viewport
      createGlobe(el.value, {
        devicePixelRatio: 2,
        width: canvasSize * 2, // Largura em pixels
        height: canvasSize * 2, // Altura em pixels
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
      nome,
      senha,
      errorMessage,
      login,
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

.bg{
  position: absolute; /* Posiciona o canvas atrás dos outros elementos */
  width: 100%;
  height: 100%;
  display: flex;
    vertical-align: middle;
    align-items: center;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
    z-index: 0; /* Coloca o canvas atrás */
    
}
.background-canvas {
  align-items: center;
  width: 100%;
  height: 100%;
}

.form-container {
  position: relative; /* Para que o formulário fique acima do canvas */
  z-index: 1; /* Coloca o formulário acima do canvas */
  background: rgba(30, 30, 30, 0.60); /* Fundo semi-transparente para melhor legibilidade */
  padding: 20px; /* Adiciona um pouco de espaço interno */
  border-radius: 8px; /* Bordas arredondadas */
}
</style>