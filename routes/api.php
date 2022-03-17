<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;


/*
Route::get("/products", function(){
    return Product::all();
});

Route::post("/products", function(){
    return Product::create([
        "name" => "Product One",
        "slug" => "Product-One",
        "description" => "Ceci est une description",
        "price" => "78.8",
    ]);
});
*/

//Route::resource("products", ProductController::class);

//Public routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::get("products/search/{name}", [ProductController::class, "search"]);
Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/{id}", [ProductController::class, "show"]);


//protected routes
Route::middleware(["auth:sanctum"])->group(function(){
    Route::post("/products", [ProductController::class, "store"]);
    Route::put("/products/{id}", [ProductController::class, "update"]);
    Route::delete("/products/{id}", [ProductController::class, "destroy"]);

    //deconnexion
    Route::post("/logout", [AuthController::class, "logout"]);
});

//others method to protect routes
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
