@props(['title' => null])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($title)
        <h3>{{ $title }}</h3>
    @endisset

    {{ $slot }}
</div>