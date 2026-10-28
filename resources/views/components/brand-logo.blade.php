@props([
    'size' => 32,
    'class' => '',
])

@php
    $size = (int) $size;
@endphp

<svg 
    xmlns="http://www.w3.org/2000/svg" 
    viewBox="0 0 64 64" 
    width="{{ $size }}" 
    height="{{ $size }}" 
    class="brand-logo-svg flex-shrink-0 {{ $class }}" 
    role="img" 
    aria-label="ClientHub Logo"
    style="display: inline-block; vertical-align: middle; border-radius: {{ max(4, round($size * 0.22)) }}px; box-shadow: 0 4px 12px rgba(30, 27, 75, 0.25);"
>
    <defs>
        <linearGradient id="ch-bg-{{ $size }}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#4f46e5" />
            <stop offset="50%" stop-color="#312e81" />
            <stop offset="100%" stop-color="#1e1b4b" />
        </linearGradient>
        <linearGradient id="ch-cyan-{{ $size }}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#38bdf8" />
            <stop offset="100%" stop-color="#0284c7" />
        </linearGradient>
    </defs>
    <!-- Background Squircle -->
    <rect x="3" y="3" width="58" height="58" rx="14" fill="url(#ch-bg-{{ $size }})" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
    
    <!-- Stylized "C" Bracket (White) -->
    <path d="M 40 21 L 23 21 C 20.2 21 18 23.2 18 26 L 18 38 C 18 40.8 20.2 43 23 43 L 40 43" 
          fill="none" 
          stroke="#ffffff" 
          stroke-width="5" 
          stroke-linecap="round" 
          stroke-linejoin="round" />

    <!-- Connected "Hub" Bridge (Cyan) -->
    <path d="M 28 32 L 44 32" 
          fill="none" 
          stroke="url(#ch-cyan-{{ $size }})" 
          stroke-width="5" 
          stroke-linecap="round" />

    <!-- Receiver Pillar / Node (Cyan) -->
    <path d="M 44 26 L 44 42" 
          fill="none" 
          stroke="url(#ch-cyan-{{ $size }})" 
          stroke-width="5" 
          stroke-linecap="round" />

    <!-- Amber Spark / Indicator Dot (Gold) -->
    <circle cx="44" cy="21" r="3.5" fill="#fbbf24" stroke="#fef08a" stroke-width="0.8" />
</svg>
