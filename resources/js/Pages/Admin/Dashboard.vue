<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from './Layout.vue';

defineProps({
  stats: Object,
});
</script>

<template>
  <AdminLayout>
    <Head title="Admin Dashboard" />
    <h2 class="text-2xl font-semibold">Overview</h2>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div class="rounded-lg bg-blue-50 p-4"><p class="text-sm text-slate-600">Sermons</p><p class="text-2xl font-bold">{{ stats.sermons }}</p></div>
      <div class="rounded-lg bg-red-50 p-4"><p class="text-sm text-slate-600">Events</p><p class="text-2xl font-bold">{{ stats.events }}</p></div>
      <div class="rounded-lg bg-green-50 p-4"><p class="text-sm text-slate-600">Visitors</p><p class="text-2xl font-bold">{{ stats.visitors }}</p></div>
      <div class="rounded-lg bg-amber-50 p-4"><p class="text-sm text-slate-600">Prayer Requests</p><p class="text-2xl font-bold">{{ stats.prayerRequests }}</p></div>
    </div>
  </AdminLayout>
</template>
