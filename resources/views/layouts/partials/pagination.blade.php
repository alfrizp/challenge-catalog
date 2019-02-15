@if ($paginator->hasPages())
  <ul class="pagination pagination-md">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="page-item disabled"><span class="page-link nohover">{{ __('app.previous') }}</span></li>
    @else
      <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">{{ __('app.previous') }}</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="page-item active"><span class="page-link" >{{ $page }}</span></li>
          @elseif(
            (
              $page === $paginator->currentPage() + 1
              || $page === $paginator->currentPage() + 2
              || $page === $paginator->currentPage() - 1
              || $page === $paginator->currentPage() - 2
            )
              || $page === $paginator->lastPage()
              || $page === 1
          )
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
          @elseif(
            $page === $paginator->lastPage()-1
            || $page === 1+1
          )
            <li class="page-item"><span class="page-link" >...</span></li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">{{ __('app.next') }}</a></li>
    @else
      <li class="page-item disabled"><span class="page-link nohover">{{ __('app.next') }}</span></li>
    @endif
  </ul>
@endif
