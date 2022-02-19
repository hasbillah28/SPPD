<head>
    @include('layouts.partial.head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            position: relative;
            width: 70%;
            height: auto;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #3f2fa4;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        .container:hover .overlay {
            height: 100%;
        }

        .text {
            color: white;
            font-size: 30px;
            font-style: italic;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .bg-image {
            /* The image used */
            background-image: url("{{ asset('storage/gedung-kantor-BPN.jpg')}}");

           /*  Add the blur effect */
           /* filter: blur(4px);
            -webkit-filter: blur(4px);*/

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position:center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body>
<div  class="bg-image min-vh-100 d-flex flex-row align-items-center ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="col-sm-12">
                    @if(session()->get('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-medium-emphasis">Sign In to your account</p>
                            <form method="POST" action="{{ route('authenticate') }}">
                                {{--                                @csrf--}}
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <i class="icon cil-user"></i></span>
                                    <input id="nip" class="form-control @error('username') is-invalid @enderror" name="nip" value="{{ old('username') }}" required autocomplete="username" placeholder="NIP">
                                    @error('nip')
                                    <span class="invalid-tooltip" role="alertdialog">coba</span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <i class="icon cil-lock-locked"></i></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card col-md-5 text-white bg-primary py-5">
                        <div class="card-body text-center">
                            <div>
                                <img src="{{ asset('storage/logobpn.png') }}" alt="avatar"class="image">
                                <div class="overlay">
                                    <p>Sistem Informasi Perjalanan Dinas</p>
                                    <h2 class="text">WELLCOME TO SIPD </h2>


                                </div>
                                {{--<h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
