@extends('back.template.master')
@section('title', 'Quản lý tin tức');
@section('heading', 'Cập nhật nội dung');


@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <form role="form" action="{{route('update_news')}}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{ $news->id}}">
                <input type="hidden" name="idUser" value="{{ $news->idUser}}">
                <input type="hidden" name="view" value="{{ $news->view}}">
                <input type="hidden" name="alias" value="{{ $news->alias}}">
                <div class=" form-group">
                    <label for="exampleInputEmail1">Tiêu đề<span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $news->title}}" maxlength="70">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Danh mục<span class="color_red">*</span></label>
                    <select name="idCat" class="form-control">
                        <option value="{{ $news->idCat }}">
                            {{ $news->idCat ? \App\Models\CategoryModel::find($news->idCat)->name : 'Danh mục cha không xác định' }}
                        </option>
                        @foreach(\App\Models\CategoryModel::where('id', '!=', $news->idCat)->get() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" form-group">
                    <label for="exampleInputEmail1">Mô tả<span class="color_red">*</span></label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class=" form-group">
                    <label for="exampleInputEmail1">Nội dung<span class="color_red">*</span></label>
                    <textarea name="content" class="form-control" id="ckeditor">{{ $news->content }}</textarea>
                </div>
            </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
    </div>
    </form>
</div>
<!-- /.card -->
<script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'), {
            ckfinder: {
                uploadUrl: "{{route('upload_images').'?_token='.csrf_token()}}",
            }
        })
        .catch(error => {});
</script>
</div>
@stop