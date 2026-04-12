<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useScrollReveal } from '../composables/useScrollReveal';

const props = defineProps({
  post: Object,
});

useScrollReveal();
</script>

<template>
  <Layout>
    <Head :title="post.title" />

    <div class="scroll-reveal reveal-from-bottom space-y-8 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/60">
      <div class="scroll-reveal reveal-from-bottom flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" style="--reveal-delay: 40ms">
        <div class="space-y-3">
          <p class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Blog post</p>
          <h1 class="text-4xl font-bold text-slate-900">{{ post.title }}</h1>
          <p class="text-sm uppercase tracking-[0.24em] text-slate-500">{{ post.date }} · {{ post.author }}</p>
        </div>
        <Link href="/blog" class="rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Back to blog</Link>
      </div>

      <div class="scroll-reveal reveal-from-bottom overflow-hidden rounded-[28px] bg-slate-100 border border-slate-200" style="--reveal-delay: 90ms">
        <img :src="post.image" :alt="post.title" class="h-[420px] w-full object-cover" />
      </div>

      <div class="scroll-reveal reveal-from-bottom max-w-none space-y-6 text-slate-700" style="--reveal-delay: 130ms">
        <p class="text-lg leading-8">{{ post.excerpt }}</p>
        <p class="leading-8">{{ post.body1 }}</p>
        <p class="leading-8">{{ post.body2 }}</p>
      </div>
    </div>
  </Layout>
</template>
