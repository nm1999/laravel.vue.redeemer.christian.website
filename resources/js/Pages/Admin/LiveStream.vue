<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from './Layout.vue';

const props = defineProps({ liveStream: Object });

const form = useForm({
  platform: props.liveStream?.platform ?? 'youtube',
  embed_url: props.liveStream?.embed_url ?? '',
  is_active: props.liveStream?.is_active ?? true,
});

const submit = () => form.put('/admin/live-stream');
</script>

<template>
  <AdminLayout>
    <Head title="Live Stream Settings" />
    <h2 class="mb-4 text-2xl font-semibold">Live Stream</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <select v-model="form.platform" class="w-full rounded border p-2">
        <option value="youtube">YouTube</option>
        <option value="facebook">Facebook</option>
      </select>
      <input v-model="form.embed_url" class="w-full rounded border p-2" placeholder="https://www.youtube.com/embed/...">
      <label class="flex items-center gap-2"><input v-model="form.is_active" type="checkbox"> Active</label>
      <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">Save</button>
    </form>
  </AdminLayout>
</template>
