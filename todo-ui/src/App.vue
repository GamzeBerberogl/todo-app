<template>
  <div id="app">
    <nav class="flex items-center justify-between p-4 bg-gray-50 shadow-md">
      <div class="flex items-center">
        <span class="text-xl font-semibold text-gray-800">Todo App</span>
      </div>

      <div v-if="isAuthenticated && !isAuthOrHomeRoute" class="relative">
        <img
          @click="toggleDropdown"
          src="@/assets/profile.png"
          alt="Profile"
          class="w-10 h-10 rounded-full cursor-pointer ring-2 ring-offset-1 ring-gray-300 hover:ring-blue-500 transition duration-300"
        />
        <transition name="fade">
          <div
            v-show="dropdownOpen"
            class="dropdown absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
            @click.stop
          >
            <router-link
              to="/profile"
              class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg transition duration-200"
            >
              Profili Görüntüle
            </router-link>
            <router-link
              to="/todos"
              class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-200"
            >
              Todo's
            </router-link>
            <button
              @click="logout"
              class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg transition duration-200"
            >
              Çıkış Yap
            </button>
          </div>
        </transition>
      </div>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import { API_URL } from '@/config';

export default {
  setup() {
    const route = useRoute();
    const router = useRouter();
    const dropdownOpen = ref(false);

    // Kullanıcının giriş yapıp yapmadığını kontrol et
    const isAuthenticated = computed(() => {
      return !!localStorage.getItem('token');
    });

    // Giriş sayfası ('/auth') veya ana sayfa ('/home') rotasında olup olmadığını kontrol et
    const isAuthOrHomeRoute = computed(() => {
      return route.path === '/auth' || route.path === '/';
    });

    const toggleDropdown = (event) => {
      event.stopPropagation(); // Tıklama olayının yayılmasını durdur
      dropdownOpen.value = !dropdownOpen.value;
    };

    const handleClickOutside = (event) => {
      if (dropdownOpen.value && !event.target.closest('.dropdown')) {
        dropdownOpen.value = false;
      }
    };

    onMounted(() => {
      document.addEventListener('click', handleClickOutside);
    });

    onBeforeUnmount(() => {
      document.removeEventListener('click', handleClickOutside);
    });

    const logout = async () => {
      try {
        const token = localStorage.getItem('token');
        if (token) {
          await axios.post(`${API_URL}/auth/logout`, {}, {
            headers: {
              'Authorization': `Bearer ${token}`,
            },
          });
          
          localStorage.removeItem('token');
          
          router.push({ name: 'Home' });
        } else {
          alert('Oturum açmamışsınız.');
        }
      } catch (error) {
        console.error('Logout failed:', error);
        alert('Çıkış işlemi başarısız.');
      }
    };

    return {
      isAuthenticated,
      isAuthOrHomeRoute,
      dropdownOpen,
      toggleDropdown,
      logout,
    };
  },
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
nav {
  background-color: #f8fafc;
}
span.text-xl {
  font-size: 1.25rem;
  font-weight: 600;
}
</style>
