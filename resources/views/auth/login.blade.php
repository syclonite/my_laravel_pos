<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
</head>

<body class="main-bg">
<!-- Login Form -->

<div class="container fixed-container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="login-logo">
                <a><img class="login-logo" src="{{ "/images/nowshad_enterprise-removebg-preview.png" }}" alt="Image"></a>
            </div>
            <div class="card card-move remove-color" >
      {{--          <div class="card-header">
                    Featured
                </div>--}}
                <div class="card-body" >
                    <form action="{{ route('login') }}"  method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input  type="email" name="email" id="email" class="form-control" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
               {{--         <div class="mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" />
                            <label for="remember" class="form-label">Remember Me</label>
                        </div>--}}
                        <div class="d-grid">
                            <button type="submit" class="btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>

 {{--           <div class="card">
                <div class="card-title text-center border-bottom">
                    <h2 class="p-3">Login</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}"  method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input  type="email" name="email" id="email" class="form-control" />
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" />
                            <label for="remember" class="form-label">Remember Me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-sm text-light main-bg">Login</button>
                        </div>
                    </form>
                </div>
            </div>--}}
        </div>
    </div>
</div>
</body>

</html>

<style>
    :root{
        /*--main-bg:#e91e63;*/
        background-image: url('/images/loginb.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .main-bg {
        background: var(--main-bg) !important;
    }

    input:focus, button:focus {
        border: 1px solid var(--main-bg) !important;
        box-shadow: none !important;
    }

    .form-check-input:checked {
        background-color: var(--main-bg) !important;
        border-color: var(--main-bg) !important;
    }

    .card, .btn, input{
        border-radius:0 !important;
    }

    .fixed-container {
        position: relative;
        height: 200px; /* Optional: Set a height for the container */
    }

    .card-move {
        position: absolute;
        bottom: -450;
        right: 150;
        margin: 10px;
    }
    .login-logo{
        width:500;
        position: absolute;
        bottom: -150;
        right: 350;
        margin: 10px;
    }
    .remove-color{
        background-color: transparent;
    }
</style>
