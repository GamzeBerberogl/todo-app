<template>
    <div>
      <h1>Todo Düzenle</h1>
      <form @submit.prevent="updateTodo">
        <label for="title">Başlık:</label>
        <input v-model="todo.title" type="text" id="title" required>
  
        <label for="description">Açıklama:</label>
        <textarea v-model="todo.description" id="description" required></textarea>
  
        <label for="is_completed">Tamamlandı:</label>
        <input v-model="todo.is_completed" type="checkbox" id="is_completed">
  
        <button type="submit">Güncelle</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { API_URL } from '@/config';

  export default {
    data() {
      return {
        todo: {
          title: '',
          description: '',
          is_completed: false,
        }
      };
    },
    async created() {
      const id = this.$route.params.id;
      const response = await axios.get(`${API_URL}/todos/${id}`);
      this.todo = response.data;
    },
    methods: {
      async updateTodo() {
        const id = this.$route.params.id;
        const token = localStorage.getItem('token');
        await axios.put(`${API_URL}/todos/${id}`, this.todo, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.$router.push('/');
      }
    }
  };
  </script>
  