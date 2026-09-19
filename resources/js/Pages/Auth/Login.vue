<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: { type: Boolean },
    status: { type: String },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 text-center"
        >
            {{ status }}
        </div>
        <div class="mb-8 text-center">
            <div
                class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 text-white mb-4 shadow-lg shadow-blue-500/30"
            >
                <i class="fas fa-rocket text-2xl">G</i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Welcome back</h1>
            <p class="text-sm text-gray-500 mt-1">
                Sign in to access your dashboard
            </p>
        </div>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="email" value="Email address" class="text-gray-700 font-medium" />
                <div class="relative mt-2">
                    <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"
                    >
                        <i class="fas fa-envelope"></i>
                    </span>
                    <TextInput
                        id="email"
                        type="email"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50/60 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition-all"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="you@company.com"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <InputLabel for="password" value="Password" class="text-gray-700 font-medium" />
                </div>
                <div class="relative mt-2">
                    <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"
                    >
                        <i class="fas fa-lock"></i>
                    </span>
                    <TextInput
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="block w-full pl-10 pr-11 py-3 rounded-xl border-gray-200 bg-gray-50/60 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition-all"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        :aria-label="showPassword ? 'Hide password' : 'Show password'"
                    >
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <PrimaryButton
                class="w-full justify-center py-3 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 shadow-lg shadow-blue-500/25 transition-all duration-200 normal-case tracking-normal text-sm font-semibold"
                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                :disabled="form.processing"
            >
                <i class="fas fa-arrow-right-to-bracket mr-2"></i>
                Admin Login
            </PrimaryButton>
        </form>
        
        <p class="text-center text-xs text-gray-400 mt-8">
            <i class="fas fa-shield-alt mr-1 text-blue-400"></i>
            Protected by encrypted connection
        </p>
    </GuestLayout>
</template>