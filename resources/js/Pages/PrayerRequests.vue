<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ publicRequests: Array });

const form = useForm({ name: '', email: '', request: '', is_private: true });
const submit = () => form.post('/prayer-requests', { onSuccess: () => form.reset('request') });
</script>

<template>
  <Layout>
    <Head title="Prayer Requests" />
    <section class="grid gap-6 lg:grid-cols-2">
      <div class="rounded-3xl bg-white p-8 border border-slate-200">
        <h1 class="text-3xl font-bold">Submit a Prayer Request</h1>
        <form class="mt-6 space-y-3" @submit.prevent="submit">
          <input v-model="form.name" required class="w-full rounded border px-3 py-2" placeholder="Name" />
          <input v-model="form.email" type="email" class="w-full rounded border px-3 py-2" placeholder="Email (optional)" />
          <textarea v-model="form.request" required rows="5" class="w-full rounded border px-3 py-2" placeholder="How can we pray for you?" />
          <label class="inline-flex items-center gap-2 text-sm"><input v-model="form.is_private" type="checkbox" /> Keep this request private</label>
          <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Submit</button>
        </form>
      </div>

      <div class="rounded-3xl bg-white p-8 border border-slate-200">
        <h2 class="text-2xl font-semibold">Community Prayer Wall</h2>
        <div class="mt-4 space-y-3">
          <article v-for="request in publicRequests" :key="request.id" class="rounded border border-slate-200 p-3">
            <p>{{ request.request }}</p>
            <p class="text-sm text-slate-500 mt-1">{{ request.name }}</p>
          </article>
        </div>
      </div>
    </section>
  </Layout>
</template>
