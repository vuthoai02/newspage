<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Poppins", sans-serif;
            height: 100%;
        }

        a {
            color: #92badd;
            display: inline-block;
            text-decoration: none;
            font-weight: 400;
        }

        h3 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            margin: 40px 8px 10px 8px;
            color: #cccccc;
        }

        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            height: 100vh;
            min-height: 100%;
            padding: 20px;
            background-image: url("{{ asset('assets/background.png' )}}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        #formContent {
            border-radius: 10px 10px 10px 10px;
            padding: 30px;
            display: flex;
            background-color: rgba(255, 255, 255, 0.3);
            flex-direction: row;
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        .input{
            width: 20vw;
            height: 5vh;
            padding: 5px;
        }

        #submit{
            background-color: orange;
            border: none;
            color: white;
            height: 6.5vh;
            width: 10vw;
            font-weight: bold;
        }

        #formFooter {
            padding: 25px;        }
        .alert{
            margin-top: 10px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="fadeIn first">
            <h1 style="color: white; margin-bottom:10px;">Đăng nhập</h1>
        </div>
        <div id="formContent">

            <!-- Login Form -->
            <form action="{{route('login')}}" method="POST">
                @csrf
                <input type="text" id="login" class="input" name="email" placeholder="Email">
                <input type="password" id="password" class="input" name="password" placeholder="Mật khẩu">
                <input type="submit" id="submit" value="Đăng nhập">
                @if(session('notice'))
                <div class="alert">
                    {{ session('notice')}}
                </div>
                @endif
            </form>
        </div>
        <div id="formFooter">
            <a href="#">Quên mật khẩu?</a>
            <span style="color: white;">|</span>
            <a href="{{url('/register')}}">Chưa có tài khoản?</a>
        </div>
    </div>
</body>

</html>