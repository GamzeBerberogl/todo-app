<template>
  <div class="min-h-screen bg-white p-8">Y
    <form @submit.prevent="createTodo" class="bg-white p-8 rounded-xl shadow-lg max-w-lg mx-auto">
      <h2 class="text-3xl font-bold mb-2 text-center text-[#074173]">Yeni Görev Oluştur</h2> 
      <p class="text-lg text-center text-[#1679AB] mb-6">Oluştur</p> 
      <div class="mb-6">
        <label class="block text-[#074173] text-sm font-bold mb-2" for="title">Başlık</label> 
        <input v-model="title" class="input-field" type="text" id="title" placeholder="Todo title" required /> 
      </div>
      <div class="mb-6">
        <label class="block text-[#074173] text-sm font-bold mb-2" for="description">Açıklama</label> 
        <textarea v-model="description" class="input-field" id="description" placeholder="Todo description" required></textarea> 
      </div>
      <div class="mb-6 flex items-center">
        <input v-model="completed" type="checkbox" id="completed" class="form-checkbox text-[#1679AB] h-5 w-5 rounded" /> 
        <label for="completed" class="ml-2 text-[#074173] font-bold">Completed</label> 
      </div>
      <button class="btn-primary w-full" type="submit">Create Todo</button> 
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import { API_URL } from '@/config';

export default {
  data() {
    return {
      title: '',
      description: '',
      completed: false,
    };
  },
  methods: {
    handleError(error, defaultMessage) {
      const errorMessage = error.response?.data?.message || defaultMessage;
      alert(errorMessage);
      console.error(errorMessage, error);
    },
    async createTodo() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.post(`${API_URL}/todos`,
          {
            title: this.title,
            description: this.description,
            is_completed: this.completed ? 1 : 0,
          },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        this.$router.push('/todos');
      } catch (error) {
        console.error('Todo creation failed:', error);
        alert('Görev oluşturulamadı. Lütfen tekrar deneyin.');
      }
    },
  },
};
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
}

.input-field {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #1679AB; 
  border-radius: 8px; 
  font-size: 1rem;
  color: #333;
  background-color: #f9f9f9;
  transition: border-color 0.3s ease;
}

.input-field:focus {
  border-color: #074173; 
  outline: none;
  box-shadow: 0 0 8px rgba(7, 65, 115, 0.2);
}

.btn-primary {
  background-color: #074173; 
  color: white;
  padding: 0.75rem;
  border: none;
  border-radius: 8px; 
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #1679AB; 
}

.form-checkbox {
  accent-color: #1679AB; 
  cursor: pointer;
}
</style>
