<div class="drawer-side">
    <label for="my-drawer-2" class="drawer-overlay "></label>
    <ul class="menu p-4 overflow-y-auto w-80 bg-white text-base-content">
        <!-- Sidebar content here -->
        <li><a class="{{ Route::currentRouteName() == 'category.form' ? 'active' : '' }}"
                href="{{ route('category.form') }}">Category</a></li>
        <li><a class="{{ Route::currentRouteName() == 'subcategory.create' ? 'active' : '' }}"
                href="{{ route('subcategory.create') }}">Subcategory</a></li>
        <li><a class="{{ Route::currentRouteName() == 'product.form' ? 'active' : '' }}"
                href="{{ route('product.form') }}">Product</a></li>
        <li><a class="{{ Route::currentRouteName() == 'view.product' ? 'active' : '' }}"
                href="{{ route('view.product') }}">View Products</a></li>
    </ul>
</div>
