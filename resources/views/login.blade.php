<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Prima Vista</title>

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
    {{-- <script src="{{asset('vendor/js/helpers.js')}}"></script>
    <script src="{{asset('vendor/js/bootstrap.js')}}"></script> --}}
    {{-- <script src="{{asset('js/config.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js','resources/js/helpers.js', 'resources/js/menu.js', 'resources/js/apexcharts.js', 'resources/js/dashboards-analytics.js', 'resources/js/main.js', 'resources/js/masonry.js',  'resources/js/perfect-scrollbar.js', 'resources/js/popper.js'])
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body py-0">
              @error('email')
              <div class="alert alert-danger alert-dismissible" role="alert">
                Salah Email atau password, coba lagi..
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @enderror
              @error('blocked')
              <div class="alert alert-danger alert-dismissible" role="alert">
                 Akun anda di blokir!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @enderror
              @error('error')
              <div class="alert alert-danger alert-dismissible" role="alert">
                Akun Tidak Terdaftar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @enderror
              <!-- Logo -->
              <div class="app-brand justify-content-center pt-3">
                <img src="{{asset('img/icons/brands/LogoPVS-Warna.png')}}" alt="" srcset="" width="200px">
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Prima Vista Solusi</h4>
              <p class="mb-4">Silahkan Sign in untuk melanjutkan</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('loginFunc') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email / Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Email/Username"
                    value="{{old('email')}}"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href=" {{route('password.request')}} ">
                      <small>Lupa Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me" />
                    <label class="form-check-label" for="remember-me">Ingat Saya</label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>
            </div>
            <div class="card-footer pt-0 pb-0">
                <p>Belum punya akun ?, <a href="{{route('register')}}">daftar di sini</a></p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
