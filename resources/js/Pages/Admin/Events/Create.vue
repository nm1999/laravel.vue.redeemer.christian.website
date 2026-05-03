<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import AdminBtn from '../AdminBtn.vue';

const form = useForm({ title: '', description: '', location: '', image: null, starts_at: '', ends_at: '', is_featured: false });
const updateImage = (event) => {
  form.image = event.target.files[0] || null;
};

const submit = () => form.post('/admin/events', { forceFormData: true });
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
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="text-sm text-red-600">{{ form.errors.image }}</p>
      <textarea v-model="form.description" class="w-full rounded border p-2" rows="6" placeholder="Description" />
      <label class="flex items-center gap-2"><input v-model="form.is_featured" type="checkbox"> Featured</label>
      <AdminBtn :processing="form.processing">Save</AdminBtn>
    </form>
  </AdminLayout>
</template>
