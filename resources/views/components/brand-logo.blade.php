@props([
    'size' => 32,
    'class' => '',
])

@php
    $size = (int) $size;
@endphp

<img 
    src="{{ asset('images/logo-emblem.png') }}" 
    alt="ClientHub Logo" 
    width="{{ $size }}" 
    height="{{ $size }}" 
    class="brand-logo-img flex-shrink-0 {{ $class }}" 
    style="display: inline-block; vertical-align: middle; object-fit: contain; width: {{ $size }}px; height: {{ $size }}px;"
    loading="eager"
/>
