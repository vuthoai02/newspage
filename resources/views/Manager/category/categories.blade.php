@extends('back.template.master')
@section('title', 'Quản lý danh mục');
@section('heading', 'Quản lý danh mục');

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

    .pagination {
        width: 100%;
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
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
    <div>
        <a href="{{ url('/admin/manager/add-categories') }}" class="add">+ Thêm danh mục</a>
    </div>
    <table>
        <tr style="border-bottom: 1px solid gray;">
            <th>ID</th>
            <th>Danh mục</th>
            <th>Danh mục cha</th>
            <th>Thao tác</th>
        </tr>
        @if(!empty($categories))
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                @if ($category->parentId)
                <?php
                $parentCategory = \App\Models\CategoryModel::find($category->parentId);
                ?>
                {{ $parentCategory->name }}
                @else
                Không có
                @endif
            </td>
            <td style="display: flex; color:blue">
                <a href="{{ url('/admin/manager/update-category/'.$category->id)}}">[Chỉnh sửa]</a>
                <form action="{{ route('deletecategory') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">[Xóa]</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    @if(!empty($categories))
    <div class="pagination">
        {{ $categories->links('back.pagination.custom') }}
    </div>
    @endif
</div>
@stop