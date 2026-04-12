<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useScrollReveal } from '../composables/useScrollReveal';

const props = defineProps({
  posts: Array,
});

useScrollReveal();
</script>

<template>
  <Layout>
    <Head title="Blog" />

    <section class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50">
      <div class="space-y-6">
        <div class="space-y-3">
          <p class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Church stories</p>
          <h1 class="text-4xl font-bold text-slate-900 sm:text-5xl">Inspiring messages, stories, and community updates.</h1>
          <p class="max-w-2xl text-lg leading-8 text-slate-600">Read the latest reflections, encouragement, and practical faith resources from Redeemer Christian Church.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
          <article
            v-for="(post, index) in posts"
            :key="post.slug"
            class="scroll-reveal group overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-lg shadow-slate-200/70 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:bg-white"
            :class="[
              index % 2 === 0 ? 'reveal-from-left' : 'reveal-from-right',
              index < 3 ? 'is-visible' : '',
            ]"
            :style="index < 3 ? {} : { '--reveal-delay': `${(index - 3) * 90}ms` }"
          >
            <div class="space-y-4">
              <div class="overflow-hidden rounded-3xl bg-slate-100">
                <img :src="post.image" :alt="post.title" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105" />
              </div>
              <div>
                <p class="text-sm uppercase tracking-[0.24em] text-red-600">{{ post.date }}</p>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900">{{ post.title }}</h2>
                <p class="mt-4 text-slate-700 leading-7">{{ post.excerpt }}</p>
              </div>
            </div>

            <div class="mt-6">
              <Link :href="`/blog/${post.slug}`" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 transition hover:text-blue-900">
                Read more
                <span aria-hidden="true">→</span>
              </Link>
            </div>
          </article>
        </div>
      </div>
    </section>
  </Layout>
</template>
