<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cashier') }}
        </h2>
    
        <button id="logout" data-url="{{route('logout')}}">Logout</button>    
    </x-slot>

    <div class="py-4">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Now Servicing</div>
                    <div class="card-body" id="cashier-queue-{{auth()->user()->id}}">
                        -- --
                    </div>
               </div>
            </div>
            <div class="col-6">
                <input type="hidden" name="client_id">
                <button id="prevQueue" data-url="{{route('queue.firePrev')}}" data-cashier_id="{{auth()->user()->id}}">Prev</button>
                <button id="nextQueue" data-url="{{route('queue.fire')}}" data-cashier_id="{{auth()->user()->id}}">Next</button>
                <button id="notifyQueue" data-url="{{route('queue.fire.notification')}}" data-cashier_id="{{auth()->user()->id}}">Notify</button>
            </div>
        </div>
        <div id="datetime"></div>
    </div>
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
</x-app-layout>
