<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- box icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    {{-- css --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    {{-- alert --}}
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>@yield('title')</title>
</head>

<body class="bg-[#fafafa]">
    <x-navbar />

    @yield('content')

    {{-- jquery/ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function notif(message, icon = "success") {
            if ($(window).width() > 768) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: "400px",
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: icon,
                    title: message
                });
                return;
            }

            Swal.fire({
                position: "center-end",
                icon: "success",
                title: message,
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    title: 'custom-swal',
                    icon: 'custom-swal-icon'
                }
            });
        }

        function notifCenter(message) {
            Swal.fire({
                position: "center-end",
                icon: "success",
                title: message,
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    title: 'custom-swal',
                    icon: 'custom-swal-icon'
                }
            });
        }
        $(document).ready(function() {
            @if (session('success'))
                notif(@json(session('success')));
            @endif


        });
    </script>
    @stack('scripts')
</body>

</html>
