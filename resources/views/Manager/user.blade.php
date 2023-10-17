@extends('back.template.master')
@section('title', 'Quản lý người dùng');
@section('heading', 'Quản lý người dùng');

<style>
    table, tr,th,td{
        border:1px solid black; 
        border-collapse: collapse;
        padding: 5px;
    }
    table{
        width: 100%;
    }
</style>

@section('content')
<div class="col-md-12">
    <table >
        <tr>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
</div>
@stop