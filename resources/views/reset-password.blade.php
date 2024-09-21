<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reset-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .reset-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-reset {
            width: 100%;
            background-color: #007bff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="reset-card">
        <h2>Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            {{-- <input type="hidden" name="token" value="{{ $request->route('token') }}"> --}}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="nim_npp">NIM/NPP</label>
                <input type="text" class="form-control" id="nim_npp" name="nim_npp" value="{{ old('nim_npp') }}" required autofocus>
            </div>

            {{-- <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ $request->email ?? old('email') }}" required autofocus>
            </div> --}}

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <button type="submit" class="btn btn-primary btn-reset">Reset Password</button>
        </form>
    </div>
</body>

</html>