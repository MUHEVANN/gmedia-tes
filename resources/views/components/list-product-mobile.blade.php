@props(['productCategory'])
<div class="pb-40">
    @if ($productCategory->isEmpty())
        <div class="col-span-full flex items-center justify-center">
            <h1 class="text-sm">No Product Found</h1>
        </div>
    @else
        @foreach ($productCategory as $item)
            <h1>{{ $item->name }}</h1>
            <div class="overflow-x-auto pb-4">
                <div class="flex flex-row gap-4 overflow-x-auto  p-4">
                    @if ($item->product->isEmpty())
                        <div class="col-span-full flex items-center justify-center">
                            <h1 class="text-sm">No Product Found</h1>
                        </div>
                    @else
                        @foreach ($item->product as $prod)
                            <div class="h-[250px] w-[200px] bg-white shadow rounded scroll-snap-start flex-shrink-0">
                                <div class="w-full h-[60%]">
                                    <img src="{{ asset('storage/products/' . $prod->image) }}" alt=""
                                        class="w-full h-full object-cover rounded">
                                </div>

                                <div class="flex flex-col justify-between h-[40%] p-2">
                                    <div>
                                        <div class="flex justify-between items-center">
                                            <h2 class="capitalize">{{ $prod->name }}</h2>
                                            <button class="text-white bg-[#DE350B] px-2 py-1 rounded hapus"
                                                data-id="{{ $prod }}"><i class='bx bx-trash'></i></button>
                                        </div>
                                        <span class="text-sm">Rp {{ number_format($prod->price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-center w-full ">
                                        <button data-item="{{ $prod }}"
                                            class="bg-primary cart rounded w-full text-white py-1 hover:bg-blue-800 transition-all duration-300 ease-in-out"><i
                                                class='bx bx-cart-add'></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
