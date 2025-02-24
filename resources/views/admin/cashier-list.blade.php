<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cashier List') }}
        </h2>
        @include('layouts.includes.admin-nav')
    </x-slot>
    
    <div class="mx-3 py-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Cashier List</div>
                <button class="show-modal" data-target="#cashierModalPopUp">+</button>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Log Status</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="cashierTableList">
                      {{-- Fetch cashier List --}}
                    </tbody>
                </table>
            </div>
        </div>
      {{-- TODO: Make inlcude file gathher all the modal and put in the app.blade.php --}}
        <!-- Modal -->
        <div class="modal fade" id="cashierModalPopUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cashierModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="cashierModal">Cashier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="cashierForm">
                    <input type="hidden" id="cashier_id">
                    <div class="mb-3">
                        <label for="name">Cashier Name</label>
                        <input type="text" id="name" class="form-control">
                        <div class="errors" id="name-error"></div>
                        <label for="name">Password </label>
                        <input type="password" id="password" class="form-control">
                        <div class="errors" id="password-error"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
    </div>
    @section('script')

    <script>
      console.log('test')
    </script>
    @endsection
</x-app-layout>

