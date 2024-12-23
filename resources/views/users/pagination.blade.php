
@if ($data->count() > 0)


<nav class="datatable-pagination">
    <ul class="datatable-pagination-list">
        @if ($data->onFirstPage())
        <li class="datatable-pagination-list-item datatable-disabled">
            <button disabled aria-label="Previous Page">‹</button>
        </li>
        @else
        <li class="datatable-pagination-list-item">
            <a href="{{ $data->previousPageUrl() }}" class="datatable-pagination-list-item-link"
                aria-label="Previous Page">‹</a>
        </li>
        @endif

        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
        <li class="datatable-pagination-list-item {{ $data->currentPage() == $page ? 'datatable-active' : '' }}">
            <a href="{{ $url }}" class="datatable-pagination-list-item-link" aria-label="Page {{ $page }}">{{ $page
                }}</a>
        </li>
        @endforeach

        @if ($data->hasMorePages())
        <li class="datatable-pagination-list-item">
            <a href="{{ $data->nextPageUrl() }}" class="datatable-pagination-list-item-link"
                aria-label="Next Page">›</a>
        </li>
        @else
        <li class="datatable-pagination-list-item datatable-disabled">
            <button disabled aria-label="Next Page">›</button>
        </li>
        @endif
    </ul>
</nav>
@endif
