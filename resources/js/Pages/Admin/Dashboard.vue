<script setup>
import Layout from './Layout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ stats: Object });
</script>

<template>
  <Layout>
    <Head title="Admin Dashboard" />
    <section class="grid gap-4 md:grid-cols-4">
      <article class="rounded-xl bg-white p-5 border" v-for="(value, key) in stats" :key="key">
        <p class="text-sm text-slate-500">{{ key }}</p>
        <p class="text-3xl font-bold">{{ value }}</p>
      </article>
    </section>
  </Layout>
</template>
