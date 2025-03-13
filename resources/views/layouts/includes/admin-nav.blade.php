<nav class="navbar py-4 px-2 bg-dark  navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">@yield('title')</a>
      <button class="navbar-toggler text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{route('admin.index')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{route('admin.userList')}}">Client List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{route('admin.cashierList')}}">Cashier List</a>
          </li>
        </ul>
        <button id="logout" class="btn btn-primary" data-url="{{route('logout')}}">Logout</button>
      </div>
    </div>
</nav>
