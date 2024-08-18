<template>
  <div class="todos-container">
    <div class="todos-content">
      <div class="header-section">
        <h1>Todo Listem</h1>
        <button @click="createTodo" class="create-todo-button">Yeni Görev Oluştur</button>
      </div>
      <div class="todos-grid">
        <div v-if="todos.length === 0" class="empty-message">Henüz yapılacak iş bulunmuyor.</div>
        <div
          v-else
          v-for="todo in todos"
          :key="todo.id"
          :class="['todo-card', todo.is_completed ? 'completed' : 'not-completed']"
        >
          <div class="todo-header">
            <input
              v-model="todo.title"
              :class="['todo-title', todo.editMode ? 'editable' : '']"
              :disabled="!todo.editMode"
              @focus="setEditMode(todo, true)"
            />
            <div class="todo-icons">
              <span v-if="todo.editMode" @click="saveTodo(todo)" class="icon save-icon">✔️</span>
              <span v-if="!todo.editMode" @click="toggleEditMode(todo)" class="icon edit-icon">✏️</span>
              <span @click="deleteTodo(todo.id)" class="icon delete-icon">🗑️</span>
            </div>
          </div>
          <textarea
            v-model="todo.description"
            :class="['todo-description', todo.editMode ? 'editable' : '']"
            :disabled="!todo.editMode"
            @focus="setEditMode(todo, true)"
          />
          <div class="tick-container">
            <input
              type="checkbox"
              :checked="todo.is_completed"
              @change="toggleComplete(todo)"
              class="tick-box"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { API_URL } from '@/config';

export default {
  name: 'Todos',
  data() {
    return {
      todos: [],
      newTodo: null,
    };
  },
  mounted() {
    this.fetchTodos();
  },
  methods: {
    handleError(error, defaultMessage) {
      const errorMessage = error.response?.data?.message || defaultMessage;
      alert(errorMessage);
      console.error(errorMessage, error);
    },
    async fetchTodos() {
      try {
        const token = localStorage.getItem('token');
        if (!token) {
          this.$router.push('/auth');
          return;
        }

        const response = await axios.get(`${API_URL}/todos`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.todos = response.data.data.map((todo) => ({
          ...todo,
          editMode: false,
        }));
      } catch (error) {
        this.handleError(error, 'Yapılacaklar listesi alınamadı.');
      }
    },
    async createTodo() {
      try {
        const token = localStorage.getItem('token');
        if (!token) {
          alert('Oturum açmalısınız!');
          this.$router.push('/auth');
          return;
        }

        const newTodoData = {
          title: 'Yeni Görev', 
          description: '',     
          is_completed: 0, 
        };

        const response = await axios.post(`${API_URL}/todos`, newTodoData, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.todos.unshift({
          ...response.data.data,
          editMode: true, 
        });

        console.log('Yeni Todo başarıyla oluşturuldu:', response.data);
      } catch (error) {
        this.handleError(error, 'Yeni görev oluşturulamadı.');
      }
    },
    async toggleComplete(todo) {
      todo.is_completed = todo.is_completed ? 0 : 1;
      await this.saveTodo(todo);
    },

    async saveTodo(todo) {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.put(`${API_URL}/todos/${todo.id}`, {
          title: todo.title,
          description: todo.description,
          is_completed: todo.is_completed,
        }, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        console.log('Todo başarıyla kaydedildi:', response.data);
        todo.editMode = false;
      } catch (error) {
        this.handleError(error, 'Görev kaydedilemedi.');
      }
    },

    async deleteTodo(id) {
      try {
        const token = localStorage.getItem('token');
        await axios.delete(`${API_URL}/todos/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.todos = this.todos.filter((todo) => todo.id !== id);
      } catch (error) {
        this.handleError(error, 'Görev silinemedi.');
      }
    },

    toggleEditMode(todo) {
      todo.editMode = !todo.editMode;
    },

    setEditMode(todo, mode) {
      todo.editMode = mode;
    },
  },
};
</script>


<style scoped>
.todos-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
  background-color: white;
}

.todos-content {
  background-color: white;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 1200px;
}

.header-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

h1 {
  margin: 0;
  color: #074173;
}

.create-todo-button {
  color: #074173;
  padding: 0.5rem 1.5rem;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.create-todo-button:hover {
  background-color: #1d88bd36;
}

.todos-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.todo-card {
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 1rem;
  width: 300px;
  height: 200px;
  display: flex;
  flex-direction: column;
  position: relative;
  box-sizing: border-box;
}

.completed {
  background-color: #074173;
  color: white;
}

.not-completed {
  background-color: #5B99C2;
}

.todo-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.todo-title {
  font-size: 0.875rem;
  font-weight: bold;
  margin: 0;
  border: none;
  background: transparent;
  width: 100%;
  padding: 0.25rem 0.5rem;
  outline: none;
}

.editable {
  border: 1px solid #ccc;
  background: #ffffff80;
  border-radius: 5px;
  padding: 0.25rem 0.5rem;
}

.todo-icons {
  display: flex;
  gap: 0.5rem;
}

.icon {
  cursor: pointer;
  font-size: 1.2rem;
  color: #666;
}

.icon:hover {
  color: #074173;
}

.tick-box {
  cursor: pointer;
  transform: scale(1.2);
  accent-color: #F9DBBA;
  border-radius: 50%;
  margin-left: auto;
}

.tick-container {
  position: absolute;
  bottom: 10px;
  right: 10px;
}

.todo-description {
  font-size: 0.875rem;
  color: #333;
  border: none;
  background: transparent;
  flex-grow: 1;
  resize: none;
  min-height: 40px;
}

.todo-description.editable {
  border: 1px solid #ccc;
  background: #ffffff80;
  border-radius: 5px;
  padding: 0.25rem 0.5rem;
}

.empty-message {
  text-align: center;
  color: #666;
  font-size: 1rem;
  grid-column: span 2;
}
</style>
