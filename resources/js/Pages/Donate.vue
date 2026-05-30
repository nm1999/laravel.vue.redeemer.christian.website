<script setup>
import Layout from './Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({ publicKey: String, status: String, url: String });
const form = useForm({ amount: 2500, currency: 'USD' });
const selectedAmount = ref(2500);
const amountOptions = [2500, 5000, 10000, 20000];

const submit = () => {
  form.amount = selectedAmount.value;
  form.post(props.url || '/donate');
};

const formattedAmount = computed(() => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: form.currency,
    maximumFractionDigits: 0,
  }).format(selectedAmount.value / 100);
});
</script>

<template>
  <Layout>
    <Head title="Give Online" />

    <section class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 lg:px-8">
      <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
        <div class="rounded-[2rem] bg-gradient-to-br from-slate-50 via-slate-100 to-slate-50 p-8 shadow-lg shadow-slate-200/70">
          <div class="space-y-6">
            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold uppercase tracking-[0.18em] text-blue-700">
              Give with love
            </div>

            <div class="space-y-4">
              <h1 class="text-4xl font-semibold tracking-tight text-slate-900 sm:text-2xl">
                Support Redeemer Christian Church
              </h1>
              <p class="max-w-2xl text-lg leading-8 text-slate-600">
                Your gift helps our community grow, serve, and share hope. Every donation is secure, transparent, and used to support worship, outreach, and care for families in need.
              </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
              <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">What your gift does</p>
                <ul class="mt-4 space-y-3 text-slate-700">
                  <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"></span>
                    <span>Strengthen worship and weekly gatherings.</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"></span>
                    <span>Support local outreach and care programs.</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"></span>
                    <span>Invest in teaching, community, and hope.</span>
                  </li>
                </ul>
              </div>
              <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Fast, secure gift</p>
                <div class="mt-4 space-y-4 text-slate-700">
                  <p class="leading-7">Pesapal handles the payment securely so you can give with confidence. Donations are processed quickly and safely.</p>
                  <div class="rounded-3xl bg-slate-50 p-4 text-sm text-slate-700">
                    <p class="font-semibold text-slate-900">Ready to give?</p>
                    <p class="mt-1">Choose an amount, then complete your gift in the secure checkout.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden p-6 sm:p-8">
          <div class="space-y-6">
            <div>
              <p class="text-sm uppercase tracking-[0.18em] text-blue-700">Online donation</p>
              <h2 class="mt-3 text-3xl font-semibold text-slate-900">Give with confidence</h2>
            </div>

            <div class="rounded-3xl bg-slate-50 p-5">
              <div class="flex items-center justify-between gap-4">
                <div>
                  <p class="text-sm text-slate-500">Selected amount</p>
                  <p class="mt-2 text-3xl font-semibold text-slate-900">{{ formattedAmount }}</p>
                </div>
                <span class="rounded-2xl bg-blue-100 px-3 py-2 text-sm font-semibold text-blue-700">USD</span>
              </div>
            </div>

            <div>
              <p class="mb-3 text-sm font-semibold uppercase tracking-[0.16em] text-slate-500">Choose an amount</p>
              <div class="grid gap-3 sm:grid-cols-2">
                <button
                  v-for="amount in amountOptions"
                  :key="amount"
                  type="button"
                  @click="selectedAmount = amount"
                  :class="['rounded-3xl border px-4 py-3 text-left transition-all duration-200', selectedAmount === amount ? 'border-blue-600 bg-blue-600 text-white shadow-lg' : 'border-slate-200 bg-white text-slate-700 hover:border-blue-300 hover:bg-slate-50']"
                >
                  <span class="block text-sm">{{ new Intl.NumberFormat('en-US', { style: 'currency', currency: form.currency, maximumFractionDigits: 0 }).format(amount / 100) }}</span>
                  <span class="mt-1 block text-xs text-slate-500">A thoughtful gift</span>
                </button>
              </div>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
              <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Custom amount</label>
                <input
                  v-model.number="selectedAmount"
                  type="number"
                  min="100"
                  step="100"
                  class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                />
              </div>
              <button class="btn-primary w-full" type="submit">Proceed to Donate</button>
            </form>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
              <p class="font-semibold text-slate-900">Secure payment</p>
              <p class="mt-1">Pesapal protects your gift and payment details. You will be redirected to complete your donation safely.</p>
            </div>

            <div v-if="status === 'success'" class="rounded-3xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
              Thank you for your donation! Your gift is making an impact.
            </div>
            <div v-if="status === 'failure'" class="rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
              Donation failed. Please try again or contact our team for help.
            </div>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
