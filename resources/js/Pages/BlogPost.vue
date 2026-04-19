<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ post: Object });
</script>

<template>
  <Layout>
    <Head :title="post.title" />
    <article class="rounded-3xl bg-white p-8 border border-slate-200">
      <p class="text-sm text-slate-500">{{ post.preached_at }} · {{ post.speaker }}</p>
      <h1 class="text-4xl font-bold mt-2">{{ post.title }}</h1>
      <p class="mt-4">{{ post.excerpt }}</p>
      <div class="mt-6 whitespace-pre-line">{{ post.content }}</div>
      <a v-if="post.video_url" :href="post.video_url" class="inline-block mt-4 text-blue-700" target="_blank">Watch sermon video</a>
      <div class="mt-6"><Link href="/blog" class="text-blue-700">← Back to sermons</Link></div>
    </article>
  </Layout>
</template>
