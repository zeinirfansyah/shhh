<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $message->message_title }}
            {{ $message->message_sender }}
            {{ $message->message_content }}
        </div>
    </div>
</x-app-layout>
