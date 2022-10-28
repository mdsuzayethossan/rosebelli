@extends('layouts.admin')
@section('content')
    <div class="product-container w-11/12 mx-auto">
        <div class="navbar bg-primary mt-5 rounded">
            <div class="flex-1">
                <a class="btn btn-ghost normal-case text-xl text-white">Products</a>
            </div>
            <div class="flex-none gap-2">
                <div class="form-control lg:w-[500px]">
                    <input type="text" placeholder="Search" class="input focus:outline-0" />
                </div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="https://placeimg.com/80/80/people" />
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="justify-between">
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- product show edit delete --}}
        <div class="overflow-x-auto mt-5 w-full">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product ID</th>
                        <th>Product Slug</th>
                        <th>Size</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($ordered_products as $ordered_product)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $ordered_product->product_id }}</td>
                            <td>{{ $ordered_product->product->product_id }}</td>
                            <td>
                                @if ($ordered_product->size)
                                    {{ $ordered_product->size }}
                                @else
                                    {{ 'None' }}
                                @endif
                            </td>
                            <td>{{ $ordered_product->product_price }}</td>
                            <td>{{ $ordered_product->quantity }}</td>
                            <td>{{ $ordered_product->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
