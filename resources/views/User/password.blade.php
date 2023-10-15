@extends('back.template.master')
@section('title', 'Quản lý thông tin tài khoản');
@section('heading', 'Thay đổi mật khẩu');


@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <form role="form" action="{{route('change_pass')}}" method="post">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class=" form-group">
                <label for="exampleInputEmail1">Mật khẩu cũ<span class="color_red">*</span></label>
                <input type="password" class="form-control" name="oldpass">

                <div class="form-group">
                    <label for="exampleInputEmail1">Mật khẩu mới <span class="color_red">*</span></label>
                    <input type="password" class="form-control" name="newpass">
                </div>
                <div class=" form-group">
                    <label for="exampleInputPassword1">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" name="repass" >
                </div>
            </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thay đổi</button>
    </div>
    </form>
</div>
<!-- /.card -->




</div>
@stop