@props(['active'])
<a {{ $attributes->merge() }}>
    {{ $slot }}
</a>
