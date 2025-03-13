
<x-app-layout>
  <x-slot name="header">
      <div>
        @section('title', 'Cashier List')
          @include('layouts.includes.admin-nav')
      </div>
  </x-slot>
  
  <div class="mx-3 py-3">
      <div class="card">
          <div class="card-body">
              <div class="card-title d-flex justify-content-between align-items-center">
                  <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Cashier List</h3>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cashierModalPopUp">+</button>
              </div>
              <!-- Table -->
              <table class="table table-bordered table-striped">
                  <thead class="table-dark">
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

      <!-- Modal -->
      <div class="modal fade" id="cashierModalPopUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cashierModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="cashierModal">Add Cashier</h1>
                      <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="cashierForm">
                          <input type="hidden" id="cashier_id">
                          <div class="mb-3">
                              <label for="name" class="form-label">Cashier Name</label>
                              <input type="text" id="name" class="form-control">
                              <div class="errors text-danger" id="name-error"></div>
                          </div>
                          <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" id="password" class="form-control">
                              <div class="errors text-danger" id="password-error"></div>
                          </div>
                          <div class="d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

  </div>

  @section('script')
  @endsection
</x-app-layout>
