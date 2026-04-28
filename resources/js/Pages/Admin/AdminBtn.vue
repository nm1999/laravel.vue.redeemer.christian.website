<script setup>
defineProps({
  processing: { type: Boolean, default: false },
  pill: { type: Boolean, default: false },
});
</script>

<template>
  <button
    type="submit"
    :disabled="processing"
    :class="[
      'inline-flex items-center gap-2 font-semibold text-white transition disabled:opacity-60',
      pill
        ? 'rounded-full bg-blue-600 px-6 py-2.5 text-sm hover:bg-blue-700'
        : 'rounded bg-blue-600 px-4 py-2 text-sm hover:bg-blue-700',
    ]"
  >
    <svg
      v-if="processing"
      class="h-4 w-4 animate-spin"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
    >
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
    </svg>
    <slot />
  </button>
</template>
