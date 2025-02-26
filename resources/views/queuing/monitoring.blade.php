<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Queuing') }}
        </h2>
    </x-slot>

    <div class="py-4">
       <div class="card">
        <div class="card-header">Now Servicing</div>
        <div class="card-body" id="queue-servicing">
            {{-- Queue --}}
        </div>
       </div>
    </div>

</x-app-layout>
