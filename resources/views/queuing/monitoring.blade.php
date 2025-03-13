<x-app-layout>
    <x-slot name="header">
        <div class="">
            <!-- Icon + Title -->
            <div class="p-3">
                <h2 class="font-semibold text-xl leading-tight">{{ __('Queuing') }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-blue-500 text-white text-center py-2 rounded-t-lg">
                <span class="text-xl font-semibold">Now Servicing</span>
            </div>
            <div class="card-body" id="queue-servicing">
            
            </div>
        </div>

        <div id="datetime" class="text-center mt-4 text-lg font-medium text-gray-700"></div>

        @section('script')
        <script>
            function updateDateTime() {
                const now = new Date();
                const formattedDateTime = now.toLocaleString();
                document.getElementById('datetime').innerText = formattedDateTime;
            }
            setInterval(updateDateTime, 1000);
            updateDateTime();
        </script>
        @endsection
    </div>

</x-app-layout>
