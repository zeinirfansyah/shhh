<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            this is a profile page of {{ $user->username }}

            <form action="{{ route('sendMessage', ['username' => $user->username]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="message_title" id="message_title" placeholder="title"/>
                <input type="text" name="message_sender" id="message_sender" placeholder="You can put your initial name here!"/>
               <textarea name="message_content" id="message_content" placeholder="your message"></textarea>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</x-app-layout>
