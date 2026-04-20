<script setup>
import Layout from './Layout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { nextTick, onBeforeUnmount, onMounted, ref } from 'vue';
import { useScrollReveal } from '../composables/useScrollReveal';

const leadershipTeam = ref([]);
let leaderObserver = null;

useScrollReveal();

const observeLeaderCards = () => {
  const leaderCards = document.querySelectorAll('[data-leader-reveal]');

  if (!leaderCards.length) {
    return;
  }

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    leaderCards.forEach((element) => element.classList.add('is-visible'));
    return;
  }

  leaderObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          leaderObserver?.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.16,
      rootMargin: '0px 0px -8% 0px',
    },
  );

  leaderCards.forEach((element) => {
    leaderObserver?.observe(element);
  });
};

onMounted(async () => {
  try {
    const response = await axios.get('/api/church-leaders');
    leadershipTeam.value = response.data.data;
  } catch {
    leadershipTeam.value = [];
  }

  await nextTick();
  observeLeaderCards();
});

onBeforeUnmount(() => {
  leaderObserver?.disconnect();
  leaderObserver = null;
});
</script>

<template>
  <Layout>
    <Head title="About" />

    <section class="scroll-reveal reveal-from-bottom relative overflow-hidden rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50">
      <div class="absolute right-0 top-0 h-40 w-40 rounded-full bg-red-100 blur-3xl"></div>
      <div class="space-y-8">
        <div class="space-y-3">
          <p class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Our story</p>
          <h1 class="text-4xl font-bold text-slate-900 sm:text-5xl">A welcoming church built on hope, service, and joy.</h1>
          <p class="max-w-2xl text-lg leading-8 text-slate-700">Redeemer Christian Church guides families, students, and neighbors through inspiring worship, practical teaching, and community care.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
          <article class="scroll-reveal reveal-from-left rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-lg shadow-slate-200/70" style="--reveal-delay: 80ms">
            <h2 class="text-2xl font-semibold text-slate-900">Faith & Values</h2>
            <p class="mt-4 text-slate-700 leading-7">We live out grace, generosity, and belonging through worship, Bible study, and outreach. Our mission is to build hope for every season of life.</p>
          </article>

          <article class="scroll-reveal reveal-from-right rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-lg shadow-slate-200/70" style="--reveal-delay: 140ms">
            <h2 class="text-2xl font-semibold text-slate-900">Community Focus</h2>
            <p class="mt-4 text-slate-700 leading-7">From weekly prayer groups to family events, we create space where every person can connect, grow, and serve together.</p>
          </article>
        </div>

        <div class="grid gap-6 sm:grid-cols-3">
          <div class="scroll-reveal reveal-from-bottom rounded-3xl bg-blue-50 p-6 text-center shadow-xl shadow-blue-100/70" style="--reveal-delay: 40ms">
            <p class="text-4xl font-bold text-blue-700">10K+</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Lives touched</p>
          </div>
          <div class="scroll-reveal reveal-from-bottom rounded-3xl bg-red-50 p-6 text-center shadow-xl shadow-red-100/70" style="--reveal-delay: 120ms">
            <p class="text-4xl font-bold text-red-700">5</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Weekly ministries</p>
          </div>
          <div class="scroll-reveal reveal-from-bottom rounded-3xl bg-slate-50 p-6 text-center shadow-xl shadow-slate-200/70" style="--reveal-delay: 200ms">
            <p class="text-4xl font-bold text-blue-700">24/7</p>
            <p class="mt-2 text-sm uppercase tracking-[0.2em] text-slate-500">Support and prayer</p>
          </div>
        </div>
      </div>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 grid gap-10 lg:grid-cols-2" style="--reveal-delay: 40ms">
      <div class="scroll-reveal reveal-from-left rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 70ms">
        <h2 class="text-3xl font-semibold text-slate-900">How we worship</h2>
        <p class="mt-4 text-slate-700 leading-8">Our services blend inspiring music, scripture, and real-life teaching to help people experience God in everyday life.</p>
        <ul class="mt-8 space-y-4 text-slate-700">
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Sunday Worship at 10AM</li>
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Midweek prayer and study evenings</li>
          <li class="flex gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span> Kids and youth programs</li>
        </ul>
      </div>

      <div class="scroll-reveal reveal-from-right rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 130ms">
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

    <section class="scroll-reveal reveal-from-bottom mt-12 grid gap-8 lg:grid-cols-2" style="--reveal-delay: 60ms">
      <article class="scroll-reveal reveal-from-left rounded-[32px] border border-blue-100 bg-blue-50 p-8 shadow-2xl shadow-blue-100/50" style="--reveal-delay: 70ms">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Vision</p>
        <h2 class="mt-4 text-3xl font-semibold text-slate-900">To see lives transformed by Jesus in every home and generation.</h2>
        <p class="mt-4 leading-8 text-slate-700">Our vision is a church family where people encounter Christ, discover purpose, and carry hope into schools, workplaces, and communities.</p>
      </article>

      <article class="scroll-reveal reveal-from-right rounded-[32px] border border-red-100 bg-red-50 p-8 shadow-2xl shadow-red-100/50" style="--reveal-delay: 130ms">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-red-700">Mission</p>
        <h2 class="mt-4 text-3xl font-semibold text-slate-900">Celebrate Christ, build disciples, and serve the city with love.</h2>
        <p class="mt-4 leading-8 text-slate-700">We gather for worship, grow through practical teaching and small groups, and go out in compassion through outreach, prayer, and care.</p>
      </article>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 70ms">
      <div class="space-y-3">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Leadership</p>
        <h2 class="text-3xl font-semibold text-slate-900">Meet our church leaders</h2>
        <p class="max-w-2xl text-slate-700">Add or update each profile with a photo, full name, and ministry title as your team grows.</p>
      </div>

      <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <article
          v-for="(leader, index) in leadershipTeam"
          :key="leader.id ?? leader.name"
          data-leader-reveal
          class="scroll-reveal overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 shadow-lg shadow-slate-200/70"
          :class="index % 2 === 0 ? 'reveal-from-left' : 'reveal-from-right'"
          :style="{ '--reveal-delay': `${index * 90}ms` }"
        >
          <img
            :src="leader.image"
            :alt="leader.name"
            class="h-64 w-full object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-slate-900">{{ leader.name }}</h3>
            <p class="mt-2 text-sm font-semibold uppercase tracking-[0.2em] text-blue-700">{{ leader.title }}</p>
            <p v-if="leader.bio" class="mt-3 text-sm leading-6 text-slate-600">{{ leader.bio }}</p>
          </div>
        </article>
      </div>
    </section>
  </Layout>
</template>
