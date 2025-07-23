<script setup lang="ts">
import { defineProps } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Invoices',
        href: '/invoice',
    },
];
interface Invoice {
  id: number;
  invoice_number: string;
  invoice_description: string | null;
  customer_name: string;
  customer_email: string;
  billing_address: string;
  billing_city: string;
  billing_postal_code: string;
  billing_country: string;
  total_amount: number; // Laravel's decimal:2 cast will make this a number
  due_date: string; // Dates often come as strings from API/Inertia
  invoice_date: string;
  invoice_address: string;
  status: 'pending' | 'paid' | 'overdue' | 'draft'; // Union type for possible statuses
  created_at: string;
  updated_at: string;
  deleted_at: string | null; // For soft deletes
  // Add any other properties if they are passed, e.g., order_items if eager loaded
  order_items?: Array<{
    id: number;
    item_name: string;
    quantity: number;
    single_price: number;
    total_amount: number;
  }>;
}
const props = defineProps<{
  invoices: Invoice[]; // 'invoices' prop is an array of Invoice objects
}>();
const formatDate = (dateString: string): string => {
  if (!dateString) return '';
  const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>
<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
         <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
             red red
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <div class="invoices-list-container">
            <p v-if="invoices.length === 0">No invoices found. <a href="/invoices/create">Create one!</a></p>
            <table v-else class="invoice-table">
            <thead>
                <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="invoice in invoices" :key="invoice.id">
                <td>{{ invoice.invoice_number }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ formatDate(invoice.due_date) }}</td>
                <td>
                    <span :class="['status-badge', 'status-' + invoice.status]">
                    {{ invoice.status }}
                    </span>
                </td>
                <td>${{ invoice.total_amount ? invoice.total_amount.toFixed(2) : '0.00' }}</td>
                <td>
                    <a :href="'/invoices/' + invoice.id" class="btn btn-sm btn-info">View</a>
                    <a :href="'/invoices/' + invoice.id + '/edit'" class="btn btn-sm btn-primary">Edit</a>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
            </div>
        </div>
    </AppLayout>
</template>