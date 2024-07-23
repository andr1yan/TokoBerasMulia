<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Bukti</title>
    <link rel="shortcut icon" href="{{ asset('images/p.png') }}" type="image/x-icon">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .full-screen-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-auto">
                <img src="{{ asset($path->foto) }}" class="full-screen-img" alt="Foto">
            </div>
        </div>
    </div>

</body>
</html>