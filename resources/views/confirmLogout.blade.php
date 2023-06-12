<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Yakin ingin logout?</h1>
    <a href="{{ route('logout') }}"
        onclick="
            event.preventDefault();
            document.getElementById('logout-form').submit();"
    >
        Logout
    </a>
    <a href="http://127.0.0.1:8000/dashboard">
        Batal
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>