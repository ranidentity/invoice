<template>
    <transition name="slide">
      <div v-if="open" class="fixed inset-0 z-50 flex">
        <!-- Overlay -->
        <div
          class="fixed inset-0 bg-black bg-opacity-40 transition-opacity"
          @click="close"
        ></div>
        <!-- Modal Panel -->
        <div
          class="relative h-full bg-white dark:bg-gray-900 shadow-2xl transition-all duration-300 ease-in-out
            w-full sm:w-[70vw] max-w-3xl ml-[2cm] flex flex-col"
          :class="{
            'rounded-l-3xl': isDesktop,
            'w-full ml-0 max-w-full': !isDesktop
          }"
        >
          <!-- Close Button (Mobile) -->
          <button
            v-if="!isDesktop"
            class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-gray-700 dark:hover:text-white"
            @click="close"
          >
            &times;
          </button>
          <div class="overflow-y-auto p-8">
            <!-- Header -->
            <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">New Invoice</h1>
            <!-- Bill From -->
            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200" style="line-height:24px;">Bill From</h3>
            <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Street Address</h3>
            <input type="text" class="w-full mb-4 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
            <div class="flex gap-4 mb-6">
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">City</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Post Code</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Country</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
            </div>
            <div class="mb-6"></div>
            <!-- Bill To -->
            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200" style="line-height:24px;">Bill To</h3>
            <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Client's Name</h3>
            <input type="text" class="w-full mb-4 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
            <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Client's Email</h3>
            <input type="email" class="w-full mb-4 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
            <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Street Name</h3>
            <input type="text" class="w-full mb-4 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
            <div class="flex gap-4 mb-6">
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">City</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Post Code</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Country</h3>
                <input type="text" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
            </div>
            <div class="flex gap-4 mb-6">
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Invoice Date</h3>
                <input type="date" class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
              </div>
              <div class="flex-1">
                <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Payment Terms</h3>
                <select class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                  <option>Net 30</option>
                  <option>Net 15</option>
                  <option>Net 7</option>
                </select>
              </div>
            </div>
            <h3 class="text-xs font-semibold mb-1 text-gray-500 dark:text-gray-400" style="line-height:15px;">Project Description</h3>
            <input type="text" class="w-full mb-6 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" />
            <div class="mb-6"></div>
          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script setup>
  import { ref, computed, onMounted, onUnmounted } from 'vue'
  const props = defineProps({ open: Boolean })
  const emit = defineEmits(['close'])
  
  const isDesktop = ref(window.innerWidth >= 640)
  const close = () => emit('close')
  
  function handleResize() {
    isDesktop.value = window.innerWidth >= 640
  }
  onMounted(() => window.addEventListener('resize', handleResize))
  onUnmounted(() => window.removeEventListener('resize', handleResize))
  </script>
  
  <style scoped>
  .slide-enter-active, .slide-leave-active {
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), opacity 0.3s;
  }
  .slide-enter-from {
    transform: translateX(-100%);
    opacity: 0;
  }
  .slide-enter-to {
    transform: translateX(0);
    opacity: 1;
  }
  .slide-leave-from {
    transform: translateX(0);
    opacity: 1;
  }
  .slide-leave-to {
    transform: translateX(-100%);
    opacity: 0;
  }
  </style>