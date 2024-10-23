@props(['totalAmount'])

<span>
    Rp. {{ number_format($totalAmount, 0, ',', '.') }}
</span>
