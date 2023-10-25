@extends('back.template.master')
@section('title', 'Quản lý danh mục');
@section('heading', 'Thông tin danh mục');


@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <form role="form" action="{{route('update_cat')}}" method="post">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">
                <input type="hidden" name="alias" value="{{ $category->alias }}">
                <div class=" form-group">
                    <label for="exampleInputEmail1">Danh mục<span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name}}">
                </div>
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