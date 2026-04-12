<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Register')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // 1. Validasi Input
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);


        try {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => $validated['password'],
            ]);

            // 3. Login dan Redirect
            event(new Registered($user));

            Auth::login($user);

            $this->redirect(route('dashboard', absolute: false), navigate: true);
        } catch (\Exception $e) {
            // if failed, flash error message to session
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}; ?>

<div class="relative z-1 bg-white p-6 sm:p-0 dark:bg-gray-900">
    <div class="flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row dark:bg-gray-900">
        <!-- Form -->
        <div class="flex w-full flex-1 flex-col lg:w-1/2">
            <!-- Back -->
            <div class="mx-auto w-full max-w-md pt-6 sm:pt-10">
                <a href="{{ route('login') }}" wire:navigate
                    class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition">
                    <svg class="stroke-current" width="20" height="20" fill="none">
                        <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to login
                </a>
            </div>

            <!-- Content -->
            <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center py-6">

                <!-- Heading -->
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        Sign Up
                    </h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Create your account to start using the system
                    </p>
                </div>

                <!-- Form -->
                <form wire:submit="register" class="space-y-2">
                    <div>
                        <x-input-label for="name" class="mb-1.5 block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ __('Name') }} <span class="text-red-500">*</span>
                        </x-input-label>
                        <x-text-input
                            wire:model="name"
                            id="name"
                            placeholder="Masukkan nama lengkap"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-800 shadow-sm transition duration-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            type="text"
                            name="name"
                            required
                            autofocus
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <x-input-label for="email" class="mb-1.5 block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ __('Email') }} <span class="text-red-500">*</span>
                        </x-input-label>
                        <x-text-input
                            wire:model="email"
                            id="email"
                            placeholder="Masukkan alamat email"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-800 shadow-sm transition duration-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            type="email"
                            name="email"
                            required
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <x-input-label for="password" class="mb-1.5 block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ __('Password') }} <span class="text-red-500">*</span>
                        </x-input-label>
                        <x-text-input
                            wire:model="password"
                            id="password"
                            placeholder="••••••••"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-800 shadow-sm transition duration-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ __('Confirm Password') }} <span class="text-red-500">*</span>
                        </x-input-label>
                        <x-text-input
                            wire:model="password_confirmation"
                            id="password_confirmation"
                            placeholder="••••••••"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-800 shadow-sm transition duration-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                    </div>

                    <div class="flex flex-col items-center space-y-4 pt-2">
                        <x-primary-button class="w-full justify-center h-11 text-sm font-bold tracking-wide transition-all active:scale-95">
                            {{ __('Create Account') }}
                        </x-primary-button>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" wire:navigate class="font-semibold text-brand-600 hover:text-brand-500 hover:underline dark:text-brand-400">
                                {{ __('Sign In') }}
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Footer -->
                <!-- <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="/login" wire:navigate
                        class="text-brand-500 hover:underline">
                        Sign In
                    </a>
                </p> -->

            </div>
        </div>
        <div class="bg-brand-950 relative hidden h-full w-full items-center lg:grid lg:w-1/2 dark:bg-white/5">
            <div class="z-1 flex items-center justify-center">

                <!-- Grid Decoration -->
                <x-common.common-grid-shape />

                <div class="flex max-w-sm flex-col items-center text-center">

                    <!-- Logo -->
                    <a href="/" class="mb-6 block text-center text-5xl font-bold text-white dark:text-white">
                        Let's Join,
                    </a>

                    <!-- Headline -->
                    <h1 class="mb-3 text-2xl font-semibold text-white dark:text-white">
                        Authentication Page <br> Rekomendasi Motor Listrik Terbaik
                    </h1>

                    <!-- Description -->
                    <p class="mb-6 text-sm text-gray-400 dark:text-white/60">
                        Sistem Pendukung Keputusan berbasis metode MCDM untuk membantu Anda memilih motor listrik
                        terbaik sesuai kebutuhan, performa, dan budget.
                    </p>

                    <!-- Features / Value Points -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-300 dark:text-white/70">

                        <!-- Item 1 -->
                        <div class="flex flex-col items-center text-center gap-2">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500/20">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 17l6-6 4 4 8-8"></path>
                                </svg>
                            </div>
                            <p>Multi Kriteria</p>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex flex-col items-center text-center gap-2">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500/20">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3"></path>
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                            </div>
                            <p>Rekomendasi Otomatis</p>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex flex-col items-center text-center gap-2">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-purple-500/20">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 17v-6h13"></path>
                                    <path d="M9 11l-4 4 4 4"></path>
                                </svg>
                            </div>
                            <p>Analisis Cepat</p>
                        </div>
                    </div>

                </div>
                <!-- Toggler -->
                <div class="fixed right-6 bottom-6 z-50">
                    <button
                        class="bg-brand-500 hover:bg-brand-600 inline-flex size-14 items-center justify-center rounded-full text-white transition-colors"
                        @click.prevent="$store.theme.toggle()">
                        <svg class="hidden fill-current dark:block" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99998 1.5415C10.4142 1.5415 10.75 1.87729 10.75 2.2915V3.5415C10.75 3.95572 10.4142 4.2915 9.99998 4.2915C9.58577 4.2915 9.24998 3.95572 9.24998 3.5415V2.2915C9.24998 1.87729 9.58577 1.5415 9.99998 1.5415ZM10.0009 6.79327C8.22978 6.79327 6.79402 8.22904 6.79402 10.0001C6.79402 11.7712 8.22978 13.207 10.0009 13.207C11.772 13.207 13.2078 11.7712 13.2078 10.0001C13.2078 8.22904 11.772 6.79327 10.0009 6.79327ZM5.29402 10.0001C5.29402 7.40061 7.40135 5.29327 10.0009 5.29327C12.6004 5.29327 14.7078 7.40061 14.7078 10.0001C14.7078 12.5997 12.6004 14.707 10.0009 14.707C7.40135 14.707 5.29402 12.5997 5.29402 10.0001ZM15.9813 5.08035C16.2742 4.78746 16.2742 4.31258 15.9813 4.01969C15.6884 3.7268 15.2135 3.7268 14.9207 4.01969L14.0368 4.90357C13.7439 5.19647 13.7439 5.67134 14.0368 5.96423C14.3297 6.25713 14.8045 6.25713 15.0974 5.96423L15.9813 5.08035ZM18.4577 10.0001C18.4577 10.4143 18.1219 10.7501 17.7077 10.7501H16.4577C16.0435 10.7501 15.7077 10.4143 15.7077 10.0001C15.7077 9.58592 16.0435 9.25013 16.4577 9.25013H17.7077C18.1219 9.25013 18.4577 9.58592 18.4577 10.0001ZM14.9207 15.9806C15.2135 16.2735 15.6884 16.2735 15.9813 15.9806C16.2742 15.6877 16.2742 15.2128 15.9813 14.9199L15.0974 14.036C14.8045 13.7431 14.3297 13.7431 14.0368 14.036C13.7439 14.3289 13.7439 14.8038 14.0368 15.0967L14.9207 15.9806ZM9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088ZM5.96356 15.0972C6.25646 14.8043 6.25646 14.3295 5.96356 14.0366C5.67067 13.7437 5.1958 13.7437 4.9029 14.0366L4.01902 14.9204C3.72613 15.2133 3.72613 15.6882 4.01902 15.9811C4.31191 16.274 4.78679 16.274 5.07968 15.9811L5.96356 15.0972ZM4.29224 10.0001C4.29224 10.4143 3.95645 10.7501 3.54224 10.7501H2.29224C1.87802 10.7501 1.54224 10.4143 1.54224 10.0001C1.54224 9.58592 1.87802 9.25013 2.29224 9.25013H3.54224C3.95645 9.25013 4.29224 9.58592 4.29224 10.0001ZM4.9029 5.9637C5.1958 6.25659 5.67067 6.25659 5.96356 5.9637C6.25646 5.6708 6.25646 5.19593 5.96356 4.90303L5.07968 4.01915C4.78679 3.72626 4.31191 3.72626 4.01902 4.01915C3.72613 4.31204 3.72613 4.78692 4.01902 5.07981L4.9029 5.9637Z" fill="" />
                        </svg>
                        <svg class="fill-current dark:hidden" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.4547 11.97L18.1799 12.1611C18.265 11.8383 18.1265 11.4982 17.8401 11.3266C17.5538 11.1551 17.1885 11.1934 16.944 11.4207L17.4547 11.97ZM8.0306 2.5459L8.57989 3.05657C8.80718 2.81209 8.84554 2.44682 8.67398 2.16046C8.50243 1.8741 8.16227 1.73559 7.83948 1.82066L8.0306 2.5459ZM12.9154 13.0035C9.64678 13.0035 6.99707 10.3538 6.99707 7.08524H5.49707C5.49707 11.1823 8.81835 14.5035 12.9154 14.5035V13.0035ZM16.944 11.4207C15.8869 12.4035 14.4721 13.0035 12.9154 13.0035V14.5035C14.8657 14.5035 16.6418 13.7499 17.9654 12.5193L16.944 11.4207ZM16.7295 11.7789C15.9437 14.7607 13.2277 16.9586 10.0003 16.9586V18.4586C13.9257 18.4586 17.2249 15.7853 18.1799 12.1611L16.7295 11.7789ZM10.0003 16.9586C6.15734 16.9586 3.04199 13.8433 3.04199 10.0003H1.54199C1.54199 14.6717 5.32892 18.4586 10.0003 18.4586V16.9586ZM3.04199 10.0003C3.04199 6.77289 5.23988 4.05695 8.22173 3.27114L7.83948 1.82066C4.21532 2.77574 1.54199 6.07486 1.54199 10.0003H3.04199ZM6.99707 7.08524C6.99707 5.52854 7.5971 4.11366 8.57989 3.05657L7.48132 2.03522C6.25073 3.35885 5.49707 5.13487 5.49707 7.08524H6.99707Z" fill="" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>