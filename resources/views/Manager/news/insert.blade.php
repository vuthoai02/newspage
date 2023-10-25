@extends('back.template.master')
@section('title', 'Quản lý tin tức');
@section('heading', 'Thêm tin tức');


@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <form role="form" action="{{route('post_news')}}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <input type="hidden" name="idUser" value="{{Auth::user()->id}}">
                <div class=" form-group">
                    <label for="exampleInputEmail1">Tiêu đề<span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" maxlength="70">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Danh mục<span class="color_red">*</span></label>
                    <select name="idCat" class="form-control">
                        <option value="" selected>Trống</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" form-group">
                    <label for="exampleInputEmail1">Mô tả<span class="color_red">*</span></label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class=" form-group">
                    <label for="exampleInputEmail1">Nội dung<span class="color_red">*</span></label>
                    <textarea name="content" class="form-control" id="ckeditor"></textarea>
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
<script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ),{
            ckfinder: {
                uploadUrl: "{{route('upload_images').'?_token='.csrf_token()}}",
            }
        })
        .catch( error => {
        } );
</script>
</div>
@stop