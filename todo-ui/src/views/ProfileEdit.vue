<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-xl p-8">
      <h2 class="text-3xl font-bold text-[#074173] mb-6 border-b border-[#1679AB] pb-4 text-center">Profili Düzenle</h2> 
      <form @submit.prevent="updateProfile">
        <div class="mb-4">
          <label for="name" class="block text-sm font-bold text-[#074173] mb-2">İsim</label> 
          <input
            type="text"
            id="name"
            v-model="user.name"
            class="mt-1 block w-full px-4 py-2 border border-[#1679AB] rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5DEBD7] sm:text-sm" 
            required
          />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-sm font-bold text-[#074173] mb-2">Email</label> 
          <input
            type="email"
            id="email"
            v-model="user.email"
            class="mt-1 block w-full px-4 py-2 border border-[#1679AB] rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5DEBD7] sm:text-sm" 
            required
          />
        </div>
        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-[#074173] text-white px-4 py-2 rounded-full hover:bg-[#1679AB] transition-colors font-bold" 
          >
            Kaydet
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
        console.error('Kullanıcı verileri alınırken bir hata oluştu:', error);
      }
    },
    async updateProfile() {
      try {
        const token = localStorage.getItem('token');
        await axios.put(`${API_URL}/profile`, this.user, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        alert('Profile updated successfully!');
        this.$router.push({ name: 'Profile' }); 
      } catch (error) {
        console.error('Profil güncellenirken bir hata oluştu:', error);
      }
    },
  },
};
</script>
