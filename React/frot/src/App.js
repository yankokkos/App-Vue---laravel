import React, { useRef, useState, useEffect } from 'react';
import axios from 'axios';
import createGlobe from 'cobe';
import './App.css'; // Certifique-se de criar um arquivo CSS para os estilos

const App = () => {
  const el = useRef(null);
  const [phi, setPhi] = useState(0);
  const [tab, setTab] = useState('login');
  const [nome, setNome] = useState('');
  const [senha, setSenha] = useState('');
  const [newNome, setNewNome] = useState('');
  const [newSenha, setNewSenha] = useState('');
  const [errorMessage, setErrorMessage] = useState('');
  const [registerErrorMessage, setRegisterErrorMessage] = useState('');

  const login = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/login', {
        Nome: nome,
        senha: senha,
      });
      console.log('Login bem-sucedido:', response.data);
      // Redirecionar para a home após o login
    } catch (error) {
      setErrorMessage('Credenciais inválidas');
    }
  };

  const register = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/register', {
        Nome: newNome,
        senha: newSenha,
        funcao: '3', // Define a função como Visitante
      });
      console.log('Cadastro bem-sucedido:', response.data);
      // Você pode redirecionar ou mostrar uma mensagem de sucesso
    } catch (error) {
      setRegisterErrorMessage('Erro ao cadastrar. Tente novamente.');
    }
  };

  useEffect(() => {
    const canvasSize = 90 * window.innerHeight / 100; // 90% da altura da viewport
    createGlobe(el.current, {
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
        state.phi = phi;
        setPhi((prev) => prev + 0.01);
      },
    });
  }, [phi]);

  return (
    <div className="bg">
      <canvas style={{ width: '90vh', height: '90vh' }} className="background-canvas" ref={el}></canvas>
      <div className="login-container">
        <div className="logobox">
          <img src="./assets/logo.svg" alt="Logo" className="logo" />
        </div>
        <div className="tabs">
          <button onClick={() => setTab('login')} className={tab === 'login' ? 'active' : ''}>Login</button>
          <button onClick={() => setTab('register')} className={tab === 'register' ? 'active' : ''}>Cadastro</button>
        </div>
        <div className="card-text">
          {tab === 'login' ? (
            <form onSubmit={login}>
              <input
                type="text"
                placeholder="Nome"
                value={nome}
                onChange={(e) => setNome(e.target.value)}
                required
              />
              <input
                type="password"
                placeholder="Senha"
                value={senha}
                onChange={(e) => setSenha(e.target.value)}
                required
              />
              <button type="submit">Login</button>
              {errorMessage && <div className="alert error">{errorMessage}</div>}
            </form>
          ) : (
            <form onSubmit={register}>
              <input
                type="text"
                placeholder="Nome"
                value={newNome}
                onChange={(e) => setNewNome(e.target.value)}
                required
              />
              <input
                type="password"
                placeholder="Senha"
                value={newSenha}
                onChange={(e) => setNewSenha(e.target.value)}
                required
              />
              <button type="submit">Cadastrar</button>
              {registerErrorMessage && <div className="alert error">{registerErrorMessage}</div>}
            </form>
          )}
        </div>
      </div>
    </div>
  );
};

export default App;