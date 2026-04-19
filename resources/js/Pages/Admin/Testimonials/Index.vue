<script setup>
import Layout from '../Layout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
defineProps({ testimonials: Array });
const destroyItem = (id) => { if (confirm('Delete testimonial?')) router.delete(`/admin/testimonials/${id}`); };
</script>

<template>
  <Layout>
    <Head title="Testimonials" />
    <section class="rounded-xl bg-white p-5 border">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Testimonials</h1>
        <Link href="/admin/testimonials/create" class="rounded bg-blue-600 px-3 py-2 text-white">Add Testimonial</Link>
      </div>
      <div class="space-y-3">
        <article v-for="item in testimonials" :key="item.id" class="rounded border p-3">
          <p class="font-semibold">{{ item.name }}</p>
          <p class="text-sm text-slate-500">{{ item.role }}</p>
          <p class="mt-1">{{ item.quote }}</p>
          <div class="mt-2 space-x-2">
            <Link :href="`/admin/testimonials/${item.id}/edit`" class="text-blue-700">Edit</Link>
            <button class="text-red-700" @click="destroyItem(item.id)">Delete</button>
          </div>
        </article>
      </div>
    </section>
  </Layout>
</template>
