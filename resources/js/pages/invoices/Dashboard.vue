<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-950 flex">
      <!-- Sidebar -->
      <Sidebar />
  
      <!-- Main Content -->
      <main
        class="flex-1 ml-[2cm] px-[10%] pt-[10%] pb-8 transition-all"
      >
        <HeaderSection
          :invoice-counter-text="filteredInvoices.length === 0 ? 'No invoices' : 'There are '+filteredInvoices.length+' total invoices'"
          v-model="filterStatus"
          @add-invoice="addInvoice"
        />
        <div class="mt-8">
        <template v-if="filteredInvoices.length === 0">
          <div class="flex flex-col items-center justify-center h-96">
            <img src="/assets/illustration-empty.svg" alt="No Invoices" class="w-40 h-40 mb-6 opacity-80" />
            <p class="text-lg text-gray-500 dark:text-gray-400">No invoices to display</p>
          </div>
        </template>
        <template v-else>
          <InvoiceList
            :invoices="filteredInvoices"
            @view="viewInvoice"
          />
        </template>
      </div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'
  import Sidebar from './Components/Sidebar.vue'
  import HeaderSection from './Components/HeaderSection.vue'
  import InvoiceList from './Components/Invoicelist.vue'
  
  // Example invoice data
  const invoices = ref([
    {
      id: 1,
      number: 'INV-001',
      dueDate: '18 Aug 2021',
      client: 'Acme Corp',
      amount: '$1,200.00',
      status: 'Paid'
    },
    {
      id: 2,
      number: 'INV-002',
      dueDate: '25 Aug 2021',
      client: 'Beta LLC',
      amount: '$800.00',
      status: 'Pending'
    },
    {
      id: 3,
      number: 'INV-003',
      dueDate: '30 Aug 2021',
      client: 'Gamma Inc',
      amount: '$2,500.00',
      status: 'Overdue'
    }
  ])
  
  const filterStatus = ref('')
  const filteredInvoices = computed(() =>
    filterStatus.value
      ? invoices.value.filter(inv => inv.status.toLowerCase() === filterStatus.value)
      : invoices.value
  )
  
  function addInvoice() {
    // Implement your add invoice logic here
    alert('Add Invoice Clicked!')
  }
  function viewInvoice(inv) {
    // Implement your view invoice logic here
    alert(`View Invoice: ${inv.number}`)
  }
  </script>