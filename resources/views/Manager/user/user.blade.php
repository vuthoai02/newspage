@extends('back.template.master')
@section('title', 'Quản lý người dùng');
@section('heading', 'Quản lý người dùng');

<style>
    tr,
    th,
    td {
        padding: 5px;
    }

    table {
        width: 100%;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    button {
        color: red !important;
        border: none;
    }
    .pagination{
        width: 100%;
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
</style>

@section('content')
<div class="col-md-12">
    <table>
        <tr style="border-bottom: 1px solid gray;">
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        @if($users)
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('deleteUser') }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">[Xóa]</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </table>
    @if($users)
    <div class="pagination">
        {{ $users->links('back.pagination.custom') }}
    </div>
    @endif
</div>
@stop