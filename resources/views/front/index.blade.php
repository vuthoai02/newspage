@extends('front.template.master')
@section('title', 'News')

<style>
    a{
        color: #000;
    }
    #content {
        width: 70%;
        padding-left: 20px;
    }

    .newsItem {
        color: #000;
        background-color: transparent;
        padding: 10px;

    }

    .newsItem:hover {
        background-color: #f2f2f2;
        padding: 10px;
    }
</style>
@section('content')
@component('front.template.CategoryList', ['categories' => $categories])
@endcomponent
<div id="content">
    <div>
        @if($news)
        @foreach($news as $ne)
        <div class="newsItem">
            <a href="{{ url('/post/'.$ne->alias)}}">
                <p style="color:steelblue;">By {{ $ne->username }}</p>
                <h3>{{ $ne->title }}</h3>
                <p>{{ $ne->description }}</p>
                <p style="color: #888;"><i class="fa fa-eye"> {{ $ne->view}} | {{ $ne->created_at->format('d/m/Y') }}</i></p>
            </a>
        </div>
        <hr style="margin-top:5px;margin-bottom:5px;" />
        @endforeach
        @else
        <img src="{{ asset('assets/no-results.png')}}"/>
        @endif
    </div>
    @if($news)
    <div class="pagination">
        {{ $news->links('back.pagination.custom') }}
    </div>
    @endif
</div>
@stop