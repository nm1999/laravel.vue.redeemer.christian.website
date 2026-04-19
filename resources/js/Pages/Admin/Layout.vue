<script setup>
import { Link, useForm } from '@inertiajs/vue3';
const logoutForm = useForm({});
const logout = () => logoutForm.post('/admin/logout');
</script>

<template>
  <div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-6 py-6">
      <header class="mb-6 flex flex-wrap items-center gap-3 rounded-xl bg-white p-4 border border-slate-200">
        <Link href="/admin/dashboard" class="font-semibold">Dashboard</Link>
        <Link href="/admin/sermons" class="text-sm">Sermons</Link>
        <Link href="/admin/events" class="text-sm">Events</Link>
        <Link href="/admin/live-stream" class="text-sm">Live Stream</Link>
        <Link href="/admin/prayer-requests" class="text-sm">Prayer Requests</Link>
        <Link href="/admin/testimonials" class="text-sm">Testimonials</Link>
        <button class="ml-auto rounded bg-slate-800 px-3 py-2 text-white text-sm" @click="logout">Logout</button>
      </header>
      <slot />
    </div>
  </div>
</template>
