<template>
  <div class="flex flex-row items-center justify-center text-center p-12 mt-12"> 
    <div class="flex flex-col items-start justify-center space-y-5"> 
      <h1 class="text-5xl font-bold text-[#074173] mb-6"> 
        Yaz. Planla. Düzenle.
      </h1>
      <p class="text-xl text-[#1679AB] mb-10"> 
        Todo App yardımıyla işlerinizi organize edin.
      </p>
      <div class="flex space-x-6"> 
        <router-link to="/auth" class="cta-button">
          <button class="bg-[#074173] text-white py-3 px-6 rounded-lg hover:bg-[#1679AB] transition-colors text-lg"> 
            Hadi Başlayalım!
          </button>
        </router-link>
      </div>
    </div>
    <div class="ml-[120px]"> 
      <img src="@/assets/dashboard.png" alt="Dashboard Görseli" class="w-[28rem] h-auto"/> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
};
</script>
