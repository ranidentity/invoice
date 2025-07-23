<template>
    <section class="w-full">
      <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
      >
        <!-- Left: Title & Description -->
        <div>
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Invoice Dashboard
          </h1>
          <p class="mt-4 text-base text-gray-600 dark:text-gray-300">
            {{invoiceCounterText}}
          </p>
        </div>
        <!-- Right: Filter & Add Button -->
        <div class="flex flex-row gap-2 items-center">
          <select
            v-model="selectedStatus"
            class="rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2"
          >
            <option value="">All Statuses</option>
            <option value="paid">Paid</option>
            <option value="pending">Pending</option>
            <option value="overdue">Overdue</option>
          </select>
          <button
            class="ml-2 px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
            @click="$emit('add-invoice')"
          >
            Add New Invoice
          </button>
        </div>
      </div>
    </section>
</template>
  
<script setup>
  import { ref, defineProps, defineEmits, watch } from 'vue'
  const props = defineProps({
    totalInvoices: { type: Number, required: true },
    modelValue: { type: String, default: '' },
    invoiceCounterText: {type: String,required: false}
  })
  const emit = defineEmits(['update:modelValue', 'add-invoice'])
  const selectedStatus = ref(props.modelValue)
  watch(selectedStatus, val => emit('update:modelValue', val))
</script>