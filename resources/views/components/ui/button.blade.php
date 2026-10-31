@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'button',
])

@php
    $classes = 'shadcn-btn shadcn-btn-' . $variant . ' shadcn-btn-size-' . $size;
@endphp

<button
    type="{{ $type }}"
    data-slot="button"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>

