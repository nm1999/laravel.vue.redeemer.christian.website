<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

defineProps({ sermons: Array });

const destroySermon = (id) => {
  if (confirm('Delete sermon?')) {
    router.delete(`/admin/sermons/${id}`);
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manage Sermons" />
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-semibold">Sermons</h2>
      <Link href="/admin/sermons/create" class="rounded bg-blue-600 px-3 py-2 text-sm text-white">Add Sermon</Link>
    </div>
    <div class="space-y-3">
      <div v-for="sermon in sermons" :key="sermon.id" class="rounded border p-3">
        <p class="font-semibold">{{ sermon.title }}</p>
        <p class="text-sm text-slate-500">{{ sermon.speaker || 'Unknown speaker' }}</p>
        <div class="mt-2 flex gap-3 text-sm">
          <Link :href="`/admin/sermons/${sermon.id}/edit`" class="text-blue-700">Edit</Link>
          <button class="text-red-700" @click="destroySermon(sermon.id)">Delete</button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
