<x-app-layout>
  <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="flex flex-col p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

      <div class="flex flex-col md:flex-row gap-5 md:gap-0 justify-between">
        <div class="space-y-6 w-full md:w-1/2">
          <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required
              autofocus autocomplete="username" disabled aria-disabled="true" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
          </div>

          <div>
            <x-input-label for="display_name" :value="__('Display Name')" />
            <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full"
              :value="old('display_name', $user->display_name)" required autofocus autocomplete="display_name" disabled aria-disabled="true" />
            <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
          </div>

          <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
              required autocomplete="username" disabled aria-disabled="true" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
              <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                  {{ __('Your email address is unverified.') }}

                  <button form="send-verification"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Click here to re-send the verification email.') }}
                  </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                  <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                  </p>
                @endif
              </div>
            @endif
          </div>
        </div>
        <div class="flex w-full md:w-1/2 justify-center items-center order-first md:order-last">
          <div
            class="flex flex-col gap-3 justify-center items-center lg:px-2 lg:pt-4 lg:pb-6 border-2 shadow-md lg:-rotate-3 hover:rotate-0 hover:rounded-xl outline-2 outline-dashed outline-offset-4 outline-gray-400 transition-all duration-300">
            @if ($user->avatar === 'default.jpg')
              <img src="{{ asset('assets/images/vox_populi_avatar.png') }}"
                class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover">
            @else
              <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}"
                class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover ">
            @endif
            <div id="status">
              <p class="text-sm text-gray-600 dark:text-gray-400">Hai,... I'm a thief.</p>
            </div>
          </div>
        </div>
      </div>

      <div id="button">
        <a href="{{ route('profile.edit') }}"
          class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit</a>
      </div>
    </div>
  </section>


</x-app-layout>
