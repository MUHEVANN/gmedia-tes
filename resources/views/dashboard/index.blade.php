@extends('layouts.dashboard')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="max-w-screen-xl mx-auto px-4">
        <div class=" justify-end py-4 gap-2 hidden md:flex">
            <a href="{{ route('category.create') }}">
                <x-button variant="secondary">
                    + Add Category
                </x-button>
            </a>
            <a href="/product/create">
                <x-button variant="secondary">
                    + Add Product
                </x-button>
            </a>
            <a href="{{ route('cart.index') }}" class="relative">
                <x-button>
                    <i class='bx bx-cart-add'></i>
                </x-button>
                <div class="sum">
                    @include('components.quantity', ['sum' => $sum])
                </div>
            </a>

        </div>

        <div class="max-w-screen-xl mx-auto px-4 hidden md:block ">
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap  -mb-px" id="category_parent">
                    @include('components.category', ['productCategory' => $categories])

                </ul>
            </div>

            <div id="product-list" class="mt-6 ">
                @include('components.card-product', ['products' => $products])
            </div>
        </div>

        <form id="search_form" class="max-w-screen-xl mx-auto md:hidden mb-3 relative">
            <input type="text" class="w-full rounded border-gray-400 border" placeholder="search" />
            <div class="absolute right-2 -translate-y-1/2 top-1/2"><i class='bx bx-search'></i></div>
            <button type="submit" class="hidden"></button>
        </form>
        <div class="max-w-screen-xl mx-auto md:hidden" id="card-mobile">
            @include('components.list-product-mobile', ['productCategory' => $productCategory])
        </div>

        <div class="md:hidden fixed bottom-0 w-full  left-0 flex flex-col gap-3">
            <a href="{{ route('cart.index') }}"> <button
                    class="absolute right-4 -top-10 rounded-full h-[40px] w-[40px] grid place-content-center text-white bg-primary"><i
                        class='bx bx-cart-add text-xl'></i>
                    <div class="sum">
                        @include('components.quantity', ['sum' => $sum])
                    </div>
                </button></a>
            <div class="p-5 bg-white h-full gap-2 shadow-lg rounded-t-xl flex flex-col justify-between shad-custom">
                <button type="button" data-drawer-target="drawer-bottom-category" data-drawer-show="drawer-bottom-category"
                    data-drawer-placement="bottom" aria-controls="drawer-bottom-category"
                    class="border-primary border text-primary rounded py-2 text-sm">+
                    Add Category</button>
                <button data-drawer-target="drawer-bottom-product" data-drawer-show="drawer-bottom-product"
                    data-drawer-placement="bottom" aria-controls="drawer-bottom-product"
                    class="border-primary border text-primary rounded py-2 text-sm">+ Add Product</button>
            </div>
        </div>

    </div>
    {{-- category --}}
    <div id="drawer-bottom-category"
        class="fixed bottom-0 rounded-t-lg left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform duration-300 ease-in-out bg-white dark:bg-gray-800 translate-y-full"
        tabindex="-1" aria-labelledby="drawer-bottom-label">
        <h5 class="text-xl font-bold">Add Category</h5>
        <button type="button" id="category_drawer" data-drawer-hide="drawer-bottom-category"
            aria-controls="drawer-bottom-category"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form action="" class="w-full mt-4" id="category_form">
            <div>
                <input type="text" class="border-gray-400 border rounded w-full" id="category_name"
                    placeholder="category name">
                <span id="error-category_name" class="text-sm text-danger"></span>
            </div>
            <button type="submit"
                class="mt-4 flex w-full text-white bg-primary justify-center py-2 rounded ">Tambah</button>
        </form>
    </div>

    {{-- product --}}
    <div id="drawer-bottom-product"
        class="fixed bottom-0 rounded-t-lg left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform duration-300 ease-in-out bg-white dark:bg-gray-800 translate-y-full"
        tabindex="-1" aria-labelledby="drawer-bottom-label">
        <h5 class="text-xl font-bold">Add product</h5>
        <button type="button" id="product_drawer" data-drawer-hide="drawer-bottom-product"
            aria-controls="drawer-bottom-product"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form action="" class="w-full mt-4" id="product_form" enctype="multipart/form-data">
            <div class="hidden mb-3 w-full h-[300px]" id="image_preview">
                <img src="" alt="" class="w-full h-full object-cover rounded">
            </div>
            <div class="mb-3 ">
                <div id="file_upload"
                    class="w-full rounded border border-gray-400 text-gray-500 px-3 py-2 flex justify-between items-center">
                    <span id="upload_text">Product
                        Image</span> <i class='bx bx-cloud-upload text-xl'></i>
                </div>
                <span class="text-sm text-danger" id="error-product_image"></span>
                <input id="product_image" type="file" class="hidden border-gray-400 border rounded w-full"
                    placeholder="product name">
            </div>
            <div class="mb-3">
                <input id="product_name" type="text" class="border-gray-400 border rounded w-full"
                    placeholder="product name">
                <span class="text-sm text-danger" id="error-product_name"></span>
            </div>
            <div class="mb-3">
                <input id="price" type="number" class="border-gray-400 border rounded w-full" placeholder="price">
                <span class="text-sm text-danger" id="error-price"></span>
            </div>
            <div class="mb-3">
                <select name="" id="product_category" class="border-gray-400 border rounded w-full  ">
                    <option value="">Product Category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <span class="text-sm text-danger" id="error-product_category"></span>
            </div>
            <button type="submit"
                class="mt-4 flex w-full text-white bg-primary justify-center py-2 rounded ">Tambah</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function getParams(param) {

            const params = new URLSearchParams(window.location.search);
            return params.get(param)
        }
        $(document).ready(function() {
            $('body').on('click', '.hapus', function() {
                var item = $(this).data('id');
                const param = getParams('category_id')
                console.log(param)
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `/product/${item.id}`,
                            data: {
                                category_id: param
                            },
                            success: function(response) {
                                $('#product-list').html(response.products);
                                $('#card-mobile').html(response.productCategory);
                                $('.sum').html(response.sum);
                                notif("Product has been deleted");
                            }
                        })

                    }
                });
            })

            const params = getParams('category_id')
            if (params === null) {
                $('.category_id').first().addClass('active')
            } else {
                $(`.category_id[data-id=${params}]`).addClass('active')
            }

            $('.category_id').on('click', function(e) {
                e.preventDefault();
                $('.category_id').removeClass('active');
                $(this).addClass('active');
                var id = $(this).data('id');
                if (id === params) {
                    return;
                }
                const newUrl =
                    `${window.location.protocol}//${window.location.host}${window.location.pathname}?category_id=${id}`;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
                $.ajax({
                    type: "GET",
                    url: "/dashboard",
                    data: {
                        category_id: id
                    },
                    success: function(response) {
                        $('#product-list').html(response.products);
                    }
                })
            })

            $('body').on('click', '.cart', function() {
                var item = $(this).data('item');
                $.ajax({
                    type: "POST",
                    url: "/cart",
                    data: {
                        product_id: item.id,
                        category_id: item.category_id
                    },
                    success: function(response) {
                        if ($(window).width() > 768) {
                            notif(response.message)
                        } else {
                            notifCenter(response.message)
                        }
                        $('.sum').html(response.sum)
                    }
                })
            })


            $('#category_form').on('submit', function(e) {
                e.preventDefault();
                var name = $('#category_name').val();

                $.ajax({
                    type: "POST",
                    url: "/category",
                    data: {
                        name: name
                    },
                    success: function(response) {
                        if (response.error) {
                            console.log(response.error.name.join(','))
                            $('#error-category_name').text(response.error.name.join(','))
                            return;
                        }
                        $('#category_name').val('');
                        $('#card-mobile').html(response.productCategory);
                        $('#category_parent').html(response.category);
                        $('#category_drawer').click()
                        notifCenter('category added')


                    }
                })
            })

            $('#file_upload').on('click', function() {
                $('#product_image').click();

            })

            $('#product_image').on('change', function() {
                const reader = new FileReader();
                $('#upload_text').text(this.files[0].name ?? 'Product Image')
                reader.onload = (e) => {
                    $('#image_preview').find('img').attr('src', e.target.result)
                }
                reader.readAsDataURL(this.files[0])
                $('#image_preview').removeClass('hidden')
            })

            function formError(message) {
                $('#error-product_name').text(message.name ? message.name.join(', ') : '')
                $('#error-product_image').text(message.image ? message.image.join(', ') : '')
                $('#error-price').text(message.price ? message.price.join(', ') : '')
                $('#error-product_category').text(message.category_id ? message.category_id.join(', ') :
                    '')
            }

            $('#product_form').on('submit', function(e) {
                e.preventDefault()
                const param = getParams('category_id');
                var formData = new FormData();
                formData.append('name', $('#product_name').val());
                formData.append('price', $('#price').val());
                formData.append('category_id', $('#product_category').val());
                formData.append('category_url', param);
                formData.append('image', $('#product_image').prop('files')[0]);

                formError('')
                $.ajax({
                    type: "POST",
                    url: "/product",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        if (response.error) {
                            formError(response.error)
                        } else {
                            $('#card-mobile').html(response.productCategory)
                            $('#product-list').html(response.products)
                            $('#product_form').find('input').val('')
                            $('#upload_text').text('Product Image')
                            $('#product_category').val('')
                            $('#image_preview').addClass('hidden')
                            $('#product_drawer').click()
                            notifCenter('product added')
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr
                            .responseText); // Menampilkan pesan kesalahan dari server
                        notifCenter(
                            'Failed to add category'
                        ); // Menampilkan notifikasi atau pesan gagal
                    }
                });
            })

            $('#search_form').on('submit', function(e) {
                e.preventDefault();
                var search = $(this).find('input').val();
                $.ajax({
                    type: "GET",
                    url: "/search-product",
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('#card-mobile').html(response.productCategory);
                    }
                })
            })
        })
    </script>
@endpush
