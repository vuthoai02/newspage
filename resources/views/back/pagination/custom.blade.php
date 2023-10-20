<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }

    .pagination .disabled,
    .pagination .active {
        font-weight: bold;
    }

    .pagination a,
    .pagination .prev,
    .pagination .next {
        padding: 5px 10px;
        margin: 0 2px;
        border: 1px solid #ccc;
        color: #333;
        text-decoration: none;
        background-color: #fff;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }
</style>

<ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    <li class="page-item">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>