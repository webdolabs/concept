<?php

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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });

    Route::get('user/list', \App\Http\Livewire\User\Users::class);
    Route::get('user/profile', \App\Http\Livewire\User\Profile::class)->name('profile.show');

    Route::group(['prefix' => 'ecommerce'], function () {
        Route::get('orders', \App\Http\Livewire\Ecommerce\Orders::class);
        Route::get('items', \App\Http\Livewire\Ecommerce\Items::class);
        Route::get('settings/{page}', \App\Http\Livewire\Ecommerce\Settings::class);

        Route::get('invoice/generate/{id}', [\App\Http\Controllers\Ecommerce\InvoiceController::class, 'generate']);
        Route::get('invoice/show/{id}', [\App\Http\Controllers\Ecommerce\InvoiceController::class, 'show']);
    });

    Route::group(['prefix' => 'collection'], function () {
        Route::get('{collection}/index', \App\Http\Livewire\Collection\Index::class);
        //Route::get('{collection}/create/{lang}', \App\Http\Livewire\Collection\Create::class);
        Route::get('{collectionName}/edit/{lang}/{uid?}', \App\Http\Livewire\Collection\Edit::class);
    });
});

Route::get('import/orders', [\App\Http\Controllers\Tools\ImportFromPrevVersionController::class, 'importOrders']);

Route::get('/test', App\Http\Livewire\Upload::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
