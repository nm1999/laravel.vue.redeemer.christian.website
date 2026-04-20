<script setup>
import { Link } from '@inertiajs/vue3';

const navItems = [
  { name: 'Home', href: '/' },
  { name: 'About', href: '/about' },
  { name: 'Blog', href: '/blog' },
  { name: 'Events', href: '/events' },
  { name: 'Give', href: '/donate' },
  { name: 'Contact', href: '/contact' },
];

const socialLinks = [
  { name: 'Facebook', href: '#' },
  { name: 'YouTube', href: '#' },
  { name: 'X', href: '#' },
];
</script>

<template>
  <div class="min-h-screen bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm">
      <div class="border-b border-slate-200 bg-slate-100 text-slate-700">
        <div class="mx-auto flex max-w-7xl items-center justify-end px-6 py-2 sm:px-10 lg:px-16">
          <div class="flex items-center gap-3">
            <a
              v-for="link in socialLinks"
              :key="link.name"
              :href="link.href"
              :aria-label="link.name"
              class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300 bg-white transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700"
            >
              <svg v-if="link.name === 'Facebook'" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.6-1.6H16.8V4.8c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4V11H8v3h2.6v8h2.9Z" />
              </svg>
              <svg v-else-if="link.name === 'YouTube'" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 0 0 .5 6.2 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-5.8ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z" />
              </svg>
              <svg v-else class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M18.9 2H22l-6.8 7.8L23.2 22h-6.3l-4.9-6.9L5.9 22H2.8l7.3-8.3L.8 2h6.4l4.4 6.2L18.9 2Zm-1.1 18h1.8L6.2 3.9H4.3l13.5 16.1Z" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="mx-auto max-w-7xl px-6 py-5 sm:px-10 lg:px-16">
        <div class="flex items-center justify-between gap-4">
          <Link href="/" class="flex items-center gap-3 text-xl font-semibold tracking-tight text-slate-900">
            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-700 shadow-inner shadow-blue-500/10">RC</span>
            Redeemer Church
          </Link>

          <nav class="hidden items-center gap-8 md:flex">
            <Link v-for="item in navItems" :key="item.href" :href="item.href" class="text-slate-700 transition hover:text-blue-700">
              {{ item.name }}
            </Link>
          </nav>

          <Link href="/donate" class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 sm:px-5 sm:py-2.5">
            Give Online
          </Link>
        </div>

        <nav class="mt-4 flex items-center gap-5 overflow-x-auto pb-1 text-sm md:hidden">
          <Link v-for="item in navItems" :key="`mobile-${item.href}`" :href="item.href" class="whitespace-nowrap text-slate-700 transition hover:text-blue-700">
            {{ item.name }}
          </Link>
        </nav>
      </div>
    </header>

    <main class="px-6 py-8 sm:px-10 lg:px-16">
      <slot />
    </main>

    <footer class="border-t border-slate-200 bg-slate-100 px-6 py-12 text-slate-600 sm:px-10 lg:px-16">
      <div class="mx-auto flex max-w-7xl flex-col gap-8 md:flex-row md:items-center md:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Redeemer Christian Church</h2>
          <p class="max-w-xl text-sm leading-6 text-slate-600">A warm community blessed by worship, connection, and joyful service.</p>
        </div>

        <div class="grid gap-4 text-sm sm:grid-cols-3">
          <div>
            <p class="font-semibold text-slate-900">Worship</p>
            <p>Sunday 10AM</p>
          </div>
          <div>
            <p class="font-semibold text-slate-900">Location</p>
            <p>123 Faith Avenue</p>
          </div>
          <div>
            <p class="font-semibold text-slate-900">Email</p>
            <p>hello@redeemerchurch.org</p>
          </div>
        </div>

        <div class="text-sm">
          <Link href="/donate" class="font-semibold text-blue-700 hover:text-blue-900">Support the ministry</Link>
        </div>
      </div>
    </footer>
  </div>
</template>
