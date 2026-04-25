<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import HeroSlideForm from './Form.vue';

const form = useForm({
  kicker: '',
  title: '',
  description: '',
  image: null,
  order: 0,
  is_active: true,
});

const submit = () => form.post('/admin/hero-slides', { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Create Hero Slide" />
    <h2 class="mb-4 text-2xl font-semibold">Create Hero Slide</h2>
    <HeroSlideForm :form="form" :submit="submit" submit-label="Save" />
  </AdminLayout>
</template>