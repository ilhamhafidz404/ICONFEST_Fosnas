<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Fosnas &mdash; ALOPE</title>

  <link rel="stylesheet" href={{ @asset("template/modules/bootstrap/css/bootstrap.min.css") }}>
  <link rel="stylesheet" href={{ @asset("template/modules/fontawesome/css/all.min.css") }}>

  <link rel="stylesheet" href={{ @asset("template/css/style.css") }}>
  <link rel="stylesheet" href={{ @asset("template/css/components.css") }}>

  <!-- CSS Libraries -->
  <link rel="stylesheet" href={{ @asset("template/modules/jqvmap/dist/jqvmap.min.css") }}>
  <link rel="stylesheet" href={{ @asset("template/modules/summernote/summernote-bs4.css") }}>
  <link rel="stylesheet" href={{ @asset("template/modules/owlcarousel2/dist/assets/owl.carousel.min.css") }}>
  <link rel="stylesheet" href={{ @asset("template/modules/owlcarousel2/dist/assets/owl.theme.default.min.css") }}>

  <link rel="stylesheet" href={{ @asset("template/modules/jquery-selectric/selectric.css") }}>
  <!-- use the latest VueQuill release -->
<link rel="stylesheet" href="https://unpkg.com/@vueup/vue-quill@latest/dist/vue-quill.snow.prod.css">

  @vite('resources/css/app.css')
</head>

<body>

    <div id="app">
      <my-app :data="{{ $data }}"></my-app>
    </div>


    @vite('resources/js/app.js')

  <!-- General JS Scripts -->
  <script src={{ @asset("template/modules/jquery.min.js") }}></script>
  <script src={{ @asset("template/modules/popper.js") }}></script>
  <script src={{ @asset("template/modules/tooltip.js") }}></script>
  <script src={{ @asset("template/modules/bootstrap/js/bootstrap.min.js") }}></script>
  <script src={{ @asset("template/modules/nicescroll/jquery.nicescroll.min.js") }}></script>
  <script src={{ @asset("template/js/stisla.js") }}></script>
  
  <!-- JS Libraies -->
  {{-- <script src={{ @asset("template/modules/jquery.sparkline.min.js") }}></script>
  <script src={{ @asset("template/modules/chart.min.js") }}></script>
  <script src={{ @asset("template/modules/owlcarousel2/dist/owl.carousel.min.js") }}></script>
  <script src={{ @asset("template/modules/chocolat/dist/js/jquery.chocolat.min.js") }}></script>
  <script src={{ @asset("template/modules/jquery-selectric/jquery.selectric.min.js") }}></script> --}}

  
  {{-- <script src="https://unpkg.com/@vueup/vue-quill@latest"></script> --}}

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  
  <script src={{ @asset("template/js/scripts.js") }}></script>
  <script src={{ @asset("template/js/custom.js") }}></script>
</body>
</html>