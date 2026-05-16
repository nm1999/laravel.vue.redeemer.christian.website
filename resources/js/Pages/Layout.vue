<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const whatsappHref = computed(() => {
  const num = page.props.siteSettings?.whatsapp_number;
  return num ? `https://wa.me/${num}` : 'https://wa.me/';
});
const youtubeLiveHref = computed(() => {
  return page.props.siteSettings?.youtube_live_url || 'https://www.youtube.com';
});

const navItems = [
  { name: 'HOME', href: '/' },
  { name: 'ABOUT US', href: '/about' },
  { name: 'ACTIVITIES', href: '/activities' },
  { name: 'EVENTS', href: '/events' },
  { name: 'CONTACT', href: '/contact' },
  { name: 'GALLERY', href: '/gallery' },
];

const socialLinks = computed(() => [
  {
    name: 'Facebook',
    href: page.props.siteSettings?.facebook_url || 'https://www.facebook.com',
    classes: 'border-blue-200 bg-blue-50 text-blue-700 hover:border-blue-300 hover:bg-blue-100',
  },
  {
    name: 'YouTube',
    href: page.props.siteSettings?.youtube_url || 'https://www.youtube.com',
    classes: 'border-red-200 bg-red-50 text-red-700 hover:border-red-300 hover:bg-red-100',
  },
  {
    name: 'X',
    href: page.props.siteSettings?.twitter_url || 'https://x.com',
    classes: 'border-blue-200 bg-blue-50 text-blue-700 hover:border-blue-300 hover:bg-blue-100',
  },
]);
</script>

<template>
  <div class="min-h-screen bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm">
      <div class="border-b border-slate-200 bg-slate-100 text-slate-700">
        <div class="mx-auto flex max-w-7xl items-center justify-end px-6 py-1 sm:px-10 lg:px-16">
          <div class="flex items-center gap-2">
            <a
              v-for="link in socialLinks"
              :key="link.name"
              :href="link.href"
              target="_blank"
              rel="noopener noreferrer"
              :aria-label="link.name"
              :class="[
                'inline-flex h-7 w-7 items-center justify-center rounded-full border transition',
                link.classes,
              ]"
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
            <div class="rounded-xl from-red-600 to-blue-600 p-1">
              <div style="display:inline-flex;align-items:center;gap:0.5rem;" class="rounded-lg bg-white p-1">
                <div class="">
                   <img src="images/logo.jpg" alt="Redeemer Christian Church Logo" class="block h-14 w-auto rounded-lg bg-white object-contain px-2 py-1">
                </div>
                <div class="">
                  <h6 style="font-weight: bolder;">REDEEMER CHRISTIAN <p></p> FELLOWSHIP MINISTRY</h6>
                </div>               
              </div>
            </div>
          </Link>

          <nav class="hidden items-center gap-8 md:flex">
            <Link v-for="item in navItems" :key="item.href" :href="item.href" class="text-slate-700 transition hover:text-blue-700">
              {{ item.name }}
            </Link>
          </nav>

          <Link href="/donate" class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 sm:px-5 sm:py-2.5">
            Donate
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

    <!-- Floating action buttons — WhatsApp & YouTube Live -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
      <!-- YouTube Live -->
      <a
        :href="youtubeLiveHref"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Watch us live on YouTube"
        class="fab-yt group flex items-center gap-2 rounded-full bg-red-600 py-3 pl-3 pr-4 text-white shadow-2xl shadow-red-600/40 transition-all hover:bg-red-500"
      >
        <span class="fab-ring" aria-hidden="true" />
        <!-- YouTube icon -->
        <svg class="h-5 w-5 flex-shrink-0 fill-white" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 0 0 .5 6.2 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-5.8ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z" />
        </svg>
        <span class="max-w-0 overflow-hidden whitespace-nowrap text-sm font-semibold transition-all duration-300 group-hover:max-w-[8rem]">Watch Live Service</span>
      </a>

      <!-- WhatsApp -->
      <a
        :href="whatsappHref"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat with us on WhatsApp"
        class="group flex items-center gap-2 rounded-full bg-[#25D366] py-3 pl-3 pr-4 text-white shadow-2xl shadow-green-500/40 transition-all hover:bg-[#1ebe59]"
      >
        <!-- WhatsApp icon -->
        <svg class="h-5 w-5 flex-shrink-0 fill-white" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
        </svg>
        <span class="max-w-0 overflow-hidden whitespace-nowrap text-sm font-semibold transition-all duration-300 group-hover:max-w-[8rem]">WhatsApp Us</span>
      </a>
    </div>

    <footer class="border-t border-slate-200 bg-slate-100 px-6 py-12 text-slate-600 sm:px-10 lg:px-16">
      <div class="mx-auto flex max-w-7xl flex-col gap-8 md:flex-row md:items-center md:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Redeemer Christian Church</h2>
          <p class="max-w-xl text-sm leading-6 text-slate-600">A warm community blessed by worship, connection, and joyful service.</p>
        </div>

        <div class="grid gap-4 text-sm sm:grid-cols-3">
          <div>
            <p class="font-semibold text-slate-900">Worship</p>
            <p>Sunday 8AM</p>
          </div>
          <div>
            <p class="font-semibold text-slate-900">Location</p>
            <p>{{ page.props.siteSettings?.location || '123 Faith Avenue' }}</p>
          </div>
          <div>
            <p class="font-semibold text-slate-900">Email</p>
            <p>{{ page.props.siteSettings?.email || 'hello@redeemerchurch.org' }}</p>
          </div>
        </div>

        <div class="text-sm">
          <Link href="/donate" class="font-semibold text-blue-700 hover:text-blue-900">Support the ministry</Link>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* YouTube Live FAB pulsing ring */
.fab-yt {
  position: relative;
  overflow: visible;
}

.fab-ring {
  position: absolute;
  inset: 0;
  border-radius: 9999px;
  border: 2px solid #ef4444;
  animation: fab-ping 1.8s cubic-bezier(0, 0, 0.2, 1) infinite;
  pointer-events: none;
}

@keyframes fab-ping {
  0%   { transform: scale(1);    opacity: 0.7; }
  80%  { transform: scale(1.6);  opacity: 0;   }
  100% { transform: scale(1.6);  opacity: 0;   }
}
</style>
