<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Here are the details of clients:</p>
                    <!-- $clients -->
                    @foreach($clients as $client)
                        <div class="py-3 text-grey-900">
                            <h3 class="text-lg text-grey-900">{{ $client->name }}</h3>
                            <p>{{ $client->redirect }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 p-6 bg-white border-b border-gray-200">
                    <form action="/oauth/clients" method="POST">
                        <div>
                            <x-label for="name">Name</x-label>
                            <x-input type="text" name="name" placeholder="Client Name"></x-input>
                        </div>
                        <div>
                            <x-label for="redirect">Redirect</x-label>
                            <x-input type="text" name="redirect" placeholder="https://test-url.com/callback"></x-input>
                        </div>
                        <div>
                            @csrf
                            <x-button type="submit">Create Client</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
