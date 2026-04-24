<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);

const newsletterForm = useForm({ email: '' });
const subscribe = () => {
  newsletterForm.post('/newsletter/subscribe', {
    preserveScroll: true,
    onSuccess: () => newsletterForm.reset(),
  });
};

const navItems = computed(() => [
  { name: 'Home', href: '/' },
  { name: 'About', href: '/about' },
  { name: 'Sermons', href: '/blog' },
  { name: 'Events', href: '/events' },
  { name: 'Prayer', href: '/prayer-requests' },
  { name: 'Donate', href: '/donate' },
  { name: 'Contact', href: '/contact' },
]);
</script>

<template>
  <div class="min-h-screen bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm">
      <div class="mx-auto max-w-7xl px-6 py-4 sm:px-10 lg:px-16 flex items-center justify-between gap-4">
        <Link href="/" class="text-xl font-semibold">Redeemer Church</Link>
        <nav class="hidden md:flex items-center gap-4 text-sm">
          <Link v-for="item in navItems" :key="item.href" :href="item.href" class="hover:text-blue-700">{{ item.name }}</Link>
          <Link v-if="user?.is_admin" href="/admin/dashboard" class="font-semibold text-blue-700">Admin</Link>
          <Link v-if="!user" href="/admin/login" class="font-semibold text-blue-700">Login</Link>
        </nav>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8 sm:px-10 lg:px-16">
      <div v-if="$page.props.flash?.success" class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
        {{ $page.props.flash.success }}
      </div>
      <slot />
    </main>

    <footer class="border-t border-slate-200 bg-white mt-12">
      <div class="mx-auto max-w-7xl px-6 py-8 sm:px-10 lg:px-16 grid gap-6 md:grid-cols-3 text-sm">
        <div>
          <h3 class="font-semibold">Contact</h3>
          <p>123 Faith Avenue, Kampala</p>
          <p>+256 700 000 000</p>
          <p>hello@redeemerchurch.org</p>
        </div>
        <div>
          <h3 class="font-semibold">Service Times</h3>
          <p>Sunday: 10:00 AM</p>
          <p>Wednesday: 6:30 PM</p>
        </div>
        <form class="space-y-2" @submit.prevent="subscribe">
          <h3 class="font-semibold">Newsletter</h3>
          <input v-model="newsletterForm.email" type="email" required class="w-full rounded border border-slate-300 px-3 py-2" placeholder="Email address" />
          <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="newsletterForm.processing">Subscribe</button>
        </form>
      </div>
    </footer>
  </div>
</template>
