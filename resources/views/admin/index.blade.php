<x-app-layout>
    <x-slot name="header">
        <div>
            @section('title', 'Dashboard')
              @include('layouts.includes.admin-nav')
          </div>
    </x-slot>

    <div class="py-12">
        <div class="container mt-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900 dark:text-gray-100">
                    <p class="mt-2 mx-3 text-gray-600 dark:text-gray-300">
                        Welcome to the dashboard! You can manage your system and users from here.
                    </p>
    
                    <!-- Responsive Two Box Layout Using Bootstrap -->
                    <div class="row mt-6 ">
                        <!-- Box 1 -->
                        <div class=" col-12 col-md-4 mb-4">
                            <div class="bg-light dark:bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-300 dark:border-gray-600 box">
                                <h3 class="text-xl pt-2 font-semibold text-gray-900 dark:text-gray-100 text-center">Cashier Online</h3>
                                <h1 class="display-1 mt-2 text-center text-gray-600 dark:text-gray-300">{{$cashiers}}</h1>
                            </div>
                        </div>
    
                        <!-- Box 2 -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="bg-light dark:bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-300 dark:border-gray-600 box">
                                <h3 class="text-xl pt-2 font-semibold text-center text-gray-900 dark:text-gray-100">Pending Clients</h3>
                                <h1 class="display-1 mt-2 text-center text-gray-600 dark:text-gray-300" >{{$pendingClients}}</h1>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <div class="bg-light dark:bg-gray-700 p-6 rounded-lg shadow-lg border border-gray-300 dark:border-gray-600 box">
                                <h3 class="text-xl pt-2 font-semibold text-center text-gray-900 dark:text-gray-100">All Clients</h3>
                                <p class="display-1 text-center mt-2 text-gray-600 dark:text-gray-300">{{$allClients}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</x-app-layout>
