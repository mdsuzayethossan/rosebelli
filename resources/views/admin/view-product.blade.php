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
                            <a class="justify-between">
                                Profile
                                <span class="badge">New</span>
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li><a>Logout</a></li>
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
                        <th>Category Name</th>
                        <th>Subategory Name</th>
                        <th>Product Name</th>
                        <th>Group</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Discount price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($products as $product)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>
                                @if ($product->categories)
                                    {{ $product->categories->category_name }}
                                @endif
                            </td>
                            <td>
                                @if ($product->subcategories)
                                    {{ $product->subcategories->subcategory_name }}
                                @endif
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_group }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>{{ \Illuminate\Support\Str::words($product->description, 10, '...') }}</td>
                            <td><img src="{{ asset('uploads/products') }}/{{ $product->product_image }}" alt="">
                            </td>
                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                            <td>{{ $product->updated_at->format('d-m-Y') }}</td>
                            <td class="flex h-20 items-center">
                                <label for="my-modal-{{ $product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </label>

                                <label for="my-modal-delete{{ $product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </label>
                            </td>
                        </tr>
                        {{-- product edit start here  --}}
                        <input type="checkbox" id="my-modal-{{ $product->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box max-w-screen-lg fixed right-20">
                                <form action="{{ route('product.update') }}" enctype="multipart/form-data" class="w-11/12"
                                    method="POST">
                                    @csrf
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <div
                                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 text-center">
                                                <div>
                                                    <select
                                                        class="select w-full max-w-xs border-2 focus:outline-none border-gray-300 category_change"
                                                        id="" name="category">
                                                        <option disabled selected>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <select
                                                        class="select w-full max-w-xs border-2 focus:outline-none border-gray-300 set_subcategory"
                                                        id="" name="subcategory">
                                                    </select>
                                                </div>

                                                <div><input type="text" placeholder="Product name" name="product_name"
                                                        class="input border-2 focus:outline-none border-gray-300 w-full max-w-xs" />

                                                </div>
                                                <div>
                                                    <input type="text" placeholder="Product group" name="product_group"
                                                        class="input border-2 focus:outline-none border-gray-300 w-full max-w-xs" />
                                                </div>
                                                <div>
                                                    <input type="number" placeholder="Product price" name="product_price"
                                                        class="input border-2 focus:outline-none border-gray-300 w-full max-w-xs" />
                                                </div>
                                                <div>
                                                    <input type="number" placeholder="Discount percentage" name="discount"
                                                        class="input border-2 focus:outline-none border-gray-300 w-full max-w-xs" />

                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="px-2">
                                                    <textarea name="description" class="textarea border-2 min-h-[8.8rem] focus:outline-none border-gray-300 w-full"
                                                        placeholder="Product description"></textarea>

                                                </div>
                                                <div class="px-2">
                                                    <div
                                                        class="relative h-[8.8rem] rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                                        <div class="absolute">
                                                            <div class="flex flex-col items-center ">
                                                                <input type="file" name="product_image"
                                                                    class="block w-full text-sm text-slate-500
                                                                file:mr-4 file:py-2 file:px-4
                                                                file:rounded-full file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-violet-50 file:text-violet-700
                                                                hover:file:bg-violet-100
                                                              " />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                            <button type="submit"
                                                class="inline-flex justify-center py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-action">
                                    <label for="my-modal-{{ $product->id }}" class="btn"><svg
                                            class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" viewBox="0 0 512 512">
                                            <polygon
                                                points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                        </svg></label>
                                </div>
                            </div>
                        </div>
                        {{-- product edit end here --}}
                        {{-- product delete start here  --}}
                        <input type="checkbox" id="my-modal-delete{{ $product->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box text-center">
                                <h3 class="font-bold text-lg">Are you sure you want to delete this item?</h3>
                                <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="delete_id" value="{{ $product->id }}">
                                        <button type="submit"
                                            class="inline-flex justify-center cursor-pointer py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Sure
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-action">
                                    <label for="my-modal-delete{{ $product->id }}" class="btn"><svg
                                            class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                            width="32" height="32" viewBox="0 0 512 512">
                                            <polygon
                                                points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                        </svg></label>
                                </div>
                            </div>
                        </div>
                        {{-- Product delete end here --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- product show edit delete --}}
        <h2 class="text-2xl bg-primary opacity-100 text-white w-full text-center py-4 font-bold uppercase my-20">Trashed
            products
        </h2>
        {{-- trsahed products restore forcedelete --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category Name</th>
                        <th>Subategory Name</th>
                        <th>Product Name</th>
                        <th>Group</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Discount price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($trashed_products as $trashed_product)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>
                                @if ($trashed_product->categories)
                                    {{ $trashed_product->categories->category_name }}
                                @endif
                            </td>
                            <td>
                                @if ($trashed_product->subcategories)
                                    {{ $trashed_product->subcategories->subcategory_name }}
                                @endif
                            </td>
                            <td>{{ $trashed_product->product_name }}</td>
                            <td>{{ $trashed_product->product_group }}</td>
                            <td>{{ $trashed_product->product_price }}</td>
                            <td>{{ $trashed_product->discount }}</td>
                            <td>{{ $trashed_product->discount_price }}</td>
                            <td>{{ \Illuminate\Support\Str::words($trashed_product->description, 10, '...') }}</td>
                            <td><img src="{{ asset('uploads/products') }}/{{ $trashed_product->product_image }}"
                                    alt=""></td>
                            <td>{{ $trashed_product->created_at->format('d-m-Y') }}</td>
                            <td>{{ $trashed_product->updated_at->format('d-m-Y') }}</td>
                            <td class="flex h-20 items-center">
                                <label for="my-modal-restore{{ $trashed_product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </label>

                                <label for="my-modal-delete{{ $trashed_product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </label>
                            </td>
                        </tr>
                        {{-- Trashed product delete start here  --}}
                        <input type="checkbox" id="my-modal-delete{{ $trashed_product->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box text-center">
                                <h3 class="font-bold text-lg">Are you sure you want to delete this item?</h3>
                                <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                    <form action="{{ route('product.force.delete', $trashed_product->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="delete_id" value="{{ $trashed_product->id }}">
                                        <button type="submit"
                                            class="inline-flex justify-center cursor-pointer py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Sure
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-action">
                                    <label for="my-modal-delete{{ $trashed_product->id }}" class="btn"><svg
                                            class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                            width="32" height="32" viewBox="0 0 512 512">
                                            <polygon
                                                points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                        </svg></label>
                                </div>
                            </div>
                        </div>
                        {{-- Trashed Product delete end here --}}
                        {{-- Trashed product delete start here  --}}
                        <input type="checkbox" id="my-modal-restore{{ $trashed_product->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box text-center">
                                <h3 class="font-bold text-lg">Are you sure you want to delete this item?</h3>
                                <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                    <a href="{{ route('product.restore', $trashed_product->id) }}"
                                        class="inline-flex justify-center cursor-pointer py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sure
                                    </a>
                                </div>
                                <div class="modal-action">
                                    <label for="my-modal-restore{{ $trashed_product->id }}" class="btn"><svg
                                            class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                            width="32" height="32" viewBox="0 0 512 512">
                                            <polygon
                                                points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                        </svg></label>
                                </div>
                            </div>
                        </div>
                        {{-- Trashed Product delete end here --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- trshed products restore forcedelete --}}
    </div>
@endsection
