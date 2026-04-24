<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({ liveStream: Object });
const form = useForm({
  platform: props.liveStream?.platform ?? 'youtube',
  title: props.liveStream?.title ?? 'Join us live',
  url: props.liveStream?.url ?? '',
  is_active: props.liveStream?.is_active ?? true,
});
const submit = () => form.put('/admin/live-stream');
</script>

<template>
  <Layout>
    <Head title="Live Stream" />
    <section class="rounded-xl bg-white p-5 border max-w-2xl">
      <h1 class="text-2xl font-bold mb-4">Live Stream Settings</h1>
      <form class="space-y-3" @submit.prevent="submit">
        <select v-model="form.platform" class="w-full rounded border px-3 py-2">
          <option value="youtube">YouTube</option>
          <option value="facebook">Facebook Live</option>
          <option value="custom">Custom Embed</option>
        </select>
        <input v-model="form.title" required class="w-full rounded border px-3 py-2" placeholder="Title" />
        <input v-model="form.url" type="url" required class="w-full rounded border px-3 py-2" placeholder="Stream URL" />
        <label class="inline-flex gap-2"><input v-model="form.is_active" type="checkbox" /> Active</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
      </form>
    </section>
  </Layout>
</template>
