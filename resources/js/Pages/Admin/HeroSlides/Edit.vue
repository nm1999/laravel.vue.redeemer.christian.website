<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import HeroSlideForm from './Form.vue';

const props = defineProps({ heroSlide: Object });

const form = useForm({
  kicker: props.heroSlide.kicker,
  title: props.heroSlide.title,
  description: props.heroSlide.description,
  image: null,
  order: props.heroSlide.order,
  is_active: Boolean(props.heroSlide.is_active),
});

const submit = () => form
  .transform((data) => ({ ...data, _method: 'put' }))
  .post(`/admin/hero-slides/${props.heroSlide.id}`, { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Edit Hero Slide" />
    <h2 class="mb-4 text-2xl font-semibold">Edit Hero Slide</h2>
    <HeroSlideForm
      :form="form"
      :submit="submit"
      submit-label="Update"
      :existing-image-url="props.heroSlide.image_url"
    />
  </AdminLayout>
</template>