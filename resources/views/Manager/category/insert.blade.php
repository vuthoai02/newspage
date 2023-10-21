@extends('back.template.master')
@section('title', 'Quản lý danh mục');
@section('heading', 'Thêm danh mục');


@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <form role="form" action="{{route('post_categories')}}" method="post">
            <div class="card-body">
                @csrf
                <div class=" form-group">
                <label for="exampleInputEmail1">Tên danh mục<span class="color_red">*</span></label>
                <input type="text" class="form-control" name="name">

                <div class="form-group">
                    <label for="exampleInputEmail1">Danh mục cha<span class="color_red">*</span></label>
                    <select name="parentId" class="form-control">
                        <option value="">Không có</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
    </form>
</div>
<!-- /.card -->




</div>
@stop