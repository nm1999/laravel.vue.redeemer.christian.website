<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post('/login');
</script>

<template>
  <Layout>
    <Head title="Login" />
    <section class="mx-auto max-w-lg rounded-3xl border border-slate-200 bg-white p-8">
      <h1 class="text-3xl font-bold">Sign In</h1>
      <form class="mt-6 space-y-3" @submit.prevent="submit">
        <input v-model="form.email" type="email" class="w-full rounded border p-2" placeholder="Email">
        <input v-model="form.password" type="password" class="w-full rounded border p-2" placeholder="Password">
        <label class="flex items-center gap-2"><input v-model="form.remember" type="checkbox"> Remember me</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Login</button>
      </form>
    </section>
  </Layout>
</template>
