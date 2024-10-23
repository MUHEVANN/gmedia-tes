@extends('layouts.dashboard')
@section('title')
    Cart
@endsection
@section('content')
    <div class="">
        <div class="max-w-screen-xl mx-auto px-4 py-6">
            <div id="table-product">
                @include('components.table-product', ['cart' => $cart])
            </div>

            <div class="flex w-full justify-end my-8">
                <div class="flex items-center gap-24 font-semibold">
                    <span>Total</span>
                    <div id="total">
                        @include('components.total', ['totalAmount' => $totalAmount])
                    </div>
                </div>
            </div>

            <div class="flex justify-end w-full ">

                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}"><button
                            class="px-5 py-3 border-primary border text-sm text-primary rounded hover:text-white hover:bg-primary transition-all duration-300 ease-in-out">Back
                            To Home</button></a>
                    <button
                        class="px-5 py-3 bg-primary  text-sm text-white rounded hover:bg-blue-800 payment disabled:bg-blue-400 disabled:cursor-not-allowed"
                        @if (!$cart || $cart->product->isEmpty()) disabled @endif>Pay To
                        Bill</button>
                </div>

            </div>
        </div>



    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateButton() {
                if ($('.table-product').find('.product-row').length === 0) {
                    $('.payment').attr('disabled', true);
                } else {
                    $('.payment').attr('disabled', false);
                }
            }
            $('body').on('click', '.hapus', function() {
                var id = $(this).data('id');
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
                            url: `/cart/${id}`,
                            success: function(response) {
                                $('#table-product').html(response.cart);
                                $('#total').html(response.total);
                                updateButton()
                                notif("Product has been deleted");
                            }
                        })

                    }
                });
            })

            $('body').on('click', '.tambah', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: `/cart-tambah/${id}`,
                    success: function(response) {
                        $('#table-product').html(response.cart);
                        $('#total').html(response.total);
                        $(`#quantity-${id}`).html(response.sum);
                        notif("Product has been increament");
                    }
                })
            })
            $('body').on('click', '.kurang', function() {
                var id = $(this).data('id');
                if ($(`#quantity-${id}`).find('span').text() == 1) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Produk akan terhapus jika kurang dari 1",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: `/cart-kurang/${id}`,
                                success: function(response) {
                                    $('#total').html(response.total);
                                    $('#table-product').html(response.cart);
                                    updateButton()
                                    notif("Product has been deleted");

                                }
                            })

                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: `/cart-kurang/${id}`,
                        success: function(response) {
                            $('#total').html(response.total);
                            $('#table-product').html(response.cart);
                            $(`#quantity-${id}`).html(response.sum);
                            updateButton()
                            notif("Product has been decreament");

                        }
                    })
                }
            })

            $('body').on('click', '.payment', function() {
                $.ajax({
                    type: "POST",
                    url: `/payment`,
                    success: function(response) {
                        var total = new Intl.NumberFormat('ID', {
                            style: "currency",
                            currency: "IDR"
                        }).format(response.total_amount)
                        $('#table-product').html(response.cart);
                        $('#total').html(response.total);
                        updateButton()
                        Swal.fire({
                            title: "Payment Success Fully!",
                            text: total,
                            icon: "success"
                        });
                    }
                })
            })
        });
    </script>
@endpush
