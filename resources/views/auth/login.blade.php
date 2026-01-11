<x-guest-layout>

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md border border-[#E8DCC9]">

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-center latte-title mb-6">
            Login
        </h1>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-[#4B3A2E]" />
                <x-text-input id="email"
                              class="block mt-1 w-full bg-[#FFF8F0] border-[#D9C8B3] focus:border-[#C8A27C] focus:ring-[#C8A27C]"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-[#4B3A2E]" />
                <x-text-input id="password"
                              class="block mt-1 w-full bg-[#FFF8F0] border-[#D9C8B3] focus:border-[#C8A27C] focus:ring-[#C8A27C]"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember Me --}}
            <label class="inline-flex items-center mb-4">
                <input id="remember_me" type="checkbox"
                       class="rounded border-[#D9C8B3] text-[#C8A27C] focus:ring-[#C8A27C]">
                <span class="ml-2 text-sm text-[#4B3A2E]">Remember me</span>
            </label>

            {{-- Bottom actions --}}
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-[#B8926E] hover:text-[#8A6E52]"
                       href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                {{-- Login Button (styled latte) --}}
                <x-primary-button class="px-6 py-3 bg-[#C8A27C] hover:bg-[#B8926E] text-white rounded-full shadow">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </form>
    </div>

</x-guest-layout>
