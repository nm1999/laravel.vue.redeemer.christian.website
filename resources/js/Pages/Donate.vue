<script setup>
import Layout from "./Layout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { computed, ref, watch, toRefs } from "vue";

const isLoading = ref(false);
const props = defineProps({
    publicKey: String,
    status: String,
    url: String,
    order_tracking_id: String,
});
const { url, status, order_tracking_id } = toRefs(props);

watch(url, (newVal, oldVal) => {
    if (oldVal !== newVal) {
        isLoading.value = false;
        window.location.href = newVal;
    }
});
const form = useForm({
    amount: "",
    description: "Donation",
    email: "admin@redemeer.org",
    callback_url: "https://redeemercf.org/donate",
    consumer_key: "rucWgAxGe2yqlHDKnc3GFFfOG/jJECdk",
    consumer_secret_key: "exky6Ytq4mD99FQaj6iveoy6B6U=",
});

const submit = () => {
    isLoading.value = true;
    form.post("/initiate-payment");
};
</script>

<template>
    <Layout>
        <Head title="Give Online" />

        <section class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
                <div
                    class="rounded-[2rem] bg-gradient-to-br from-slate-50 via-slate-100 to-slate-50 p-8 shadow-lg shadow-slate-200/70"
                >
                    <div class="space-y-6">
                        <div
                            class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold uppercase tracking-[0.18em] text-blue-700"
                        >
                            Give with love
                        </div>

                        <div class="space-y-4">
                            <h1
                                class="text-4xl font-semibold tracking-tight text-slate-900 sm:text-2xl"
                            >
                                Support Redeemer Christian Church
                            </h1>
                            <p
                                class="max-w-2xl text-lg leading-8 text-slate-600"
                            >
                                Your gift helps our community grow, serve, and
                                share hope. Every donation is secure,
                                transparent, and used to support worship,
                                outreach, and care for families in need.
                            </p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div
                                class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm"
                            >
                                <p
                                    class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500"
                                >
                                    What your gift does
                                </p>
                                <ul class="mt-4 space-y-3 text-slate-700">
                                    <li class="flex items-start gap-3">
                                        <span
                                            class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"
                                        ></span>
                                        <span
                                            >Strengthen worship and weekly
                                            gatherings.</span
                                        >
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span
                                            class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"
                                        ></span>
                                        <span
                                            >Support local outreach and care
                                            programs.</span
                                        >
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span
                                            class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-600"
                                        ></span>
                                        <span
                                            >Invest in teaching, community, and
                                            hope.</span
                                        >
                                    </li>
                                </ul>
                            </div>
                            <div
                                class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm"
                            >
                                <p
                                    class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500"
                                >
                                    Fast, secure gift
                                </p>
                                <div class="mt-4 space-y-4 text-slate-700">
                                    <p class="leading-7">
                                        Pesapal handles the payment securely so
                                        you can give with confidence. Donations
                                        are processed quickly and safely.
                                    </p>
                                    <div
                                        class="rounded-3xl bg-slate-50 p-4 text-sm text-slate-700"
                                    >
                                        <p class="font-semibold text-slate-900">
                                            Ready to give?
                                        </p>
                                        <p class="mt-1">
                                            Choose an amount, then complete your
                                            gift in the secure checkout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card overflow-hidden p-6 sm:p-8">
                    <div class="space-y-6">
                        <div>
                            <p
                                class="text-sm uppercase tracking-[0.18em] text-blue-700"
                            >
                                Online donation
                            </p>
                        </div>

                        <form @submit.prevent="submit" class="space-y-4">
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                    >Amount (UGX)</label
                                >
                                <input
                                    type="number"
                                    v-model="form.amount"
                                    name="amount"
                                    placeholder="amount"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                                />

                                <!-- hide inputs for security reasons -->
                                <input
                                    type="email"
                                    hidden
                                    v-model="form.email"
                                    name="email"
                                    value="admin@benina.net"
                                />
                                <input
                                    type="text"
                                    hidden
                                    v-model="form.description"
                                    name="description"
                                    placeholder="description"
                                />
                                <br />
                                <input
                                    type="text"
                                    hidden
                                    v-model="form.callback_url"
                                    name="callback_url"
                                    placeholder="callback url"
                                />
                                <br />
                                <input
                                    type="text"
                                    hidden
                                    v-model="form.consumer_key"
                                    name="consumer_key"
                                    placeholder="consumer key"
                                />
                                <input
                                    type="text"
                                    hidden
                                    v-model="form.consumer_secret_key"
                                    name="consumer_secret_key"
                                    placeholder="consumer secret key"
                                />
                            </div>
                            <button
                                :disabled="isLoading"
                                class="btn-primary w-full"
                                type="submit"
                            >
                                <span v-if="isLoading"
                                    >Processing ........</span
                                >
                                <span v-else>Proceed to Donate</span>
                            </button>
                        </form>

                        <div
                            class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600"
                        >
                            <p class="font-semibold text-slate-900">
                                Secure payment
                            </p>
                            <p class="mt-1">
                                Pesapal protects your gift and payment details.
                                You will be redirected to complete your donation
                                safely.
                            </p>
                        </div>

                        <div
                            v-if="status === 'success'"
                            class="rounded-3xl border border-green-200 bg-green-50 p-4 text-sm text-green-700"
                        >
                            Thank you for your donation! Your gift is making an
                            impact.
                        </div>
                        <div
                            v-if="status === 'failure'"
                            class="rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"
                        >
                            Donation failed. Please try again or contact our
                            team for help.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>
