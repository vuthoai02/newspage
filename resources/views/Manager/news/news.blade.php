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
</style>

@section('content')
<div class="col-md-12">
    @if(Auth::user()->role == 'user')
    <div>
        <a href="{{ url('/user/manager/add-news')}}" class="add">+ Thêm tin tức</a>
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
            <td>
                @php
                $user = \App\Models\UserModel::find($ne->idUser);
                if ($user) {
                echo $user->username;
                }
                @endphp
            </td>
            @endif
            <td>
                <a>{{ $ne->title }}</a>
            </td>
            <td>
                @if ($ne->idCat)
                <?php
                $category = \App\Models\CategoryModel::find($ne->idCat);
                ?>
                {{ $category->name }}
                @else
                Không có
                @endif
            </td>
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
        @endif
    </table>
    @if($news)
    <div class="pagination">
        {{ $news->links('back.pagination.custom') }}
    </div>
    @endif
</div>
@stop