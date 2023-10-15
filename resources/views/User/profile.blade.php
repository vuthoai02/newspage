@extends('back.template.master')
@section('title', 'Quản lý thông tin tài khoản');
@section('heading', 'Thông tin tài khoản');


@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <form role="form" action="{{route('update_infor')}}" method="post">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <input type="hidden" name="role" value="{{Auth::user()->role}}">
                <div class=" form-group">
                <label for="exampleInputEmail1">Tên tài khoản<span class="color_red">*</span></label>
                <input type="text" class="form-control" name="fullname" value="{{Auth::user()->username}}" disabled>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="color_red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                </div>
                <div class=" form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" value="********" disabled>
                </div>
                <a style="color:red;font-weight:bold;" href="{{ url('/change-password') }}">[Đổi mật khẩu]</a>
            </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
    </div>
    </form>
</div>
<!-- /.card -->




</div>
@stop