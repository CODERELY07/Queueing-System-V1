<x-app-layout>
    <x-slot name="header">
        <div>
            @section('title', 'Client List')
              @include('layouts.includes.admin-nav')
          </div>
    </x-slot>

    <div class="container">
        <!-- Success alert -->
        @if(session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        {{-- delete selected checkbox --}}
        <form class="mt-3" action="{{ route('clients.delete-selected') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-between py-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="deleteAll" />
                    <label class="form-check-label" for="deleteAll">
                        Select All
                    </label>
                </div>
                <div class="form-check">
                    <button type="submit" class="btn btn-danger">Delete Selected</button>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAllRows" />
                        </th>
                        <th>Transaction Number</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Cashier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_clients[]" value="{{ $client->id }}" class="client-checkbox">
                            </td>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->status }}</td>
                            <td>
                                @if($client->cashier && $client->cashier->name)
                                    {{$client->cashier->name}}
                                @endif
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-secondary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-client-id="{{ $client->id }}" data-cashier-name="{{ $client->cashier ? $client->cashier->name : '' }}" data-status="{{ $client->status }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $clients->links('pagination::bootstrap-5') }}
            </div>
        </form>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Client Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('clients.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="client_id" id="client_id" value="">

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="waiting">Waiting</option>
                                <option value="servicing">Servicing</option>
                                <option value="done">Done</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        $(document).ready(function() {
            if ($('#successAlert').length) {
                setTimeout(function() {
                    $('#successAlert').alert('close');
                }, 3000); 
            }


            $('#selectAllRows').on('click', function() {
                $('.client-checkbox').prop('checked', this.checked);
            });

          
            $('.client-checkbox').on('change', function() {
                $('#selectAllRows').prop('checked', $('.client-checkbox:checked').length === $('.client-checkbox').length);
            });

            $('#deleteAll').on('change', function() {
                var isChecked = $(this).prop('checked');
                $('.client-checkbox').prop('checked', isChecked);
                $('#selectAllRows').prop('checked', isChecked);
            });


            $('.edit-btn').on('click', function() {
                var clientId = $(this).data('client-id');
                var cashierName = $(this).data('cashier-name');
                var status = $(this).data('status');

                $('#client_id').val(clientId);
                $('#status').val(status);
            });
        });
    </script>
    @endsection
</x-app-layout>
