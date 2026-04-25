<script setup>
import Layout from './Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onBeforeUnmount, onMounted, ref } from 'vue';

const defaultHomeGalleryImages = [
  '/images/1.jpg',
  '/images/2.jpg',
  '/images/3.jpg',
  '/images/4.jpg',
  '/images/1.jpg',
  '/images/3.jpg',
  '/images/4.jpg',
  '/images/2.jpg',
  '/images/1.jpg',
];

const defaultHeroSlides = [
  {
    image: '/images/1.jpg',
    kicker: 'Sunday Celebration',
    title: 'Church is family, not just an event.',
    description: 'Worship, community, and practical hope for every generation.',
  },
  {
    image: '/images/2.jpg',
    kicker: 'Life At Redeemer',
    title: 'Belong, grow, and serve together.',
    description: 'Find real friendships, strong teaching, and a place to call home.',
  },
  {
    image: '/images/3.jpg',
    kicker: 'Join This Weekend',
    title: 'A warm welcome is waiting for you.',
    description: 'Come as you are and experience faith that meets everyday life.',
  },
  {
    image: '/images/4.jpg',
    kicker: 'Community Impact',
    title: 'Bringing hope to our city.',
    description: 'From prayer to outreach, we serve with love and purpose.',
  },
];

const props = defineProps({
  featuredEvents: {
    type: Array,
    default: () => [],
  },
  homeGalleryImages: {
    type: Array,
    default: () => [],
  },
  heroSlides: {
    type: Array,
    default: () => [],
  },
  activeLiveStream: {
    type: Object,
    default: null,
  },
});

const homeGalleryImages = props.homeGalleryImages.length ? props.homeGalleryImages : defaultHomeGalleryImages;
const heroSlides = props.heroSlides.length ? props.heroSlides : defaultHeroSlides;

const carouselSlides = [
  {
    label: 'Family',
    title: 'Kids, youth, and families',
    text: 'Safe spaces, joyful programs, and meaningful guidance for all ages.',
    cardClass: 'border-blue-100 bg-blue-50 shadow-blue-100/70',
    labelClass: 'text-blue-700',
  },
  {
    label: 'Connect',
    title: 'Small groups',
    text: 'Weekly gatherings for prayer, study, and real friendships.',
    cardClass: 'border-red-100 bg-red-50 shadow-red-100/70',
    labelClass: 'text-red-700',
  },
  {
    label: 'Grow',
    title: 'Practical teaching',
    text: 'Real-life faith that helps you thrive each week.',
    cardClass: 'border-blue-100 bg-blue-50 shadow-blue-100/70',
    labelClass: 'text-blue-700',
  },
  {
    label: 'Serve',
    title: 'Community care',
    text: 'Local outreach, meals, and meaningful action together.',
    cardClass: 'border-red-100 bg-red-50 shadow-red-100/70',
    labelClass: 'text-red-700',
  },
  {
    label: 'Inspire',
    title: 'Daily devotionals',
    text: 'Encouragement and scripture for life beyond Sunday.',
    cardClass: 'border-blue-100 bg-blue-50 shadow-blue-100/70',
    labelClass: 'text-blue-700',
  },
  {
    label: 'Gather',
    title: 'Special events',
    text: 'Concerts, workshops, and community celebrations all year.',
    cardClass: 'border-red-100 bg-red-50 shadow-red-100/70',
    labelClass: 'text-red-700',
  },
];

const activeSlide = ref(0);
const activeHeroSlide = ref(0);
let slideTimer = null;
let heroSlideTimer = null;
let scrollRevealObserver = null;

const nextHeroSlide = () => {
  activeHeroSlide.value = (activeHeroSlide.value + 1) % heroSlides.length;
};

const previousHeroSlide = () => {
  activeHeroSlide.value = (activeHeroSlide.value - 1 + heroSlides.length) % heroSlides.length;
};

const goToHeroSlide = (index) => {
  activeHeroSlide.value = index;
};

const startHeroSlideTimer = () => {
  stopHeroSlideTimer();
  heroSlideTimer = window.setInterval(nextHeroSlide, 5500);
};

const stopHeroSlideTimer = () => {
  if (heroSlideTimer) {
    window.clearInterval(heroSlideTimer);
    heroSlideTimer = null;
  }
};

const nextSlide = () => {
  activeSlide.value = (activeSlide.value + 1) % carouselSlides.length;
};

const previousSlide = () => {
  activeSlide.value = (activeSlide.value - 1 + carouselSlides.length) % carouselSlides.length;
};

const goToSlide = (index) => {
  activeSlide.value = index;
};

const startSlideTimer = () => {
  stopSlideTimer();
  slideTimer = window.setInterval(nextSlide, 4200);
};

const stopSlideTimer = () => {
  if (slideTimer) {
    window.clearInterval(slideTimer);
    slideTimer = null;
  }
};

const setupScrollReveal = () => {
  const revealElements = document.querySelectorAll('.scroll-reveal');

  if (!revealElements.length) {
    return;
  }

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    revealElements.forEach((element) => element.classList.add('is-visible'));
    return;
  }

  scrollRevealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          scrollRevealObserver?.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.16,
      rootMargin: '0px 0px -8% 0px',
    },
  );

  revealElements.forEach((element) => {
    scrollRevealObserver?.observe(element);
  });
};

onMounted(() => {
  startHeroSlideTimer();
  startSlideTimer();
  setupScrollReveal();
});

onBeforeUnmount(() => {
  stopHeroSlideTimer();
  stopSlideTimer();
  scrollRevealObserver?.disconnect();
  scrollRevealObserver = null;
});
</script>

<template>
  <Layout>
    <Head title="Home" />

    <section
      class="relative overflow-hidden rounded-[32px] shadow-2xl shadow-slate-300/40"
      @mouseenter="stopHeroSlideTimer"
      @mouseleave="startHeroSlideTimer"
    >
      <div class="relative h-[68vh] min-h-[460px] max-h-[760px]">
        <Transition name="hero-fade" mode="out-in">
          <img
            :key="heroSlides[activeHeroSlide].image"
            :src="heroSlides[activeHeroSlide].image"
            :alt="heroSlides[activeHeroSlide].title"
            class="absolute inset-0 h-full w-full object-cover"
          >
        </Transition>

        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/45 to-slate-900/20" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-transparent to-transparent" />

        <div class="relative z-10 flex h-full items-end p-6 sm:p-10 lg:p-14">
          <div class="max-w-3xl text-white">
            <p class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-white backdrop-blur-sm">
              {{ heroSlides[activeHeroSlide].kicker }}
            </p>
            <h1 class="mt-5 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">
              {{ heroSlides[activeHeroSlide].title }}
            </h1>
            <p class="mt-4 max-w-2xl text-base text-slate-100 sm:text-lg">
              {{ heroSlides[activeHeroSlide].description }}
            </p>
            <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:items-center">
              <Link href="/about" class="inline-flex items-center justify-center rounded-full bg-red-600 px-7 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                Learn More
              </Link>
              <Link href="/contact" class="inline-flex items-center justify-center rounded-full border border-white/70 bg-white/10 px-7 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                Plan Your Visit
              </Link>
            </div>
          </div>
        </div>

        <button
          type="button"
          aria-label="Previous hero slide"
          class="absolute left-3 top-1/2 z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/60 bg-black/25 text-white backdrop-blur-sm transition hover:bg-black/40 sm:left-5"
          @click="previousHeroSlide"
        >
          <span aria-hidden="true">&#10094;</span>
        </button>
        <button
          type="button"
          aria-label="Next hero slide"
          class="absolute right-3 top-1/2 z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/60 bg-black/25 text-white backdrop-blur-sm transition hover:bg-black/40 sm:right-5"
          @click="nextHeroSlide"
        >
          <span aria-hidden="true">&#10095;</span>
        </button>

        <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 items-center gap-2">
          <button
            v-for="(slide, index) in heroSlides"
            :key="slide.image"
            type="button"
            :aria-label="`Go to hero slide ${index + 1}`"
            class="h-2.5 rounded-full transition-all"
            :class="index === activeHeroSlide ? 'w-9 bg-white' : 'w-2.5 bg-white/60 hover:bg-white/90'"
            @click="goToHeroSlide(index)"
          />
        </div>
      </div>
    </section>
    <br>

    <section class="scroll-reveal reveal-from-bottom relative overflow-hidden rounded-[32px] border border-slate-200 bg-gradient-to-br from-sky-50 via-white to-red-50 p-8 shadow-2xl shadow-slate-300/40">
      <div class="absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.18),_transparent_35%)]" />
      <div class="absolute left-0 top-1/3 h-72 w-72 rounded-full bg-red-200/40 blur-3xl"></div>
      <div class="absolute right-0 bottom-0 h-72 w-72 rounded-full bg-blue-200/60 blur-3xl"></div>

      <div class="relative grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <div class="space-y-8">
          <div class="space-y-4">
            <p class="inline-flex items-center gap-2 rounded-full bg-red-100 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-red-700">Welcome home</p>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Redeemer Church: a brighter place for faith, family, and fresh hope.</h1>
            <p class="max-w-3xl text-lg leading-8 text-slate-700">Explore worship, groups, stories, and service opportunities designed to help you grow spiritually and feel connected in every season.</p>
          </div>

          <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <Link href="/about" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Learn about us</Link>
            <Link href="/contact" class="inline-flex items-center justify-center rounded-full border border-blue-200 bg-white px-6 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">Contact our team</Link>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-[28px] bg-white/90 p-6 shadow-lg shadow-slate-200/60">
              <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Next worship experience</p>
              <p class="mt-3 text-xl font-semibold text-slate-900">Sunday worship at 10AM</p>
              <p class="mt-2 text-slate-600">A warm service with music, teaching, and kids ministry for every age.</p>
            </div>
            <div class="rounded-[28px] bg-white/90 p-6 shadow-lg shadow-slate-200/60">
              <p class="text-sm uppercase tracking-[0.2em] text-red-700">Plan a visit</p>
              <p class="mt-3 text-xl font-semibold text-slate-900">Arrive with confidence</p>
              <p class="mt-2 text-slate-600">Clear directions, friendly parking, and a welcoming team waiting for you.</p>
            </div>
          </div>
        </div>

        <div class="relative overflow-hidden rounded-[32px] border border-slate-200 bg-white/95 p-8 shadow-2xl shadow-slate-300/30">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.14),_transparent_35%)]" />
          <div class="relative space-y-6">
            <div class="rounded-[32px] border border-blue-100 bg-slate-50/95 p-6 shadow-lg shadow-blue-100/40">
              <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Featured story</p>
              <h2 class="mt-4 text-3xl font-bold text-slate-900">A story of hope and community</h2>
              <p class="mt-4 text-slate-600 leading-7">Every week our church celebrates connection, service, and steps toward new beginnings.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
              <div class="rounded-[28px] bg-blue-600/10 p-5 text-slate-900 transition duration-300 hover:-translate-y-1 hover:bg-blue-600/15">
                <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Worship</p>
                <p class="mt-3 text-lg font-semibold">Joyful and engaging.</p>
              </div>
              <div class="rounded-[28px] bg-red-100/80 p-5 text-slate-900 transition duration-300 hover:-translate-y-1 hover:bg-red-100/95">
                <p class="text-sm uppercase tracking-[0.2em] text-red-700">Outreach</p>
                <p class="mt-3 text-lg font-semibold">Practical care for neighbors.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="scroll-reveal reveal-from-bottom mt-10 overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-xl shadow-slate-200/40"
        style="--reveal-delay: 120ms"
        @mouseenter="stopSlideTimer"
        @mouseleave="startSlideTimer"
      >
        <div class="relative min-h-[248px] px-6 py-8 sm:min-h-[220px]">
          <Transition name="fade" mode="out-in">
            <div
              :key="activeSlide"
              :class="carouselSlides[activeSlide].cardClass"
              class="rounded-[28px] border p-6 shadow-lg"
            >
              <p :class="carouselSlides[activeSlide].labelClass" class="text-sm uppercase tracking-[0.2em]">
                {{ carouselSlides[activeSlide].label }}
              </p>
              <h3 class="mt-3 text-2xl font-semibold text-slate-900">{{ carouselSlides[activeSlide].title }}</h3>
              <p class="mt-3 text-slate-600">{{ carouselSlides[activeSlide].text }}</p>
            </div>
          </Transition>

          <button
            type="button"
            aria-label="Previous slide"
            class="absolute left-3 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 shadow hover:bg-slate-100"
            @click="previousSlide"
          >
            <span aria-hidden="true">&#10094;</span>
          </button>
          <button
            type="button"
            aria-label="Next slide"
            class="absolute right-3 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 shadow hover:bg-slate-100"
            @click="nextSlide"
          >
            <span aria-hidden="true">&#10095;</span>
          </button>
        </div>

        <div class="flex items-center justify-center gap-2 pb-6">
          <button
            v-for="(slide, index) in carouselSlides"
            :key="slide.title"
            type="button"
            :aria-label="`Go to ${slide.label} slide`"
            class="h-2.5 rounded-full transition-all"
            :class="index === activeSlide ? 'w-8 bg-blue-600' : 'w-2.5 bg-slate-300 hover:bg-slate-400'"
            @click="goToSlide(index)"
          />
        </div>
      </div>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 grid gap-8 lg:grid-cols-2">
      <article class="scroll-reveal reveal-from-left rounded-[32px] border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/60" style="--reveal-delay: 70ms">
        <p class="text-sm uppercase tracking-[0.25em] text-red-700">What to expect</p>
        <h2 class="mt-4 text-3xl font-bold text-slate-900">A welcoming church with modern warmth</h2>
        <p class="mt-4 text-slate-600 leading-8">From easy parking and friendly greeters to inspiring teaching and a safe children’s area, we’ve designed every detail so your first visit feels natural and comfortable.</p>
        <ul class="mt-8 space-y-4 text-slate-700">
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Creative worship and music for every generation</li>
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Clear teaching that connects scripture to life</li>
          <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-3 w-3 rounded-full bg-blue-600"></span>Small groups for growth, prayer, and new friendships</li>
        </ul>
      </article>

      <article class="scroll-reveal reveal-from-right rounded-[32px] border border-slate-200 bg-blue-600/10 p-8 shadow-xl shadow-blue-100/70" style="--reveal-delay: 120ms">
        <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Our heart</p>
        <h2 class="mt-4 text-3xl font-bold text-slate-900">Faith that serves the city</h2>
        <p class="mt-4 text-slate-700 leading-8">We believe faith is best lived in community. That means prayer, outreach, and practical help where it matters most.</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
          <div class="rounded-3xl bg-white p-5 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-red-700">Serve</p>
            <p class="mt-3 text-slate-700">Local food drives, mentoring, and support for neighbors.</p>
          </div>
          <div class="rounded-3xl bg-white p-5 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Grow</p>
            <p class="mt-3 text-slate-700">Weekly small groups and discipleship for every stage.</p>
          </div>
        </div>
      </article>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/40">
      <div class="scroll-reveal reveal-from-bottom flex flex-wrap items-end justify-between gap-4" style="--reveal-delay: 40ms">
        <div>
          <p class="text-sm uppercase tracking-[0.25em] text-red-700">Church moments</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">Life at Redeemer in pictures</h2>
        </div>
        <p class="max-w-xl text-slate-600">A few moments from worship, fellowship, and serving together as a church family.</p>
      </div>

      <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <figure
          v-for="(image, index) in homeGalleryImages"
          :key="image"
          class="scroll-reveal group overflow-hidden rounded-[24px] border border-slate-200 bg-slate-100 shadow-lg shadow-slate-200/40"
          :class="index % 2 === 0 ? 'reveal-from-left' : 'reveal-from-right'"
          :style="{ '--reveal-delay': `${index * 90}ms` }"
        >
          <img
            :src="image"
            :alt="`Redeemer church photo ${index + 1}`"
            class="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
            loading="lazy"
          >
        </figure>
      </div>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 80ms">
      <div class="grid gap-10 lg:grid-cols-[1fr_0.8fr] lg:items-center">
        <div class="space-y-5">
          <p class="text-sm uppercase tracking-[0.25em] text-blue-700">Join the next event</p>
          <h2 class="text-3xl font-bold text-slate-900">A weekend of connection and fresh vision</h2>
          <p class="text-slate-600 leading-8">Experience a welcoming service, an inspiring message, and a community that wants to see you thrive.</p>
          <Link href="/contact" class="inline-flex items-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-700">Save your spot</Link>
        </div>

        <div class="overflow-hidden rounded-[28px] bg-slate-100 p-6 shadow-inner shadow-slate-200/50">
          <div class="space-y-5">
            <div class="rounded-[28px] bg-blue-600/10 p-6">
              <p class="text-sm uppercase tracking-[0.2em] text-blue-700">Featured session</p>
              <p class="mt-4 text-xl font-semibold text-slate-900">Live worship and practical teaching</p>
            </div>
            <div class="rounded-[28px] bg-red-100 p-6">
              <p class="text-sm uppercase tracking-[0.2em] text-red-700">Kids & families</p>
              <p class="mt-4 text-xl font-semibold text-slate-900">A safe, joyful place for every child.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 100ms">
      <h2 class="text-3xl font-bold text-slate-900">Upcoming events calendar</h2>
      <div class="mt-6 grid gap-4 md:grid-cols-3">
        <article v-for="event in featuredEvents" :key="event.id" class="rounded-2xl border border-slate-200 p-4">
          <p class="text-sm text-slate-500">{{ new Date(event.starts_at).toLocaleString() }}</p>
          <p class="mt-1 font-semibold text-slate-900">{{ event.title }}</p>
          <p class="mt-2 text-sm text-slate-600">{{ event.location }}</p>
        </article>
      </div>
      <Link href="/events" class="mt-5 inline-flex rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white">View all events</Link>
    </section>

    <section v-if="activeLiveStream?.embed_url" class="scroll-reveal reveal-from-bottom mt-12 rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-200/50" style="--reveal-delay: 120ms">
      <h2 class="text-3xl font-bold text-slate-900">Watch Live</h2>
      <p class="mt-2 text-slate-600">Join our current live service stream.</p>
      <div class="mt-5 overflow-hidden rounded-2xl">
        <iframe
          class="h-[420px] w-full"
          :src="activeLiveStream.embed_url"
          title="Live Stream"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen
        />
      </div>
    </section>
  </Layout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.45s ease, transform 0.45s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

.hero-fade-enter-active,
.hero-fade-leave-active {
  transition: opacity 0.7s ease;
}

.hero-fade-enter-from,
.hero-fade-leave-to {
  opacity: 0;
}

.scroll-reveal {
  opacity: 0;
  transition: transform 0.72s ease, opacity 0.72s ease;
  transition-delay: var(--reveal-delay, 0ms);
}

.reveal-from-left {
  transform: translateX(-38px);
}

.reveal-from-right {
  transform: translateX(38px);
}

.reveal-from-bottom {
  transform: translateY(32px);
}

.scroll-reveal.is-visible {
  opacity: 1;
  transform: translate(0, 0);
}

@media (prefers-reduced-motion: reduce) {
  .scroll-reveal,
  .scroll-reveal.is-visible {
    opacity: 1;
    transform: none;
    transition: none;
  }
}
</style>
