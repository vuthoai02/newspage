@extends('back.template.master')
@section('title', 'Quản lý tin tức');
@section('heading', 'Quản lý tin tức');

<style>
    tr,
    th,
    td {
        padding: 5px;
    }

    table {
        width: 100%;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        margin-top: 15px;
    }

    button {
        color: red !important;
        border: none;
    }

    .add {
        background-color: limegreen;
        padding: 10px;
        margin-bottom: 10px;
        color: #fff;
    }

    #top{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

@section('content')
<div class="col-md-12">
    @if(Auth::user()->role == 'user')
    <div id="top">
        <a href="{{ url('/user/manager/add-news')}}" class="add">+ Thêm tin tức</a>
        <form role="form" action="{{ route('search_news')}}" method="post">
            @csrf
            <input type="text" name="search" placeholder="Tìm kiếm bài viết" />
            <button type="submit" id="search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
    @endif
    <table>
        <tr style="border-bottom: 1px solid gray;">
            @if(Auth::user()->role == 'admin')
            <th>ID</th>
            <th>Tác giả</th>
            @endif
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Lượt xem</th>
            <th>Thao tác</th>
        </tr>
        @if($news)
        @foreach ($news as $ne)
        <tr>
            @if(Auth::user()->role == 'admin')
            <td>{{ $ne->id }}</td>
            <td>{{ $ne->username }}</td>
            @endif
            <td>
                <a>{{ $ne->title }}</a>
            </td>
            <td>{{ $ne->nameCat }}</td>
            <td>{{ $ne->view }}</td>
            <td style="display: flex; color:blue">
                @if(Auth::user()->role == 'user')
                <a href="{{ url('/user/manager/update-news/'.$ne->id)}}">[Chỉnh sửa]</a>
                @endif
                <form action="{{ route('delete_news') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $ne->id }}">
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">[Xóa]</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <td>Không tìm thấy nội dung!</td>
        @endif
    </table>
    @if($news)
    <div class="pagination">
        {{ $news->links('back.pagination.custom') }}
    </div>
    @endif
</div>
@stop