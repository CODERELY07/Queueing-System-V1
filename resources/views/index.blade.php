<x-app-layout>
    <x-slot name="header">
        <h2 class="p-3">
            {{ __('Queue - Client Registration') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold">Welcome to Queuing System</h1>
                    <p>Please Input your name.</p>
                    <form id="clientForm" data-url="{{route('get.store.name')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="inputs form-control" name="name" id="name">
                            <div id="name-error" class="errors"></div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary show-modal"  value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     {{-- Modal --}}
    <div class="modal fade " id="transactionData" tabindex="-1" aria-labelledby="transactionDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="transactionDataLabel">Your Queue</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printClientQueue">
                
            </div>
            <div class="modal-footer">
            <button type="button" id="printBtn" class="btn btn-success">Print</button>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>

