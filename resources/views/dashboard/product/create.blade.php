@extends('layouts.dashboard')
@section('title')
    Create Product
@endsection

@section('content')
    <div class="pt-[6rem] w-full flex justify-center relative">
        <div class="absolute top-4 px-4 w-full left-[50%] translate-x-[-50%] max-w-screen-xl "><a
                href="{{ route('dashboard') }}" class="flex items-center"><i
                    class='bx bx-arrow-back text-xl me-2 z-[999]'></i>back</a></div>
        <x-form action="{{ route('product.store') }}" method="POST">
            <h1 class="font-semibold text-xl text-center">Product Category</h1>
            <div class="w-full container-img h-[300px] hidden relative">
                <div class="absolute right-0 top-0"><i class='bx bx-x text-2xl hover:cursor-pointer close'></i></div>
                <img src="" alt="" class="w-full h-full object-contain" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="flex flex-col justify-center items-center md:items-start">
                    <div id="upload"
                        class="w-[200px] h-[200px] border border-dashed  border-primary hover:cursor-pointer grid place-content-center bg-secondary">
                        <i class='bx bx-cloud-upload text-8xl text-primary'></i>
                        <span class="text-primary">Upload Image</span>
                    </div>
                    <span id="text_upload"></span>
                    <input type="file" name="image" class="image border-gray-400 rounded hidden "
                        accept=".jpg,.jpeg,.webp,.png,.svg" />
                    @error('image')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="">Product Name</label>
                        <input type="text" name="name" placeholder="Category Name" class="border-gray-400 rounded"
                            value="{{ old('name') }}" />
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="">Price</label>
                        <input type="number" name="price" placeholder="price" class="border-gray-400 rounded"
                            value="{{ old('price') }}" />
                        @error('price')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="">Product Name</label>
                        <select name="category_id" id="">
                            <option value="">Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex items-center flex-col gap-2">
                <x-button type="submit">Create</x-button>
            </div>
        </x-form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#upload').on('click', function() {
                $('.image').click();
            })


            $('.image').on('change', function() {
                const file = $(this).prop('files')[0];
                const reader = new FileReader();
                $('#text_upload').text(this.files[0].name)
                reader.onload = function(e) {
                    $('.container-img').removeClass('hidden');
                    $('.container-img').find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            })

            $('.close').on('click', function() {
                $('.container-img').addClass('hidden');
            })
        });
    </script>
@endpush
