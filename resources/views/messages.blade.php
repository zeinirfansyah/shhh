<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap gap-5 justify-center items-center bg-white">
        @foreach ($messages as $message)
          <form action="{{ route('updateMessageStatus', ['id' => $message->id]) }}" method="POST">
            @csrf @method('put')
            <button type="submit" class="message w-[12rem] flex flex-col justify-center items-center p-4">
              <!-- $message->status === 'read' render image A else render image B -->
              @if ($message->status === 'read')
                <img src="{{ asset('assets/illustrations/message.webp') }}" alt="message open"
                  class="hover:scale-110 transition-all duration-500" />
              @else
                <img src="{{ asset('assets/illustrations/newmessage.webp') }}" alt="message"
                  class="hover:scale-110 transition-all duration-500" />
              @endif
              <p class="text-gray-600">{{ $message->title }}</p>

            </button>
          </form>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>
