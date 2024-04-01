<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($messages as $message)
                <a href="{{ route('messageDetail', ['id' => $message->id]) }}">
                    <div class="p-4 sm:p-8 bg-blue-400 dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h1>{{ $message->message_sender }}</h1>
                            <p>{{ $message->message_content }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
