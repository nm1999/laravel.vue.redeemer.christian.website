<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ events: Array, selectedEvent: Object });
</script>

<template>
  <Layout>
    <Head title="Events" />
    <section class="rounded-3xl border border-slate-200 bg-white p-8">
      <h1 class="text-3xl font-bold">Events</h1>
      <p class="mt-2 text-slate-600">See upcoming services and programs.</p>
      <div class="mt-6 grid gap-4 lg:grid-cols-2">
        <article v-for="event in events" :key="event.id" class="rounded-xl border p-4">
          <p class="text-sm text-slate-500">{{ new Date(event.starts_at).toLocaleString() }}</p>
          <h2 class="mt-1 text-xl font-semibold">{{ event.title }}</h2>
          <p class="mt-2 text-slate-600">{{ event.description }}</p>
          <p class="mt-2 text-sm text-slate-500">{{ event.location }}</p>
          <Link :href="`/events/${event.slug}`" class="mt-3 inline-block text-blue-700">View details</Link>
        </article>
      </div>
      <div v-if="selectedEvent" class="mt-8 rounded-xl bg-slate-100 p-5">
        <h3 class="text-xl font-semibold">Selected Event: {{ selectedEvent.title }}</h3>
        <p class="mt-2">{{ selectedEvent.description }}</p>
      </div>
    </section>
  </Layout>
</template>
