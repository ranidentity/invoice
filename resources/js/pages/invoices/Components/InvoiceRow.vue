<template>
    <div
      class="flex flex-col md:flex-row md:items-center justify-between gap-2 py-4 px-2 border-b border-gray-200 dark:border-gray-700"
    >
      <div class="flex flex-wrap items-center gap-2 text-gray-900 dark:text-white">
        <span class="font-semibold">#{{ invoice.number }}</span>
        <span class="mx-1 text-gray-400">·</span>
        <span>Due {{ invoice.dueDate }}</span>
        <span class="mx-1 text-gray-400">·</span>
        <span>{{ invoice.client }}</span>
        <span class="mx-1 text-gray-400">·</span>
        <span>{{ invoice.amount }}</span>
        <span class="mx-1 text-gray-400">·</span>
        <span
          :class="{
            'text-green-600 dark:text-green-400': invoice.status === 'Paid',
            'text-yellow-600 dark:text-yellow-400': invoice.status === 'Pending',
            'text-red-600 dark:text-red-400': invoice.status === 'Overdue'
          }"
          class="font-medium"
        >
          {{ invoice.status }}
        </span>
      </div>
      <button
        class="ml-auto flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-900 transition"
        @click="$emit('view', invoice)"
      >
        <svg
          class="w-5 h-5 text-blue-600 dark:text-blue-400"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 5l7 7-7 7"
          />
        </svg>
      </button>
    </div>
  </template>
  
  <script setup>
  defineProps({
    invoice: { type: Object, required: true }
  })
  defineEmits(['view'])
  </script>