<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

defineProps({ heroSlides: Array });

const destroyHeroSlide = (id) => {
  if (confirm('Delete hero slide?')) {
    router.delete(`/admin/hero-slides/${id}`);
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manage Hero Slides" />
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-semibold">Hero Slides</h2>
      <Link href="/admin/hero-slides/create" class="rounded bg-blue-600 px-3 py-2 text-sm text-white">Add Hero Slide</Link>
    </div>

    <div class="overflow-x-auto rounded border">
      <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
          <tr>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Slide</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Text</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Order</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Status</th>
            <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
          <tr v-for="heroSlide in heroSlides" :key="heroSlide.id">
            <td class="px-3 py-3">
              <img :src="heroSlide.image_url" :alt="heroSlide.title" class="h-16 w-28 rounded object-cover">
            </td>
            <td class="px-3 py-3">
              <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ heroSlide.kicker }}</p>
              <p class="font-medium text-slate-900">{{ heroSlide.title }}</p>
              <p class="mt-1 max-w-md text-sm text-slate-600">{{ heroSlide.description }}</p>
            </td>
            <td class="px-3 py-3 text-slate-700">{{ heroSlide.order }}</td>
            <td class="px-3 py-3 text-slate-700">{{ heroSlide.is_active ? 'Active' : 'Hidden' }}</td>
            <td class="px-3 py-3">
              <div class="flex gap-3 text-sm">
                <Link :href="`/admin/hero-slides/${heroSlide.id}/edit`" class="text-blue-700">Edit</Link>
                <button class="text-red-700" @click="destroyHeroSlide(heroSlide.id)">Delete</button>
              </div>
            </td>
          </tr>
          <tr v-if="!heroSlides.length">
            <td colspan="5" class="px-3 py-6 text-center text-sm text-slate-500">No hero slides added yet.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>