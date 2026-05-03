<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from '../Layout.vue';
import AdminBtn from '../AdminBtn.vue';

const props = defineProps({ event: Object });
const form = useForm({ ...props.event, image: null });

const existingImageUrl = computed(() => {
  const value = props.event?.image_path;

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
    .post(`/admin/events/${props.event.id}`, { forceFormData: true });
};
</script>

<template>
  <AdminLayout>
    <Head title="Edit Event" />
    <h2 class="mb-4 text-2xl font-semibold">Edit Event</h2>
    <form class="space-y-3" @submit.prevent="submit">
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <input v-model="form.location" class="w-full rounded border p-2" placeholder="Location">
      <input v-model="form.starts_at" type="datetime-local" class="w-full rounded border p-2">
      <input v-model="form.ends_at" type="datetime-local" class="w-full rounded border p-2">
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="text-sm text-red-600">{{ form.errors.image }}</p>
      <img v-if="existingImageUrl" :src="existingImageUrl" alt="Current event image" class="h-24 w-40 rounded object-cover border">
      <textarea v-model="form.description" class="w-full rounded border p-2" rows="6" placeholder="Description" />
      <label class="flex items-center gap-2"><input v-model="form.is_featured" type="checkbox"> Featured</label>
      <AdminBtn :processing="form.processing">Update</AdminBtn>
    </form>
  </AdminLayout>
</template>
