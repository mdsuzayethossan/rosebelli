@extends('layouts.admin')
@section('content')
    <div class="drawer drawer-mobile mb-10">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-center mt-5">
            <!-- Page content here -->

            <form action="{{ route('banner.store') }}" method="POST">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <input type="text" placeholder="Banner title" required name="banner_title"
                                    class="input border-2 focus:outline-none border-gray-300 shadow-none w-full max-w-xs" />
                            </div>
                            <div>
                                <input type="text" required placeholder="Type button name" name="banner_button"
                                    class="input border-2 focus:outline-none border-gray-300 shadow-none w-full max-w-xs" />
                            </div>
                            <div class="md:col-span-2">
                                <input type="text" required placeholder="Enter button link" name="banner_link"
                                    class="input border-2 focus:outline-none border-gray-300 shadow-none w-full" />
                            </div>
                            <div class="md:col-span-2">
                                <textarea name="description" required class="textarea border-2 w-full focus:outline-0 border-gray-300"
                                    placeholder="Description"></textarea>
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

            <div class="overflow-x-auto mt-5">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Banner Title</th>
                            <th>Button Name</th>
                            <th>Button Link</th>
                            <th>Description</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($banners as $banner)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->btn_name }}</td>
                                <td>{{ $banner->btn_link }}</td>
                                <td>{{ $banner->description }}</td>
                                <td>{{ $banner->created_at->format('d-m-Y') }}</td>
                                <td class="flex">
                                    <label for="my-modal-{{ $banner->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </label>

                                    <label for="my-modal-delete{{ $banner->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </label>
                                </td>
                            </tr>
                            {{-- Category edit start here  --}}
                            <input type="checkbox" id="my-modal-{{ $banner->id }}" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box">
                                    <form action="{{ route('banner.update') }}" method="PUT">
                                        @csrf
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                            <input type="hidden" name="id" value="{{ $banner->id }}">
                                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                <div class="grid md:grid-cols-2 gap-4">
                                                    <div>
                                                        <input type="text" placeholder="Banner title" name="banner_title"
                                                            class="input border-2 focus:outline-none border-gray-300 shadow-none w-full max-w-xs" />
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Type button name"
                                                            name="banner_button"
                                                            class="input border-2 focus:outline-none border-gray-300 shadow-none w-full max-w-xs" />
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <input type="text"placeholder="Enter button link"
                                                            name="banner_link"
                                                            class="input border-2 focus:outline-none border-gray-300 shadow-none w-full" />
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <textarea name="description" class="textarea border-2 w-full focus:outline-0 border-gray-300" placeholder="Description"></textarea>
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
                                        <label for="my-modal-{{ $banner->id }}" class="btn"><svg
                                                class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- Category edit end here --}}
                            {{-- Category delete start here  --}}
                            <input type="checkbox" id="my-modal-delete{{ $banner->id }}" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box text-center">
                                    <h3 class="font-bold text-lg">Are you sure you want to delete this item?</h3>
                                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                                        <a href="{{ route('category.delete', $banner->id) }}" type="submit"
                                            class="inline-flex justify-center py-2 px-7 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Sure
                                        </a>
                                    </div>
                                    <div class="modal-action">
                                        <label for="my-modal-delete{{ $banner->id }}" class="btn"><svg
                                                class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" viewBox="0 0 512 512">
                                                <polygon
                                                    points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                                            </svg></label>
                                    </div>
                                </div>
                            </div>
                            {{-- Category delete end here --}}
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @include('layouts.sidebar')
    </div>
@endsection

@section('footer_script_admin')
    @if (session('banner_insert'))
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
                title: '{{ session('banner_insert') }}'
            })
        </script>
    @endif
    @if (session('banner_update'))
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
                title: '{{ session('banner_update') }}'
            })
        </script>
    @endif
    @if (session('notUpdatedbanner'))
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
                icon: 'warning',
                title: '{{ session('notUpdatedbanner') }}'
            })
        </script>
    @endif
@endsection
