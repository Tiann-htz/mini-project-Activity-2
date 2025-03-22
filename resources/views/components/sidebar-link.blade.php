@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 rounded-md bg-blue-100 text-blue-700'
            : 'flex items-center p-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if(isset($icon))
        <div class="mr-3">
            {{ $icon }}
        </div>
    @endif
    <span>{{ $slot }}</span>
</a>