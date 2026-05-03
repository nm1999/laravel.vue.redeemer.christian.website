<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from '../Layout.vue';
import AdminBtn from '../AdminBtn.vue';

const props = defineProps({ sermon: Object });
const form = useForm({ ...props.sermon, image: null });

const existingImageUrl = computed(() => {
  const value = props.sermon?.image_path;

  if (! value) {
    return null;
  }

  if (value.startsWith('http://') || value.startsWith('https://') || value.startsWith('/')) {
    return value;
  }

  return `/storage/${value}`;
});

const updateImage = (event) => {
  form.image = event.target.files[0] || null;
};

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      _method: 'put',
    }))
    .post(`/admin/sermons/${props.sermon.id}`, { forceFormData: true });
};
</script>

<template>
  <AdminLayout>
    <Head title="Edit Sermon" />
    <h2 class="mb-4 text-2xl font-semibold">Edit Sermon</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <input v-model="form.speaker" class="w-full rounded border p-2" placeholder="Speaker">
      <input v-model="form.preached_at" type="datetime-local" class="w-full rounded border p-2">
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="text-sm text-red-600">{{ form.errors.image }}</p>
      <img v-if="existingImageUrl" :src="existingImageUrl" alt="Current sermon image" class="h-24 w-40 rounded object-cover border">
      <textarea v-model="form.excerpt" class="w-full rounded border p-2" placeholder="Excerpt" />
      <textarea v-model="form.content" class="w-full rounded border p-2" rows="6" placeholder="Content" />
      <label class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox"> Published</label>
      <AdminBtn :processing="form.processing">Update</AdminBtn>
    </form>
  </AdminLayout>
</template>
