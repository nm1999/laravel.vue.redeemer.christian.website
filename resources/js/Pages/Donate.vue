<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ stripeKey: String, status: String });
const form = useForm({ name: '', email: '', amount: 50, message: '' });

const submit = () => form.post('/donate/intent');
</script>

<template>
  <Layout>
    <Head title="Donate" />
    <section class="rounded-3xl bg-white p-8 border border-slate-200 max-w-2xl">
      <h1 class="text-3xl font-bold">Give Online</h1>
      <p class="mt-2 text-slate-600">Secure donations powered by Stripe.</p>
      <p v-if="!stripeKey" class="mt-2 text-amber-700">Stripe keys are not configured yet.</p>
      <p v-if="status === 'success'" class="mt-2 text-green-700">Thank you for your donation!</p>
      <form class="mt-6 space-y-3" @submit.prevent="submit">
        <input v-model="form.name" required class="w-full rounded border px-3 py-2" placeholder="Name" />
        <input v-model="form.email" type="email" required class="w-full rounded border px-3 py-2" placeholder="Email" />
        <input v-model="form.amount" type="number" min="1" step="0.01" required class="w-full rounded border px-3 py-2" placeholder="Amount (USD)" />
        <textarea v-model="form.message" class="w-full rounded border px-3 py-2" placeholder="Message (optional)" />
        <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Create Payment Intent</button>
      </form>
    </section>
  </Layout>
</template>
