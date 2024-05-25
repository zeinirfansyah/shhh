<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap gap-5 justify-center items-center bg-white">
        @foreach ($messages as $message)
          <form action="{{ route('updateMessageStatus', ['id' => $message->id]) }}" method="POST">
            @csrf @method('put')
            <button type="submit"
              class="envelope w-[12rem] flex flex-col justify-center items-center outline-dashed -outline-offset-4 outline-gray-400 p-4">
              <img src="{{ asset('assets/illustrations/envelope.svg') }}" alt="">
              <h1 class="text-center">New Message</h1>
            </button>
          </form>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>
