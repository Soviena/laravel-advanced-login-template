<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Reset Password</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    {{-- <script src="{{asset('vendor/js/helpers.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/js/bootstrap.js')}}"></script> --}}
    {{-- <script src="{{asset('js/config.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js','resources/js/helpers.js', 'resources/js/menu.js', 'resources/js/apexcharts.js', 'resources/js/dashboards-analytics.js', 'resources/js/main.js', 'resources/js/masonry.js',  'resources/js/perfect-scrollbar.js', 'resources/js/popper.js'])
  </head>

<body>

    <div class="container-xxl">
          <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
              <!-- Forgot Password -->
              <div class="card">
                <div class="card-body">

                  <h4 class="mb-2">Yeay! 😊</h4>
                  <p class="mb-4">Emailmu telah berhasil kami verifikasi</p>
                </div>
              </div>
              <!-- /Forgot Password -->
            </div>
          </div>
        </div>
</body>
