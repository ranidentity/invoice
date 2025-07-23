<template>
    <div>
      <InvoiceRow
        v-for="inv in invoices"
        :key="inv.id"
        :invoice="inv"
        @view="$emit('view', inv)"
      />
    </div>
  </template>
  
  <script setup>
  import InvoiceRow from './InvoiceRow.vue'
  defineProps({
    invoices: { type: Array, required: true }
  })
  defineEmits(['view'])
  </script>