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
        a{
            text-decoration: none;
        }

        h1{
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
            position: relative;
        }

        #search input {
            width: 35vw;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #0384fc;
            outline: none;
        }

        #search-button {
            position: absolute;
            left: 64.5vw;
            top: 1px;
            background-color: #0384fc;
            padding: 12px 15px;
            border: none;
            border-radius: 0 15px 15px 0;
            outline: none;
            cursor: pointer;
        }

        .fa-search {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div>
            <div>
                <div class="nav">
                    <div>
                        <a href="/"><h1>News</h1></a>
                    </div>
                    <div>
                        <a>Bạn muốn sáng tạo nội dung?</a>
                    </div>
                </div>
                <div id="search">
                    <form>
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
        <footer class="main-footer">
        </footer>
    </div>
</body>

</html>