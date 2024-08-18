<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-lg">
      <h2 class="text-3xl font-bold text-[#074173] mb-6 text-center">Şifre Değiştir</h2> 
      <form @submit.prevent="changePassword">
        <div class="mb-4">
          <label for="currentPassword" class="block text-[#074173] text-sm font-bold mb-2">Mevcut Şifre</label> 
          <input
            type="password"
            id="currentPassword"
            v-model="passwords.currentPassword"
            class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]" 
            required
          />
        </div>
        <div class="mb-4">
          <label for="newPassword" class="block text-[#074173] text-sm font-bold mb-2">Yeni Şifre</label>
          <input
            type="password"
            id="newPassword"
            v-model="passwords.newPassword"
            class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]"
            required
          />
        </div>
        <div class="mb-6">
          <label for="confirmPassword" class="block text-[#074173] text-sm font-bold mb-2">Yeni Şifre Tekrar</label> 
          <input
            type="password"
            id="confirmPassword"
            v-model="passwords.confirmPassword"
            class="input w-full px-4 py-2 border border-[#1679AB] rounded-full focus:outline-none focus:ring-2 focus:ring-[#5DEBD7]" 
            required
          />
        </div>
        <div class="flex justify-end">
          <button
            type="submit"
            class="w-full py-3 px-4 bg-[#074173] text-white font-bold rounded-full hover:bg-[#1679AB] transition-colors">
            Değiştir
          </button>
        </div>
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
      passwords: {
        currentPassword: '',
        newPassword: '',
        confirmPassword: '',
      },
    };
  },
  methods: {
    async changePassword() {
      if (this.passwords.newPassword !== this.passwords.confirmPassword) {
        alert('Yeni şifreler eşleşmiyor!');
        return;
      }
      try {
        const token = localStorage.getItem('token');
        await axios.put(`${API_URL}/profile/change-password`, {
          current_password: this.passwords.currentPassword,
          new_password: this.passwords.newPassword,
          confirm_password: this.passwords.confirmPassword
        }, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        alert('Şifre başarıyla değiştirildi!');
        this.$router.push('/profile'); 
      } catch (error) {
        const errorMessage = error.response?.data?.message || 'Şifre değiştirilemedi. Lütfen tekrar deneyin.';
        alert(errorMessage);
        console.error('Şifre değiştirilemedi:', error);
      }
    },
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
.bg-header {
  background-color: transparent;
}
</style>
