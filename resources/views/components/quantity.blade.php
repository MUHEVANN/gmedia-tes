@props(['sum', 'style' => true])

@if ($style)
    <div
        class="hidden absolute -right-2 -top-2 w-[20px] h-[20px] bg-danger rounded-full text-white md:grid place-content-center text-[12px] {{ $sum === 0 && 'hidden' }}">
        {{ $sum }}
    </div>
    <div
        class="md:hidden w-[18px] h-[18px] bg-danger absolute right-0 -top-1 rounded-full text-[14px]  place-content-center">
        {{ $sum }}
    </div>
@else
    <span>{{ $sum }}</span>
@endif
