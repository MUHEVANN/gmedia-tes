@props(['action', 'method'])

<form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data"
    class="md:w-[600px] flex flex-col gap-6 px-4 py-8 md:px-16 md:py-8 md:shadow-lg rounded z-[50] bg-white">
    @csrf
    {{ $slot }}
</form>
