@props([
    'for' => null,
])

<label
    @if($for) for="{{ $for }}" @endif
    data-slot="label"
    {{ $attributes->merge(['class' => 'shadcn-label']) }}
>
    {{ $slot }}
</label>

