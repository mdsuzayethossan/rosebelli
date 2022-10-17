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
                <a class="tab tab-lifted tab-active">Tab 1</a>
                <a class="tab tab-lifted">Tab 2</a>
                <a class="tab tab-lifted">Tab 3</a>
            </div>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="card card-compact bg-base-100 shadow-xl">
                        <a href="{{ route('product.details', $product->id) }}" class="cursor-pointer">
                            <figure><img src="https://placeimg.com/400/225/arch" class="rounded" alt="Shoes" /></figure>
                        </a>
                        <div class="card-body">
                            <h2 class="text-2xl uppercase text-gray-900 font-bold">Shoes!</h2>
                            <p class="uppercase text-sm text-gray-500">If a dog chews shoes whose shoes does he choose?</p>
                            <p class="font-bold text-xl text-[#fb5d5d]"><b>৳</b><span>400</span></p>
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
@endsection
