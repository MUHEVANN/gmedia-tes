<div class="hidden md:block relative table-product  overflow-x-auto  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Qty
                </th>
                <th scope="col" class="px-6 py-3">
                    Sub Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

            @if (!$cart || $cart->product->isEmpty())
                <tr class="h-full flex  w-full justify-center mt-12 ">
                    <td rowspan="4" colspan="4" class="w-full ">Keranjang Anda kosong. Silakan tambahkan
                        produk.</td>
                </tr>
            @else
                @foreach ($cart->product as $item)
                    <tr
                        class="odd:bg-white product-row odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">
                            <div class="w-[200px] h-[200px]">
                                <img src="{{ asset('storage/products/' . $item->image) }}" alt=""
                                    class="w-full h-full object-cover rounded" />

                            </div>
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center gap-2">
                                <span data-id="{{ $item->id }}"
                                    class="kurang bg-primary text-white shadow-sm shadow-primary hover:bg-blue-800  transition-all duration-300 ease-in-out h-[30px] w-[30px] grid place-content-center rounded-full hover:cursor-pointer">-</span>
                                <div id="quantity-{{ $item->id }}">
                                    @include('components.quantity-single', [
                                        'sum' => $item->pivot->quantity,
                                    ])
                                </div>

                                <span data-id="{{ $item->id }}"
                                    class=" tambah bg-primary text-white shadow-sm shadow-primary hover:bg-blue-800 transition-all duration-300 ease-in-out h-[30px] w-[30px] grid place-content-center rounded-full hover:cursor-pointer">+</span>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            Rp {{ number_format($item->price * $item->pivot->quantity, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            <button data-id="{{ $item->id }}"
                                class="hapus text-white bg-danger rounded px-4 py-2 shadow shadow-danger hover:bg-red-700 transition-all duration-300 ease-in-out"><i
                                    class='bx bx-trash'></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

<div class="md:hidden">
    @if (!$cart || $cart->product->isEmpty())
        <p class="text-center w-full text-gray-400">produck kosong</p>
    @else
        @foreach ($cart->product as $item)
            <div class="bg-white p-2 px-4">
                <div>
                    <i class='bx bx-x text-xl text-danger'></i>
                </div>
                <ul class="flex flex-col">
                    <li class="py-2 border-t border-b border-gray-300 flex justify-between items-center">
                        <span class="uppercase text-sm">Product</span>
                        <span class="text-primary text-sm capitalize">{{ $item->name }}</span>
                    </li>
                    <li class="py-2  border-b border-gray-300 flex justify-between items-center">
                        <span class="uppercase text-sm">price</span>
                        <span class="text-sm ">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </li>
                    <li class="py-2 border-b border-gray-300 flex justify-between items-center">
                        <span class="uppercase text-sm">quantity</span>
                        <div class="text-sm flex items-center gap-4"> <span data-id="{{ $item->id }}"
                                class="kurang bg-primary text-white  hover:bg-blue-800  transition-all duration-300 ease-in-out h-[24px] w-[24px] grid place-content-center rounded-full hover:cursor-pointer">-</span>
                            <div id="quantity-{{ $item->id }}">
                                @include('components.quantity-single', [
                                    'sum' => $item->pivot->quantity,
                                ])
                            </div>

                            <span data-id="{{ $item->id }}"
                                class=" tambah bg-primary text-white  hover:bg-blue-800 transition-all duration-300 ease-in-out h-[24px] w-[24px] grid place-content-center rounded-full hover:cursor-pointer">+</span>
                        </div>
                    </li>
                    <li class="py-2 border-b border-gray-300 flex justify-between items-center">
                        <span class="uppercase text-sm">sub total</span>
                        <span class="text-sm ">Rp
                            {{ number_format($item->pivot->quantity * $item->price, 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>
        @endforeach
    @endif
</div>
