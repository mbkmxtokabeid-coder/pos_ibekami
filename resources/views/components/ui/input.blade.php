@props([
    'type' => 'text',
    'invalid' => false,
])

<input
    type="{{ $type }}"
    data-slot="input"
    {{ $attributes->merge(['class' => 'shadcn-input' . ($invalid ? ' is-invalid' : '')]) }}
>

