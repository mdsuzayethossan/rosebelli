@extends('layouts.admin')
@section('content')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-center mt-5">
            <!-- Page content here -->

            <form action="{{ route('subcategory.store') }}" method="POST">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
                            <div>
                                <select class="select w-full max-w-xs border-2 focus:outline-none border-gray-300"
                                    name="category_id">
                                    <option disabled selected>Slect Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-warning shadow-lg mt-2">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <input type="text" placeholder="Subcategory name" name="subcategory_name"
                                    class="input border-2 focus:outline-none border-gray-300 w-full max-w-xs" />
                                @error('subcategory_name')
                                    <div class="alert alert-warning shadow-lg mt-2">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 cursor-pointer px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto mt-5">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Subcategory Name</th>
                            <th>Category Name</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>
                                    @if ($subcategory->subcategories)
                                        {{ $subcategory->subcategories->category_name }}
                                    @endif
                                </td>
                                <td>{{ $subcategory->created_at->format('d-m-Y') }}</td>
                                <td>{{ $subcategory->updated_at->format('d-m-Y') }}</td>
                                <td class="flex">
                                    <label for="my-modal-{{ $subcategory->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </label>

                                    <label for="my-modal-delete{{ $subcategory->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </label>
                                </td>
                            </tr>
                            {{-- Category edit start here  --}}
                            <input type="checkbox" id="my-modal-{{ $subcategory->id }}" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box">
                                    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="sm:rounded-md sm:overflow-hidden">
                                            <input type="hidden" name="id" value="{{ $subcategory->id }}">
                                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                <div class="grid grid-cols-1 gap-4">
                                                    <div>
                                                        <input type="text" placeholder="Subcategory name"
                                                            name="subcategory_name"
                                                            value="{{ $subcategory->subcategory_name }}"
                                                            class="input border-2 focus:outline-none border-gray-300 shadow-none w-full max-w-xs" />
                                                        @error('subcategory_name')
                                                            <div class="alert alert-warning shadow-lg mt-2">
                                                                <div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="stroke-current flex-shrink-0 h-6 w-6"
                                                                        fill="none" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                    </svg>
                                                                    <span>{{ $message }}</span>
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                                <button type="submit"
                                                    class="inline-flex justify-center py-2 px-7 cursor-pointer border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-action">
                                        <label for="my-modal-{{ $subcategory->id }}" class="btn"><svg
                                                class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- subcategory edit end here --}}
                            {{-- subcategory delete start here  --}}
                            <input type="checkbox" id="my-modal-delete{{ $subcategory->id }}" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box text-center">
                                    <h3 class="font-bold text-lg">Are you sure you want to delete this item?</h3>
                                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                        <form action="{{ route('subcategory.destroy', $subcategory->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex cursor-pointer justify-center py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Sure
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-action">
                                        <label for="my-modal-delete{{ $subcategory->id }}" class="btn"><svg
                                                class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- subcategory delete end here --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- trashed subcategories start here --}}
            <div class="overflow-x-auto mt-5">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Subcategory Name</th>
                            <th>Category Name</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($trashed_subcategories as $trashed_subcategory)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $trashed_subcategory->subcategory_name }}</td>
                                <td>
                                    @if ($trashed_subcategory->subcategories)
                                        {{ $trashed_subcategory->subcategories->category_name }}
                                    @endif
                                </td>
                                <td>{{ $trashed_subcategory->created_at->format('d-m-Y') }}</td>
                                <td>{{ $trashed_subcategory->updated_at->format('d-m-Y') }}</td>
                                <td class="flex">
                                    <label for="my-modal-restore-{{ $trashed_subcategory->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>

                                    </label>

                                    <label for="my-modal-force-delete{{ $trashed_subcategory->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </label>
                                </td>
                            </tr>
                            {{-- subcategory restore start here  --}}
                            <input type="checkbox" id="my-modal-restore-{{ $trashed_subcategory->id }}"
                                class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box text-center">
                                    <h3 class="font-bold text-lg">Are you sure you want to restore this item?</h3>
                                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                        <a href="{{ route('subcategory.restore', $trashed_subcategory->id) }}"
                                            type="submit"
                                            class="inline-flex cursor-pointer justify-center py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Sure
                                        </a>
                                    </div>
                                    <div class="modal-action">
                                        <label for="my-modal-restore-{{ $trashed_subcategory->id }}" class="btn"><svg
                                                class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- subcategory restore end here --}}


                            {{-- subcategory force delete start here  --}}
                            <input type="checkbox" id="my-modal-force-delete{{ $trashed_subcategory->id }}"
                                class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box text-center">
                                    <h3 class="font-bold text-lg">Are you sure you want to permanently delete this item?
                                    </h3>
                                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                        <form action="{{ route('subcategory.forece.delete', $trashed_subcategory->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="delete_id"
                                                value="{{ $trashed_subcategory->id }}">
                                            <button type="submit"
                                                class="inline-flex justify-center cursor-pointer py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Sure
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-action">
                                        <label for="my-modal-force-delete{{ $trashed_subcategory->id }}"
                                            class="btn"><svg class="swap-on fill-current"
                                                xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- subcategory force delete end here --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- trashed subcategories end here --}}

        </div>
        @include('layouts.sidebar')
    </div>
@endsection
@section('footer_script')
    @if (session('insert'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('insert') }}'
            })
        </script>
    @endif
    @if (session('subnameexist'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('subnameexist') }}'
            })
        </script>
    @endif
    @if (session('updated'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('updated') }}'
            })
        </script>
    @endif
    @if (session('delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('delete') }}'
            })
        </script>
    @endif
    @if (session('force_delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('force_delete') }}'
            })
        </script>
    @endif
    @if (session('restore'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('restore') }}'
            })
        </script>
    @endif
@endsection
