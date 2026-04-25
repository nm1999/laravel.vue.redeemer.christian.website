<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import HomeGalleryImageForm from './Form.vue';

const props = defineProps({ homeGalleryImage: Object });

const form = useForm({
  image: null,
  order: props.homeGalleryImage.order,
  is_active: Boolean(props.homeGalleryImage.is_active),
});

const submit = () => form
  .transform((data) => ({ ...data, _method: 'put' }))
  .post(`/admin/home-gallery-images/${props.homeGalleryImage.id}`, { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Edit Home Gallery Image" />
    <h2 class="mb-4 text-2xl font-semibold">Edit Home Gallery Image</h2>
    <HomeGalleryImageForm
      :form="form"
      :submit="submit"
      submit-label="Update"
      :existing-image-url="props.homeGalleryImage.image_url"
    />
  </AdminLayout>
</template>