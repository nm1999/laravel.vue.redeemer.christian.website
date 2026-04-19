<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({ event: Object });
const form = useForm({ ...props.event });
const submit = () => form.put(`/admin/events/${props.event.id}`);
</script>

<template>
  <Layout>
    <Head title="Edit Event" />
    <section class="rounded-xl bg-white p-5 border">
      <h1 class="text-2xl font-bold mb-4">Edit Event</h1>
      <form class="space-y-3" @submit.prevent="submit">
        <input v-model="form.title" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.slug" required class="w-full rounded border px-3 py-2" />
        <textarea v-model="form.description" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.location" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.starts_at" type="datetime-local" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.ends_at" type="datetime-local" class="w-full rounded border px-3 py-2" />
        <input v-model="form.image_url" type="url" class="w-full rounded border px-3 py-2" />
        <label class="inline-flex gap-2"><input v-model="form.is_featured" type="checkbox" /> Featured</label>
        <label class="inline-flex gap-2"><input v-model="form.is_published" type="checkbox" /> Published</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Update</button>
      </form>
    </section>
  </Layout>
</template>
