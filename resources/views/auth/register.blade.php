<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Fosnas</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href={{ @asset("template/modules/bootstrap/css/bootstrap.min.css") }}>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href={{ @asset("template/modules/bootstrap-social/bootstrap-social.css") }}>
    <!-- Template CSS -->
    <link rel="stylesheet" href={{ @asset("template/css/style.css") }}>
    <link rel="stylesheet" href={{ @asset("template/css/components.css") }}>
  </head>
  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-8 offset-2">
              <div class="login-brand">
                <img src="/template/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
              </div>
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Register</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register') }}"> @csrf <div class="row">
                      <div class="form-group col-6">
                        <label for="name">Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> @error('name') <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span> @enderror
                      </div>
                      {{-- --}}
                      <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus> @error('email') <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span> @enderror
                      </div>
                      {{-- --}}
                      <div class="col-6 form-group">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required> @error('password') <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span> @enderror
                      </div>
                      {{-- --}}
                      <div class="col-6 form-group">
                        <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block"> Registrasi </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="mt-5 text-muted text-center"> Sudah punya akun? <a href="/login">Login</a>
              </div>
              <div class="simple-footer"> Copyright &copy; ALOPE 2023 </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src={{ @asset("template/js/stisla.js") }}></script>
    <script src={{ @asset("template/js/scripts.js") }}></script>
  </body>
</html>