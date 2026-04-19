<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';

const form = useForm({ title: '', description: '', location: '', image_path: '', starts_at: '', ends_at: '', is_featured: false });
const submit = () => form.post('/admin/events');
</script>

<template>
  <AdminLayout>
    <Head title="Create Event" />
    <h2 class="mb-4 text-2xl font-semibold">Create Event</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <input v-model="form.location" class="w-full rounded border p-2" placeholder="Location">
      <input v-model="form.starts_at" type="datetime-local" class="w-full rounded border p-2">
      <input v-model="form.ends_at" type="datetime-local" class="w-full rounded border p-2">
      <input v-model="form.image_path" class="w-full rounded border p-2" placeholder="Image URL">
      <textarea v-model="form.description" class="w-full rounded border p-2" rows="6" placeholder="Description" />
      <label class="flex items-center gap-2"><input v-model="form.is_featured" type="checkbox"> Featured</label>
      <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Save</button>
    </form>
  </AdminLayout>
</template>
