<div class="flex items-center gap-4">
    <a href="{{ route('dashboard') }}"><button
            class="px-5 py-3 border-primary border text-sm text-primary rounded hover:text-white hover:bg-primary transition-all duration-300 ease-in-out">Back
            To Home</button></a>
    <button class="px-5 py-3 bg-primary  text-sm text-white rounded hover:bg-blue-800 payment "
        {{ !$cart || $cart->product->isEmpty() ?? 'disabled' }}>Pay To
        Bill</button>
</div>
