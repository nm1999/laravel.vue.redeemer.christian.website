<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ requests: Array });
const statusForms = {};
const updateStatus = (id, status) => {
  if (!statusForms[id]) statusForms[id] = useForm({ status });
  statusForms[id].status = status;
  statusForms[id].put(`/admin/prayer-requests/${id}`);
};
</script>

<template>
  <Layout>
    <Head title="Prayer Requests" />
    <section class="rounded-xl bg-white p-5 border">
      <h1 class="text-2xl font-bold mb-4">Prayer Requests</h1>
      <div class="space-y-3">
        <article v-for="item in requests" :key="item.id" class="rounded border p-3">
          <p class="font-semibold">{{ item.name }} <span class="text-xs text-slate-500">({{ item.status }})</span></p>
          <p class="mt-1">{{ item.request }}</p>
          <div class="mt-2 flex gap-2">
            <button class="rounded border px-2 py-1 text-xs" @click="updateStatus(item.id, 'reviewed')">Mark Reviewed</button>
            <button class="rounded border px-2 py-1 text-xs" @click="updateStatus(item.id, 'prayed')">Mark Prayed</button>
          </div>
        </article>
      </div>
    </section>
  </Layout>
</template>
