<style>
    .custom-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-top: 15px;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .custom-pagination a, 
    .custom-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 10px; 
        font-size: 12px;
        border: 1px solid #e2e8f0; /* Default light border */
        border-radius: 4px;
        color: #4a5568;
        text-decoration: none;
        background-color: #fff;
        transition: all 0.2s ease-in-out;
        min-width: 30px;
        height: 30px;
        box-sizing: border-box;
    }

    .custom-pagination i {
        font-size: 9px !important;
        margin: 0 3px;
    }

    /* Hover Effect: 1px Solid Brown */
    .custom-pagination a:hover {
        background-color: #fff; /* Background white hi rakha hai */
        border: 1px solid #795548; /* Brown border on hover */
        color: #795548; /* Text color bhi brown */
    }

    /* Active Page (Always Brown) */
    .custom-pagination .active-page {
        background-color: #795548; 
        color: #ffffff !important;
        border: 1px solid #795548;
        font-weight: 600;
        cursor: default;
    }

    .custom-pagination .disabled {
        color: #cbd5e0;
        cursor: not-allowed;
        background-color: #f8fafc;
        border-color: #edf2f7;
    }

    .nav-btn {
        min-width: auto !important;
        padding: 0 10px !important;
    }
</style>

@if ($paginator->hasPages())
    <div class="custom-pagination">
        
        @if ($paginator->onFirstPage())
            <span class="disabled nav-btn">
                <i class="fa-solid fa-chevron-left fa-sm"></i> Back
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left fa-sm"></i> Back
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nav-btn">
                Next <i class="fa-solid fa-chevron-right fa-sm"></i>
            </a>
        @else
            <span class="disabled nav-btn">
                Next <i class="fa-solid fa-chevron-right fa-sm"></i>
            </span>
        @endif

    </div>
@endif