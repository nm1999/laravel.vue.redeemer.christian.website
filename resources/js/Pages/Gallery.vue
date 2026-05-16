<script setup>
import Layout from "./Layout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
  homeGalleryImages: {
    type: Array,
    default: () => [],
  },
});
</script>
<template>
    <Layout>
        <Head title="Gallery" />
        <section class="">
            <div class="" style="--reveal-delay: 40ms">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-red-700">
                        Our Gallery
                    </p>
                </div>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <figure
                    v-for="(image, index) in homeGalleryImages"
                    :key="image"
                    class="rounded-[24px] group border border-slate-200 bg-slate-100 shadow-lg shadow-slate-200/40"
                    
                    :style="{ '--reveal-delay': `${index * 90}ms` }"
                >
                    <img
                        :src="image"
                        :alt="`Redeemer church photo ${index + 1}`"
                        class="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                        loading="lazy"
                    />
                </figure>
            </div>
        </section>
    </Layout>
</template>
