<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

defineProps({ events: Array });

const destroyEvent = (id) => {
  if (confirm('Delete event?')) router.delete(`/admin/events/${id}`);
};
</script>

<template>
  <AdminLayout>
    <Head title="Manage Events" />
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-semibold">Events</h2>
      <Link href="/admin/events/create" class="rounded bg-blue-600 px-3 py-2 text-sm text-white">Add Event</Link>
    </div>
    <div class="space-y-3">
      <div v-for="event in events" :key="event.id" class="rounded border p-3">
        <p class="font-semibold">{{ event.title }}</p>
        <p class="text-sm text-slate-500">{{ event.location || 'No location' }}</p>
        <div class="mt-2 flex gap-3 text-sm">
          <Link :href="`/admin/events/${event.id}/edit`" class="text-blue-700">Edit</Link>
          <button class="text-red-700" @click="destroyEvent(event.id)">Delete</button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
