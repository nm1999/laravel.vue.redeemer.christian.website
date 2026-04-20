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
      <input v-model="form.name" class="w-full rounded border p-2" placeholder="Name">
      <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
    </div>

    <div>
      <input v-model="form.title" class="w-full rounded border p-2" placeholder="Title">
      <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
    </div>

    <div>
      <input v-model.number="form.order" type="number" min="0" class="w-full rounded border p-2" placeholder="Display Order">
      <p v-if="form.errors.order" class="mt-1 text-sm text-red-600">{{ form.errors.order }}</p>
    </div>

    <div>
      <input type="file" accept="image/*" class="w-full rounded border p-2" @change="updateImage">
      <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
      <img v-if="existingImageUrl" :src="existingImageUrl" alt="Current church leader" class="mt-3 h-24 w-24 rounded object-cover">
    </div>

    <div>
      <textarea v-model="form.bio" class="w-full rounded border p-2" rows="4" placeholder="Bio (optional)" />
      <p v-if="form.errors.bio" class="mt-1 text-sm text-red-600">{{ form.errors.bio }}</p>
    </div>

    <button class="rounded bg-blue-600 px-4 py-2 text-white" :disabled="form.processing">{{ submitLabel }}</button>
  </form>
</template>
