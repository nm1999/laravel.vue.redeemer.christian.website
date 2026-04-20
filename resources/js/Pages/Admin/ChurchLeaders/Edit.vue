<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layout.vue';
import ChurchLeaderForm from './Form.vue';

const props = defineProps({ churchLeader: Object });

const form = useForm({
  name: props.churchLeader.name,
  title: props.churchLeader.title,
  image: null,
  bio: props.churchLeader.bio ?? '',
  order: props.churchLeader.order,
});

const submit = () => form
  .transform((data) => ({ ...data, _method: 'put' }))
  .post(`/admin/church-leaders/${props.churchLeader.id}`, { forceFormData: true });
</script>

<template>
  <AdminLayout>
    <Head title="Edit Church Leader" />
    <h2 class="mb-4 text-2xl font-semibold">Edit Church Leader</h2>
    <ChurchLeaderForm
      :form="form"
      :submit="submit"
      submit-label="Update"
      :existing-image-url="props.churchLeader.image_url"
    />
  </AdminLayout>
</template>
