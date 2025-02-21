<x-app-layout>
    <x-slot name="header">
        <h2 class="p-3">
            {{ __('Queue - Login') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-center align-items-center mt-5 p-2">
        <form id="loginForm" data-url="{{route('login.post')}}">
            <div class="alert"></div>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="name" class="form-control" id="name" name="name">
              <div class="errors" id="name-error"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              <div class="errors" id="password-error"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <br><br>
            <a href="{{route('get.client.name')}}">Home</a> | <a href="#">Cashier</a>
          </form>
    </div>
</x-app-layout>
