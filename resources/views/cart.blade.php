@extends('layouts.master')
@section('content')
    <section class="bg-gray-100 py-12 sm:py-16 lg:py-20">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <h1 class="text-2xl font-semibold text-gray-900">Your Cart</h1>
            </div>

            <div class="mx-auto mt-8 max-w-4xl md:mt-12">
                <div class="bg-white shadow">
                    <ul class="grid grid-cols-5 text-lg bg-primary uppercase text-white font-bold px-8 py-4">
                        <li class="col-span-1">IMAGE</li>
                        <li class="col-span-2">PRODUCT NAME/UNTIL PRICE</li>
                        <li class="text-end col-span-1">Name</li>
                        <li class="text-end col-span-1">Name</li>
                    </ul>
                    @if ($carts->count() > 0)
                        <div class="px-4 py-6 sm:px-8 sm:py-10">
                            <div class="flow-root">
                                <ul class="-my-8">
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach ($carts as $cart)
                                        @php
                                            $total += $cart->rel_to_product->discount_price * $cart->quantity;
                                        @endphp

                                        <li
                                            class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                            <div class="shrink-0 mr-5">
                                                <img class="h-24 w-24 max-w-full rounded-lg object-cover"
                                                    src="{{ asset('uploads/products') }}/{{ $cart->rel_to_product->product_image }}"
                                                    alt="" />
                                            </div>

                                            <div class="relative flex flex-1 flex-col justify-between ps-5">
                                                <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                                    <div class="pr-8 sm:pr-5">
                                                        <p class="text-base font-semibold text-gray-900">
                                                            {{ $cart->rel_to_product->product_name }}</p>
                                                        <p class="mx-0 mt-1 mb-0 text-gray-400 text-base font-semibold">
                                                            <b>৳</b>{{ $cart->rel_to_product->discount_price }}
                                                        </p>
                                                    </div>

                                                    <div
                                                        class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                                        <p
                                                            class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">
                                                            <b>৳</b>{{ $cart->rel_to_product->discount_price * $cart->quantity }}
                                                        </p>
                                                        <form action="{{ route('cart.update') }}" method="POST">
                                                            @csrf
                                                            <div class="sm:order-1">
                                                                <div class="mx-auto flex h-8 items-stretch text-gray-600">

                                                                    <button type="button"
                                                                        class="flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-black hover:text-white"
                                                                        onclick="product_decrement(this.parentElement)">-</button>

                                                                    <input type="text" readonly
                                                                        class="text-center w-full bg-gray-100 px-4 text-xs uppercase transition product_quantity"
                                                                        name="qtybutton[{{ $cart->id }}]"
                                                                        value="{{ $cart->quantity }}"
                                                                        id="cart{{ $cart->id }}">
                                                                    <button id="" type="button"
                                                                        class="flex product_increment items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-black hover:text-white"
                                                                        onclick="product_increment(this.parentElement)">+</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                                    <a href="{{ route('cart.delete', $cart->id) }}"
                                                        class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" class="">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-6 border-t border-b py-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400">Subtotal</p>
                                    <p class="text-lg font-semibold text-gray-900"><b>৳</b>{{ $total }}</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400">Shipping</p>
                                    <p class="text-lg font-semibold text-gray-900">$8.00</p>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">Total</p>
                                <p class="text-2xl font-semibold text-gray-900"><span
                                        class="text-lg font-semibold text-gray-900"><b>৳</b></span>{{ $total }}</p>
                            </div>

                            <div class="mt-6 text-center">
                                <button type="submit"
                                    class="group mb-3 inline-flex w-full items-center justify-center rounded-md bg-gray-900 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                                    Cart Update
                                </button>
                                </form>
                                <a href="{{ route('checkout') }}"
                                    class="group inline-flex w-full items-center justify-center rounded-md bg-gray-900 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                                    Checkout
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-center py-4 font-semibold">Your cart is currently empty.</h3>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer_script')
    <script>
        function product_increment(id) {
            const thisValue = id.children[1].value++;
        }

        function product_decrement(id) {
            let thisValue = parseInt(id.children[1].value);
            if (thisValue > 1) {
                id.children[1].value--;
            }
        }
    </script>
    @if (session('cart_updated'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('cart_updated') }}'
            })
        </script>
    @endif
    @if (session('cart_delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('cart_delete') }}'
            })
        </script>
    @endif
@endsection
