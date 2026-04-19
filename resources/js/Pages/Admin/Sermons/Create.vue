<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

const form = useForm({ title: '', excerpt: '', content: '', image_path: '', speaker: '', preached_at: '', is_published: true });
const submit = () => form.post('/admin/sermons');
</script>

<template>
  <AdminLayout>
    <Head title="Create Sermon" />
    <h2 class="mb-4 text-2xl font-semibold">Create Sermon</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <input v-model="form.speaker" class="w-full rounded border p-2" placeholder="Speaker">
      <input v-model="form.preached_at" type="datetime-local" class="w-full rounded border p-2">
      <input v-model="form.image_path" class="w-full rounded border p-2" placeholder="Image URL">
      <textarea v-model="form.excerpt" class="w-full rounded border p-2" placeholder="Excerpt" />
      <textarea v-model="form.content" class="w-full rounded border p-2" rows="6" placeholder="Content" />
      <label class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox"> Published</label>
      <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Save</button>
    </form>
  </AdminLayout>
</template>
