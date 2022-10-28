<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto mt-5 w-full">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product ID</th>
                                    <th>Product Slug</th>
                                    <th>Order Id</th>
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
                                        <td>{{ $ordered_product->order_id }}</td>
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
            </div>
        </div>
    </div>
</x-app-layout>
