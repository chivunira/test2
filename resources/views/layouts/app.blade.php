<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaveout_portal</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/my.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/my.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-md mb-6">
  <img class="navbar-logo" src="./logo.svg" alt="">
  <a class="navbar-brand" href="#">AAmanufacturing</a>
  <ul class="navbar-nav">
    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link active"  href="{{ route('posts') }}">Posts</a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link active"  href="{{ route('leaveform') }}">Apply For Leave</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active"  href="{{ route('viewhistory') }}">View Leave History</a>
    </li>
    @endauth

{{-- 
    @guest
    <li class="nav-item">
      <a class="nav-link active"  href="{{ route('home') }}">Home</a>
    </li>
    @endguest --}}

  </ul>
  <ul class="nav justify-content-end navbar-nav ms-auto">

    @auth
      
      <li class="nav-item">
        <a class="nav-link" href="{{url('profile')}}">[ {{ auth()->user()->name }} ]</a>
      </li>
      <li class="nav-item">
        <form action="{{route('logout')}}" method="post">
          {{ csrf_field() }}
          <button type="submit" class="btn nav-link ">Logout</button>
        </form>
      </li>

    @endauth
    
    @guest
      <li class="nav-item">
        <a class="nav-link nav-link-main" href="{{route('login')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">How to use</a>
      </li>
    @endguest
      
</ul>
</nav>
<div id="layoutSidenav">

    @include('layouts.inc3.admin-sidebar')
    <div id="layoutSidenav_content">
                <main>

                    @yield('content')

                </main>
                @include('layouts.inc3.admin-footer')
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

@yield('scripts')

</body>
</html>