<x-app-layout>
    <x-slot name="header">
        <div class="navbar py-4 px-2 bg-dark  navbar-expand-lg d-flex justify-content-between"><
            <h2 class="text-white ">
                {{ __('Cashier') }}
            </h2>   
            <button id="logout" class="btn btn-primary" data-url="{{route('logout')}}">Logout</button>    
        </div>
    </x-slot>

    <div class="py-4">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">Now Servicing</div>
                    <div class="card-body cashier-queue" id="cashier-queue-{{auth()->user()->id}}">
                    
                    </div>
                    <div class="p-3 d-flex justify-content-center gap-4">
                        <input type="hidden" name="client_id">
                        <button id="prevQueue" data-url="{{route('queue.firePrev')}}" data-cashier_id="{{auth()->user()->id}}" class="btn btn-secondary">Prev</button>
                        <button id="notifyQueue" data-url="{{route('queue.fire.notification')}}" data-cashier_id="{{auth()->user()->id}}" class="btn btn-primary">Notify</button>
                        <button id="nextQueue" data-url="{{route('queue.fire')}}" data-cashier_id="{{auth()->user()->id}}" class="btn btn-secondary">Next</button>
                      
                    </div>
               </div>
            </div>
           
            <div>

            </div>
        </div>
    </div>
</x-app-layout>
