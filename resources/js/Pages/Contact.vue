<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Layout>
    <Head title="Contact" />

    <section class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
      <div class="rounded-[32px] border border-white/10 bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-md">
        <div class="space-y-6">
          <div>
            <p class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-emerald-200">Contact</p>
            <h1 class="mt-4 text-4xl font-bold text-white">Reach out to Redeemer Church.</h1>
            <p class="mt-4 text-slate-300 leading-8">We’d love to welcome you, answer questions, and share how you can connect with our community.</p>
          </div>

          <div class="space-y-5 rounded-3xl bg-slate-950/90 p-6 text-slate-200 shadow-lg shadow-slate-950/20">
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-300">Email</p>
              <p class="mt-2 text-lg font-semibold text-white">hello@redeemerchurch.org</p>
            </div>
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-300">Visit us</p>
              <p class="mt-2 text-lg font-semibold text-white">123 Faith Avenue, Main City</p>
            </div>
            <div>
              <p class="text-sm uppercase tracking-[0.25em] text-emerald-300">Office hours</p>
              <p class="mt-2 text-lg font-semibold text-white">Mon–Fri 9AM–5PM</p>
            </div>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-3xl bg-slate-950/90 p-6 shadow-xl shadow-slate-950/20">
              <p class="text-xl font-semibold text-white">Prayer requests</p>
              <p class="mt-3 text-slate-300 leading-7">Send us your needs and we’ll pray with you through our weekly prayer team.</p>
            </div>
            <div class="rounded-3xl bg-slate-950/90 p-6 shadow-xl shadow-slate-950/20">
              <p class="text-xl font-semibold text-white">Visit information</p>
              <p class="mt-3 text-slate-300 leading-7">Plan your first visit with directions, childcare details, and what to expect.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-[32px] border border-white/10 bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-md">
        <div class="space-y-6">
          <h2 class="text-3xl font-semibold text-white">Send a message</h2>
          <p class="text-slate-300 leading-7">Use this form to share your prayer requests, ask about our ministries, or tell us how we can assist you.</p>
          <form class="space-y-5">
            <label class="block text-sm font-medium text-slate-200">
              Name
              <input type="text" placeholder="Your name" class="mt-3 w-full rounded-3xl border border-white/10 bg-slate-950/90 px-4 py-3 text-slate-200 outline-none transition focus:border-emerald-400/50 focus:ring-2 focus:ring-emerald-500/20" />
            </label>
            <label class="block text-sm font-medium text-slate-200">
              Email
              <input type="email" placeholder="you@example.com" class="mt-3 w-full rounded-3xl border border-white/10 bg-slate-950/90 px-4 py-3 text-slate-200 outline-none transition focus:border-emerald-400/50 focus:ring-2 focus:ring-emerald-500/20" />
            </label>
            <label class="block text-sm font-medium text-slate-200">
              Message
              <textarea rows="5" placeholder="How can we help?" class="mt-3 w-full rounded-3xl border border-white/10 bg-slate-950/90 px-4 py-3 text-slate-200 outline-none transition focus:border-emerald-400/50 focus:ring-2 focus:ring-emerald-500/20"></textarea>
            </label>
            <button type="submit" class="inline-flex w-full justify-center rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-emerald-400">Send message</button>
          </form>
        </div>
      </div>
    </section>
  </Layout>
</template>

