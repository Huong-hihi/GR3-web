<div class="col" style="display: flex; justify-content: center">
    <div class="demo-inline-spacing">
        <!-- Basic Pagination -->
        <nav aria-label="Page navigation">
        @if ($paginator->hasPages())
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item prev disabled"><a href="javascript:void(0)" rel="prev" class="page-link"><i class="tf-icon bx bx-chevron-left"></i></a></li>
                @else
                    <li class="page-item prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link"><i class="tf-icon bx bx-chevron-left"></i></a></li>
                @endif

                @if($paginator->currentPage() > 2)
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                @endif
                @if($paginator->currentPage() > 3)
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
                @endif
                @foreach(range(1, $paginator->lastPage()) as $i)
                    @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
                        @if ($i == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ $i }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
                @endif
                @if($paginator->currentPage() < $paginator->lastPage() - 1)
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item next"><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link"><i class="tf-icon bx bx-chevron-right"></i></a></li>
                @else
                    <li class="page-item next disabled" style="cursor: "><a href="javascript:void(0)" rel="prev" class="page-link"><i class="tf-icon bx bx-chevron-right"></i></a></li>
                @endif
            </ul>
        @endif
        </nav>
    </div>
</div>
