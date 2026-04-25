<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import HomeGalleryImageForm from './Form.vue';

const form = useForm({
  image: null,
  order: 0,
  is_active: true,
});

const submit = () => form.post('/admin/home-gallery-images', { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Create Home Gallery Image" />
    <h2 class="mb-4 text-2xl font-semibold">Create Home Gallery Image</h2>
    <HomeGalleryImageForm :form="form" :submit="submit" submit-label="Save" />
  </AdminLayout>
</template>