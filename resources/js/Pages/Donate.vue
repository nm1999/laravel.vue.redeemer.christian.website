<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ publicKey: String, status: String });
const form = useForm({ amount: 2500, currency: 'USD' });

const submit = () => {
  form.post('/donate');
};
</script>

<template>
  <Layout>
    <Head title="Give Online" />
    <section class="rounded-3xl border border-slate-200 bg-white p-8">
      <h1 class="text-3xl font-bold">Give Online</h1>
      <p class="mt-3 text-slate-600">Secure giving powered by Stripe.</p>
      <p v-if="status === 'success'" class="mt-3 text-green-700">Thank you for your donation!</p>
      <p v-if="status === 'failure'" class="mt-3 text-red-700">Donation failed. Please try again.</p>
      <form class="mt-6 space-y-3" @submit.prevent="submit">
        <label class="block text-sm">Amount (in cents)</label>
        <input v-model.number="form.amount" type="number" min="100" class="w-full rounded border p-2">
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Continue</button>
      </form>
      <p v-if="!publicKey" class="mt-4 text-sm text-amber-700">Stripe key not configured. Demo mode enabled.</p>
    </section>
  </Layout>
</template>
