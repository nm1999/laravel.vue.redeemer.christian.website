<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  events: Array,
  latestSermons: Array,
  liveStream: Object,
  testimonials: Array,
});
</script>

<template>
  <Layout>
    <Head title="Home" />

    <section class="rounded-3xl bg-white p-8 border border-slate-200">
      <h1 class="text-4xl font-bold">Welcome to Redeemer Christian Church</h1>
      <p class="mt-4 text-slate-700">Join us Sunday at 10:00 AM. Come as you are and worship with us.</p>
      <div class="mt-6 flex gap-3">
        <Link href="/events" class="rounded bg-blue-600 px-4 py-2 text-white">Plan Your Visit</Link>
        <Link href="/donate" class="rounded border border-blue-600 px-4 py-2 text-blue-700">Give Online</Link>
      </div>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-8 border border-slate-200" v-if="liveStream">
      <h2 class="text-2xl font-semibold">Watch Live</h2>
      <p class="text-slate-600">{{ liveStream.title }}</p>
      <div class="mt-4 aspect-video overflow-hidden rounded-xl border border-slate-200">
        <iframe :src="liveStream.embed_url" class="h-full w-full" allowfullscreen />
      </div>
    </section>

    <section class="mt-8 grid gap-6 lg:grid-cols-3">
      <article class="rounded-3xl bg-white p-6 border border-slate-200" v-for="event in events" :key="event.id">
        <p class="text-xs uppercase text-slate-500">{{ new Date(event.starts_at).toLocaleString() }}</p>
        <h3 class="text-xl font-semibold mt-2">{{ event.title }}</h3>
        <p class="text-slate-600 mt-2">{{ event.location }}</p>
      </article>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-8 border border-slate-200">
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Latest Sermons</h2>
        <Link href="/blog" class="text-blue-700">View all</Link>
      </div>
      <div class="mt-4 grid gap-4 md:grid-cols-3">
        <article v-for="sermon in latestSermons" :key="sermon.id" class="rounded-xl border border-slate-200 p-4">
          <h3 class="font-semibold">{{ sermon.title }}</h3>
          <p class="text-sm text-slate-500">{{ sermon.speaker }}</p>
          <p class="text-sm mt-2">{{ sermon.excerpt }}</p>
        </article>
      </div>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-8 border border-slate-200" v-if="testimonials?.length">
      <h2 class="text-2xl font-semibold">Testimonials</h2>
      <div class="grid gap-4 md:grid-cols-3 mt-4">
        <blockquote v-for="item in testimonials" :key="item.id" class="rounded-xl border border-slate-200 p-4">
          “{{ item.quote }}”
          <footer class="mt-2 text-sm text-slate-600">{{ item.name }} <span v-if="item.role">· {{ item.role }}</span></footer>
        </blockquote>
      </div>
    </section>
  </Layout>
</template>
