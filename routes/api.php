<?php

use Illuminate\Http\Request;
use App\User;
use App\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('test/{id}', function($id) {
//     // If the Content-Type and Accept headers are set to 'application/json', 
//     // this will return a JSON structure. This will be cleaned up later.
//     return User::find($id);
//     // return Response::json(array(User::all()));
// });

// Route::post('register', ['uses' => 'Auth\RegisterController@register']);

// Route::get('products', function() {
//     return response(Product::all(), 200);
// });

// Route::get('products/{product}', function ($productId) {
//     return response(Product::find($productId), 200);
// });

// Route::post('products', function(Request $request) {
//     $resp = Product::create($request->all());
//     return response()->json($resp, 200);
// });

// Route::put('products/{product}', function(Request $request, $productId) {
//     $product = Product::findOrFail($productId);
//     $product->update($request->all());
//     return $product;
// });

// Route::delete('products/{product}', function(Request $request, $productId) {
//     $product = Product::findOrFail($productId);
//     $product->delete();
//     return response()->json(null, 204);
// });

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('details', 'UserController@details');
});

Route::get('products', 'ProductsController@index');

Route::get('products/{productId}', 'ProductsController@show');

Route::post('products', 'ProductsController@store');

Route::put('products/{product}', 'ProductsController@update');

Route::delete('products/{product}', 'ProductsController@delete');

