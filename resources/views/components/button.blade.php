@props(['variant' => 'default', 'type' => 'button'])


@php
    $classes = '';

    switch ($variant) {
        case 'secondary':
            $classes = 'bg-secondary text-primary hover:bg-primary hover:text-white font-semibold';
            break;

        default:
            $classes = 'bg-blueText text-white hover:bg-blue-800 ';
            break;
    }
@endphp


<button type="{{ $type }}"
    class="w-full md:max-w-max px-4 py-2 rounded transition-all duration-300 ease-in-out {{ $classes }}">
    {{ $slot }}
</button>
