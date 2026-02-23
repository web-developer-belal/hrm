<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, html5, responsive, Projects">
    <meta name="author" content="Dreams technologies - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/flowbite.min.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tabler-icons/tabler-icons.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dist/style.css') }}">
    @livewireStyles
</head>

<body class="bg-white">

    <div id="global-loader" style="display: none;">
        <div class="page-loader"></div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <div class="container-fuild">
            <div class="w-full overflow-hidden relative block h-screen">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6">
                    <div class="lg:col-span-5">
                        <div
                            class="login-background relative hidden md:flex items-center justify-center flex-wrap h-screen">
                            <div class="bg-overlay-img">
                                <img src="{{ asset('assets/img/bg/bg-01.png') }}" class="bg-1 absolute right-0 bottom-0"
                                    alt="Img">
                                <img src="{{ asset('assets/img/bg/bg-02.png') }}" class="bg-2 absolute bottom-0 left-0"
                                    alt="Img">
                                <img src="{{ asset('assets/img/bg/bg-03.png') }}" class="bg-3 absolute right-0 top-0"
                                    alt="Img">
                            </div>
                            <div class="authentication-card w-full m-4 p-4">
                                <div
                                    class="authen-overlay-item relative z-1 bg-primary-200 border p-8 rounded-xl w-full">
                                    <h1 class="text-white display-1">Empowering people <br> through seamless HR <br>
                                        management.</h1>
                                    <div class="my-4 mx-auto authen-overlay-img">
                                        <img src="{{ asset('assets/img/bg/authentication-bg-01.png') }}"
                                            alt="Img">
                                    </div>
                                    <div>
                                        <p class="text-white fs-20 fw-semibold text-center">Efficiently manage your
                                            workforce, streamline <br> operations effortlessly.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7">
                        <div class="max-w-md mx-auto">
                            <div class="w-full h-screen">

                                {{ $slot }}
                            </div>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
    @livewireScripts
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Flowbite JS -->
    <script src="{{ asset('assets/js/flowbite.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
