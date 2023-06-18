<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href={{ @asset("template/modules/bootstrap/css/bootstrap.min.css") }}>
  <link rel="stylesheet" href={{ @asset("template/modules/fontawesome/css/all.min.css") }}>

  <link rel="stylesheet" href={{ @asset("template/css/style.css") }}>
  <link rel="stylesheet" href={{ @asset("template/css/components.css") }}>

    <link rel="stylesheet" href={{ @asset("template/css/style.css") }}>

    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              FOSNAS
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Apakah anda yakin ingin logout?</h4>
              </div>

              <div class="card-body text-center">
                <a 
                    href="{{ route('logout') }}"
                    onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    "
                    class="btn btn-lg btn-primary mr-3"
                >
                  Yakin
                </button>
                <a href="http://127.0.0.1:8000/dashboard" class="btn btn-lg btn-secondary">
                  Batal
                </a>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; ALOPE 2023
            </div>
          </div>
        </div>
      </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>


  <!-- Template JS File -->
  <script src={{ @asset("template/js/scripts.js") }}></script>
  <script src={{ @asset("template/js/custom.js") }}></script>
</body>
</html>