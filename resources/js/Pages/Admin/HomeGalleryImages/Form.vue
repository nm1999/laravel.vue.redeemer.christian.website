<script setup>
const props = defineProps({
  form: Object,
  submit: Function,
  submitLabel: String,
  existingImageUrl: {
    type: String,
    default: '',
  },
});

const updateImage = (event) => {
  props.form.image = event.target.files[0] || null;
};
</script>

<template>
  <form class="space-y-4" @submit.prevent="submit">
    <div>
      <input v-model.number="form.order" type="number" min="0" class="w-full rounded border p-2" placeholder="Display Order">
      <p v-if="form.errors.order" class="mt-1 text-sm text-red-600">{{ form.errors.order }}</p>
    </div>

    <label class="flex items-center gap-2 text-sm text-slate-700">
      <input v-model="form.is_active" type="checkbox">
      Show this image on the homepage gallery
    </label>
    <p v-if="form.errors.is_active" class="mt-1 text-sm text-red-600">{{ form.errors.is_active }}</p>

    <div>
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
      <img v-if="existingImageUrl" :src="existingImageUrl" alt="Current home gallery image" class="mt-3 h-28 w-40 rounded object-cover">
    </div>

    <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">{{ submitLabel }}</button>
  </form>
</template>