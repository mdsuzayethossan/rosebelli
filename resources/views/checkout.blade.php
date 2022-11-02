@extends('layouts.master')
@section('content')
    <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <a href="#" class="text-2xl font-bold text-gray-800">Order</a>
        <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
            <div class="relative">
                <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">

                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                            href="#">1</a>
                        <span class="font-semibold text-gray-500">Payment</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if ($carts->count() > 0)
        <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
            <div class="px-4 pt-8 mb-10">
                <p class="text-xl font-medium">Order Summary</p>
                <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
                <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        @php
                            $subtotal += $cart->rel_to_product->discount_price * $cart->quantity;
                        @endphp
                        <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                            <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                                src="{{ asset('uploads/products') }}/{{ $cart->rel_to_product->product_image }}"
                                alt="" />
                            <div class="flex w-full flex-col px-4 py-4">
                                <span class="font-semibold">{{ $cart->rel_to_product->product_name }}</span>
                                <span class="float-right text-gray-400 text-base font-semibold">
                                    <b>৳</b>{{ $cart->rel_to_product->discount_price }}</span>
                                <p class="text-lg font-bold">
                                    <b>৳</b>{{ $cart->rel_to_product->discount_price * $cart->quantity }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <form action="{{ route('order') }}" method="POST">
                    @csrf

                    <p class="mt-8 text-lg font-medium">Shipping Methods</p>
                    <div class="form-control">
                        <label
                            class="label border-[3px] p-3 rounded border-gray-200 my-3 hover:border-primary cursor-pointer">
                            <span class="label-text">Inside Dhaka</span>
                            <input type="radio" required name="shipping" value="1"
                                class="radio shipping checked:bg-red-500" />
                        </label>
                    </div>
                    <div class="form-control">
                        <label
                            class="label border-[3px] p-3 rounded border-gray-200 my-3 hover:border-primary cursor-pointer">
                            <span class="label-text font-semibold text-lg">Outside Dhaka</span>
                            <input type="radio" required name="shipping" value="0"
                                class="radio shipping checked:bg-red-500" />
                        </label>
                    </div>
            </div>


            <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium">Payment Details</p>
                <p class="text-gray-400">Complete your order by providing your payment details.</p>
                <div class="">
                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            value="{{ Auth::user()->email }}" readonly placeholder="your.email@gmail.com" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Phone Number</label>
                    <div class="relative">
                        <input type="number" required name="phone"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Your phone number" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>

                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Address</label>
                    <div class="relative">
                        <textarea cols="30" rows="4" name="address"
                            class="w-full rounded-md border border-gray-200 px-4 py-2 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Write your full address"> </textarea>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Message</label>
                    <div class="relative">
                        <textarea cols="30" rows="4" name="message"
                            class="w-full rounded-md border border-gray-200 px-4 py-2 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Write your message"> </textarea>
                    </div>

                    <!-- Total -->
                    <div class="mt-6 border-t border-b py-2">

                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Shipping</p>
                            <p class="font-semibold text-gray-900"><b>৳</b><span id="shipping">0</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Subtotal</p>
                            <p class="font-semibold text-gray-900"><b>৳</b>{{ $subtotal }}</p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Total</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            <b>৳</b><span id="subtotal">{{ $subtotal }}</span>
                        </p>
                    </div>
                </div>
                <button class="mt-4 mb-8 w-full rounded-md bg-primary px-6 py-3 font-medium text-white">Place
                    Order</button>
            </div>
            </form>
        </div>
    @else
        <div>
            <h3 class="text-center py-4 font-semibold">Your cart is currently empty.</h3>
            <div class="card-actions justify-center py-6">
                <a href="{{ route('index') }}"
                    class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-red-500 hover:text-white border-2 border-red-500 focus:outline-none">
                    Go to shopping
                </a>
            </div>
        </div>
    @endif

@endsection
@section('footer_script')
    <script>
        $('.shipping').click(function() {
            const shippingValue = $(this).val();
            const subtotal = parseFloat($('#subtotal').text());
            let total = null;
            if (shippingValue == 1) {
                total = subtotal + 70;
                $('#shipping').text(70);
            } else {
                total = subtotal + 130;
                $('#shipping').text(130);
            }
            $('#subtotal').text(total);
            $('.shipping').attr("disabled", true)
        });
    </script>
    @if (session('ordered'))
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
                title: '{{ session('ordered') }}'
            })
        </script>
    @endif
    @if (session('notavailable_cart'))
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
                title: '{{ session('notavailable_cart') }}'
            })
        </script>
    @endif
@endsection
