@extends('layouts.master')
@section('banner')
    <section>
        <div class="container">
            <div class="w-full">
                <div class="max-w-full hero-content flex-col lg:flex-row-reverse">
                    <div class="w-3/5">
                        <div class="carousel carousel-center p-5 space-x-4 shadow rounded-box">
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                            <div class="carousel-item">
                                <img src="https://placeimg.com/250/180/arch" class="rounded-box" />
                            </div>
                        </div>
                    </div>
                    <div class="w-2/5">
                        <h1 class="text-5xl font-bold">Box Office News!</h1>
                        <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                            exercitationem
                            quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                        <button
                            class="px-6 bg-red-500 py-2 text-white transition ease-in duration-200 uppercase rounded-full border-2 border-red-500 focus:outline-none">
                            Shop Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <section class="mt-20">
        <div class="container">
            <div class="tabs justify-center mb-10">
                @foreach ($categories as $category)
                    @if ($category == $category->first())
                        <button id="{{ $category->id }}"
                            class="tab tab-lifted tab-active category_filter">{{ $category->category_name }}</button>
                    @else
                        <button id="{{ $category->id }}"
                            class="tab tab-lifted category_filter">{{ $category->category_name }}</button>
                    @endif
                @endforeach
            </div>
            <div class="grid grid-cols-3 gap-4" id="product_container">
                @foreach ($products as $product)
                    <div class="card card-compact bg-base-100 shadow-xl">
                        <a href="{{ route('product.details', $product->id) }}" class="cursor-pointer">
                            <img class="w-full" src="{{ asset('uploads/products') }}/{{ $product->product_image }}"
                                class="rounded" alt="Shoes" />
                        </a>
                        <div class="card-body">
                            <h2 class="text-2xl uppercase text-gray-900 font-bold">{{ $product->product_name }}</h2>
                            <p class="uppercase text-sm text-gray-500">{{ $product->description }}</p>
                            <div class="flex gap-4 w-14 items-center">
                                <p class="font-bold text-lg text-[#fb5d5d]">
                                    <b>৳</b><span>{{ $product->discount_price }}</span>
                                </p>
                                <p class="font-semibold text-md text-gray-500">
                                    <del><b>৳</b><span>{{ $product->product_price }}</span></del>
                                </p>
                            </div>
                            <div class="card-actions justify-center">
                                <a href="{{ route('product.details', $product->id) }}"
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
@endsection
@section('footer_script')
    <script>
        $('.tab-lifted').click(function() {
            $('.tab-lifted').removeClass('tab-active');
            $(this).addClass("tab-active");
        });
    </script>
    <script>
        $('.category_filter').click(function() {
            const category_id = $(this).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('filter.on.category') }}",
                data: {
                    category_id: category_id,
                },
                success: function(data) {
                    $('#product_container').html(data);
                }
            });

        });
    </script>
@endsection
