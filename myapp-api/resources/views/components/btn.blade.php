{{-- <button {{ $attributes }}>
    {{ $slot }}
</button> --}}

@props([
    'href' => null,
])
@if($href)
    <a {{ $attributes->merge([
            'class' => 'btn btn-primary',
            'href' => $href
        ]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge([
            'class' => 'btn',
            'type' => 'button'
        ]) }}>
        {{ $slot }}
    </button>
@endif