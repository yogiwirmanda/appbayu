<!DOCTYPE html>
<html lang="en">

<head>
  @include('master.head')
</head>
<style>
  .footer {
    margin-left: unset !important;
  }
</style>

<body>
  @yield('content')
  <!-- footer start-->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 footer-copyright text-center">
          <p class="mb-0">Copyright 2022 © Puskesmar Rampal Celaket </p>
        </div>
      </div>
    </div>
  </footer>
  @include('master.script')
</body>

</html>