@props([
    'variant' => 'outline',
])

<span
    data-slot="badge"
    {{ $attributes->merge(['class' => 'shadcn-badge shadcn-badge-' . $variant]) }}
>
    {{ $slot }}
</span>

