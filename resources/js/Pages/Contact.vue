<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useScrollReveal } from '../composables/useScrollReveal';

useScrollReveal();
</script>

<template>
  <Layout>
    <Head title="Contact" />

    <section class="scroll-reveal reveal-from-bottom grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
      <div class="scroll-reveal reveal-from-left rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/60" style="--reveal-delay: 70ms">
        <div class="space-y-6">
          <div>
            <p class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Contact</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Reach out to Redeemer Church.</h1>
            <p class="mt-4 text-slate-700 leading-8">We’d love to welcome you, answer questions, and share how you can connect with our community.</p>
          </div>

          <div class="space-y-5 rounded-3xl bg-slate-50 p-6 text-slate-700 shadow-lg shadow-slate-200/50">
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-700">Email</p>
              <p class="mt-2 text-lg font-semibold text-slate-900">hello@redeemerchurch.org</p>
            </div>
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-700">Visit us</p>
              <p class="mt-2 text-lg font-semibold text-slate-900">123 Faith Avenue, Main City</p>
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
          <form class="space-y-5">
            <label class="block text-sm font-medium text-slate-700">
              Name
              <input type="text" placeholder="Your name" class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" />
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Email
              <input type="email" placeholder="you@example.com" class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" />
            </label>
            <label class="block text-sm font-medium text-slate-700">
              Message
              <textarea rows="5" placeholder="How can we help?" class="mt-3 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"></textarea>
            </label>
            <button type="submit" class="inline-flex w-full justify-center rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-emerald-400">Send message</button>
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
          href="https://www.google.com/maps?q=123+Faith+Avenue,+Main+City"
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
          src="https://www.google.com/maps?q=123+Faith+Avenue,+Main+City&output=embed"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="h-[420px] w-full border-0"
          allowfullscreen
        ></iframe>
      </div>
    </section>
  </Layout>
</template>

