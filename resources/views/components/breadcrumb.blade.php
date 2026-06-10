<nav aria-label="breadcrumb">
    <ol class="breadcrumb custom-breadcrumb mb-0">
        @foreach ($items as $item)
            <li class="breadcrumb-item d-flex align-items-center breadcrum-icon {{ $loop->last ? 'active' : '' }}">
                
                {{-- Icon --}}
                @if(isset($item['icon']))
                    <i class="{{ $item['icon'] }} me-1"></i>
                @endif

                {{-- Link / Text --}}
                @if (!$loop->last)
                    <a href="{{ $item['url'] }}">
                        {{ $item['title'] }}
                    </a>
                @else
                    <span>{{ $item['title'] }}</span>
                @endif

                {{-- Separator > --}}
                @if (!$loop->last)
                    <span class="separator mx-2">></span>
                @endif

            </li>
        @endforeach
    </ol>
</nav>