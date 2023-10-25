<style>
    #categories {
        width: 15%;
        border-right: 1px solid #888;
        padding: 0 5px 0 10px;
    }

    #categories ul {
        padding-left: 10px;
        margin-top: 5px;
    }

    #categories ul>li {
        list-style-type: none;
        color: cornflowerblue;
        font-weight: bold;
        padding: 5px;
        border-bottom: 1px solid #888;
    }

    #categories ul>li:hover {
        background-color: #f2f2f2;
    }
</style>

<div id="categories">
    <p style="background-color: cornflowerblue;color:#fff;padding:3px"><b>Danh mục</b></p>
    <ul>
        @if($categories)
        @foreach($categories as $category)
        <li><a href="{{ url('/category/'.$category->alias) }}">{{ $category->name }}</a></li>
        @endforeach
        @endif
    </ul>
</div>