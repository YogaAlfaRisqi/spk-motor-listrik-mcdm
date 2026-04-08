<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">

    <!-- LEFT: FORM -->
    <div class="flex w-full lg:w-1/2 items-center justify-center px-6 py-10">

        <div class="w-full max-w-md">

            <!-- Card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-6">

                <!-- Header -->
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        Konfirmasi Password
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Demi keamanan, silakan masukkan password Anda
                    </p>
                </div>

                <!-- Info -->
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <!-- Form -->
                <form wire:submit="confirmPassword" class="space-y-5">

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input
                            wire:model="password"
                            id="password"
                            type="password"
                            name="password"
                            class="mt-1 w-full h-11 px-4 rounded-lg border border-gray-300 dark:border-gray-700 
                                   bg-white dark:bg-gray-900 
                                   text-gray-800 dark:text-white 
                                   focus:ring-2 focus:ring-brand-500 focus:outline-none"
                            required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Button -->
                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center py-3 text-sm font-medium">
                            Confirm
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- RIGHT: HERO -->
    <div class="hidden lg:flex w-1/2 items-center justify-center 
                bg-gradient-to-br from-brand-900 to-black 
                dark:from-gray-800 dark:to-gray-900 relative">

        <x-common.common-grid-shape />

        <div class="relative z-10 max-w-md text-center px-6">
            <h1 class="text-3xl font-bold text-white mb-3">
                SPK Motor Listrik
            </h1>

            <p class="text-gray-300 mb-6">
                Sistem Pendukung Keputusan berbasis MCDM untuk membantu Anda
                memilih motor listrik terbaik secara cepat dan akurat.
            </p>
            <div class="space-y-3 text-sm text-gray-200">
                <p>✔ Perbandingan multi kriteria</p>
                <p>✔ Rekomendasi otomatis</p>
                <p>✔ Analisis berbasis data</p>
            </div>
        </div>
    </div>

</div>