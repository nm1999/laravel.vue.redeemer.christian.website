<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ posts: Array });
</script>

<template>
  <Layout>
    <Head title="Sermons" />
    <section class="rounded-3xl bg-white p-8 border border-slate-200">
      <h1 class="text-3xl font-bold">Sermons</h1>
      <div class="mt-6 grid gap-4 md:grid-cols-3">
        <article v-for="post in posts" :key="post.id" class="rounded-xl border border-slate-200 p-4">
          <p class="text-xs text-slate-500">{{ post.preached_at }}</p>
          <h2 class="text-xl font-semibold">{{ post.title }}</h2>
          <p class="text-sm text-slate-600">{{ post.speaker }}</p>
          <p class="mt-2">{{ post.excerpt }}</p>
          <Link :href="`/blog/${post.slug}`" class="inline-block mt-3 text-blue-700">Read more</Link>
        </article>
      </div>
    </section>
  </Layout>
</template>
