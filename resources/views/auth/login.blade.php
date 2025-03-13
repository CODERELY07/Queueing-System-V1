<x-app-layout>
  <x-slot name="header"></x-slot>

  <div class="d-flex justify-content-center align-items-center mt-5 p-2">
      <form id="loginForm" data-url="{{route('login.post')}}" class="card p-4 shadow rounded" style="width: 350px;">
          <div class="text-center">
              <i class="fas fa-sign-in-alt text-primary fa-3x"></i>
              <h2 class="fw-bold mt-3">Welcome!</h2>
              <p class="text-muted">Sign in to your account</p>
          </div>

          <div class="alert"></div> 

          <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" class="form-control inputs" id="name" name="name">
              </div>
              <div class="errors text-danger" id="name-error"></div>
          </div>

          <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  <input type="password" class="form-control inputs" id="password" name="password">
                  <span class="input-group-text"><i class="fas fa-eye" id="togglePassword"></i></span>
              </div>
              <div class="errors text-danger" id="password-error"></div>
          </div>

          <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-sign-in-alt"></i> Login
          </button>

          <div class="text-center mt-3">
              <a href="{{route('get.client.name')}}" class="text-decoration-none">Client</a> |
              <a href="{{route('monitoring')}}" class="text-decoration-none">Monitoring</a>
          </div>
      </form>
  </div>

  @section('script')
  <script>
      // Toggle Password Visibility
      document.getElementById("togglePassword").addEventListener("click", function() {
          let passwordInput = document.getElementById("password");
          if (passwordInput.type === "password") {
              passwordInput.type = "text";
              this.classList.replace("fa-eye", "fa-eye-slash");
          } else {
              passwordInput.type = "password";
              this.classList.replace("fa-eye-slash", "fa-eye");
          }
      });
  </script>
  @endsection

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
