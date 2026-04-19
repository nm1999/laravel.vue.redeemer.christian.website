<script setup>
import Layout from '../Layout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
defineProps({ sermons: Array });
const destroyItem = (id) => { if (confirm('Delete sermon?')) router.delete(`/admin/sermons/${id}`); };
</script>

<template>
  <Layout>
    <Head title="Manage Sermons" />
    <section class="rounded-xl bg-white p-5 border">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Sermons</h1>
        <Link href="/admin/sermons/create" class="rounded bg-blue-600 px-3 py-2 text-white">Add Sermon</Link>
      </div>
      <table class="w-full text-sm">
        <thead><tr class="text-left"><th>Title</th><th>Speaker</th><th>Date</th><th></th></tr></thead>
        <tbody>
          <tr v-for="item in sermons" :key="item.id" class="border-t">
            <td>{{ item.title }}</td><td>{{ item.speaker }}</td><td>{{ item.preached_at }}</td>
            <td class="space-x-2"><Link :href="`/admin/sermons/${item.id}/edit`" class="text-blue-700">Edit</Link><button class="text-red-700" @click="destroyItem(item.id)">Delete</button></td>
          </tr>
        </tbody>
      </table>
    </section>
  </Layout>
</template>
