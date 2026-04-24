<script setup>
import Layout from '../Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({ testimonial: Object });
const form = useForm({ ...props.testimonial });
const submit = () => form.put(`/admin/testimonials/${props.testimonial.id}`);
</script>

<template>
  <Layout>
    <Head title="Edit Testimonial" />
    <section class="rounded-xl bg-white p-5 border">
      <h1 class="text-2xl font-bold mb-4">Edit Testimonial</h1>
      <form class="space-y-3" @submit.prevent="submit">
        <input v-model="form.name" required class="w-full rounded border px-3 py-2" />
        <input v-model="form.role" class="w-full rounded border px-3 py-2" />
        <textarea v-model="form.quote" required class="w-full rounded border px-3 py-2" rows="5" />
        <label class="inline-flex gap-2"><input v-model="form.is_published" type="checkbox" /> Published</label>
        <button class="rounded bg-blue-600 px-4 py-2 text-white">Update</button>
      </form>
    </section>
  </Layout>
</template>
