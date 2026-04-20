<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import ChurchLeaderForm from './Form.vue';

const form = useForm({
  name: '',
  title: '',
  image: null,
  bio: '',
  order: 0,
});

const submit = () => form.post('/admin/church-leaders', { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Create Church Leader" />
    <h2 class="mb-4 text-2xl font-semibold">Create Church Leader</h2>
    <ChurchLeaderForm :form="form" :submit="submit" submit-label="Save" />
  </AdminLayout>
</template>
