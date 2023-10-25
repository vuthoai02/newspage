<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        #logo {
            color: #fff;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #0384fc;
            color: white;
            align-items: center;
        }

        #search {
            display: flex;
            justify-content: center;
            margin-top: 3%;
        }

        #search input {
            width: 35vw;
            padding: 10px;
            border-radius: 15px 0 0 15px;
            border: 1px solid #0384fc;
            outline: none;
        }

        #search-button {
            background-color: #0384fc;
            padding: 11px;
            border: none;
            border-radius: 0 15px 15px 0;
            outline: none;
            cursor: pointer;
        }

        .fa-search {
            color: #fff;
        }

        .container-fluid {
            display: flex;
            margin-top: 20px;
            min-height: calc(100vh - 60px);
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            height: 100px;
            margin-top: 50px;
        }

        .footer-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer-row p {
            flex: 0 0 50%;
            margin: 5px 0;
        }

        .footer .contact-info {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div>
            <div>
                <div class="nav">
                    <div>
                        <a href="{{url('/')}}">
                            <h1 id="logo">News</h1>
                        </a>
                    </div>
                    <div>
                        <a href="{{ url('/login') }}" style="color: #fff;">Bạn muốn sáng tạo nội dung?</a>
                    </div>
                </div>
                <div id="search">
                    <form role="form" action="{{route('search')}}" method="post">
                        @csrf
                        <input type="text" name="search" placeholder="Tìm kiếm bài viết" />
                        <button type="submit" id="search-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <session class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </session>
        </div>
    </div>
</body>
<footer class="footer">
    <div class="footer-row">
        <p>Tên trang web</p>
        <p class="contact-info">Địa chỉ: 123 Đường ABC, Thành phố XYZ</p>
        <p class="contact-info">Số điện thoại: 123-456-789</p>
        <p class="contact-info">Email: info@example.com</p>
    </div>
    <p>© 2023 Trang web của tôi. Tất cả các quyền được bảo lưu.</p>
    </div>
</footer>

</html>