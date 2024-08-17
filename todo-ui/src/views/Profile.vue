<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white p-8 rounded-xl shadow-2xl" style="margin-top: -100px;"> 
      <h2 class="text-3xl font-bold text-[#074173] mb-6 text-center">Profil Bilgilerim</h2> 
      <div class="flex items-center justify-between py-4 border-b border-[#1679AB]"> 
        <div class="flex items-center">
          <img class="w-16 h-16 rounded-full object-cover" src="@/assets/profile.png" alt="Profile Picture" />
          <div class="ml-4">
            <p class="text-sm font-bold text-[#074173]">Profil</p> 
            <p class="text-lg font-semibold text-gray-800">{{ user.name }}</p>
          </div>
        </div>
        <div class="flex flex-col items-end">
          <router-link :to="{ name: 'ProfileEdit' }" class="text-[#074173] hover:underline font-medium mb-2"> 
            Profili Düzenle
          </router-link>
          <router-link :to="{ name: 'ChangePassword' }" class="text-[#074173] hover:underline font-medium"> 
            Şifre Değiştir
          </router-link>
        </div>
      </div>
      <div class="py-4 flex items-center justify-between">
        <div>
          <p class="text-sm font-bold text-[#074173]">Email Adresim</p>
          <p class="text-lg font-semibold text-gray-800">{{ user.email }}</p>
        </div>
        <div>
          <span class="bg-[#5DEBD7] text-white text-xs font-bold px-2 py-1 rounded-full">Birincil</span> 
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { API_URL } from '@/config';

export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
      },
    };
  },
  mounted() {
    this.fetchUserData();
  },
  methods: {
    async fetchUserData() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.get(`${API_URL}/profile`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.user = response.data;
      } catch (error) {
        console.error('Error fetching user data:', error);
      }
    },
  },
};
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
}
.bg-header {
  background-color: transparent;
}
</style>
