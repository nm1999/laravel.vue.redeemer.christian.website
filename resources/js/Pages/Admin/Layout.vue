<script setup>
import { Link } from '@inertiajs/vue3';

const links = [
  { name: 'Dashboard', href: '/admin' },
  { name: 'Sermons', href: '/admin/sermons' },
  { name: 'Events', href: '/admin/events' },
  { name: 'Church Leaders', href: '/admin/church-leaders' },
  { name: 'Hero Slides', href: '/admin/hero-slides' },
  { name: 'Home Gallery', href: '/admin/home-gallery-images' },
  { name: 'Live Stream', href: '/admin/live-stream' },
  { name: 'Prayer Requests', href: '/admin/prayer-requests' },
];
</script>

<template>
  <div class="min-h-screen bg-slate-100">
    <header class="border-b border-slate-200 bg-white px-6 py-4">
      <div class="mx-auto flex max-w-6xl items-center justify-between">
        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
        <Link href="/" class="text-sm text-blue-700">View Site</Link>
      </div>
    </header>
    <div class="mx-auto grid max-w-6xl gap-6 p-6 md:grid-cols-[220px_1fr]">
      <nav class="rounded-xl border border-slate-200 bg-white p-4">
        <ul class="space-y-2">
          <li v-for="item in links" :key="item.href">
            <Link :href="item.href" class="block rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100">{{ item.name }}</Link>
          </li>
        </ul>
      </nav>
      <main class="rounded-xl border border-slate-200 bg-white p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
