<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const form = useForm({ title: '', slug: '', description: '', location: '', starts_at: '', ends_at: '', image_url: '', is_featured: false, is_published: true });
const submit = () => form.post('/admin/events');
</script>

<template>
  <Layout>
    <Head title="Create Event" />
    <section class="rounded-xl bg-white p-5 border">
      <h1 class="text-2xl font-bold mb-4">Create Event</h1>
      <form class="space-y-3" @submit.prevent="submit">
        <input v-model="form.title" required class="w-full rounded border px-3 py-2" placeholder="Title" />
        <input v-model="form.slug" required class="w-full rounded border px-3 py-2" placeholder="Slug" />
        <textarea v-model="form.description" required class="w-full rounded border px-3 py-2" placeholder="Description" />
        <input v-model="form.location" required class="w-full rounded border px-3 py-2" placeholder="Location" />
        <input v-model="form.starts_at" type="datetime-local" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.ends_at" type="datetime-local" class="w-full rounded border px-3 py-2" />
        <input v-model="form.image_url" type="url" class="w-full rounded border px-3 py-2" placeholder="Image URL" />
        <label class="inline-flex gap-2"><input v-model="form.is_featured" type="checkbox" /> Featured</label>
        <label class="inline-flex gap-2"><input v-model="form.is_published" type="checkbox" /> Published</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
      </form>
    </section>
  </Layout>
</template>
