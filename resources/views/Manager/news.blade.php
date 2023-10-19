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
    }

    #delete {
        color: red !important;
        border: none;
    }
</style>

@section('content')
<div class="col-md-12">
    <table>
        <tr style="border-bottom: 1px solid gray;">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        <!-- @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('deleteUser') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" id="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">[Xóa]</button>
                </form>
            </td>
        </tr>
        @endforeach -->
    </table>
</div>
@stop