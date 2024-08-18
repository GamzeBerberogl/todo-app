<template>
    <div class="min-h-screen flex items-center justify-center"> 
      <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm">
        <div class="flex justify-center mb-6 items-center border-b border-[#1679AB]"> 
          <button
            :class="['text-xl font-bold pb-2 px-4', isLogin ? 'text-[#074173]' : 'text-[#1679AB]']" 
            @click="toggleForm(true)"
          >
            Giriş Yap
          </button>
          <span class="text">|</span> 
          <button
            :class="['text-xl font-bold pb-2 px-4', !isLogin ? 'text-[#074173]' : 'text-[#1679AB]']" 
            @click="toggleForm(false)"
          >
            Kayıt Ol
          </button>
        </div>
        <h2 class="text-3xl font-bold text-[#074173] mb-6 text-center">{{ isLogin ? '' : '' }}</h2>
        <form @submit.prevent="isLogin ? login() : register()">
          <div v-if="!isLogin" class="mb-4">
            <label class="block text-[#074173] text-sm font-bold mb-2" for="name">İsim</label> 
            <input
              v-model="name"
              class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]"
              type="text"
              id="name"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-[#074173] text-sm font-bold mb-2" for="email">Email</label> 
            <input
              v-model="email"
              class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]" 
              type="email"
              id="email"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-[#074173] text-sm font-bold mb-2" for="password">Şifre</label> 
            <input
              v-model="password"
              class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]" 
              type="password"
              id="password"
              required
            />
          </div>
          <div v-if="!isLogin" class="mb-4">
            <label class="block text-[#074173] text-sm font-bold mb-2" for="password_confirmation">Şifre Tekrar</label> 
            <input
              v-model="passwordConfirmation"
              class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]" 
              type="password"
              id="password_confirmation"
              required
            />
          </div>
          <button
            type="submit"
            class="w-full py-3 px-4 bg-[#074173] text-white font-bold rounded-full hover:bg-[#1679AB] transition-colors"
          >
            {{ isLogin ? 'Giriş Yap' : 'Register' }}
          </button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { API_URL } from '@/config';
  
  export default {
    data() {
      return {
        isLogin: true,
        name: '',
        email: '',
        password: '',
        passwordConfirmation: '',
      };
    },
    methods: {
      toggleForm(login) {
        this.isLogin = login;
      },
      async login() {
  try {
    const response = await axios.post(`${API_URL}/auth/login`, {
      email: this.email,
      password: this.password,
    });

    const token = response.data.token;
    localStorage.setItem('token', token);
    this.$router.push('/todos');
  } catch (error) {
    if (error.response && error.response.data && error.response.data.message) {
      alert(`Giriş başarısız: ${error.response.data.message}`);
    } else {
      console.error('Login failed:', error);
      alert('Giriş başarısız. Lütfen bilgilerinizi kontrol edin.');
    }
  }
},

async register() {
  try {
    await axios.post(`${API_URL}/auth/register`, {
      name: this.name,
      email: this.email,
      password: this.password,
      password_confirmation: this.passwordConfirmation,
    });
    this.toggleForm(true); 
  } catch (error) {
    if (error.response && error.response.data && error.response.data.message) {
      alert(`Kayıt işlemi başarısız: ${error.response.data.message}`);
    } else {
      console.error('Kayıt işlemi başarısız:', error);
      alert('Kayıt işlemi başarısız. Lütfen tekrar deneyin.');
    }
  }
}

    },
  };
  </script>
  
  <style scoped>
  body {
    font-family: 'Arial', sans-serif;
  }
  
  .input {
    transition: all 0.3s ease-in-out;
  }
  
  input:focus {
    box-shadow: 0 0 10px rgba(93, 235, 215, 0.8); 
  }
  
  .toggle-container {
    border-bottom: 1px solid #1679AB; 
  }
  
  .toggle-button.active {
    color: #074173; 
  }
  
  .toggle-button:not(.active) {
    color: #1679AB; 
  }
  
  .toggle-container span {
    color: #074173; 
  }
  </style>
  