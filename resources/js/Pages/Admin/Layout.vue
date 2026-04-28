<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const page = usePage();

const toast = ref(null);
let toastTimer = null;

watch(
  () => page.props.flash,
  (flash) => {
    if (flash?.success || flash?.error) {
      clearTimeout(toastTimer);
      toast.value = {
        message: flash.success || flash.error,
        type: flash.success ? 'success' : 'error',
      };
      toastTimer = setTimeout(() => { toast.value = null; }, 4000);
    }
  },
  { deep: true, immediate: true },
);

const links = [
  { name: 'Dashboard', href: '/admin' },
  { name: 'Sermons', href: '/admin/sermons' },
  { name: 'Events', href: '/admin/events' },
  { name: 'Church Leaders', href: '/admin/church-leaders' },
  { name: 'Hero Slides', href: '/admin/hero-slides' },
  { name: 'Home Gallery', href: '/admin/home-gallery-images' },
  { name: 'Live Stream', href: '/admin/live-stream' },
  { name: 'Prayer Requests', href: '/admin/prayer-requests' },
  { name: 'Site Settings', href: '/admin/site-settings' },
];
</script>

<template>
  <div class="min-h-screen bg-slate-100">
    <!-- Toast notification -->
    <Transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="translate-y-2 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="translate-y-2 opacity-0"
    >
      <div
        v-if="toast"
        class="fixed bottom-6 right-6 z-50 flex items-center gap-3 rounded-xl px-5 py-3 text-sm font-medium text-white shadow-xl"
        :class="toast.type === 'success' ? 'bg-emerald-600' : 'bg-red-600'"
      >
        <svg v-if="toast.type === 'success'" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        <svg v-else class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        {{ toast.message }}
        <button class="ml-1 rounded hover:opacity-70" @click="toast = null">✕</button>
      </div>
    </Transition>
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
