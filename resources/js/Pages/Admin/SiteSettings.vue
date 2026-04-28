<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from './Layout.vue';

const props = defineProps({ settings: Object });

const form = useForm({
  mission: props.settings?.mission ?? '',
  vision: props.settings?.vision ?? '',
  email: props.settings?.email ?? '',
  location: props.settings?.location ?? '',
  whatsapp_number: props.settings?.whatsapp_number ?? '',
  youtube_live_url: props.settings?.youtube_live_url ?? '',
  intro_video_url: props.settings?.intro_video_url ?? '',
});

const submit = () => form.put('/admin/site-settings');
</script>

<template>
  <AdminLayout>
    <Head title="Site Settings" />
    <h2 class="mb-6 text-2xl font-semibold">Site Settings</h2>

    <div v-if="$page.props.flash?.success" class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
      {{ $page.props.flash.success }}
    </div>

    <form class="space-y-6" @submit.prevent="submit">
      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Mission Statement</label>
        <textarea
          v-model="form.mission"
          rows="4"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="Enter the church mission statement…"
        />
        <p v-if="form.errors.mission" class="mt-1 text-sm text-red-600">{{ form.errors.mission }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Vision Statement</label>
        <textarea
          v-model="form.vision"
          rows="4"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="Enter the church vision statement…"
        />
        <p v-if="form.errors.vision" class="mt-1 text-sm text-red-600">{{ form.errors.vision }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Contact Email</label>
        <input
          v-model="form.email"
          type="email"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="hello@redeemerchurch.org"
        >
        <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Church Location / Address</label>
        <input
          v-model="form.location"
          type="text"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="123 Faith Avenue, Main City"
        >
        <p class="mt-1 text-xs text-slate-500">Shown on the Contact page and used in the Google Maps link.</p>
        <p v-if="form.errors.location" class="mt-1 text-sm text-red-600">{{ form.errors.location }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">WhatsApp Number</label>
        <div class="flex items-center rounded-lg border border-slate-300 focus-within:border-blue-400 overflow-hidden">
          <span class="bg-slate-50 px-3 py-3 text-sm text-slate-500 border-r border-slate-300 select-none">+</span>
          <input
            v-model="form.whatsapp_number"
            type="text"
            class="flex-1 p-3 text-sm focus:outline-none"
            placeholder="1234567890 (digits only, no + or spaces)"
          >
        </div>
        <p class="mt-1 text-xs text-slate-500">Used for the floating WhatsApp button. Enter the full number with country code, digits only (e.g. <code>263771234567</code>).</p>
        <p v-if="form.errors.whatsapp_number" class="mt-1 text-sm text-red-600">{{ form.errors.whatsapp_number }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">YouTube Live URL</label>
        <input
          v-model="form.youtube_live_url"
          type="url"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="https://www.youtube.com/@YourChannel/live"
        >
        <p class="mt-1 text-xs text-slate-500">Used for the floating YouTube Live button. Paste your channel's live URL (e.g. <code>https://www.youtube.com/@redeemerchurch/live</code>).</p>
        <p v-if="form.errors.youtube_live_url" class="mt-1 text-sm text-red-600">{{ form.errors.youtube_live_url }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Intro Video URL</label>
        <input
          v-model="form.intro_video_url"
          type="url"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="https://www.youtube.com/embed/…"
        >
        <p class="mt-1 text-xs text-slate-500">
          Paste a YouTube or Vimeo embed URL (e.g. <code>https://www.youtube.com/embed/VIDEO_ID</code>). This video will play above the hero slides on the home page. Leave blank to hide.
        </p>
        <p v-if="form.errors.intro_video_url" class="mt-1 text-sm text-red-600">{{ form.errors.intro_video_url }}</p>
      </div>

      <button
        type="submit"
        class="rounded-full bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 disabled:opacity-60"
        :disabled="form.processing"
      >
        Save Settings
      </button>
    </form>
  </AdminLayout>
</template>
