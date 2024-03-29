<?php

use App\Http\Controllers\AdminGeneralController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [FrontendController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//category
Route::prefix('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'create')->name('category.form');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/update', 'category_update')->name('category.update');
        Route::get('/category/delete/${id}', 'category_delete')->name('category.delete');
        Route::get('/category/restore/${id}', 'category_restore')->name('category.restore');
        Route::get('/category/forece/delete/${id}', 'category_forece_delete')->name('category.force.delete');
    });
    Route::resource('subcategory', SubCategoryController::class);
    Route::delete('/subcategory/forece/delete', [SubCategoryController::class, 'subcategory_forcedelete'])->name('subcategory.forece.delete');
    Route::get('/subcategory/restore/${id}', [SubCategoryController::class, 'restore'])->name('subcategory.restore');
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'create')->name('product.form');
        Route::post('/getsubcategory', 'get_subcategory')->name('get.subcategory');
        Route::post('/product-store', 'store')->name('product.store');
        Route::post('/product-update', 'pruduct_update')->name('product.update');
        Route::delete('/product-delete', 'pruduct_delete')->name('product.delete');
        Route::delete('/product-force-delete', 'pruduct_force_delete')->name('product.force.delete');
        Route::get('/product/restore/${id}', 'product_restore')->name('product.restore');
        Route::get('/view/products', 'view_product')->name('view.product');
    });
    Route::controller(AdminGeneralController::class)->group(function () {
        Route::get('/banner', 'banner')->name('banner');
        Route::get('/view-orders', 'view_order')->name('view.order');
        Route::get('/ordered-products/${id}', 'ordered_products')->name('ordered.products');
        Route::post('/banner-store', 'banner_store')->name('banner.store');
        Route::get('/banner-update', 'banner_update')->name('banner.update');
    });
});


//Frontend routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});
Route::controller(FrontendController::class)->group(function () {
    Route::post('/add-cart', 'add_cart')->name('add.cart');
    Route::post('/filter-on-category', 'filter_on_category')->name('filter.on.category');
});
Route::controller(ProductDetailsController::class)->group(function () {
    Route::get('/product-details/${id}', 'details')->name('product.details');
});
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'cart')->name('cart');
    Route::post('/cart/update', 'cart_update')->name('cart.update');
    Route::get('/cart/delete/${id}', 'cart_delete')->name('cart.delete');
    Route::get('/checkout', 'checkout')->name('checkout');
});
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/order', 'order')->name('order');
});


require __DIR__ . '/auth.php';
