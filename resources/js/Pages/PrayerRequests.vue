<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ name: '', email: '', request_text: '', is_private: true });
const submit = () => form.post('/prayer-requests');
</script>

<template>
  <Layout>
    <Head title="Prayer Requests" />
    <section class="rounded-3xl border border-slate-200 bg-white p-8">
      <h1 class="text-3xl font-bold">Prayer Requests</h1>
      <p class="mt-2 text-slate-600">Share your request and our team will pray with you.</p>
      <form class="mt-6 space-y-3" @submit.prevent="submit">
        <input v-model="form.name" class="w-full rounded border p-2" placeholder="Your name">
        <input v-model="form.email" type="email" class="w-full rounded border p-2" placeholder="Email (optional)">
        <textarea v-model="form.request_text" class="w-full rounded border p-2" rows="6" placeholder="Your prayer request" />
        <label class="flex items-center gap-2"><input v-model="form.is_private" type="checkbox"> Keep this private</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Submit Request</button>
      </form>
    </section>
  </Layout>
</template>
