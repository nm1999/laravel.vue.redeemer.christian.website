<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from './Layout.vue';
import AdminBtn from './AdminBtn.vue';

const props = defineProps({ settings: Object });

const form = useForm({
  mission: props.settings?.mission ?? '',
  vision: props.settings?.vision ?? '',
  email: props.settings?.email ?? '',
  location: props.settings?.location ?? '',
  whatsapp_number: props.settings?.whatsapp_number ?? '',
  youtube_live_url: props.settings?.youtube_live_url ?? '',
  intro_video_url: props.settings?.intro_video_url ?? '',
  facebook_url: props.settings?.facebook_url ?? '',
  youtube_url: props.settings?.youtube_url ?? '',
  twitter_url: props.settings?.twitter_url ?? '',
  site_name: props.settings?.site_name ?? '',
  site_favicon: null,
});

const existingFaviconUrl = computed(() => {
  const value = props.settings?.site_favicon_url;

  if (! value) {
    return null;
  }

  if (value.startsWith('http://') || value.startsWith('https://') || value.startsWith('/')) {
    return value;
  }

  return `/storage/${value}`;
});

const updateFavicon = (event) => {
  form.site_favicon = event.target.files[0] || null;
};

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      _method: 'put',
    }))
    .post('/admin/site-settings', {
      forceFormData: true,
      onSuccess: () => form.reset('site_favicon'),
    });
};
</script>

<template>
  <AdminLayout>
    <Head title="Site Settings" />
    <h2 class="mb-6 text-2xl font-semibold">Site Settings</h2>

    <form class="space-y-6" @submit.prevent="submit">
      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Site Name (Browser Title)</label>
        <input
          v-model="form.site_name"
          type="text"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="Redeemer Christian Church"
        >
        <p class="mt-1 text-xs text-slate-500">Used in the browser tab title across the website.</p>
        <p v-if="form.errors.site_name" class="mt-1 text-sm text-red-600">{{ form.errors.site_name }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Title Logo / Favicon Image</label>
        <input
          type="file"
          accept="image/*"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          @change="updateFavicon"
        >
        <p class="mt-1 text-xs text-slate-500">Upload an image used as the browser tab icon and link preview image.</p>
        <p v-if="form.errors.site_favicon" class="mt-1 text-sm text-red-600">{{ form.errors.site_favicon }}</p>
        <img
          v-if="existingFaviconUrl"
          :src="existingFaviconUrl"
          alt="Current favicon"
          class="mt-3 h-12 w-12 rounded object-cover border border-slate-200"
        >
      </div>

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
        <label class="mb-1 block text-sm font-medium text-slate-700">Facebook URL (Header)</label>
        <input
          v-model="form.facebook_url"
          type="url"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="https://www.facebook.com/yourpage"
        >
        <p class="mt-1 text-xs text-slate-500">Used for the Facebook icon link in the top header.</p>
        <p v-if="form.errors.facebook_url" class="mt-1 text-sm text-red-600">{{ form.errors.facebook_url }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">YouTube URL (Header)</label>
        <input
          v-model="form.youtube_url"
          type="url"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="https://www.youtube.com/@YourChannel"
        >
        <p class="mt-1 text-xs text-slate-500">Used for the YouTube icon link in the top header.</p>
        <p v-if="form.errors.youtube_url" class="mt-1 text-sm text-red-600">{{ form.errors.youtube_url }}</p>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium text-slate-700">Twitter/X URL (Header)</label>
        <input
          v-model="form.twitter_url"
          type="url"
          class="w-full rounded-lg border border-slate-300 p-3 text-sm focus:border-blue-400 focus:outline-none"
          placeholder="https://x.com/yourhandle"
        >
        <p class="mt-1 text-xs text-slate-500">Used for the X icon link in the top header.</p>
        <p v-if="form.errors.twitter_url" class="mt-1 text-sm text-red-600">{{ form.errors.twitter_url }}</p>
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

      <AdminBtn :processing="form.processing" :pill="true">Save Settings</AdminBtn>
    </form>
  </AdminLayout>
</template>
