<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Kerja Praktek</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <!--<img src="images/1.png" class="img-fluid" style="width: 250px;">-->
                </div>
                <p class="text-white fs-2">KERJA PRAKTEK</p>
                <small class="text-white text-wrap text-center">Universitas Dian Nuswantoro</small>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login</h2>
                    </div>
                    <form action="{{ route('loginPost') }}" method="POST">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{-- {{ $errors->first('nim_npp') }} --}}
                                {{ $errors->first('nim_npp') ?: $errors->first('email') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nim_npp" class="visually-hidden">NIM/NPP/Email</label>
                            <input type="text" class="form-control form-control-lg bg-light fs-6" name="nim_npp" id="nim_npp" placeholder="Masukkan NIM/NPP atau Email" required autofocus>
                        </div>
                        
                        <div class="form-group mb-1">
                            <label for="password" class="visually-hidden">Password</label>
                            <input type="password"  class="form-control form-control-lg bg-light fs-6" name="password" id="password"  placeholder="Masukkan Password" required>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-secondary"><small>Reset Password</small></a>
                        <div class="input-group mb-3 mt-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>