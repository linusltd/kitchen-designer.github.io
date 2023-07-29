<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/email.css') }}" />
    <title>Kitchen Designer</title>

  </head>
  <body>
    <!-- Body Wrapper -->
    <div class="container__fluid">
      <div class="email__container">
        <!-- Logo -->
        <div class="brand">
          <img src="{{ asset('assets/website') }}/images/logo.svg" alt="" />
        </div>

        @yield('content')
      <!-- Footer -->

      <footer class="email__footer">
        <p>
          If you have any questions, reply to this email or contact us at
          <span>info@kitabjahan.com</span>
        </p>
      </footer>
    </div>
  </body>
</html>
