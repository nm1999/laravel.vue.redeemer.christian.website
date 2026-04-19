<script setup>
import Layout from './Layout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ events: Array, focusedSlug: String });

const calendar = computed(() => {
  const grouped = {};
  for (const event of props.events) {
    const key = new Date(event.starts_at).toLocaleString('en-US', { month: 'long', year: 'numeric' });
    grouped[key] ??= [];
    grouped[key].push(event);
  }
  return grouped;
});
</script>

<template>
  <Layout>
    <Head title="Events" />
    <section class="rounded-3xl bg-white p-8 border border-slate-200">
      <h1 class="text-3xl font-bold">Events Calendar</h1>
      <div class="mt-6 space-y-6" v-for="(items, month) in calendar" :key="month">
        <h2 class="text-xl font-semibold">{{ month }}</h2>
        <div class="grid gap-4 md:grid-cols-2">
          <article v-for="event in items" :key="event.id" class="rounded-xl border p-4" :class="focusedSlug === event.slug ? 'border-blue-500' : 'border-slate-200'">
            <h3 class="font-semibold">{{ event.title }}</h3>
            <p class="text-sm text-slate-500">{{ new Date(event.starts_at).toLocaleString() }} · {{ event.location }}</p>
            <p class="mt-2">{{ event.description }}</p>
          </article>
        </div>
      </div>
    </section>
  </Layout>
</template>
