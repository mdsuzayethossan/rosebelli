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
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subtotal</th>
                        <th>Total Price</th>
                        <th>Shipping</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>Order Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($orders as $order)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->subtotal }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->delivery_charge }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->message }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="flex h-20 items-center">
                                <label for="my-modal-{{ $order->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </label>

                                <label for="my-modal-delete{{ $order->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </label>
                                <label for="my-modal-delete{{ $order->id }}">
                                    <a href="{{ route('ordered.products', $order->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>

                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
