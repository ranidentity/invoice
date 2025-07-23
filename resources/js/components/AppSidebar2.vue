<template>
  <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col shadow-lg">
    <div class="flex items-center justify-center h-16 border-b border-gray-700">
      <router-link to="/dashboard" class="text-2xl font-bold text-indigo-400 hover:text-indigo-300">
        InvoiceApp
      </router-link>
    </div>

    <nav class="flex-1 mt-6 space-y-2">
      <router-link to="/dashboard"
                  class="flex items-center py-2 px-4 rounded-md text-sm font-medium transition duration-150 ease-in-out"
                  :class="{ 'bg-gray-700 text-white': $route.path.startsWith('/dashboard'), 'text-gray-300 hover:bg-gray-700 hover:text-white': !$route.path.startsWith('/dashboard') }">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001 1h2a1 1 0 001-1m-6 0v-4a1 1 0 011-1h2a1 1 0 011 1v4m-6 0h6"></path></svg>
        Dashboard
      </router-link>

      <router-link to="/invoices"
                  class="flex items-center py-2 px-4 rounded-md text-sm font-medium transition duration-150 ease-in-out"
                  :class="{ 'bg-gray-700 text-white': $route.path.startsWith('/invoices'), 'text-gray-300 hover:bg-gray-700 hover:text-white': !$route.path.startsWith('/invoices') }">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        Invoices
      </router-link>
    </nav>

    <div class="mt-auto pt-4 border-t border-gray-700">
      <router-link to="/profile"
                  class="flex items-center py-2 px-4 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-150 ease-in-out">
        <img class="h-8 w-8 rounded-full object-cover mr-3" :src="user.profile_photo_url" :alt="user.name">
        {{ user.name }}
      </router-link>

      <form @submit.prevent="logout" class="mt-2">
        <button type="submit" class="w-full text-left py-2 px-4 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-150 ease-in-out">
          <svg class="w-5 h-5 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H5a3 3 0 01-3-3V7a3 3 0 013-3h5a3 3 0 013 3v1"></path></svg>
          Log Out
        </button>
      </form>
    </div>
  </aside>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { usePage } from '@inertiajs/vue3'; 

const user = ref({
  name: 'John Doe',
  profile_photo_url: 'https://via.placeholder.com/150'
});


const router = useRouter();
// Access the current page properties (like user info, current URL)
const page = usePage();

const logout = async () => {
  try {
    const response = await fetch('/logout', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      }
    });

    if (response.ok) {
      // Redirect to login page or home page after logout
      router.push('/login');
    }
  } catch (error) {
    console.error('Logout failed:', error);
  }
};

</script>

<style scoped>
/* Scoped styles for the sidebar */
/* Tailwind CSS utility classes are heavily used above, so custom CSS is minimal here */
</style>