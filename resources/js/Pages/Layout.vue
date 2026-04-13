<script setup>
import { Link } from '@inertiajs/vue3';

const navItems = [
  { name: 'Home', href: '/' },
  { name: 'About', href: '/about' },
  { name: 'Blog', href: '/blog' },
  { name: 'Contact', href: '/contact' },
];
</script>

<template>
  <div class="min-h-screen bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm">
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

          <Link href="/contact" class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 sm:px-5 sm:py-2.5">
            Get in Touch
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
      </div>
    </footer>
  </div>
</template>
