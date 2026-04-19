<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from './Layout.vue';

defineProps({ prayerRequests: Array });
</script>

<template>
  <AdminLayout>
    <Head title="Prayer Requests" />
    <h2 class="mb-4 text-2xl font-semibold">Prayer Requests</h2>
    <div class="space-y-3">
      <div v-for="request in prayerRequests" :key="request.id" class="rounded border p-3">
        <p class="font-semibold">{{ request.name }}</p>
        <p class="mt-1 text-sm text-slate-600">{{ request.request_text }}</p>
      </div>
    </div>
  </AdminLayout>
</template>
