<x-app-layout>
  <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 py-12">
    <div class="flex flex-col p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <div class="flex flex-col md:flex-row gap-5 md:gap-0 justify-between">
        <div class="space-y-6 w-full md:w-1/2">
          <div>
            <h1>Username</h1>
            <h1 class="px-3 py-2 border-2">{{ $user->username }}</h1>
          </div>
          <div>
            <h1>Display Name</h1>
            <h1 class="px-3 py-2 border-2">{{ $user->display_name }}</h1>
          </div>
          <div>
            <h1>Email</h1>
            <h1 class="px-3 py-2 border-2">{{ $user->email }}</h1>
          </div>
          <div>
            <h1>Status</h1>
            <h1 class="px-3 py-2 border-2">
                @if ($user->status)
                {{ $user->status }}
                @else
                No Status
                @endif
            </h1>
          </div>
          <div id="button">
            <a href="{{ route('profile.edit') }}"
              class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit</a>
          </div>
        </div>
        <div class="flex w-full md:w-1/2 justify-center items-center order-first md:order-last">
          <div
            class="flex flex-col gap-3 lg:max-w-[250px] lg:max-h-[320px] overflow-hidden justify-center items-center lg:px-2 lg:py-4 border-2 shadow-md lg:-rotate-3 hover:rotate-0 hover:rounded-xl outline-2 outline-dashed outline-offset-4 outline-gray-400 transition-all duration-300">
            @if ($user->avatar === 'default.jpg')
              <img src="{{ asset('assets/images/shhh_avatar.png') }}"
                class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover">
            @else
              <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}"
                class="w-[150px] h-[150px] lg:w-[240px] lg:h-[240px] object-cover ">
            @endif
            <div id="status pb-2" >
              <p class="text-sm  text-gray-600 dark:text-gray-400">
                @if ($user->status)
                {{ $user->status }}
                @else
                ...
                @endif
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</x-app-layout>
