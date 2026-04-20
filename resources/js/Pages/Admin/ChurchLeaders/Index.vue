<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

defineProps({ churchLeaders: Array });

const destroyChurchLeader = (id) => {
  if (confirm('Delete church leader?')) {
    router.delete(`/admin/church-leaders/${id}`);
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manage Church Leaders" />
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-semibold">Church Leaders</h2>
      <Link href="/admin/church-leaders/create" class="rounded bg-blue-600 px-3 py-2 text-sm text-white">Add Church Leader</Link>
    </div>

    <div class="overflow-x-auto rounded border">
      <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
          <tr>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Leader</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Title</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Order</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
          <tr v-for="leader in churchLeaders" :key="leader.id">
            <td class="px-3 py-3">
              <div class="flex items-center gap-3">
                <img :src="leader.image_url" :alt="leader.name" class="h-12 w-12 rounded object-cover">
                <span class="font-medium text-slate-900">{{ leader.name }}</span>
              </div>
            </td>
            <td class="px-3 py-3 text-slate-700">{{ leader.title }}</td>
            <td class="px-3 py-3 text-slate-700">{{ leader.order }}</td>
            <td class="px-3 py-3">
              <div class="flex gap-3 text-sm">
                <Link :href="`/admin/church-leaders/${leader.id}/edit`" class="text-blue-700">Edit</Link>
                <button class="text-red-700" @click="destroyChurchLeader(leader.id)">Delete</button>
              </div>
            </td>
          </tr>
          <tr v-if="!churchLeaders.length">
            <td colspan="4" class="px-3 py-6 text-center text-sm text-slate-500">No church leaders added yet.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>
