<x-app-layout>
    <x-slot name="header">
        <div class="p-3">
            <h2 class="text-2xl font-semibold">{{ __('Queue - Client Registration') }}</h2>
        </div>
    </x-slot>
    
    <div class="p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome to the Queuing System</h1>
                    <p class="text-gray-600 dark:text-gray-300">Please input your name to register in the queue.</p>
                    
                    <!-- Form -->
                    <form id="clientForm" data-url="{{route('get.store.name')}}">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" class="form-control mt-2 p-2 border rounded-md w-full dark:bg-gray-700 dark:text-white" id="name" placeholder="Enter your name" required>
                            <div id="name-error" class="text-red-500 mt-1"></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Queue Information -->
    <div class="modal fade" id="transactionData" tabindex="-1" aria-labelledby="transactionDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transactionDataLabel">Your Queue Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="printClientQueue">
                    <!-- Queue details will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="printBtn" class="btn btn-success">Print</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
