<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post('/admin/login');
</script>

<template>
  <Layout>
    <Head title="Admin Login" />
    <section class="mx-auto max-w-md rounded-3xl bg-white p-8 border border-slate-200">
      <h1 class="text-2xl font-bold">Admin Login</h1>
      <form class="mt-6 space-y-3" @submit.prevent="submit">
        <input v-model="form.email" type="email" required class="w-full rounded border px-3 py-2" placeholder="Email" />
        <input v-model="form.password" type="password" required class="w-full rounded border px-3 py-2" placeholder="Password" />
        <label class="inline-flex gap-2"><input v-model="form.remember" type="checkbox" /> Remember me</label>
        <button class="w-full rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Login</button>
      </form>
    </section>
  </Layout>
</template>
