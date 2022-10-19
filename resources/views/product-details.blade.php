@extends('layouts.master')
@section('content')
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    src="{{ asset('uploads/products') }}/{{ $single_product->product_image }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    {{-- <h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2> --}}
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $single_product->product_name }}</h1>
                    <div class="flex mb-4">
                        <span class="flex items-center">
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 text-primary" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 text-primary" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 text-primary" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 text-primary" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 text-primary" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                            <span class="text-gray-600 ml-3">4 Reviews</span>
                        </span>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                    </path>
                                </svg>
                            </a>
                            <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                    </path>
                                </svg>
                            </a>
                        </span>
                    </div>
                    <p class="leading-relaxed">{{ $single_product->description }}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                        {{-- <div class="flex">
                            <span class="mr-3">Color</span>
                            <button class="border-2 border-gray-300 rounded-full w-6 h-6 focus:outline-none"></button>
                            <button
                                class="border-2 border-gray-300 ml-1 bg-gray-700 rounded-full w-6 h-6 focus:outline-none"></button>
                            <button
                                class="border-2 border-gray-300 ml-1 bg-indigo-500 rounded-full w-6 h-6 focus:outline-none"></button>
                        </div> --}}
                        <div class="form-control">
                            <label class="label">
                            </label>
                            <label class="input-group h-5">
                                <span class="p-0 bg-transparent cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg"
                                        id="product_decrement" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                    </svg>

                                </span>
                                <input type="text" value="1" readonly id="product_quantity"
                                    class="w-20 input text-center font-bold h-5 focus:outline-none text-gray-600" />
                                <input type="hidden" name="" value="{{ $single_product->id }}" id="product_id">
                                <span class="p-0 bg-transparent cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg"
                                        id="product_increment" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </span>
                            </label>
                        </div>
                        {{-- <div class="flex ml-6 items-center">
                            <span class="mr-3">Size</span>
                            <div class="relative">
                                <select
                                    class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                    <option>SM</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                                <span
                                    class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6"></path>
                                    </svg>
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    <div class="flex">
                        <p class="font-bold text-xl text-[#fb5d5d]">
                            <b>৳</b><span>{{ $single_product->product_price }}</span>
                        </p>
                        <button class="flex ml-auto text-white bg-primary border-0 py-2 px-6 focus:outline-none rounded"
                            id="add_to_cart">Add to
                            cart</button>
                        <button
                            class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 hover:text-primary ml-4">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($related_products) > 0)
        <section>
            <div class="container">
                <h2 class="text-3xl font-bold text-center text-primary mb-10">Related Products</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($related_products as $related_product)
                        <div class="card card-compact bg-base-100 shadow-xl">
                            <a href="{{ route('product.details', $related_product->id) }}" class="cursor-pointer">
                                <figure><img src="https://placeimg.com/400/225/arch" class="rounded" alt="Shoes" />
                                </figure>
                            </a>
                            <div class="card-body">
                                <h2 class="text-2xl uppercase text-gray-900 font-bold">
                                    {{ $related_product->product_name }}
                                </h2>
                                <p class="uppercase text-sm text-gray-500">{{ $related_product->description }}</p>
                                <p class="font-bold text-xl text-[#fb5d5d]">
                                    <b>৳</b><span>{{ $related_product->product_price }}</span>
                                </p>
                                <div class="card-actions justify-center">
                                    <a href="{{ route('product.details', $related_product->id) }}"
                                        class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-red-500 hover:text-white border-2 border-red-500 focus:outline-none">
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

@endsection
@section('footer_script')
    <script>
        $('#product_increment').click(function() {
            $('#product_quantity').get(0).value++
        });
        $('#product_decrement').click(function() {
            const quantity_curr = $('#product_quantity').val();
            if (quantity_curr > 1) {
                $('#product_quantity').get(0).value--
            }
        })
    </script>
    <script>
        $('#add_to_cart').click(function() {
            const product_id = $('#product_id').val();
            const quantity_curr = $('#product_quantity').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('add.cart') }}",
                data: {
                    product_id: product_id,
                    quantity: quantity_curr,
                },
                success: function(data) {
                    alert(data)
                }
            });

        });
    </script>
@endsection
