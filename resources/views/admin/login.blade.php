<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="{{ asset('images/p.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('coreui/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('coreui/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('coreui/vendors/@coreui/icons/css/free.min.css') }}">
    <style>
        body {
            background-color: black;
            background-size: cover; 
        }

        .butt {
            border-width:3px;
            border-style:solid;
            opacity: 90%;
            border-radius:2px;
        }
        a:link { text-decoration: none; }
        a:visited { text-decoration: none; }
        a:hover { text-decoration: none; }
        a:active { text-decoration: none; }
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px white inset !important;
        }
        input:-webkit-autofill{
            -webkit-text-fill-color: black  !important;
        }

        .card {
            margin-top:6%;
            width: 22rem;
        }

        .but1 {
            width: 100%;
        }

        h1 {
            color:white;
        }
        
        
    </style>
</head>

<body>

@include('layouts.message')

    <div class="col-xl-12 d-flex justify-content-center align-items-center pt-5">
        <h1>Pembukuan Toko Beras Mulia</h1>
    </div>

        <div class="col-xl-12 d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                    <h1 style="font-family:arial;font-size:30px;">
                        <center style="color:black;"><b>Login</b>&nbsp;<b>Admin</b></center>
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                        </div>
                        <div class="but1">
                            <button type="submit" width="100%" name="simpan" class="btn btn-outline-success">Login</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>

    <script src="{{ asset('coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('coreui/vendors/simplebar/js/simplebar.min.js') }}"></script>
</body>
</html>