<script setup>
import Layout from './Layout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Layout>
    <Head title="About" />

    <section class="relative overflow-hidden rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50">
      <div class="absolute right-0 top-0 h-40 w-40 rounded-full bg-red-100 blur-3xl"></div>
      <div class="space-y-8">
        <div class="space-y-3">
          <p class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Our story</p>
          <h1 class="text-4xl font-bold text-slate-900 sm:text-5xl">A welcoming church built on hope, service, and joy.</h1>
          <p class="max-w-2xl text-lg leading-8 text-slate-700">Redeemer Christian Church guides families, students, and neighbors through inspiring worship, practical teaching, and community care.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
          <article class="rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-lg shadow-slate-200/70">
            <h2 class="text-2xl font-semibold text-slate-900">Faith & Values</h2>
            <p class="mt-4 text-slate-700 leading-7">We live out grace, generosity, and belonging through worship, Bible study, and outreach. Our mission is to build hope for every season of life.</p>
          </article>

          <article class="rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-lg shadow-slate-200/70">
            <h2 class="text-2xl font-semibold text-slate-900">Community Focus</h2>
            <p class="mt-4 text-slate-700 leading-7">From weekly prayer groups to family events, we create space where every person can connect, grow, and serve together.</p>
          </article>
        </div>

        <div class="grid gap-6 sm:grid-cols-3">
          <div class="rounded-3xl bg-blue-50 p-6 text-center shadow-xl shadow-blue-100/70">
            <p class="text-4xl font-bold text-blue-700">10K+</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Lives touched</p>
          </div>
          <div class="rounded-3xl bg-red-50 p-6 text-center shadow-xl shadow-red-100/70">
            <p class="text-4xl font-bold text-red-700">5</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Weekly ministries</p>
          </div>
          <div class="rounded-3xl bg-slate-50 p-6 text-center shadow-xl shadow-slate-200/70">
            <p class="text-4xl font-bold text-blue-700">24/7</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Support and prayer</p>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-12 grid gap-10 lg:grid-cols-2">
      <div class="rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-2xl shadow-slate-200/50">
        <h2 class="text-3xl font-semibold text-slate-900">How we worship</h2>
        <p class="mt-4 text-slate-700 leading-8">Our services blend inspiring music, scripture, and real-life teaching to help people experience God in everyday life.</p>
        <ul class="mt-8 space-y-4 text-slate-700">
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Sunday Worship at 10AM</li>
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Midweek prayer and study evenings</li>
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Kids and youth programs</li>
        </ul>
      </div>

      <div class="rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-2xl shadow-slate-200/50">
        <h2 class="text-3xl font-semibold text-slate-900">Service times</h2>
        <div class="mt-8 space-y-6 text-slate-700">
          <div>
            <p class="text-xl font-semibold text-slate-900">Sunday Morning</p>
            <p class="mt-2 leading-7">10:00 AM worship service with live music, children’s ministry, and a message for the whole family.</p>
          </div>
          <div>
            <p class="text-xl font-semibold text-slate-900">Wednesday Night</p>
            <p class="mt-2 leading-7">6:30 PM prayer, Bible study, and small group connection for every age.</p>
          </div>
          <div>
            <p class="text-xl font-semibold text-slate-900">Community Care</p>
            <p class="mt-2 leading-7">Service projects, neighborhood support, and a place to serve others in love.</p>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
