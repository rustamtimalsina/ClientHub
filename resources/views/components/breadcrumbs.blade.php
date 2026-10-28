@props(['links' => []])

@if(!empty($links))
    <style>
        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .breadcrumb-link {
            color: var(--muted);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.15s ease;
        }
        .breadcrumb-link:hover {
            color: var(--primary);
        }
        [data-theme="dark"] .breadcrumb-link:hover {
            color: #818cf8;
        }
        .breadcrumb-current {
            color: var(--text);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .breadcrumb-sep {
            color: var(--muted);
            opacity: 0.55;
            flex-shrink: 0;
        }
    </style>
    <nav aria-label="Breadcrumb" class="breadcrumb-nav">
        @foreach($links as $index => $link)
            @if($index > 0)
                <svg class="breadcrumb-sep" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            @endif

            @if(!empty($link['url']) && !$loop->last)
                <a href="{{ $link['url'] }}" class="breadcrumb-link">
                    @if(!empty($link['icon']))
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    @endif
                    {{ $link['label'] }}
                </a>
            @else
                <span class="breadcrumb-current">
                    {{ $link['label'] }}
                </span>
            @endif
        @endforeach
    </nav>
@endif
