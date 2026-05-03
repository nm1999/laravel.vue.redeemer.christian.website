<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import AdminBtn from '../AdminBtn.vue';

const form = useForm({ title: '', excerpt: '', content: '', image: null, speaker: '', preached_at: '', is_published: true });
const updateImage = (event) => {
  form.image = event.target.files[0] || null;
};

const submit = () => form.post('/admin/sermons', { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Create Sermon" />
    <h2 class="mb-4 text-2xl font-semibold">Create Sermon</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <input v-model="form.speaker" class="w-full rounded border p-2" placeholder="Speaker">
      <input v-model="form.preached_at" type="datetime-local" class="w-full rounded border p-2">
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="text-sm text-red-600">{{ form.errors.image }}</p>
      <textarea v-model="form.excerpt" class="w-full rounded border p-2" placeholder="Excerpt" />
      <textarea v-model="form.content" class="w-full rounded border p-2" rows="6" placeholder="Content" />
      <label class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox"> Published</label>
      <AdminBtn :processing="form.processing">Save</AdminBtn>
    </form>
  </AdminLayout>
</template>
