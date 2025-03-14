<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Kasir-App || Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- My Css --}}
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">

    {{-- SweetAlert --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
</head>

<body>
    <div class="center">
        <h1>Login</h1>
        <form method="post" id="loginForm">
            @csrf
            @method('POST')
            <div class="txt_field">
                <input type="email" name="email" value="{{ old('email') }}" id="email" autofocus>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" value="{{ old('password') }}" id="password">
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
            <input type="submit" value="Login" id="loginButton">
        </form>
        <center><p>Repost by <a href='https://pindo-portfolio.vercel.app/' title='pindosaputra' target='_blank'>Pindo Saputra</a></p></center>
<br>
    </div>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    {{-- SweetAlert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.js') }}"></script>

    {{-- MyJs --}}
    <script src="{{ asset('js/myJs.js') }}"></script>

    <script>
        const handleLogin = (url, data) => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                },
                success: (response) => {
                    successNotification('Login berhasil!');
                    // Redirect atau aksi lain setelah login berhasil
                    setTimeout(() => {
                        window.location.href = response.redirectUrl || '/dashboard';
                    }, 2000);
                },
                error: (error) => {
                    ajaxErrorHandling(error, $("#loginForm"))
                }
            });
        };

        $(document).ready(() => {
            $("#loginForm").on("submit", (e) => {
                e.preventDefault();

                const data = {
                    email: $("#email").val(),
                    password: $("#password").val()
                };
                handleLogin('authLogin', data);
            });
        });
    </script>

</body>

</html>
