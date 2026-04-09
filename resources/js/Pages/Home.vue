<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Layout>
    <Head title="Home" />

    <section class="relative overflow-hidden rounded-[32px] border border-slate-200 bg-gradient-to-br from-sky-50 via-white to-red-50 p-8 shadow-2xl shadow-slate-300/40">
      <div class="absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.18),_transparent_35%)]" />
      <div class="absolute left-0 top-1/3 h-72 w-72 rounded-full bg-red-200/40 blur-3xl"></div>
      <div class="absolute right-0 bottom-0 h-72 w-72 rounded-full bg-blue-200/60 blur-3xl"></div>

      <div class="relative grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <div class="space-y-8">
          <div class="space-y-4">
            <p class="inline-flex items-center gap-2 rounded-full bg-red-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-red-700">Welcome home</p>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Redeemer Church: a brighter place for faith, family, and fresh hope.</h1>
            <p class="max-w-3xl text-lg leading-8 text-slate-700">Explore worship, groups, stories, and service opportunities designed to help you grow spiritually and feel connected in every season.</p>
          </div>

          <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <Link href="/about" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Learn about us</Link>
            <Link href="/contact" class="inline-flex items-center justify-center rounded-full border border-blue-200 bg-white px-6 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">Contact our team</Link>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-[28px] bg-white/90 p-6 shadow-lg shadow-slate-200/60">
              <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Next worship experience</p>
              <p class="mt-3 text-xl font-semibold text-slate-900">Sunday worship at 10AM</p>
              <p class="mt-2 text-slate-600">A warm service with music, teaching, and kids ministry for every age.</p>
            </div>
            <div class="rounded-[28px] bg-white/90 p-6 shadow-lg shadow-slate-200/60">
              <p class="text-sm uppercase tracking-[0.2em] text-red-700">Plan a visit</p>
              <p class="mt-3 text-xl font-semibold text-slate-900">Arrive with confidence</p>
              <p class="mt-2 text-slate-600">Clear directions, friendly parking, and a welcoming team waiting for you.</p>
            </div>
          </div>
        </div>

        <div class="relative overflow-hidden rounded-[32px] border border-slate-200 bg-white/95 p-8 shadow-2xl shadow-slate-300/30">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.14),_transparent_35%)]" />
          <div class="relative space-y-6">
            <div class="rounded-[32px] border border-blue-100 bg-slate-50/95 p-6 shadow-lg shadow-blue-100/40">
              <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Featured story</p>
              <h2 class="mt-4 text-3xl font-bold text-slate-900">A story of hope and community</h2>
              <p class="mt-4 text-slate-600 leading-7">Every week our church celebrates connection, service, and steps toward new beginnings.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
              <div class="rounded-[28px] bg-blue-600/10 p-5 text-slate-900 transition duration-300 hover:-translate-y-1 hover:bg-blue-600/15">
                <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Worship</p>
                <p class="mt-3 text-lg font-semibold">Joyful and engaging.</p>
              </div>
              <div class="rounded-[28px] bg-red-100/80 p-5 text-slate-900 transition duration-300 hover:-translate-y-1 hover:bg-red-100/95">
                <p class="text-sm uppercase tracking-[0.2em] text-red-700">Outreach</p>
                <p class="mt-3 text-lg font-semibold">Practical care for neighbors.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-10 overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-xl shadow-slate-200/40">
        <div class="animate-slide-left flex w-[200%] gap-4 py-6 px-4">
          <div class="min-w-[320px] rounded-[28px] border border-blue-100 bg-blue-50 p-6 shadow-lg shadow-blue-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Family</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Kids, youth, and families</h3>
            <p class="mt-3 text-slate-600">Safe spaces, joyful programs, and meaningful guidance for all ages.</p>
          </div>
          <div class="min-w-[320px] rounded-[28px] border border-red-100 bg-red-50 p-6 shadow-lg shadow-red-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-red-700">Connect</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Small groups</h3>
            <p class="mt-3 text-slate-600">Weekly gatherings for prayer, study, and real friendships.</p>
          </div>
          <div class="min-w-[320px] rounded-[28px] border border-blue-100 bg-blue-50 p-6 shadow-lg shadow-blue-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Grow</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Practical teaching</h3>
            <p class="mt-3 text-slate-600">Real-life faith that helps you thrive each week.</p>
          </div>
          <div class="min-w-[320px] rounded-[28px] border border-red-100 bg-red-50 p-6 shadow-lg shadow-red-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-red-700">Serve</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Community care</h3>
            <p class="mt-3 text-slate-600">Local outreach, meals, and meaningful action together.</p>
          </div>
          <div class="min-w-[320px] rounded-[28px] border border-blue-100 bg-blue-50 p-6 shadow-lg shadow-blue-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Inspire</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Daily devotionals</h3>
            <p class="mt-3 text-slate-600">Encouragement and scripture for life beyond Sunday.</p>
          </div>
          <div class="min-w-[320px] rounded-[28px] border border-red-100 bg-red-50 p-6 shadow-lg shadow-red-100/70">
            <p class="text-sm uppercase tracking-[0.2em] text-red-700">Gather</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-900">Special events</h3>
            <p class="mt-3 text-slate-600">Concerts, workshops, and community celebrations all year.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-12 grid gap-8 lg:grid-cols-2">
      <article class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/60">
        <p class="text-sm uppercase tracking-[0.25em] text-red-700">What to expect</p>
        <h2 class="mt-4 text-3xl font-bold text-slate-900">A welcoming church with modern warmth</h2>
        <p class="mt-4 text-slate-600 leading-8">From easy parking and friendly greeters to inspiring teaching and a safe children’s area, we’ve designed every detail so your first visit feels natural and comfortable.</p>
        <ul class="mt-8 space-y-4 text-slate-700">
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Creative worship and music for every generation</li>
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Clear teaching that connects scripture to life</li>
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Small groups for growth, prayer, and new friendships</li>
        </ul>
      </article>

      <article class="rounded-[32px] border border-slate-200 bg-blue-600/10 p-8 shadow-xl shadow-blue-100/70">
        <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Our heart</p>
        <h2 class="mt-4 text-3xl font-bold text-slate-900">Faith that serves the city</h2>
        <p class="mt-4 text-slate-700 leading-8">We believe faith is best lived in community. That means prayer, outreach, and practical help where it matters most.</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
          <div class="rounded-3xl bg-white p-5 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-red-700">Serve</p>
            <p class="mt-3 text-slate-700">Local food drives, mentoring, and support for neighbors.</p>
          </div>
          <div class="rounded-3xl bg-white p-5 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Grow</p>
            <p class="mt-3 text-slate-700">Weekly small groups and discipleship for every stage.</p>
          </div>
        </div>
      </article>
    </section>

    <section class="mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50">
      <div class="grid gap-10 lg:grid-cols-[1fr_0.8fr] lg:items-center">
        <div class="space-y-5">
          <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Join the next event</p>
          <h2 class="text-3xl font-bold text-slate-900">A weekend of connection and fresh vision</h2>
          <p class="text-slate-600 leading-8">Experience a welcoming service, an inspiring message, and a community that wants to see you thrive.</p>
          <Link href="/contact" class="inline-flex items-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-700">Save your spot</Link>
        </div>

        <div class="overflow-hidden rounded-[28px] bg-slate-100 p-6 shadow-inner shadow-slate-200/50">
          <div class="space-y-5">
            <div class="rounded-[28px] bg-blue-600/10 p-6">
              <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Featured session</p>
              <p class="mt-4 text-xl font-semibold text-slate-900">Live worship and practical teaching</p>
            </div>
            <div class="rounded-[28px] bg-red-100 p-6">
              <p class="text-sm uppercase tracking-[0.2em] text-red-700">Kids & families</p>
              <p class="mt-4 text-xl font-semibold text-slate-900">A safe, joyful place for every child.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
