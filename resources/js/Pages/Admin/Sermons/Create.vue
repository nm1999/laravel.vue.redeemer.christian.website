<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const form = useForm({ title: '', slug: '', speaker: '', preached_at: '', excerpt: '', content: '', video_url: '', is_published: true });
const submit = () => form.post('/admin/sermons');
</script>

<template>
  <Layout>
    <Head title="Create Sermon" />
    <section class="rounded-xl bg-white p-5 border">
      <h1 class="text-2xl font-bold mb-4">Create Sermon</h1>
      <form class="space-y-3" @submit.prevent="submit">
        <input v-model="form.title" required class="w-full rounded border px-3 py-2" placeholder="Title" />
        <input v-model="form.slug" required class="w-full rounded border px-3 py-2" placeholder="Slug" />
        <input v-model="form.speaker" required class="w-full rounded border px-3 py-2" placeholder="Speaker" />
        <input v-model="form.preached_at" type="date" required class="w-full rounded border px-3 py-2" />
        <textarea v-model="form.excerpt" class="w-full rounded border px-3 py-2" placeholder="Excerpt" />
        <textarea v-model="form.content" required class="w-full rounded border px-3 py-2" rows="6" placeholder="Content" />
        <input v-model="form.video_url" type="url" class="w-full rounded border px-3 py-2" placeholder="Video URL" />
        <label class="inline-flex gap-2"><input v-model="form.is_published" type="checkbox" /> Published</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
      </form>
    </section>
  </Layout>
</template>
