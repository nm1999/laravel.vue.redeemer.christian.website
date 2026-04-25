<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

defineProps({ homeGalleryImages: Array });

const destroyHomeGalleryImage = (id) => {
  if (confirm('Delete home gallery image?')) {
    router.delete(`/admin/home-gallery-images/${id}`);
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manage Home Gallery" />
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-semibold">Home Gallery</h2>
      <Link href="/admin/home-gallery-images/create" class="rounded bg-blue-600 px-3 py-2 text-sm text-white">Add Image</Link>
    </div>

    <div class="overflow-x-auto rounded border">
      <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
          <tr>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Image</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Order</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Status</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
          <tr v-for="homeGalleryImage in homeGalleryImages" :key="homeGalleryImage.id">
            <td class="px-3 py-3">
              <img :src="homeGalleryImage.image_url" alt="Home gallery" class="h-20 w-32 rounded object-cover">
            </td>
            <td class="px-3 py-3 text-slate-700">{{ homeGalleryImage.order }}</td>
            <td class="px-3 py-3 text-slate-700">{{ homeGalleryImage.is_active ? 'Active' : 'Hidden' }}</td>
            <td class="px-3 py-3">
              <div class="flex gap-3 text-sm">
                <Link :href="`/admin/home-gallery-images/${homeGalleryImage.id}/edit`" class="text-blue-700">Edit</Link>
                <button class="text-red-700" @click="destroyHomeGalleryImage(homeGalleryImage.id)">Delete</button>
              </div>
            </td>
          </tr>
          <tr v-if="!homeGalleryImages.length">
            <td colspan="4" class="px-3 py-6 text-center text-sm text-slate-500">No home gallery images added yet.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>