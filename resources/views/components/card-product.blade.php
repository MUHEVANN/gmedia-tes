<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @if ($products->isEmpty())
        <div class="col-span-full flex items-center justify-center">
            <h1 class="text-2xl font-semibold">No Product Found</h1>
        </div>
    @else
        @foreach ($products as $item)
            <div class="h-[300px] bg-white shadow rounded">
                <div class="w-full h-[60%]">
                    <img src="{{ asset('storage/products/' . $item->image) }}" alt=""
                        class="w-full h-full object-cover rounded">
                </div>

                <div class="flex flex-col justify-between h-[40%]  p-2">
                    <div>
                        <div class="flex justify-between items-center">
                            <h2 class="capitalize">{{ $item->name }}</h2>
                            <button class="text-white bg-[#DE350B] px-2 py-1 rounded hapus"
                                data-id="{{ $item }}"><i class='bx bx-trash'></i></button>
                        </div>
                        <span class="text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-center w-full ">
                        <button data-item="{{ $item }}"
                            class="bg-primary cart rounded w-full text-white py-1 hover:bg-blue-800 transition-all duration-300 ease-in-out"><i
                                class='bx bx-cart-add'></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
