@extends('layouts.dashboard')
@section('title')
    Create Category
@endsection
@section('content')
    <div class="h-[80vh] grid place-content-center relative">
        <div class="absolute top-4 px-4 w-full left-[50%] translate-x-[-50%] max-w-screen-xl "><a
                href="{{ route('dashboard') }}" class="flex items-center"><i
                    class='bx bx-arrow-back text-xl me-2 '></i>back</a></div>
        <x-form action="{{ route('category.store') }}" method="POST">
            <h1 class="font-semibold text-xl text-center">Create Category</h1>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="">Category Name</label>
                    <input type="text" name="name" placeholder="Category Name" class="border-gray-400 rounded"
                        value="{{ old('name') }}" />
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex items-center flex-col gap-2">
                <x-button type="submit">Create</x-button>
            </div>
        </x-form>
    </div>
@endsection
