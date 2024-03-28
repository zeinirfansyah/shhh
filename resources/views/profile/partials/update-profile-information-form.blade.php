<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __("Update your account's profile information and email address.") }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}" enctype="multipart/form-data">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}" class="mt-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="flex flex-col md:flex-row gap-5 md:gap-0 justify-between">
      <div class="space-y-6 w-full md:w-1/2">
        <div>
          <x-input-label for="username" :value="__('Username')" />
          <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)"
            required autofocus autocomplete="username" />
          <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
          <x-input-label for="display_name" :value="__('Display Name')" />
          <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full" :value="old('display_name', $user->display_name)"
            required autofocus autocomplete="display_name" />
          <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
        </div>

        <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
            required autocomplete="username" />
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
        <div>
            <x-input-label for="avatar" :value="__('Avatar')"/>

          <input type="file" accept="image/*" id="avatar" name="avatar"
            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 " />
          <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
      </div>
      <div class="flex w-full md:w-1/2 justify-center items-center order-first md:order-last">
        @if ($user->avatar === 'default.jpg')
          <img src="{{ asset('assets/images/vox_populi_avatar.png') }}"
          class="w-[150px] h-[150px] lg:w-[200px] lg:h-[200px] object-cover rounded-full border-2">
        @else
          <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="w-[150px] h-[150px] lg:w-[200px] lg:h-[200px] object-cover rounded-full border-2 ">
        @endif
      </div>
    </div>

    <div class="flex items-center gap-4 mt-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
