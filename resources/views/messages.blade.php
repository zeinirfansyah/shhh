<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto">
          <div class="flex flex-wrap gap-5 justify-center items-center bg-white">
            @foreach ($messages as $message)
            <a href="{{ route('messageDetail', ['id' => $message->id]) }}">
                <div class="envelope w-[12rem] flex flex-col justify-center items-center outline-dashed -outline-offset-4 outline-gray-400 p-4">
                   <img src="{{ asset('assets/illustrations/envelope.svg') }}" alt=""> 
                   <h1 class="text-center">New Message</h1>
                </div>
            </a>
        @endforeach
          </div>
        </div>
    </div>
</x-app-layout>
