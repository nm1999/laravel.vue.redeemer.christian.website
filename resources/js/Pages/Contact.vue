<script setup>
import Layout from './Layout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { useScrollReveal } from '../composables/useScrollReveal';
import { computed, ref, watch, onMounted } from 'vue';

useScrollReveal();
const settings = ref({});

const loadingSettings = async ()=> {
  const response  = await axios.get("/api/site-settings");
  settings.value = response.data.siteSettings;
  console.log(response.data);
}

onMounted(()=>{
  loadingSettings();
});

const page = usePage();
const toastMessage = ref('');
let toastTimer = null;

watch(
  () => page.props.flash?.success,
  (value) => {
    if (! value) {
      return;
    }

    if (toastTimer) {
      clearTimeout(toastTimer);
    }

    toastMessage.value = value;
    toastTimer = setTimeout(() => {
      toastMessage.value = '';
    }, 4000);
  },
  { immediate: true }
);

const contactEmail = computed(() => settings.value?.email || 'hello@redeemerchurch.org');
const contactLocation = computed(() => settings.value?.location || '123 Faith Avenue, Main City');
const mapsQuery = computed(() => encodeURIComponent(contactLocation.value));
const mapsEmbedUrl = computed(() => `https://www.google.com/maps?q=${mapsQuery.value}&output=embed`);
const mapsOpenUrl = computed(() => `https://www.google.com/maps?q=${mapsQuery.value}`);

const form = useForm({
  name: '',
  email: '',
  phone_number: '',
  request_text: '',
  is_private: true,
});

const submitMessage = () => {
  form.post('/prayer-requests', {
    preserveScroll: true,
    onSuccess: () => form.reset('name', 'email', 'phone_number', 'request_text'),
  });
};
</script>

<template>
  <Layout>
    <Head title="Contact" />

    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="translate-y-2 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="translate-y-2 opacity-0"
    >
      <div
        v-if="toastMessage"
        class="fixed right-6 top-24 z-[70] flex max-w-sm items-center gap-3 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-medium text-white shadow-2xl"
      >
        <svg class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.25 7.25a1 1 0 01-1.415 0l-3-3a1 1 0 011.414-1.42l2.293 2.294 6.543-6.544a1 1 0 011.415 0z" clip-rule="evenodd" />
        </svg>
        <span>{{ toastMessage }}</span>
        <button type="button" class="ml-1 rounded hover:opacity-80" @click="toastMessage = ''">x</button>
      </div>
    </transition>

    <section class="scroll-reveal reveal-from-bottom grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
      <div class="scroll-reveal reveal-from-left rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/60" style="--reveal-delay: 70ms">
        <div class="space-y-6">
          <div>
            <p class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Contact</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Reach out to Us.</h1>
            <p class="mt-4 text-slate-700 leading-8">We’d love to welcome you, answer questions, and share how you can connect with our community.</p>
          </div>

          <div class="space-y-5 rounded-3xl bg-slate-50 p-6 text-slate-700 shadow-lg shadow-slate-200/50">
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-700">Email</p>
              <p class="mt-2 text-lg font-semibold text-slate-900">{{ contactEmail }}</p>
            </div>
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-700">Visit us</p>
              <p class="mt-2 text-lg font-semibold text-slate-900">{{ contactLocation }}</p>
            </div>
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-700">Office hours</p>
              <p class="mt-2 text-lg font-semibold text-slate-900">Mon–Fri 9AM–5PM</p>
            </div>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="scroll-reveal reveal-from-bottom rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60" style="--reveal-delay: 60ms">
              <p class="text-xl font-semibold text-slate-900">Prayer requests</p>
              <p class="mt-3 text-slate-700 leading-7">Send us your needs and we’ll pray with you through our weekly prayer team.</p>
            </div>
            <div class="scroll-reveal reveal-from-bottom rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60" style="--reveal-delay: 130ms">
              <p class="text-xl font-semibold text-slate-900">Visit information</p>
              <p class="mt-3 text-slate-700 leading-7">Plan your first visit with directions, childcare details, and what to expect.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="scroll-reveal reveal-from-right rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/60" style="--reveal-delay: 120ms">
        <div class="space-y-6">
          <h2 class="text-3xl font-semibold text-slate-900">Send a message</h2>
          <p class="text-slate-700 leading-7">Use this form to share your prayer requests, ask about our ministries, or tell us how we can assist you.</p>
          <form class="space-y-5" @submit.prevent="submitMessage">
            <label class="block text-sm font-medium text-slate-700">
              Name
              <input
                v-model="form.name"
                type="text"
                placeholder="Your name"
                class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
              />
              <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Email
              <input
                v-model="form.email"
                type="email"
                placeholder="you@example.com"
                class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
              />
              <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Phone Number
              <input
                v-model="form.phone_number"
                type="text"
                placeholder="+263 77 123 4567"
                class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
              />
              <p v-if="form.errors.phone_number" class="mt-2 text-sm text-red-600">{{ form.errors.phone_number }}</p>
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Message
              <textarea
                v-model="form.request_text"
                rows="5"
                placeholder="How can we help?"
                class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
              ></textarea>
              <p v-if="form.errors.request_text" class="mt-2 text-sm text-red-600">{{ form.errors.request_text }}</p>
            </label>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex w-full justify-center rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-blue-600 disabled:cursor-not-allowed disabled:opacity-60"
            >
              {{ form.processing ? 'Sending...' : 'Send message' }}
            </button>
          </form>
        </div>
      </div>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/60" style="--reveal-delay: 80ms">
      <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Location</p>
          <h2 class="mt-3 text-3xl font-semibold text-slate-900">Find us on the map</h2>
        </div>
        <a
          :href="mapsOpenUrl"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-5 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100"
        >
          Open in Google Maps
        </a>
      </div>

      <div class="mt-6 overflow-hidden rounded-[24px] border border-slate-200">
        <iframe
          title="Redeemer Church location map"
          :src="mapsEmbedUrl"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="h-[420px] w-full border-0"
          allowfullscreen
        ></iframe>
      </div>
    </section>
  </Layout>
</template>

