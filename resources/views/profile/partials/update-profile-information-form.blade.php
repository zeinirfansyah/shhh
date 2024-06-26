<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900 ">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 ">
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
              <p class="text-sm mt-2 text-gray-800 ">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification"
                  class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                  {{ __('Click here to re-send the verification email.') }}
                </button>
              </p>

              @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                  {{ __('A new verification link has been sent to your email address.') }}
                </p>
              @endif
            </div>
          @endif
        </div>

        <div>
          <x-input-label for="status" :value="__('Status')" />
          <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="old('status', $user->status)" autofocus autocomplete="status" />
          <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div>
          <x-input-label for="avatar" :value="__('Avatar')" />

          <input type="file" accept="image/*" id="avatar" name="avatar"
            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 " />
          <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
      </div>
      <div class="flex w-full md:w-1/2 justify-center items-center order-first md:order-last">
        <div
          class="flex flex-col gap-3 justify-center items-center lg:px-2 lg:pt-4 lg:pb-6 border-2 shadow-md lg:-rotate-3 hover:rotate-0 hover:rounded-xl outline-2 outline-dashed outline-offset-4 outline-gray-400 transition-all duration-300">
          @if ($user->avatar === 'default.jpg')
            <img src="{{ asset('assets/images/shhh_avatar.png') }}"
              class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover">
          @else
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}"
              class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover ">
          @endif
          <div id="status">
            <p class="text-sm text-gray-600 ">{{ $user->status }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex items-center gap-4 mt-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 ">{{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
